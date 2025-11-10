<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @package Taoism_Culture
 */

defined('ABSPATH') || exit;

global $product;

do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('single-product-wrapper', $product); ?>>

    <div class="container mx-auto px-4 sm:px-8 md:px-16 lg:px-24 xl:px-40 py-5">
        
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 mb-8">
            <?php
            if (function_exists('woocommerce_breadcrumb')) {
                woocommerce_breadcrumb(array(
                    'delimiter' => '<span class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal mx-2">/</span>',
                    'wrap_before' => '<nav class="breadcrumbs-wrapper">',
                    'wrap_after' => '</nav>',
                    'before' => '<span class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal hover:text-primary transition-colors">',
                    'after' => '</span>',
                ));
            }
            ?>
        </div>

        <!-- Product Main Content: Image Gallery + Product Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
            
            <!-- Image Gallery -->
            <div class="flex flex-col gap-4">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action('woocommerce_before_single_product_summary');
                ?>
            </div>

            <!-- Product Information -->
            <div class="flex flex-col gap-6 py-4">
                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 */
                do_action('woocommerce_single_product_summary');
                ?>
            </div>
        </div>

        <!-- Tabbed Description Section -->
        <div class="mt-16 lg:mt-24 w-full">
            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action('woocommerce_after_single_product_summary');
            ?>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>

