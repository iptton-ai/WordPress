<?php
/**
 * The Template for displaying product archives
 *
 * @package Taoism_Culture
 */

defined('ABSPATH') || exit;

get_header('shop');

$product_categories = get_terms(
    array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
    )
);

$show_page_title = apply_filters('woocommerce_show_page_title', true);

$categories_markup = '';
ob_start();
?>
<div class="shop-filters__section">
    <h3 class="shop-filters__title"><?php esc_html_e('Categories', 'taoism-culture'); ?></h3>
    <ul class="shop-filters__list">
        <?php
        $all_active = !is_product_category();
        ?>
        <li>
            <a class="shop-filters__link<?php echo $all_active ? ' is-active' : ''; ?>" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                <?php esc_html_e('All Merchandise', 'taoism-culture'); ?>
            </a>
        </li>
        <?php
        if ($product_categories && !is_wp_error($product_categories)) :
            foreach ($product_categories as $category) :
                $is_current = is_product_category($category->slug);
                ?>
                <li>
                    <a class="shop-filters__link<?php echo $is_current ? ' is-active' : ''; ?>" href="<?php echo esc_url(get_term_link($category)); ?>">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </li>
                <?php
            endforeach;
        endif;
        ?>
    </ul>
</div>
<?php
$categories_markup = ob_get_clean();
?>

<main class="shop-layout">
    <div class="shop-layout__container">
        <?php woocommerce_output_all_notices(); ?>

        <div class="shop-layout__body">
            <aside class="shop-layout__sidebar" aria-label="<?php esc_attr_e('Product filters', 'taoism-culture'); ?>">
                <div class="shop-filters">
                    <?php echo $categories_markup; ?>

                    <div class="shop-filters__section">
                        <h3 class="shop-filters__title"><?php esc_html_e('Price Range', 'taoism-culture'); ?></h3>
                        <div class="shop-filters__widget shop-filters__widget--price">
                            <?php
                            the_widget(
                                'WC_Widget_Price_Filter',
                                array(
                                    'title' => '',
                                ),
                                array(
                                    'before_widget' => '',
                                    'after_widget'  => '',
                                )
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="shop-layout__main">
                <details class="shop-layout__mobile-filters">
                    <summary class="shop-layout__mobile-filters-toggle">
                        <span><?php esc_html_e('Filters & Sorting', 'taoism-culture'); ?></span>
                        <span class="shop-layout__mobile-filters-icon" aria-hidden="true"></span>
                    </summary>
                    <div class="shop-layout__mobile-filters-panel">
                        <div class="shop-filters shop-filters--mobile">
                            <?php echo $categories_markup; ?>

                            <div class="shop-filters__section">
                                <h3 class="shop-filters__title"><?php esc_html_e('Price Range', 'taoism-culture'); ?></h3>
                                <div class="shop-filters__widget shop-filters__widget--price">
                                    <?php
                                    the_widget(
                                        'WC_Widget_Price_Filter',
                                        array(
                                            'title' => '',
                                        ),
                                        array(
                                            'before_widget' => '',
                                            'after_widget'  => '',
                                        )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="shop-filters__section shop-filters__section--sorting">
                                <h3 class="shop-filters__title"><?php esc_html_e('Sort By', 'taoism-culture'); ?></h3>
                                <?php echo taoism_culture_render_catalog_ordering(true); ?>
                            </div>
                        </div>
                    </div>
                </details>

                <?php if (woocommerce_product_loop()) : ?>
                    <nav class="shop-layout__breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'taoism-culture'); ?>">
                        <a class="shop-layout__breadcrumb-link" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php esc_html_e('Home', 'taoism-culture'); ?>
                        </a>
                        <span class="shop-layout__breadcrumb-separator" aria-hidden="true">/</span>
                        <a class="shop-layout__breadcrumb-link" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                            <?php esc_html_e('Merchandise', 'taoism-culture'); ?>
                        </a>
                        <?php if (is_product_category()) : ?>
                            <span class="shop-layout__breadcrumb-separator" aria-hidden="true">/</span>
                            <span class="shop-layout__breadcrumb-current">
                                <?php single_term_title(); ?>
                            </span>
                        <?php else : ?>
                            <span class="shop-layout__breadcrumb-separator" aria-hidden="true">/</span>
                            <span class="shop-layout__breadcrumb-current">
                                <?php esc_html_e('All', 'taoism-culture'); ?>
                            </span>
                        <?php endif; ?>
                    </nav>

                    <?php if ($show_page_title) : ?>
                        <header class="shop-layout__header">
                            <h1 class="shop-layout__title">
                                <?php
                                if (is_product_category()) {
                                    single_term_title();
                                } else {
                                    echo esc_html__('道缘市集 (All Merchandise)', 'taoism-culture');
                                }
                                ?>
                            </h1>
                        </header>
                    <?php endif; ?>

                    <?php do_action('woocommerce_archive_description'); ?>

                    <div class="shop-layout__toolbar">
                        <div class="shop-layout__result-count">
                            <?php woocommerce_result_count(); ?>
                        </div>
                        <?php echo taoism_culture_render_catalog_ordering(); ?>
                    </div>

                    <?php do_action('woocommerce_before_shop_loop'); ?>

                    <div class="shop-products-grid" role="list">
                        <?php
                        if (wc_get_loop_prop('total')) :
                            while (have_posts()) :
                                the_post();
                                global $product;
                                $product_image = wp_get_attachment_url($product->get_image_id());
                                if (!$product_image) {
                                    $product_image = taoism_get_placeholder('product-tea');
                                }
                                ?>
                                <article class="shop-product-card" role="listitem">
                                    <div class="shop-product-card__media">
                                        <a class="shop-product-card__image-link" href="<?php the_permalink(); ?>">
                                            <div class="shop-product-card__image" style='background-image: url("<?php echo esc_url($product_image); ?>");'></div>
                                        </a>
                                        <?php if ($product->is_on_sale()) : ?>
                                            <span class="shop-product-card__badge">
                                                <?php esc_html_e('Sale', 'taoism-culture'); ?>
                                            </span>
                                        <?php endif; ?>
                                        <button class="shop-product-card__cart-button ajax-add-to-cart" data-product-id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php esc_attr_e('Add to cart', 'taoism-culture'); ?>">
                                            <span class="material-symbols-outlined" aria-hidden="true">add_shopping_cart</span>
                                        </button>
                                    </div>

                                    <div class="shop-product-card__info">
                                        <a class="shop-product-card__title-link" href="<?php the_permalink(); ?>">
                                            <p class="shop-product-card__title">
                                                <?php the_title(); ?>
                                            </p>
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
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </div>

                    <?php do_action('woocommerce_after_shop_loop'); ?>

                <?php else : ?>

                    <?php do_action('woocommerce_no_products_found'); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer('shop');
