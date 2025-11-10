<?php
/**
 * Taoism Culture Theme Functions
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Theme version
define('TAOISM_THEME_VERSION', '1.0.0');

/**
 * Theme Setup
 */
function taoism_culture_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 800, true);
    
    // Add custom image sizes
    add_image_size('taoism-hero', 1920, 800, true);
    add_image_size('taoism-product-large', 800, 800, true);
    add_image_size('taoism-product-thumb', 150, 150, true);
    add_image_size('taoism-culture-card', 600, 400, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'taoism-culture'),
        'footer' => esc_html__('Footer Menu', 'taoism-culture'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('editor-style.css');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'taoism_culture_setup');

/**
 * Set content width
 */
function taoism_culture_content_width() {
    $GLOBALS['content_width'] = apply_filters('taoism_culture_content_width', 1280);
}
add_action('after_setup_theme', 'taoism_culture_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function taoism_culture_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'taoism-google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700;900&family=Noto+Sans:wght@400;500;700&family=Noto+Serif+SC:wght@400;700;900&family=Noto+Sans+SC:wght@400;500;700&display=swap',
        array(),
        null
    );

    // Material Symbols
    wp_enqueue_style(
        'material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined',
        array(),
        null
    );

    // Theme stylesheet
    wp_enqueue_style(
        'taoism-culture-style',
        get_stylesheet_uri(),
        array(),
        TAOISM_THEME_VERSION
    );

    // Main CSS
    wp_enqueue_style(
        'taoism-culture-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array('taoism-culture-style'),
        TAOISM_THEME_VERSION
    );

    // Mobile CSS
    wp_enqueue_style(
        'taoism-culture-mobile',
        get_template_directory_uri() . '/assets/css/mobile.css',
        array('taoism-culture-main'),
        TAOISM_THEME_VERSION
    );

    // Main JavaScript
    wp_enqueue_script(
        'taoism-culture-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'),
        TAOISM_THEME_VERSION,
        true
    );

    // Localize script
    wp_localize_script('taoism-culture-main', 'taoismCulture', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('taoism-culture-nonce'),
        'themeUrl' => get_template_directory_uri(),
    ));

    // Comments script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'taoism_culture_scripts');

/**
 * Register widget areas
 */
function taoism_culture_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Product Sidebar', 'taoism-culture'),
        'id'            => 'product-sidebar',
        'description'   => esc_html__('Add widgets here to appear in product pages.', 'taoism-culture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'taoism-culture'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in footer column 1.', 'taoism-culture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'taoism-culture'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in footer column 2.', 'taoism-culture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'taoism-culture'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here to appear in footer column 3.', 'taoism-culture'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'taoism_culture_widgets_init');

/**
 * Register Custom Post Types
 */
function taoism_culture_register_post_types() {
    // Culture Articles
    register_post_type('culture_article', array(
        'labels' => array(
            'name'               => _x('Culture Articles', 'post type general name', 'taoism-culture'),
            'singular_name'      => _x('Culture Article', 'post type singular name', 'taoism-culture'),
            'menu_name'          => _x('Culture Articles', 'admin menu', 'taoism-culture'),
            'name_admin_bar'     => _x('Culture Article', 'add new on admin bar', 'taoism-culture'),
            'add_new'            => _x('Add New', 'culture article', 'taoism-culture'),
            'add_new_item'       => __('Add New Culture Article', 'taoism-culture'),
            'new_item'           => __('New Culture Article', 'taoism-culture'),
            'edit_item'          => __('Edit Culture Article', 'taoism-culture'),
            'view_item'          => __('View Culture Article', 'taoism-culture'),
            'all_items'          => __('All Culture Articles', 'taoism-culture'),
            'search_items'       => __('Search Culture Articles', 'taoism-culture'),
            'parent_item_colon'  => __('Parent Culture Articles:', 'taoism-culture'),
            'not_found'          => __('No culture articles found.', 'taoism-culture'),
            'not_found_in_trash' => __('No culture articles found in Trash.', 'taoism-culture')
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'culture'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'show_in_rest'       => true,
    ));

    // Taoism Lectures
    register_post_type('taoism_lecture', array(
        'labels' => array(
            'name'               => _x('Taoism Lectures', 'post type general name', 'taoism-culture'),
            'singular_name'      => _x('Taoism Lecture', 'post type singular name', 'taoism-culture'),
            'menu_name'          => _x('Taoism Lectures', 'admin menu', 'taoism-culture'),
            'name_admin_bar'     => _x('Taoism Lecture', 'add new on admin bar', 'taoism-culture'),
            'add_new'            => _x('Add New', 'taoism lecture', 'taoism-culture'),
            'add_new_item'       => __('Add New Lecture', 'taoism-culture'),
            'new_item'           => __('New Lecture', 'taoism-culture'),
            'edit_item'          => __('Edit Lecture', 'taoism-culture'),
            'view_item'          => __('View Lecture', 'taoism-culture'),
            'all_items'          => __('All Lectures', 'taoism-culture'),
            'search_items'       => __('Search Lectures', 'taoism-culture'),
            'not_found'          => __('No lectures found.', 'taoism-culture'),
            'not_found_in_trash' => __('No lectures found in Trash.', 'taoism-culture')
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'lectures'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-video-alt3',
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'show_in_rest'       => true,
    ));
}
add_action('init', 'taoism_culture_register_post_types');

/**
 * Register Custom Taxonomies
 */
function taoism_culture_register_taxonomies() {
    // Culture Article Categories
    register_taxonomy('culture_category', array('culture_article'), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => _x('Culture Categories', 'taxonomy general name', 'taoism-culture'),
            'singular_name'     => _x('Culture Category', 'taxonomy singular name', 'taoism-culture'),
            'search_items'      => __('Search Categories', 'taoism-culture'),
            'all_items'         => __('All Categories', 'taoism-culture'),
            'parent_item'       => __('Parent Category', 'taoism-culture'),
            'parent_item_colon' => __('Parent Category:', 'taoism-culture'),
            'edit_item'         => __('Edit Category', 'taoism-culture'),
            'update_item'       => __('Update Category', 'taoism-culture'),
            'add_new_item'      => __('Add New Category', 'taoism-culture'),
            'new_item_name'     => __('New Category Name', 'taoism-culture'),
            'menu_name'         => __('Categories', 'taoism-culture'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'culture-category'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'taoism_culture_register_taxonomies');

/**
 * Setup WooCommerce Product Categories
 */
function taoism_culture_setup_product_categories() {
    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        return;
    }

    // Product categories to create
    $categories = array(
        array(
            'name' => '法器 (Ritual Implements)',
            'slug' => 'ritual-implements',
            'description' => '道教法器，包括法剑、八卦镜等'
        ),
        array(
            'name' => '服饰 (Apparel)',
            'slug' => 'apparel',
            'description' => '道教服饰，包括道袍、太极服等'
        ),
        array(
            'name' => '书籍 (Books & Scriptures)',
            'slug' => 'books-scriptures',
            'description' => '道教经典书籍，包括道德经、易经等'
        ),
        array(
            'name' => '香品 (Incense & Aromatics)',
            'slug' => 'incense-aromatics',
            'description' => '香品香具，包括檀香、熏香炉等'
        ),
        array(
            'name' => '字画 (Calligraphy & Art)',
            'slug' => 'calligraphy-art',
            'description' => '书法字画，包括书法卷轴、山水画等'
        ),
        array(
            'name' => '茶具 (Tea Sets)',
            'slug' => 'tea-sets',
            'description' => '茶具茶器，包括茶壶、茶杯等'
        ),
    );

    foreach ($categories as $category) {
        // Check if category already exists
        $term = term_exists($category['name'], 'product_cat');
        
        if (!$term) {
            wp_insert_term(
                $category['name'],
                'product_cat',
                array(
                    'slug' => $category['slug'],
                    'description' => $category['description']
                )
            );
        }
    }
}
add_action('init', 'taoism_culture_setup_product_categories', 20);

/**
 * Setup WooCommerce Product Attributes
 */
function taoism_culture_setup_product_attributes() {
    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        return;
    }

    global $wpdb;

    // Material attribute
    $material_attr = array(
        'attribute_label'   => '材质 (Material)',
        'attribute_name'    => 'material',
        'attribute_type'    => 'select',
        'attribute_orderby' => 'menu_order',
        'attribute_public'  => 1,
    );

    // Check if attribute exists
    $attribute_id = $wpdb->get_var($wpdb->prepare(
        "SELECT attribute_id FROM {$wpdb->prefix}woocommerce_attribute_taxonomies WHERE attribute_name = %s",
        'material'
    ));

    if (!$attribute_id) {
        $wpdb->insert(
            $wpdb->prefix . 'woocommerce_attribute_taxonomies',
            $material_attr
        );
        
        // Register taxonomy
        register_taxonomy(
            'pa_material',
            'product',
            array('label' => '材质 (Material)')
        );

        // Add material terms
        $materials = array('Wood', 'Jade', 'Bronze', 'Ceramic', 'Fabric', 'Stone', 'Metal');
        foreach ($materials as $material) {
            wp_insert_term($material, 'pa_material');
        }
    }

    // Style attribute
    $style_attr = array(
        'attribute_label'   => '款式 (Style)',
        'attribute_name'    => 'style',
        'attribute_type'    => 'select',
        'attribute_orderby' => 'menu_order',
        'attribute_public'  => 1,
    );

    $attribute_id = $wpdb->get_var($wpdb->prepare(
        "SELECT attribute_id FROM {$wpdb->prefix}woocommerce_attribute_taxonomies WHERE attribute_name = %s",
        'style'
    ));

    if (!$attribute_id) {
        $wpdb->insert(
            $wpdb->prefix . 'woocommerce_attribute_taxonomies',
            $style_attr
        );
        
        register_taxonomy(
            'pa_style',
            'product',
            array('label' => '款式 (Style)')
        );

        // Add style terms
        $styles = array('Mountain', 'River', 'Lotus', 'Traditional', 'Modern', 'Classic');
        foreach ($styles as $style) {
            wp_insert_term($style, 'pa_style');
        }
    }

    // Clear WooCommerce cache
    delete_transient('wc_attribute_taxonomies');
}
add_action('init', 'taoism_culture_setup_product_attributes', 25);

/**
 * Custom excerpt length
 */
function taoism_culture_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'taoism_culture_excerpt_length');

/**
 * Custom excerpt more
 */
function taoism_culture_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'taoism_culture_excerpt_more');

/**
 * Add custom meta fields for culture articles
 */
function taoism_culture_add_meta_boxes() {
    add_meta_box(
        'culture_article_author',
        __('Author Details', 'taoism-culture'),
        'taoism_culture_author_meta_box',
        'culture_article',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'taoism_culture_add_meta_boxes');

function taoism_culture_author_meta_box($post) {
    wp_nonce_field('taoism_culture_author_meta', 'taoism_culture_author_nonce');
    $author_title = get_post_meta($post->ID, '_author_title', true);
    ?>
    <p>
        <label for="author_title"><?php _e('Author Title (e.g., 清风道长):', 'taoism-culture'); ?></label><br>
        <input type="text" id="author_title" name="author_title" value="<?php echo esc_attr($author_title); ?>" style="width: 100%;">
    </p>
    <?php
}

function taoism_culture_save_author_meta($post_id) {
    if (!isset($_POST['taoism_culture_author_nonce']) || 
        !wp_verify_nonce($_POST['taoism_culture_author_nonce'], 'taoism_culture_author_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['author_title'])) {
        update_post_meta($post_id, '_author_title', sanitize_text_field($_POST['author_title']));
    }
}
add_action('save_post_culture_article', 'taoism_culture_save_author_meta');

/**
 * WooCommerce customization
 */
// Remove WooCommerce breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// Change number of products per page
function taoism_culture_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'taoism_culture_products_per_page', 20);

// Modify WooCommerce columns
function taoism_culture_loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'taoism_culture_loop_columns');

/**
 * Include template parts
 */
require get_template_directory() . '/inc/image-placeholders.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/seo.php';
require get_template_directory() . '/inc/performance.php';
require get_template_directory() . '/inc/admin-dashboard.php';

if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Add Tailwind CSS and configuration to head
 */
function taoism_culture_tailwind_config() {
    ?>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#11d493",
                        "background-light": "#f6f8f7",
                        "background-dark": "#10221c",
                        "surface-dark": "#2a2a2a",
                    },
                    fontFamily: {
                        "display": ["Noto Serif", "Noto Serif SC", "serif"],
                        "sans": ["Noto Sans", "Noto Sans SC", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    <?php
}
add_action('wp_head', 'taoism_culture_tailwind_config', 1);

/**
 * Include Sample Content Generator (Admin only)
 */
if (is_admin()) {
    require get_template_directory() . '/sample-content.php';
}

/**
 * Create essential pages on theme activation
 */
function taoism_culture_create_pages_on_activation() {
    // Only run if the function exists (from sample-content.php)
    if (function_exists('taoism_create_essential_pages')) {
        taoism_create_essential_pages();
    }
}
add_action('after_switch_theme', 'taoism_culture_create_pages_on_activation');
