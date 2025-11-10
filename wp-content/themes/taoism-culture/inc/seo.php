<?php
/**
 * SEO Functions
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Open Graph meta tags
 */
function taoism_culture_add_opengraph_tags() {
    if (is_singular()) {
        global $post;
        
        $title = get_the_title();
        $description = get_the_excerpt();
        $url = get_permalink();
        $image = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : get_template_directory_uri() . '/assets/images/og-default.jpg';
        
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image) . '" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
    }
}
add_action('wp_head', 'taoism_culture_add_opengraph_tags');

/**
 * Add Twitter Card meta tags
 */
function taoism_culture_add_twitter_card_tags() {
    if (is_singular()) {
        $title = get_the_title();
        $description = get_the_excerpt();
        $image = has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : get_template_directory_uri() . '/assets/images/og-default.jpg';
        
        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image) . '" />' . "\n";
    }
}
add_action('wp_head', 'taoism_culture_add_twitter_card_tags');

/**
 * Add schema.org structured data
 */
function taoism_culture_add_schema_markup() {
    if (is_singular('product') && class_exists('WooCommerce')) {
        global $product;
        
        // Ensure we have a proper product object
        if (!is_a($product, 'WC_Product')) {
            $product = wc_get_product(get_the_ID());
        }
        
        if (!$product || !is_a($product, 'WC_Product')) {
            return;
        }
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->get_name(),
            'description' => $product->get_description(),
            'image' => wp_get_attachment_url($product->get_image_id()),
            'offers' => array(
                '@type' => 'Offer',
                'price' => $product->get_price(),
                'priceCurrency' => get_woocommerce_currency(),
                'availability' => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            ),
        );
        
        if ($product->get_rating_count() > 0) {
            $schema['aggregateRating'] = array(
                '@type' => 'AggregateRating',
                'ratingValue' => $product->get_average_rating(),
                'reviewCount' => $product->get_rating_count(),
            );
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
    
    if (is_singular('culture_article')) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt(),
            'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : '',
            'author' => array(
                '@type' => 'Person',
                'name' => taoism_get_author_title(),
            ),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => get_site_icon_url(),
                ),
            ),
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}
add_action('wp_head', 'taoism_culture_add_schema_markup');

/**
 * Add canonical URL
 */
function taoism_culture_add_canonical() {
    if (is_singular()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '" />' . "\n";
    }
}
add_action('wp_head', 'taoism_culture_add_canonical');

/**
 * Optimize image alt tags
 */
function taoism_culture_set_default_image_alt($post_id) {
    $post = get_post($post_id);
    
    if ($post && $post->post_type === 'attachment' && strpos($post->post_mime_type, 'image') !== false) {
        $alt = get_post_meta($post_id, '_wp_attachment_image_alt', true);
        
        if (empty($alt)) {
            $title = $post->post_title;
            update_post_meta($post_id, '_wp_attachment_image_alt', $title);
        }
    }
}
add_action('add_attachment', 'taoism_culture_set_default_image_alt');

/**
 * Add meta description
 */
function taoism_culture_add_meta_description() {
    if (is_singular()) {
        $description = get_the_excerpt();
        if ($description) {
            echo '<meta name="description" content="' . esc_attr(wp_trim_words($description, 20)) . '" />' . "\n";
        }
    } elseif (is_front_page()) {
        $description = get_bloginfo('description');
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
        }
    }
}
add_action('wp_head', 'taoism_culture_add_meta_description', 1);

