<?php
/**
 * The template for displaying the footer
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

                </main><!-- End main -->
                
                <!-- Footer -->
                <footer class="w-full bg-black/5 dark:bg-white/5 mt-20">
                    <div class="max-w-6xl mx-auto px-4 sm:px-8 py-12">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div class="col-span-1 md:col-span-2">
                                <div class="flex items-center gap-4 text-black dark:text-white">
                                    <div class="size-6 text-primary">
                                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M44 11.2727C44 14.0109 39.8386 16.3957 33.69 17.6364C39.8386 18.877 44 21.2618 44 24C44 26.7382 39.8386 29.123 33.69 30.3636C39.8386 31.6043 44 33.9891 44 36.7273C44 40.7439 35.0457 44 24 44C12.9543 44 4 40.7439 4 36.7273C4 33.9891 8.16144 31.6043 14.31 30.3636C8.16144 29.123 4 26.7382 4 24C4 21.2618 8.16144 18.877 14.31 17.6364C8.16144 16.3957 4 14.0109 4 11.2727C4 7.25611 12.9543 4 24 4C35.0457 4 44 7.25611 44 11.2727Z" fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold leading-tight tracking-[-0.015em] font-display"><?php bloginfo('name'); ?></h2>
                                </div>
                                <p class="mt-4 text-sm text-gray-600 dark:text-gray-300 max-w-sm font-sans">
                                    <?php
                                    $footer_text = get_theme_mod('taoism_footer_text', __('Embracing the path of balance and harmony. A curated space for cultural exploration and mindful living.', 'taoism-culture'));
                                    echo esc_html($footer_text);
                                    ?>
                                </p>
                            </div>
                            <div>
                                <h3 class="font-bold text-black dark:text-white font-display"><?php esc_html_e('Explore', 'taoism-culture'); ?></h3>
                                <ul class="mt-4 space-y-2 text-sm font-sans">
                                    <li><a class="text-gray-600 dark:text-gray-300 hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About Us', 'taoism-culture'); ?></a></li>
                                    <li><a class="text-gray-600 dark:text-gray-300 hover:text-primary transition-colors" href="<?php echo esc_url(get_post_type_archive_link('culture_article')); ?>"><?php esc_html_e('Articles', 'taoism-culture'); ?></a></li>
                                    <?php if (class_exists('WooCommerce') && function_exists('wc_get_page_permalink')) : ?>
                                        <li><a class="text-gray-600 dark:text-gray-300 hover:text-primary transition-colors" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('Shop', 'taoism-culture'); ?></a></li>
                                    <?php endif; ?>
                                    <li><a class="text-gray-600 dark:text-gray-300 hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/community')); ?>"><?php esc_html_e('Community Forum', 'taoism-culture'); ?></a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-bold text-black dark:text-white font-display"><?php esc_html_e('Support', 'taoism-culture'); ?></h3>
                                <ul class="mt-4 space-y-2 text-sm font-sans">
                                    <li><a class="text-gray-600 dark:text-gray-300 hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/faq')); ?>"><?php esc_html_e('FAQ', 'taoism-culture'); ?></a></li>
                                    <li><a class="text-gray-600 dark:text-gray-300 hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact Us', 'taoism-culture'); ?></a></li>
                                    <?php if (class_exists('WooCommerce')) : ?>
                                        <li><a class="text-gray-600 dark:text-gray-300 hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/shipping-returns')); ?>"><?php esc_html_e('Shipping & Returns', 'taoism-culture'); ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-12 border-t border-black/10 dark:border-white/10 pt-8 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600 dark:text-gray-300 font-sans">
                            <p>
                                <?php
                                $copyright_text = get_theme_mod('taoism_copyright_text', '© ' . date('Y') . ' 道 • All Rights Reserved.');
                                echo esc_html($copyright_text);
                                ?>
                            </p>
                            <div class="flex space-x-4 mt-4 sm:mt-0">
                                <a class="hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/terms')); ?>"><?php esc_html_e('Terms of Service', 'taoism-culture'); ?></a>
                                <a class="hover:text-primary transition-colors" href="<?php echo esc_url(home_url('/privacy')); ?>"><?php esc_html_e('Privacy Policy', 'taoism-culture'); ?></a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div><!-- .layout-content-container -->
        </div><!-- .flex flex-1 -->
    </div><!-- .layout-container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
