<?php
/**
 * Performance Optimization Functions
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Disable emoji scripts
 */
function taoism_culture_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'taoism_culture_disable_emojis');

/**
 * Add defer attribute to scripts
 */
function taoism_culture_defer_scripts($tag, $handle, $src) {
    $defer_scripts = array('taoism-culture-main', 'jquery-migrate');
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'taoism_culture_defer_scripts', 10, 3);

/**
 * Lazy load images
 */
function taoism_culture_add_lazy_load($content) {
    if (is_admin() || is_feed() || is_preview()) {
        return $content;
    }
    
    $content = preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
    return $content;
}
add_filter('the_content', 'taoism_culture_add_lazy_load');
add_filter('post_thumbnail_html', 'taoism_culture_add_lazy_load');

/**
 * Remove query strings from static resources
 */
function taoism_culture_remove_query_strings($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'taoism_culture_remove_query_strings', 10, 2);
add_filter('script_loader_src', 'taoism_culture_remove_query_strings', 10, 2);

/**
 * Optimize database queries
 */
function taoism_culture_optimize_queries($query) {
    if ($query->is_main_query() && !is_admin()) {
        // Limit revisions
        if (defined('WP_POST_REVISIONS') && WP_POST_REVISIONS > 5) {
            define('WP_POST_REVISIONS', 5);
        }
    }
}
add_action('pre_get_posts', 'taoism_culture_optimize_queries');

/**
 * Preload key resources
 */
function taoism_culture_preload_resources() {
    // Preload fonts
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700;900&family=Noto+Sans:wght@400;500;700&display=swap" as="style">' . "\n";
    
    // Preconnect to external domains
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'taoism_culture_preload_resources', 1);

/**
 * Clean up head
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Limit post revisions
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

/**
 * Increase autosave interval
 */
if (!defined('AUTOSAVE_INTERVAL')) {
    define('AUTOSAVE_INTERVAL', 300); // 5 minutes
}

/**
 * Optimize heartbeat API
 */
function taoism_culture_heartbeat_settings($settings) {
    $settings['interval'] = 60; // 60 seconds
    return $settings;
}
add_filter('heartbeat_settings', 'taoism_culture_heartbeat_settings');

