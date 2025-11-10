<?php
/**
 * WooCommerce Compatibility
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Declare WooCommerce support
 */
function taoism_culture_woocommerce_setup() {
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 300,
        'single_image_width'    => 600,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 1,
            'max_columns'     => 6,
        ),
    ));

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'taoism_culture_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets
 */
function taoism_culture_woocommerce_scripts() {
    wp_enqueue_style(
        'taoism-culture-woocommerce-style',
        get_template_directory_uri() . '/assets/css/woocommerce.css',
        array(),
        TAOISM_THEME_VERSION
    );

    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
        font-family: "star";
        src: url("' . $font_path . 'star.eot");
        src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
            url("' . $font_path . 'star.woff") format("woff"),
            url("' . $font_path . 'star.ttf") format("truetype"),
            url("' . $font_path . 'star.svg#star") format("svg");
        font-weight: normal;
        font-style: normal;
    }';

    wp_add_inline_style('taoism-culture-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'taoism_culture_woocommerce_scripts');

/**
 * Disable default WooCommerce wrapper
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom wrapper
 */
function taoism_culture_wrapper_start() {
    echo '<main id="main" class="site-main woocommerce-main" role="main">';
    echo '<div class="container">';
}
add_action('woocommerce_before_main_content', 'taoism_culture_wrapper_start', 10);

function taoism_culture_wrapper_end() {
    echo '</div>';
    echo '</main>';
}
add_action('woocommerce_after_main_content', 'taoism_culture_wrapper_end', 10);

/**
 * Remove default sidebar
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

/**
 * Add "Add to Cart" button on hover
 */
function taoism_culture_add_cart_button_hover() {
    global $product;
    
    echo '<div class="product-hover-actions">';
    woocommerce_template_loop_add_to_cart();
    echo '</div>';
}
add_action('woocommerce_after_shop_loop_item', 'taoism_culture_add_cart_button_hover', 15);

/**
 * Customize breadcrumb
 */
function taoism_culture_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => '<span class="separator"> / </span>',
        'wrap_before' => '<nav class="woocommerce-breadcrumb breadcrumbs">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => _x('Home', 'breadcrumb', 'taoism-culture'),
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'taoism_culture_woocommerce_breadcrumbs');

/**
 * Customize related products
 */
function taoism_culture_related_products_args($args) {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'taoism_culture_related_products_args');

/**
 * Customize sale badge
 */
function taoism_culture_custom_sale_badge($html, $post, $product) {
    if ($product->is_on_sale()) {
        $percentage = '';
        if ($product->get_regular_price() && $product->get_sale_price()) {
            $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
            return '<span class="onsale">-' . $percentage . '%</span>';
        }
        return '<span class="onsale">' . __('Sale!', 'taoism-culture') . '</span>';
    }
    return $html;
}
add_filter('woocommerce_sale_flash', 'taoism_culture_custom_sale_badge', 10, 3);

/**
 * Change number of thumbnails in product gallery
 */
function taoism_culture_product_thumbnails_columns() {
    return 5;
}
add_filter('woocommerce_product_thumbnails_columns', 'taoism_culture_product_thumbnails_columns');

/**
 * Customize add to cart message
 */
function taoism_culture_add_to_cart_message($message, $product_id) {
    $product = wc_get_product($product_id);
    
    return sprintf(
        '<div class="added-to-cart-message">%s <a href="%s" class="button wc-forward">%s</a></div>',
        esc_html__('Product added to cart!', 'taoism-culture'),
        esc_url(wc_get_cart_url()),
        esc_html__('View Cart', 'taoism-culture')
    );
}
add_filter('wc_add_to_cart_message_html', 'taoism_culture_add_to_cart_message', 10, 2);

/**
 * Customize cross-sells columns
 */
function taoism_culture_cross_sells_columns($columns) {
    return 4;
}
add_filter('woocommerce_cross_sells_columns', 'taoism_culture_cross_sells_columns');

/**
 * Customize checkout fields
 */
function taoism_culture_override_checkout_fields($fields) {
    // Add placeholder text
    $fields['billing']['billing_first_name']['placeholder'] = __('First Name', 'taoism-culture');
    $fields['billing']['billing_last_name']['placeholder'] = __('Last Name', 'taoism-culture');
    $fields['billing']['billing_email']['placeholder'] = __('Email Address', 'taoism-culture');
    $fields['billing']['billing_phone']['placeholder'] = __('Phone Number', 'taoism-culture');
    
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'taoism_culture_override_checkout_fields');

/**
 * Add custom tab to product page
 */
function taoism_culture_product_custom_tab($tabs) {
    $tabs['culture_info'] = array(
        'title'    => __('Cultural Significance', 'taoism-culture'),
        'priority' => 50,
        'callback' => 'taoism_culture_product_custom_tab_content'
    );
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'taoism_culture_product_custom_tab');

function taoism_culture_product_custom_tab_content() {
    global $post;
    $content = get_post_meta($post->ID, '_culture_info', true);
    
    if ($content) {
        echo '<div class="culture-info-content">';
        echo wp_kses_post($content);
        echo '</div>';
    } else {
        echo '<p>' . esc_html__('Learn about the cultural significance of this product.', 'taoism-culture') . '</p>';
    }
}

/**
 * Customize "Continue Shopping" button URL
 */
function taoism_culture_continue_shopping_redirect($return_to) {
    return home_url('/shop');
}
add_filter('woocommerce_continue_shopping_redirect', 'taoism_culture_continue_shopping_redirect');

/**
 * Add wishlist button (if using YITH Wishlist plugin)
 */
function taoism_culture_add_wishlist_button() {
    if (function_exists('YITH_WCWL')) {
        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
    }
}
add_action('woocommerce_after_add_to_cart_button', 'taoism_culture_add_wishlist_button');

/**
 * Customize single product page hooks
 */

// Remove default rating position
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

// Remove default price position
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

// Add price and rating wrapper
function taoism_culture_product_price_rating_wrapper_start() {
    echo '<div class="price-rating-wrapper">';
}
add_action('woocommerce_single_product_summary', 'taoism_culture_product_price_rating_wrapper_start', 9);

// Add price
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

// Add rating
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11);

function taoism_culture_product_price_rating_wrapper_end() {
    echo '</div>';
}
add_action('woocommerce_single_product_summary', 'taoism_culture_product_price_rating_wrapper_end', 12);

/**
 * Customize quantity input HTML
 */
function taoism_culture_quantity_input_args($args, $product) {
    $args['input_value'] = isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity();
    return $args;
}
add_filter('woocommerce_quantity_input_args', 'taoism_culture_quantity_input_args', 10, 2);

/**
 * Custom quantity wrapper
 */
function taoism_culture_before_quantity_input() {
    echo '<div class="quantity"><span class="quantity-label">' . esc_html__('Quantity', 'taoism-culture') . '</span><div class="quantity-input-wrapper"><button type="button" class="minus">-</button>';
}
add_action('woocommerce_before_quantity_input_field', 'taoism_culture_before_quantity_input', 10);

function taoism_culture_after_quantity_input() {
    echo '<button type="button" class="plus">+</button></div></div>';
}
add_action('woocommerce_after_quantity_input_field', 'taoism_culture_after_quantity_input', 10);

/**
 * Wrap cart buttons
 */
function taoism_culture_cart_buttons_wrapper_start() {
    echo '<div class="cart-buttons-wrapper">';
}
add_action('woocommerce_before_add_to_cart_button', 'taoism_culture_cart_buttons_wrapper_start', 30);

/**
 * Add Buy Now button after Add to Cart
 */
function taoism_culture_add_buy_now_button() {
    global $product;
    
    echo '<button type="button" class="buy-now-button" data-product-id="' . esc_attr($product->get_id()) . '">' . esc_html__('Buy Now', 'taoism-culture') . '</button>';
}
add_action('woocommerce_after_add_to_cart_button', 'taoism_culture_add_buy_now_button', 20);

function taoism_culture_cart_buttons_wrapper_end() {
    echo '</div>';
}
add_action('woocommerce_after_add_to_cart_button', 'taoism_culture_cart_buttons_wrapper_end', 30);

/**
 * Enqueue custom JavaScript for quantity buttons and buy now
 */
function taoism_culture_product_scripts() {
    if (is_product()) {
        wp_add_inline_script('jquery', "
            jQuery(document).ready(function($) {
                // Quantity buttons
                $('.quantity').on('click', '.plus', function(e) {
                    var \$input = $(this).siblings('input.qty');
                    var val = parseInt(\$input.val());
                    var max = \$input.attr('max') ? parseInt(\$input.attr('max')) : 999;
                    if (val < max) {
                        \$input.val(val + 1).trigger('change');
                    }
                });
                
                $('.quantity').on('click', '.minus', function(e) {
                    var \$input = $(this).siblings('input.qty');
                    var val = parseInt(\$input.val());
                    var min = \$input.attr('min') ? parseInt(\$input.attr('min')) : 1;
                    if (val > min) {
                        \$input.val(val - 1).trigger('change');
                    }
                });
                
                // Buy Now button
                $('.buy-now-button').on('click', function(e) {
                    e.preventDefault();
                    var \$form = $(this).closest('form.cart');
                    var \$addToCartBtn = \$form.find('.single_add_to_cart_button');
                    
                    // Temporarily store the current form action
                    var originalAction = \$form.attr('action');
                    
                    // Add a hidden input to redirect to checkout
                    \$form.append('<input type=\"hidden\" name=\"buy_now\" value=\"1\" />');
                    
                    // Submit the form
                    \$addToCartBtn.trigger('click');
                    
                    // Listen for add to cart success
                    $(document.body).on('added_to_cart', function() {
                        window.location.href = '" . esc_js(wc_get_checkout_url()) . "';
                    });
                });
            });
        ");
    }
}
add_action('wp_enqueue_scripts', 'taoism_culture_product_scripts', 99);

/**
 * Remove default WooCommerce catalog ordering dropdown
 */
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

/**
 * Render custom sorting buttons markup.
 *
 * @param bool $force_display Whether to render even if products are not yet set up in the loop.
 * @return string
 */
function taoism_culture_render_catalog_ordering($force_display = false) {
    if (!$force_display && !woocommerce_products_will_display()) {
        return '';
    }

    $current_url     = add_query_arg(null, null);
    $current_orderby = isset($_GET['orderby']) ? wc_clean(wp_unslash($_GET['orderby'])) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby', 'menu_order'));

    $catalog_orderby_options = array(
        'date'       => __('Sort by Newest', 'taoism-culture'),
        'price'      => __('Price: Low to High', 'taoism-culture'),
        'price-desc' => __('Price: High to Low', 'taoism-culture'),
        'popularity' => __('Most Popular', 'taoism-culture'),
    );

    ob_start();
    ?>
    <div class="shop-sorting" role="toolbar" aria-label="<?php esc_attr_e('Product sorting', 'taoism-culture'); ?>">
        <?php
        foreach ($catalog_orderby_options as $id => $name) :
            $link      = add_query_arg('orderby', $id, remove_query_arg('orderby', $current_url));
            $is_active = ($current_orderby === $id);
            ?>
            <a
                class="shop-sorting__button<?php echo $is_active ? ' shop-sorting__button--active' : ''; ?>"
                href="<?php echo esc_url($link); ?>"
                aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>"
            >
                <span><?php echo esc_html($name); ?></span>
            </a>
        <?php endforeach; ?>
    </div>
    <?php

    return ob_get_clean();
}

