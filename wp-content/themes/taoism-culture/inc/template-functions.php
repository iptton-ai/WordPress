<?php
/**
 * Template Functions
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get author title for culture articles
 */
function taoism_get_author_title($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $author_title = get_post_meta($post_id, '_author_title', true);
    
    if (empty($author_title)) {
        return get_the_author_meta('display_name', get_post_field('post_author', $post_id));
    }
    
    return $author_title;
}

/**
 * Display breadcrumbs
 */
function taoism_breadcrumbs() {
    if (is_front_page()) {
        return;
    }

    $separator = '<span class="separator"> / </span>';
    $home_title = __('Home', 'taoism-culture');

    echo '<nav class="breadcrumbs" aria-label="breadcrumb">';
    echo '<ol class="breadcrumb-list">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html($home_title) . '</a>' . $separator . '</li>';

    if (is_category() || is_single()) {
        $category = get_the_category();
        if ($category) {
            $category = $category[0];
            echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>' . $separator . '</li>';
        }
        if (is_single()) {
            echo '<li class="active">' . esc_html(get_the_title()) . '</li>';
        }
    } elseif (is_page()) {
        if (wp_get_post_parent_id(get_the_ID())) {
            $parent_id = wp_get_post_parent_id(get_the_ID());
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_post($parent_id);
                $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>' . $separator . '</li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb;
            }
        }
        echo '<li class="active">' . esc_html(get_the_title()) . '</li>';
    } elseif (is_search()) {
        echo '<li class="active">' . esc_html__('Search Results', 'taoism-culture') . '</li>';
    } elseif (is_404()) {
        echo '<li class="active">' . esc_html__('404 Not Found', 'taoism-culture') . '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Display post meta
 */
function taoism_post_meta() {
    $post_type = get_post_type();
    
    if ($post_type === 'culture_article') {
        $author_title = taoism_get_author_title();
        echo '<div class="post-meta">';
        echo '<span class="author">' . esc_html($author_title) . '</span>';
        echo '<span class="separator"> • </span>';
        echo '<time class="date" datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>';
        echo '</div>';
    } else {
        echo '<div class="post-meta">';
        echo '<span class="author">' . esc_html(get_the_author()) . '</span>';
        echo '<span class="separator"> • </span>';
        echo '<time class="date" datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>';
        echo '</div>';
    }
}

/**
 * Display pagination
 */
function taoism_pagination() {
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($wp_query->max_num_pages);

    echo '<nav class="pagination" role="navigation">';
    echo '<div class="pagination-wrapper">';

    // Previous
    if ($paged > 1) {
        echo '<a href="' . esc_url(get_pagenum_link($paged - 1)) . '" class="page-link prev">';
        echo '<span class="material-symbols-outlined">chevron_left</span>';
        echo '</a>';
    }

    // Page numbers
    for ($i = 1; $i <= $max; $i++) {
        if ($i == $paged) {
            echo '<span class="page-link current">' . $i . '</span>';
        } else {
            echo '<a href="' . esc_url(get_pagenum_link($i)) . '" class="page-link">' . $i . '</a>';
        }
    }

    // Next
    if ($paged < $max) {
        echo '<a href="' . esc_url(get_pagenum_link($paged + 1)) . '" class="page-link next">';
        echo '<span class="material-symbols-outlined">chevron_right</span>';
        echo '</a>';
    }

    echo '</div>';
    echo '</nav>';
}

/**
 * Display star rating
 */
function taoism_star_rating($rating, $count = 0) {
    $full_stars = floor($rating);
    $half_star = ($rating - $full_stars >= 0.5) ? 1 : 0;
    $empty_stars = 5 - $full_stars - $half_star;

    echo '<div class="star-rating">';
    
    // Full stars
    for ($i = 0; $i < $full_stars; $i++) {
        echo '<span class="material-symbols-outlined filled">star</span>';
    }
    
    // Half star
    if ($half_star) {
        echo '<span class="material-symbols-outlined half">star_half</span>';
    }
    
    // Empty stars
    for ($i = 0; $i < $empty_stars; $i++) {
        echo '<span class="material-symbols-outlined empty">star</span>';
    }
    
    if ($count > 0) {
        echo '<span class="rating-count">(' . esc_html($count) . ')</span>';
    }
    
    echo '</div>';
}

/**
 * Get primary color based on page
 */
function taoism_get_primary_color() {
    if (is_front_page()) {
        return 'var(--primary-gold)';
    }
    return 'var(--primary-green)';
}

/**
 * Display social share buttons
 */
function taoism_social_share() {
    $url = urlencode(get_permalink());
    $title = urlencode(get_the_title());
    
    echo '<div class="social-share">';
    echo '<span class="share-label">' . esc_html__('Share:', 'taoism-culture') . '</span>';
    
    // Facebook
    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" rel="noopener" class="share-btn facebook">';
    echo '<span class="sr-only">Facebook</span>';
    echo '</a>';
    
    // Twitter
    echo '<a href="https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title . '" target="_blank" rel="noopener" class="share-btn twitter">';
    echo '<span class="sr-only">Twitter</span>';
    echo '</a>';
    
    // WeChat (copy link)
    echo '<button class="share-btn wechat" data-url="' . esc_url(get_permalink()) . '" onclick="copyToClipboard(this.dataset.url)">';
    echo '<span class="sr-only">WeChat</span>';
    echo '</button>';
    
    echo '</div>';
}

/**
 * Check if dark mode is enabled
 */
function taoism_is_dark_mode() {
    // Check cookie or user preference
    return isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === 'true';
}

/**
 * Get featured image URL or placeholder
 */
function taoism_get_featured_image($size = 'large', $post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }
    
    // Return placeholder image
    return get_template_directory_uri() . '/assets/images/placeholder.jpg';
}

