<?php
/**
 * Admin Dashboard Customization
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add custom dashboard widgets
 */
function taoism_culture_add_dashboard_widgets() {
    // Sales Overview Widget
    wp_add_dashboard_widget(
        'taoism_sales_overview',
        __('Sales Overview', 'taoism-culture'),
        'taoism_culture_sales_overview_widget'
    );

    // Culture Stats Widget
    wp_add_dashboard_widget(
        'taoism_culture_stats',
        __('Culture Content Stats', 'taoism-culture'),
        'taoism_culture_content_stats_widget'
    );

    // Quick Stats Widget
    wp_add_dashboard_widget(
        'taoism_quick_stats',
        __('Quick Statistics', 'taoism-culture'),
        'taoism_culture_quick_stats_widget'
    );

    // Recent Orders Widget
    if (class_exists('WooCommerce')) {
        wp_add_dashboard_widget(
            'taoism_recent_orders',
            __('Recent Orders', 'taoism-culture'),
            'taoism_culture_recent_orders_widget'
        );
    }

    // Popular Products Widget
    if (class_exists('WooCommerce')) {
        wp_add_dashboard_widget(
            'taoism_popular_products',
            __('Top Selling Products', 'taoism-culture'),
            'taoism_culture_popular_products_widget'
        );
    }

    // System Status Widget
    wp_add_dashboard_widget(
        'taoism_system_status',
        __('System Status', 'taoism-culture'),
        'taoism_culture_system_status_widget'
    );
}
add_action('wp_dashboard_setup', 'taoism_culture_add_dashboard_widgets');

/**
 * Sales Overview Widget
 */
function taoism_culture_sales_overview_widget() {
    if (!class_exists('WooCommerce')) {
        echo '<p>' . esc_html__('WooCommerce is not active.', 'taoism-culture') . '</p>';
        return;
    }

    // Get sales data for current month
    $current_month_sales = taoism_get_sales_data('month');
    $previous_month_sales = taoism_get_sales_data('previous_month');
    
    $change_percentage = 0;
    if ($previous_month_sales > 0) {
        $change_percentage = (($current_month_sales - $previous_month_sales) / $previous_month_sales) * 100;
    }

    // Get order counts
    $today_orders = taoism_get_order_count('today');
    $week_orders = taoism_get_order_count('week');
    $month_orders = taoism_get_order_count('month');
    ?>
    <div class="taoism-dashboard-widget">
        <div class="sales-summary">
            <div class="sales-stat">
                <h3><?php echo wc_price($current_month_sales); ?></h3>
                <p><?php esc_html_e('This Month', 'taoism-culture'); ?></p>
                <?php if ($change_percentage != 0) : ?>
                    <span class="trend <?php echo $change_percentage > 0 ? 'up' : 'down'; ?>">
                        <?php echo $change_percentage > 0 ? '↑' : '↓'; ?> 
                        <?php echo number_format(abs($change_percentage), 1); ?>%
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="order-stats">
            <div class="stat-item">
                <span class="stat-label"><?php esc_html_e('Today', 'taoism-culture'); ?></span>
                <span class="stat-value"><?php echo esc_html($today_orders); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label"><?php esc_html_e('This Week', 'taoism-culture'); ?></span>
                <span class="stat-value"><?php echo esc_html($week_orders); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-label"><?php esc_html_e('This Month', 'taoism-culture'); ?></span>
                <span class="stat-value"><?php echo esc_html($month_orders); ?></span>
            </div>
        </div>

        <div class="sales-chart">
            <canvas id="taoism-sales-chart" width="400" height="150"></canvas>
        </div>
    </div>
    <?php
}

/**
 * Culture Content Stats Widget
 */
function taoism_culture_content_stats_widget() {
    $articles_count = wp_count_posts('culture_article');
    $lectures_count = wp_count_posts('taoism_lecture');
    $published_articles = $articles_count->publish ?? 0;
    $published_lectures = $lectures_count->publish ?? 0;

    // Get most viewed articles
    $popular_articles = get_posts(array(
        'post_type' => 'culture_article',
        'posts_per_page' => 5,
        'orderby' => 'meta_value_num',
        'meta_key' => 'post_views_count',
        'order' => 'DESC'
    ));
    ?>
    <div class="taoism-dashboard-widget">
        <div class="content-stats-grid">
            <div class="stat-card">
                <span class="stat-icon">📝</span>
                <div class="stat-info">
                    <h4><?php echo esc_html($published_articles); ?></h4>
                    <p><?php esc_html_e('Culture Articles', 'taoism-culture'); ?></p>
                </div>
            </div>
            <div class="stat-card">
                <span class="stat-icon">🎥</span>
                <div class="stat-info">
                    <h4><?php echo esc_html($published_lectures); ?></h4>
                    <p><?php esc_html_e('Lectures', 'taoism-culture'); ?></p>
                </div>
            </div>
        </div>

        <?php if (!empty($popular_articles)) : ?>
            <div class="popular-content">
                <h4><?php esc_html_e('Most Popular Articles', 'taoism-culture'); ?></h4>
                <ul>
                    <?php foreach ($popular_articles as $article) : 
                        $views = get_post_meta($article->ID, 'post_views_count', true) ?: 0;
                        ?>
                        <li>
                            <a href="<?php echo get_edit_post_link($article->ID); ?>">
                                <?php echo esc_html($article->post_title); ?>
                            </a>
                            <span class="views"><?php echo esc_html($views); ?> views</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Quick Stats Widget
 */
function taoism_culture_quick_stats_widget() {
    $total_users = count_users();
    $total_comments = wp_count_comments();
    
    $product_count = 0;
    if (class_exists('WooCommerce')) {
        $products = wp_count_posts('product');
        $product_count = $products->publish ?? 0;
    }
    ?>
    <div class="taoism-dashboard-widget quick-stats">
        <div class="stats-row">
            <div class="stat-box">
                <span class="material-symbols-outlined">group</span>
                <div>
                    <strong><?php echo esc_html($total_users['total_users']); ?></strong>
                    <span><?php esc_html_e('Users', 'taoism-culture'); ?></span>
                </div>
            </div>
            <div class="stat-box">
                <span class="material-symbols-outlined">inventory_2</span>
                <div>
                    <strong><?php echo esc_html($product_count); ?></strong>
                    <span><?php esc_html_e('Products', 'taoism-culture'); ?></span>
                </div>
            </div>
            <div class="stat-box">
                <span class="material-symbols-outlined">comment</span>
                <div>
                    <strong><?php echo esc_html($total_comments->approved); ?></strong>
                    <span><?php esc_html_e('Comments', 'taoism-culture'); ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Recent Orders Widget
 */
function taoism_culture_recent_orders_widget() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    $orders = wc_get_orders(array(
        'limit' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    ?>
    <div class="taoism-dashboard-widget">
        <?php if (!empty($orders)) : ?>
            <table class="widefat">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Order', 'taoism-culture'); ?></th>
                        <th><?php esc_html_e('Date', 'taoism-culture'); ?></th>
                        <th><?php esc_html_e('Status', 'taoism-culture'); ?></th>
                        <th><?php esc_html_e('Total', 'taoism-culture'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td>
                                <a href="<?php echo esc_url(admin_url('post.php?post=' . $order->get_id() . '&action=edit')); ?>">
                                    #<?php echo esc_html($order->get_order_number()); ?>
                                </a>
                            </td>
                            <td><?php echo esc_html($order->get_date_created()->date_i18n('M j, Y')); ?></td>
                            <td>
                                <span class="order-status status-<?php echo esc_attr($order->get_status()); ?>">
                                    <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
                                </span>
                            </td>
                            <td><?php echo $order->get_formatted_order_total(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p><?php esc_html_e('No orders yet.', 'taoism-culture'); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Popular Products Widget
 */
function taoism_culture_popular_products_widget() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    global $wpdb;
    
    $query = "
        SELECT p.ID, p.post_title, SUM(oim.meta_value) as total_sales
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->prefix}woocommerce_order_items oi ON p.ID = oi.order_item_id
        INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta oim ON oi.order_item_id = oim.order_item_id
        WHERE p.post_type = 'product'
        AND p.post_status = 'publish'
        AND oim.meta_key = '_qty'
        GROUP BY p.ID
        ORDER BY total_sales DESC
        LIMIT 5
    ";
    
    $products = $wpdb->get_results($query);
    ?>
    <div class="taoism-dashboard-widget">
        <?php if (!empty($products)) : ?>
            <table class="widefat">
                <thead>
                    <tr>
                        <th><?php esc_html_e('Product', 'taoism-culture'); ?></th>
                        <th><?php esc_html_e('Sales', 'taoism-culture'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td>
                                <a href="<?php echo esc_url(admin_url('post.php?post=' . $product->ID . '&action=edit')); ?>">
                                    <?php echo esc_html($product->post_title); ?>
                                </a>
                            </td>
                            <td><?php echo esc_html($product->total_sales); ?> <?php esc_html_e('units', 'taoism-culture'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p><?php esc_html_e('No sales data available.', 'taoism-culture'); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * System Status Widget
 */
function taoism_culture_system_status_widget() {
    $theme = wp_get_theme();
    $php_version = phpversion();
    $wp_version = get_bloginfo('version');
    $mysql_version = $GLOBALS['wpdb']->db_version();
    ?>
    <div class="taoism-dashboard-widget system-status">
        <ul class="status-list">
            <li>
                <span class="label"><?php esc_html_e('Theme Version:', 'taoism-culture'); ?></span>
                <span class="value"><?php echo esc_html($theme->get('Version')); ?></span>
            </li>
            <li>
                <span class="label"><?php esc_html_e('WordPress Version:', 'taoism-culture'); ?></span>
                <span class="value"><?php echo esc_html($wp_version); ?></span>
            </li>
            <li>
                <span class="label"><?php esc_html_e('PHP Version:', 'taoism-culture'); ?></span>
                <span class="value"><?php echo esc_html($php_version); ?></span>
            </li>
            <li>
                <span class="label"><?php esc_html_e('MySQL Version:', 'taoism-culture'); ?></span>
                <span class="value"><?php echo esc_html($mysql_version); ?></span>
            </li>
            <li>
                <span class="label"><?php esc_html_e('WooCommerce:', 'taoism-culture'); ?></span>
                <span class="value">
                    <?php echo (class_exists('WooCommerce') && function_exists('WC')) ? esc_html(WC()->version) : esc_html__('Not Active', 'taoism-culture'); ?>
                </span>
            </li>
        </ul>
    </div>
    <?php
}

/**
 * Helper: Get sales data
 */
function taoism_get_sales_data($period = 'month') {
    if (!class_exists('WooCommerce')) {
        return 0;
    }

    $args = array(
        'status' => array('wc-completed', 'wc-processing'),
        'limit' => -1,
    );

    switch ($period) {
        case 'today':
            $args['date_created'] = '>' . strtotime('today midnight');
            break;
        case 'week':
            $args['date_created'] = '>' . strtotime('-7 days');
            break;
        case 'month':
            $args['date_created'] = '>' . strtotime('first day of this month midnight');
            break;
        case 'previous_month':
            $args['date_created'] = strtotime('first day of last month') . '...' . strtotime('last day of last month');
            break;
    }

    $orders = wc_get_orders($args);
    $total = 0;

    foreach ($orders as $order) {
        $total += $order->get_total();
    }

    return $total;
}

/**
 * Helper: Get order count
 */
function taoism_get_order_count($period = 'month') {
    if (!class_exists('WooCommerce')) {
        return 0;
    }

    $args = array(
        'status' => array('wc-completed', 'wc-processing', 'wc-pending'),
        'limit' => -1,
        'return' => 'ids',
    );

    switch ($period) {
        case 'today':
            $args['date_created'] = '>' . strtotime('today midnight');
            break;
        case 'week':
            $args['date_created'] = '>' . strtotime('-7 days');
            break;
        case 'month':
            $args['date_created'] = '>' . strtotime('first day of this month midnight');
            break;
    }

    $orders = wc_get_orders($args);
    return count($orders);
}

/**
 * Enqueue admin dashboard styles and scripts
 */
function taoism_culture_admin_dashboard_assets($hook) {
    if ('index.php' !== $hook) {
        return;
    }

    wp_enqueue_style(
        'taoism-admin-dashboard',
        get_template_directory_uri() . '/assets/css/admin-dashboard.css',
        array(),
        TAOISM_THEME_VERSION
    );

    wp_enqueue_script(
        'chart-js',
        'https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js',
        array(),
        '3.9.1',
        true
    );

    wp_enqueue_script(
        'taoism-admin-dashboard',
        get_template_directory_uri() . '/assets/js/admin-dashboard.js',
        array('jquery', 'chart-js'),
        TAOISM_THEME_VERSION,
        true
    );

    // Get sales data for chart
    $sales_data = taoism_get_sales_chart_data();
    
    // Get currency symbol (default to $ if WooCommerce not active)
    $currency_symbol = '$';
    if (class_exists('WooCommerce') && function_exists('get_woocommerce_currency_symbol')) {
        $currency_symbol = get_woocommerce_currency_symbol();
    }
    
    wp_localize_script('taoism-admin-dashboard', 'taoismDashboard', array(
        'salesData' => $sales_data,
        'currency' => $currency_symbol,
    ));
}
add_action('admin_enqueue_scripts', 'taoism_culture_admin_dashboard_assets');

/**
 * Get sales chart data (last 7 days)
 */
function taoism_get_sales_chart_data() {
    if (!class_exists('WooCommerce')) {
        return array();
    }

    $data = array(
        'labels' => array(),
        'values' => array(),
    );

    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-{$i} days"));
        $data['labels'][] = date('M j', strtotime($date));
        
        $orders = wc_get_orders(array(
            'status' => array('wc-completed', 'wc-processing'),
            'date_created' => $date,
            'limit' => -1,
        ));
        
        $total = 0;
        foreach ($orders as $order) {
            $total += $order->get_total();
        }
        
        $data['values'][] = $total;
    }

    return $data;
}

/**
 * Track post views
 */
function taoism_track_post_views($post_id) {
    if (!is_singular('culture_article')) {
        return;
    }
    
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    
    $count = get_post_meta($post_id, 'post_views_count', true);
    if (empty($count)) {
        $count = 0;
    }
    $count++;
    update_post_meta($post_id, 'post_views_count', $count);
}
add_action('wp_head', 'taoism_track_post_views');

