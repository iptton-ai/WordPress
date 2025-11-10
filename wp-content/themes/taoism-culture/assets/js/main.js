/**
 * Main JavaScript
 *
 * @package Taoism_Culture
 */

(function($) {
    'use strict';

    // Dark Mode Toggle
    function initDarkMode() {
        const darkModeToggle = $('#dark-mode-toggle');
        const body = $('body');
        
        // Check for saved preference or default to dark mode
        const currentMode = localStorage.getItem('darkMode') || 'dark';
        
        if (currentMode === 'dark') {
            body.addClass('dark-mode');
            darkModeToggle.prop('checked', true);
        } else {
            body.removeClass('dark-mode');
            darkModeToggle.prop('checked', false);
        }
        
        // Toggle dark mode
        darkModeToggle.on('change', function() {
            if ($(this).is(':checked')) {
                body.addClass('dark-mode');
                localStorage.setItem('darkMode', 'dark');
                document.cookie = 'dark_mode=true; path=/; max-age=31536000';
            } else {
                body.removeClass('dark-mode');
                localStorage.setItem('darkMode', 'light');
                document.cookie = 'dark_mode=false; path=/; max-age=31536000';
            }
        });
    }

    // Mobile Menu Toggle
    function initMobileMenu() {
        const menuToggle = $('#mobile-menu-toggle');
        const mobileMenu = $('#mobile-menu');
        const menuClose = $('#mobile-menu-close');
        
        menuToggle.on('click', function(e) {
            e.stopPropagation();
            mobileMenu.removeClass('hidden');
            $('body').css('overflow', 'hidden');
        });
        
        // Close menu when clicking close button
        menuClose.on('click', function() {
            mobileMenu.addClass('hidden');
            $('body').css('overflow', '');
        });
        
        // Close menu when clicking a link
        $('#mobile-menu a').on('click', function() {
            mobileMenu.addClass('hidden');
            $('body').css('overflow', '');
        });
        
        // Close menu when pressing Escape
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && !mobileMenu.hasClass('hidden')) {
                mobileMenu.addClass('hidden');
                $('body').css('overflow', '');
            }
        });
    }

    // Smooth Scroll
    function initSmoothScroll() {
        $('a[href*="#"]:not([href="#"])').on('click', function(e) {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') 
                && location.hostname === this.hostname) {
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 800);
                }
            }
        });
    }

    // Lazy Load Images
    function initLazyLoad() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.dataset.src;
                        
                        if (src) {
                            img.src = src;
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // Scroll to Top Button
    function initScrollToTop() {
        const scrollTopBtn = $('#scroll-to-top');
        
        if (scrollTopBtn.length) {
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 300) {
                    scrollTopBtn.fadeIn();
                } else {
                    scrollTopBtn.fadeOut();
                }
            });
            
            scrollTopBtn.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 600);
            });
        }
    }

    // Hero Carousel
    function initHeroCarousel() {
        const carousel = $('.hero-carousel');
        
        if (carousel.length && typeof Swiper !== 'undefined') {
            new Swiper('.hero-carousel', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
            });
        }
    }

    // Product Image Gallery
    function initProductGallery() {
        $('.product-gallery-thumbnail').on('click', function(e) {
            e.preventDefault();
            const newSrc = $(this).data('large-image');
            const mainImage = $('.product-gallery-main img');
            
            if (newSrc && mainImage.length) {
                mainImage.fadeOut(200, function() {
                    $(this).attr('src', newSrc).fadeIn(200);
                });
                
                $('.product-gallery-thumbnail').removeClass('active');
                $(this).addClass('active');
            }
        });
    }

    // Product Quantity Selector
    function initQuantitySelector() {
        $(document).on('click', '.quantity-minus', function(e) {
            e.preventDefault();
            const input = $(this).siblings('input[type="number"]');
            const currentValue = parseInt(input.val()) || 1;
            const minValue = parseInt(input.attr('min')) || 1;
            
            if (currentValue > minValue) {
                input.val(currentValue - 1).trigger('change');
            }
        });
        
        $(document).on('click', '.quantity-plus', function(e) {
            e.preventDefault();
            const input = $(this).siblings('input[type="number"]');
            const currentValue = parseInt(input.val()) || 1;
            const maxValue = parseInt(input.attr('max')) || 999;
            
            if (currentValue < maxValue) {
                input.val(currentValue + 1).trigger('change');
            }
        });
    }

    // Add to Cart AJAX
    function initAjaxAddToCart() {
        $(document).on('click', '.ajax-add-to-cart', function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const productId = $button.data('product-id');
            const quantity = $button.closest('.product').find('.quantity input').val() || 1;
            
            $button.addClass('loading');
            
            $.ajax({
                url: taoismCulture.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'taoism_add_to_cart',
                    product_id: productId,
                    quantity: quantity,
                    nonce: taoismCulture.nonce
                },
                success: function(response) {
                    if (response.success) {
                        // Update cart count
                        $('.cart-count').text(response.data.cart_count);
                        
                        // Show success message
                        showNotification('Product added to cart!', 'success');
                        
                        // Trigger WooCommerce cart update
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);
                    } else {
                        showNotification(response.data.message || 'Error adding to cart', 'error');
                    }
                },
                error: function() {
                    showNotification('Error adding to cart', 'error');
                },
                complete: function() {
                    $button.removeClass('loading');
                }
            });
        });
    }

    // Show Notification
    function showNotification(message, type = 'info') {
        const notification = $('<div class="notification notification-' + type + '">' + message + '</div>');
        
        $('body').append(notification);
        
        setTimeout(function() {
            notification.addClass('show');
        }, 100);
        
        setTimeout(function() {
            notification.removeClass('show');
            setTimeout(function() {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Copy to Clipboard
    window.copyToClipboard = function(text) {
        const tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        
        showNotification('Link copied to clipboard!', 'success');
    };

    // Search Toggle
    function initSearchToggle() {
        $('#search-toggle').on('click', function() {
            $('.search-form').toggleClass('active');
            $('.search-form input').focus();
        });
        
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-form, #search-toggle').length) {
                $('.search-form').removeClass('active');
            }
        });
    }

    // Sticky Header
    function initStickyHeader() {
        const header = $('.site-header');
        const headerHeight = header.outerHeight();
        let lastScrollTop = 0;
        
        $(window).on('scroll', function() {
            const scrollTop = $(this).scrollTop();
            
            if (scrollTop > headerHeight) {
                header.addClass('scrolled');
                
                if (scrollTop > lastScrollTop) {
                    // Scrolling down
                    header.addClass('hide');
                } else {
                    // Scrolling up
                    header.removeClass('hide');
                }
            } else {
                header.removeClass('scrolled hide');
            }
            
            lastScrollTop = scrollTop;
        });
    }

    // Animate on Scroll
    function initScrollAnimations() {
        if ('IntersectionObserver' in window) {
            const animateObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                animateObserver.observe(el);
            });
        }
    }

    // Product Filter Toggle (Mobile)
    function initProductFilters() {
        $('#filter-toggle').on('click', function() {
            $('.product-filters-sidebar').toggleClass('active');
            $('body').toggleClass('filters-open');
        });
        
        $('.filter-close').on('click', function() {
            $('.product-filters-sidebar').removeClass('active');
            $('body').removeClass('filters-open');
        });
    }

    // Initialize all functions when document is ready
    $(document).ready(function() {
        initDarkMode();
        initMobileMenu();
        initSmoothScroll();
        initLazyLoad();
        initScrollToTop();
        initHeroCarousel();
        initProductGallery();
        initQuantitySelector();
        initAjaxAddToCart();
        initSearchToggle();
        initStickyHeader();
        initScrollAnimations();
        initProductFilters();
    });

})(jQuery);

