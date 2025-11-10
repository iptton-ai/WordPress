<?php
/**
 * The header for the theme
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="dark">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-background-light dark:bg-background-dark font-sans'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="relative flex min-h-screen w-full flex-col">
    <div class="layout-container flex h-full grow flex-col">
        <div class="flex flex-1 justify-center">
            <div class="layout-content-container flex w-full flex-col">
                <!-- TopNavBar -->
                <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-black/10 dark:border-white/10 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-sm px-4 sm:px-8 lg:px-16 py-3 font-display">
                    <div class="flex items-center gap-8">
                        <div class="flex items-center gap-4 text-black dark:text-white">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <div class="size-6 text-primary">
                                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M44 11.2727C44 14.0109 39.8386 16.3957 33.69 17.6364C39.8386 18.877 44 21.2618 44 24C44 26.7382 39.8386 29.123 33.69 30.3636C39.8386 31.6043 44 33.9891 44 36.7273C44 40.7439 35.0457 44 24 44C12.9543 44 4 40.7439 4 36.7273C4 33.9891 8.16144 31.6043 14.31 30.3636C8.16144 29.123 4 26.7382 4 24C4 21.2618 8.16144 18.877 14.31 17.6364C8.16144 16.3957 4 14.0109 4 11.2727C4 7.25611 12.9543 4 24 4C35.0457 4 44 7.25611 44 11.2727Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <h1 class="text-xl font-bold leading-tight tracking-[-0.015em]">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="text-black dark:text-white hover:text-primary transition-colors">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                        </div>
                        <nav class="hidden md:flex items-center gap-9">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'container'      => false,
                                'menu_class'     => 'flex items-center gap-9',
                                'link_before'    => '',
                                'link_after'     => '',
                                'fallback_cb'    => function() {
                                    $menu_items = array(
                                        array('url' => get_post_type_archive_link('culture_article'), 'title' => __('Culture', 'taoism-culture'), 'slug' => 'culture_article'),
                                        array('url' => (class_exists('WooCommerce') && function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '#'), 'title' => __('Shop', 'taoism-culture'), 'slug' => 'shop'),
                                        array('url' => home_url('/community'), 'title' => __('Community', 'taoism-culture'), 'slug' => 'community'),
                                        array('url' => home_url('/about'), 'title' => __('About Us', 'taoism-culture'), 'slug' => 'about'),
                                    );
                                    foreach ($menu_items as $item) {
                                        $is_current = false;
                                        $current_url = home_url($_SERVER['REQUEST_URI']);
                                        
                                        // Check if current page matches
                                        if (rtrim($item['url'], '/') === rtrim($current_url, '/')) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'culture_article' && is_post_type_archive('culture_article')) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'culture_article' && is_singular('culture_article')) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'shop' && (is_shop() || is_product_category() || is_product() || is_cart() || is_checkout())) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'community' && is_page('community')) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'about' && is_page('about')) {
                                            $is_current = true;
                                        }
                                        
                                        $classes = $is_current 
                                            ? 'text-primary text-sm font-medium leading-normal' 
                                            : 'text-black dark:text-white text-sm font-medium leading-normal hover:text-primary transition-colors';
                                        
                                        echo '<a class="' . $classes . '" href="' . esc_url($item['url']) . '">' . esc_html($item['title']) . '</a>';
                                    }
                                }
                            ));
                            ?>
                        </nav>
                    </div>
                    <div class="flex flex-1 justify-end gap-2 sm:gap-4">
                        <label class="hidden sm:flex flex-col min-w-40 !h-10 max-w-64">
                            <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                <div class="text-gray-500 dark:text-gray-400 flex border border-r-0 border-black/10 dark:border-white/10 bg-transparent items-center justify-center pl-3 rounded-l-lg">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">search</span>
                                </div>
                                <form role="search" method="get" class="flex-1" action="<?php echo esc_url(home_url('/')); ?>">
                                    <input type="search" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-black dark:text-white focus:outline-none focus:ring-1 focus:ring-primary border border-l-0 border-black/10 dark:border-white/10 bg-transparent h-full placeholder:text-gray-500 dark:placeholder:text-gray-400 px-4 rounded-l-none text-sm font-normal leading-normal font-sans" placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'taoism-culture'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                                </form>
                            </div>
                        </label>
                        <div class="flex gap-2">
                            <?php if (class_exists('WooCommerce') && function_exists('wc_get_account_page_permalink')) : ?>
                                <a href="<?php echo esc_url(wc_get_account_page_permalink()); ?>" class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 w-10 border border-black/10 dark:border-white/10 text-black dark:text-white hover:bg-primary/10 dark:hover:bg-primary/20 transition-colors" aria-label="<?php esc_attr_e('My Account', 'taoism-culture'); ?>">
                                    <span class="material-symbols-outlined">person</span>
                                </a>
                                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 w-10 border border-black/10 dark:border-white/10 text-black dark:text-white hover:bg-primary/10 dark:hover:bg-primary/20 transition-colors relative" aria-label="<?php esc_attr_e('View Cart', 'taoism-culture'); ?>">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                    <?php
                                    if (WC()->cart) {
                                        $cart_count = WC()->cart->get_cart_contents_count();
                                        if ($cart_count > 0) {
                                            echo '<span class="absolute -top-1 -right-1 bg-primary text-background-dark text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">' . esc_html($cart_count) . '</span>';
                                        }
                                    }
                                    ?>
                                </a>
                            <?php endif; ?>
                            
                            <button id="mobile-menu-toggle" class="md:hidden flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 w-10 border border-black/10 dark:border-white/10 text-black dark:text-white hover:bg-primary/10 dark:hover:bg-primary/20 transition-colors" aria-label="<?php esc_attr_e('Menu', 'taoism-culture'); ?>">
                                <span class="material-symbols-outlined">menu</span>
                            </button>
                        </div>
                    </div>
                </header>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="mobile-menu hidden fixed inset-0 z-50 bg-background-dark/95 backdrop-blur-md">
                    <div class="flex flex-col h-full p-6">
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-white text-xl font-bold font-display"><?php esc_html_e('Menu', 'taoism-culture'); ?></h2>
                            <button id="mobile-menu-close" class="text-white" aria-label="<?php esc_attr_e('Close Menu', 'taoism-culture'); ?>">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <nav class="flex-1">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'mobile-primary-menu',
                                'container'      => false,
                                'menu_class'     => 'flex flex-col gap-4',
                                'fallback_cb'    => function() {
                                    $menu_items = array(
                                        array('url' => home_url('/'), 'title' => __('Home', 'taoism-culture'), 'slug' => 'home'),
                                        array('url' => get_post_type_archive_link('culture_article'), 'title' => __('Culture', 'taoism-culture'), 'slug' => 'culture_article'),
                                        array('url' => (class_exists('WooCommerce') && function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '#'), 'title' => __('Shop', 'taoism-culture'), 'slug' => 'shop'),
                                        array('url' => home_url('/community'), 'title' => __('Community', 'taoism-culture'), 'slug' => 'community'),
                                        array('url' => home_url('/about'), 'title' => __('About Us', 'taoism-culture'), 'slug' => 'about'),
                                    );
                                    echo '<ul class="flex flex-col gap-4">';
                                    foreach ($menu_items as $item) {
                                        $is_current = false;
                                        $current_url = home_url($_SERVER['REQUEST_URI']);
                                        
                                        // Check if current page matches
                                        if (rtrim($item['url'], '/') === rtrim($current_url, '/')) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'home' && is_front_page()) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'culture_article' && (is_post_type_archive('culture_article') || is_singular('culture_article'))) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'shop' && (is_shop() || is_product_category() || is_product() || is_cart() || is_checkout())) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'community' && is_page('community')) {
                                            $is_current = true;
                                        } elseif ($item['slug'] === 'about' && is_page('about')) {
                                            $is_current = true;
                                        }
                                        
                                        $classes = $is_current 
                                            ? 'text-primary text-lg font-medium block py-2' 
                                            : 'text-white text-lg font-medium hover:text-primary transition-colors block py-2';
                                        
                                        echo '<li><a class="' . $classes . '" href="' . esc_url($item['url']) . '">' . esc_html($item['title']) . '</a></li>';
                                    }
                                    echo '</ul>';
                                }
                            ));
                            ?>
                        </nav>
                    </div>
                </div>

                <main class="flex-grow">
