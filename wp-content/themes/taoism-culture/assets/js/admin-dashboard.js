/**
 * Admin Dashboard Scripts
 *
 * @package Taoism_Culture
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        initSalesChart();
        refreshDashboardData();
    });

    /**
     * Initialize Sales Chart
     */
    function initSalesChart() {
        const canvas = document.getElementById('taoism-sales-chart');
        
        if (!canvas || typeof Chart === 'undefined') {
            return;
        }

        if (!taoismDashboard || !taoismDashboard.salesData) {
            return;
        }

        const ctx = canvas.getContext('2d');
        const salesData = taoismDashboard.salesData;

        const gradient = ctx.createLinearGradient(0, 0, 0, 150);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
        gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: salesData.labels,
                datasets: [{
                    label: 'Sales',
                    data: salesData.values,
                    backgroundColor: gradient,
                    borderColor: 'rgb(99, 102, 241)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgb(99, 102, 241)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: 'rgb(99, 102, 241)',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: {
                            size: 13,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 14,
                            weight: '700'
                        },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += taoismDashboard.currency + context.parsed.y.toFixed(2);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10,
                            color: '#6b7280',
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return taoismDashboard.currency + value.toFixed(0);
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10,
                            color: '#6b7280',
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    /**
     * Refresh Dashboard Data
     * Auto-refresh every 5 minutes
     */
    function refreshDashboardData() {
        setInterval(function() {
            // Check if we're on the dashboard page
            if ($('#dashboard-widgets').length === 0) {
                return;
            }

            // Reload specific widgets via AJAX
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'taoism_refresh_dashboard',
                    nonce: taoismDashboard.nonce
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Dashboard data refreshed');
                    }
                }
            });
        }, 300000); // 5 minutes
    }

    /**
     * Add loading state to widgets
     */
    function showWidgetLoading(widgetId) {
        const widget = $('#' + widgetId + ' .inside');
        widget.html('<div class="dashboard-loading">Loading...</div>');
    }

    /**
     * Remove loading state from widgets
     */
    function hideWidgetLoading(widgetId, content) {
        const widget = $('#' + widgetId + ' .inside');
        widget.html(content);
    }

    /**
     * Animate numbers (count up effect)
     */
    function animateNumber(element, target) {
        const $element = $(element);
        const start = 0;
        const duration = 1000;
        const startTime = Date.now();

        function update() {
            const currentTime = Date.now();
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const current = Math.floor(start + (target - start) * easeOutQuad(progress));
            
            $element.text(current);
            
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        function easeOutQuad(t) {
            return t * (2 - t);
        }

        update();
    }

    /**
     * Initialize number animations
     */
    $('.stat-value, .stat-box strong, .stat-info h4').each(function() {
        const $this = $(this);
        const target = parseInt($this.text().replace(/[^0-9]/g, ''));
        
        if (!isNaN(target) && target > 0) {
            $this.text('0');
            setTimeout(function() {
                animateNumber($this, target);
            }, 100);
        }
    });

    /**
     * Add tooltips to dashboard elements
     */
    if (typeof $.fn.tooltip !== 'undefined') {
        $('[data-tooltip]').tooltip({
            position: {
                my: 'center bottom-10',
                at: 'center top'
            }
        });
    }

    /**
     * Handle widget actions
     */
    $(document).on('click', '.dashboard-widget-action', function(e) {
        e.preventDefault();
        
        const action = $(this).data('action');
        const widgetId = $(this).closest('.postbox').attr('id');
        
        // Handle different actions
        switch(action) {
            case 'refresh':
                refreshWidget(widgetId);
                break;
            case 'export':
                exportWidgetData(widgetId);
                break;
        }
    });

    /**
     * Refresh individual widget
     */
    function refreshWidget(widgetId) {
        showWidgetLoading(widgetId);
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'taoism_refresh_widget',
                widget_id: widgetId,
                nonce: taoismDashboard.nonce
            },
            success: function(response) {
                if (response.success) {
                    hideWidgetLoading(widgetId, response.data.content);
                }
            },
            error: function() {
                hideWidgetLoading(widgetId, '<div class="dashboard-empty"><p>Error loading widget data.</p></div>');
            }
        });
    }

    /**
     * Export widget data
     */
    function exportWidgetData(widgetId) {
        // Create a temporary form to submit
        const form = $('<form>', {
            method: 'POST',
            action: ajaxurl,
            target: '_blank'
        });

        form.append($('<input>', {
            type: 'hidden',
            name: 'action',
            value: 'taoism_export_widget'
        }));

        form.append($('<input>', {
            type: 'hidden',
            name: 'widget_id',
            value: widgetId
        }));

        form.append($('<input>', {
            type: 'hidden',
            name: 'nonce',
            value: taoismDashboard.nonce
        }));

        $('body').append(form);
        form.submit();
        form.remove();
    }

    /**
     * Make widgets sortable (enhance WordPress default)
     */
    if (typeof $.fn.sortable !== 'undefined') {
        $('#dashboard-widgets .meta-box-sortables').sortable({
            handle: '.hndle',
            cursor: 'move',
            placeholder: 'sortable-placeholder',
            opacity: 0.7,
            tolerance: 'pointer',
            start: function(e, ui) {
                ui.placeholder.height(ui.item.height());
            }
        });
    }

    /**
     * Add smooth scroll to dashboard
     */
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 32
            }, 500);
        }
    });

})(jQuery);

