<?php
/**
 * Related Products - Custom Layout
 *
 * This template extends the default WooCommerce related products section
 * to reuse the `shop-product-card` markup from our archive grid so the
 * cards display consistently with the rest of the theme.
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!$related_products) {
    return;
}

$heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'woocommerce'));
$placeholder_image = function_exists('taoism_get_placeholder') ? taoism_get_placeholder('product-tea') : wc_placeholder_img_src();
?>

<section class="related products">
    <?php if ($heading) : ?>
        <h2><?php echo esc_html($heading); ?></h2>
    <?php endif; ?>

    <div class="related-products-grid shop-products-grid" role="list">
        <?php foreach ($related_products as $related_product) : ?>
            <?php
            $post_object = get_post($related_product->get_id());

            if (!$post_object) {
                continue;
            }

            setup_postdata($GLOBALS['post'] = $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
            wc_setup_product_data($post_object);

            $product = wc_get_product($post_object->ID);

            if (!$product) {
                continue;
            }

            $image_id = $product->get_image_id();
            $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'large') : $placeholder_image;

            $has_discount = $product->is_on_sale() && $product->get_regular_price() && $product->get_sale_price();
            $discount_badge = $has_discount
                ? '-' . absint(round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100)) . '%'
                : esc_html__('Sale', 'taoism-culture');
            ?>

            <article class="shop-product-card" role="listitem">
                <div class="shop-product-card__media">
                    <a class="shop-product-card__image-link" href="<?php the_permalink(); ?>">
                        <div
                            class="shop-product-card__image"
                            style='background-image: url("<?php echo esc_url($image_url); ?>");'
                        ></div>
                    </a>

                    <?php if ($product->is_on_sale()) : ?>
                        <span class="shop-product-card__badge">
                            <?php echo esc_html($discount_badge); ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($product->is_purchasable() && $product->is_in_stock()) : ?>
                        <button
                            class="shop-product-card__cart-button ajax-add-to-cart"
                            data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                            aria-label="<?php esc_attr_e('Add to cart', 'taoism-culture'); ?>"
                            type="button"
                        >
                            <span class="material-symbols-outlined" aria-hidden="true">add_shopping_cart</span>
                        </button>
                    <?php endif; ?>
                </div>

                <div class="shop-product-card__info">
                    <a class="shop-product-card__title-link" href="<?php the_permalink(); ?>">
                        <p class="shop-product-card__title"><?php the_title(); ?></p>
                    </a>

                    <div class="shop-product-card__price">
                        <?php echo wp_kses_post($product->get_price_html()); ?>
                    </div>

                    <?php if ($product->get_rating_count()) : ?>
                        <div class="shop-product-card__rating">
                            <?php woocommerce_template_loop_rating(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php
wp_reset_postdata();
wc_reset_product_data();

