<?php
/**
 * The template for displaying the front page
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Hero Carousel -->
<section class="w-full flex justify-center py-5">
    <div class="w-full max-w-6xl px-4">
        <div class="relative flex overflow-hidden rounded-xl">
            <div class="flex w-full items-stretch">
                <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-lg bg-surface-dark shadow-lg min-w-full">
                    <div class="w-full bg-center bg-no-repeat aspect-[2.5/1] bg-cover rounded-lg flex flex-col justify-end p-12" style='background-image: url("<?php echo esc_url(taoism_get_placeholder('hero')); ?>");'>
                        <div class="bg-black/30 backdrop-blur-sm p-6 rounded-lg max-w-md">
                            <h2 class="text-white text-3xl md:text-4xl font-bold leading-tight tracking-tight font-display">
                                <?php echo esc_html(get_theme_mod('taoism_hero_title', __('The Way of Nature', 'taoism-culture'))); ?>
                            </h2>
                            <p class="text-gray-200 text-base md:text-lg font-normal leading-normal mt-2 font-sans">
                                <?php echo esc_html(get_theme_mod('taoism_hero_description', __('Embrace the harmony of the natural world and discover tranquility within.', 'taoism-culture'))); ?>
                            </p>
                            <?php
                            $button_link = get_theme_mod('taoism_hero_button_link', get_post_type_archive_link('culture_article'));
                            $button_text = get_theme_mod('taoism_hero_button_text', __('Explore More', 'taoism-culture'));
                            ?>
                            <a href="<?php echo esc_url($button_link); ?>" class="flex mt-6 min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-background-dark text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                                <span class="truncate font-sans"><?php echo esc_html($button_text); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SectionHeader: Culture Recommendations -->
<div class="w-full flex justify-center pt-10">
    <div class="w-full max-w-6xl px-4">
        <h2 class="text-black dark:text-white text-3xl font-bold leading-tight tracking-tight font-display px-4 pb-3 pt-5 border-b border-black/10 dark:border-white/10">
            <?php esc_html_e('文化推荐 (Culture Recommendations)', 'taoism-culture'); ?>
        </h2>
    </div>
</div>

<!-- ImageGrid: Culture Recommendations -->
<div class="w-full flex justify-center py-5">
    <div class="w-full max-w-6xl px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-4">
            <?php
            $culture_args = array(
                'post_type'      => 'culture_article',
                'posts_per_page' => 4,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $culture_query = new WP_Query($culture_args);

            if ($culture_query->have_posts()) :
                $placeholder_keys = array('culture-wuwei', 'culture-laozi', 'culture-calligraphy', 'culture-meditation');
                $index = 0;
                while ($culture_query->have_posts()) :
                    $culture_query->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'taoism-culture-card');
                    if (!$thumbnail_url) {
                        $thumbnail_url = taoism_get_placeholder($placeholder_keys[$index % count($placeholder_keys)]);
                    }
                    $index++;
                    ?>
                    <a href="<?php the_permalink(); ?>" class="flex flex-col gap-3 pb-3 group">
                        <div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden shadow-md">
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 ease-in-out group-hover:scale-105" style='background-image: url("<?php echo esc_url($thumbnail_url); ?>");'></div>
                        </div>
                        <div>
                            <p class="text-black dark:text-white text-lg font-medium leading-normal font-display group-hover:text-primary transition-colors"><?php the_title(); ?></p>
                            <p class="text-gray-600 dark:text-gray-300 text-sm font-normal leading-normal font-sans"><?php echo esc_html(get_the_excerpt()); ?></p>
                        </div>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default placeholders
                $default_culture = array(
                    array(
                        'title' => __('Philosophy of Wu Wei', 'taoism-culture'),
                        'excerpt' => __('Discover the art of effortless action.', 'taoism-culture'),
                        'image' => taoism_get_placeholder('culture-wuwei')
                    ),
                    array(
                        'title' => __('The Story of Laozi', 'taoism-culture'),
                        'excerpt' => __('Learn about the ancient sage.', 'taoism-culture'),
                        'image' => taoism_get_placeholder('culture-laozi')
                    ),
                    array(
                        'title' => __('The Art of Calligraphy', 'taoism-culture'),
                        'excerpt' => __('The meditative flow of ink on paper.', 'taoism-culture'),
                        'image' => taoism_get_placeholder('culture-calligraphy')
                    ),
                    array(
                        'title' => __('Taoist Meditation Guide', 'taoism-culture'),
                        'excerpt' => __('Find inner peace and tranquility.', 'taoism-culture'),
                        'image' => taoism_get_placeholder('culture-meditation')
                    ),
                );
                foreach ($default_culture as $item) :
                    ?>
                    <div class="flex flex-col gap-3 pb-3 group">
                        <div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-xl overflow-hidden shadow-md">
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 ease-in-out group-hover:scale-105" style='background-image: url("<?php echo esc_url($item['image']); ?>");'></div>
                        </div>
                        <div>
                            <p class="text-black dark:text-white text-lg font-medium leading-normal font-display"><?php echo esc_html($item['title']); ?></p>
                            <p class="text-gray-600 dark:text-gray-300 text-sm font-normal leading-normal font-sans"><?php echo esc_html($item['excerpt']); ?></p>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>

<!-- Call-to-Action Section -->
<section class="w-full flex justify-center py-10 my-10 bg-black/5 dark:bg-white/5">
    <div class="w-full max-w-6xl px-4 text-center">
        <h3 class="text-3xl font-bold font-display text-black dark:text-white">
            <?php esc_html_e('Explore Our Philosophy', 'taoism-culture'); ?>
        </h3>
        <p class="mt-2 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto font-sans">
            <?php esc_html_e('Delve into the timeless wisdom of Tao. Understand the principles of balance, harmony, and living in accordance with the natural flow of the universe.', 'taoism-culture'); ?>
        </p>
        <a href="<?php echo esc_url(get_post_type_archive_link('culture_article')); ?>" class="mt-8 inline-flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-8 bg-primary text-background-dark text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
            <span class="truncate font-sans"><?php esc_html_e('Begin Your Journey', 'taoism-culture'); ?></span>
        </a>
    </div>
</section>

<!-- SectionHeader: New Arrivals -->
<?php if (class_exists('WooCommerce')) : ?>
<div class="w-full flex justify-center">
    <div class="w-full max-w-6xl px-4">
        <h2 class="text-black dark:text-white text-3xl font-bold leading-tight tracking-tight font-display px-4 pb-3 pt-5 border-b border-black/10 dark:border-white/10">
            <?php esc_html_e('新品上架 (New Arrivals)', 'taoism-culture'); ?>
        </h2>
    </div>
</div>

<!-- Product Grid -->
<div class="w-full flex justify-center py-5">
    <div class="w-full max-w-6xl px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-4">
            <?php
            $product_args = array(
                'post_type'      => 'product',
                'posts_per_page' => 4,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $product_query = new WP_Query($product_args);

            if ($product_query->have_posts()) :
                while ($product_query->have_posts()) :
                    $product_query->the_post();
                    global $product;
                    $product_image = wp_get_attachment_url($product->get_image_id());
                    if (!$product_image) {
                        $product_image = taoism_get_placeholder('product-tea');
                    }
                    ?>
                    <div class="flex flex-col gap-3 pb-3 group">
                        <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl overflow-hidden shadow-md relative">
                            <a href="<?php the_permalink(); ?>">
                                <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 ease-in-out group-hover:scale-105" style='background-image: url("<?php echo esc_url($product_image); ?>");'></div>
                            </a>
                            <button class="absolute bottom-4 right-4 flex items-center justify-center h-10 w-10 rounded-full bg-primary text-background-dark opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-lg hover:scale-110 ajax-add-to-cart" data-product-id="<?php echo esc_attr($product->get_id()); ?>" aria-label="<?php esc_attr_e('Add to cart', 'taoism-culture'); ?>">
                                <span class="material-symbols-outlined text-xl">add_shopping_cart</span>
                            </button>
                        </div>
                        <div>
                            <a href="<?php the_permalink(); ?>">
                                <p class="text-black dark:text-white text-lg font-medium leading-normal font-sans group-hover:text-primary transition-colors"><?php the_title(); ?></p>
                            </a>
                            <p class="text-primary text-base font-semibold leading-normal font-sans"><?php echo $product->get_price_html(); ?></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default placeholder products
                $placeholder_products = array(
                    array('name' => __('Ceramic Tea Set', 'taoism-culture'), 'price' => '$45.00', 'image' => taoism_get_placeholder('product-tea')),
                    array('name' => __('Meditation Cushion', 'taoism-culture'), 'price' => '$60.00', 'image' => taoism_get_placeholder('product-cushion')),
                    array('name' => __('Calligraphic Scroll', 'taoism-culture'), 'price' => '$120.00', 'image' => taoism_get_placeholder('product-scroll')),
                    array('name' => __('Natural Incense', 'taoism-culture'), 'price' => '$15.00', 'image' => taoism_get_placeholder('product-incense')),
                );
                foreach ($placeholder_products as $item) :
                    ?>
                    <div class="flex flex-col gap-3 pb-3 group">
                        <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl overflow-hidden shadow-md relative">
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-500 ease-in-out group-hover:scale-105" style='background-image: url("<?php echo esc_url($item['image']); ?>");'></div>
                        </div>
                        <div>
                            <p class="text-black dark:text-white text-lg font-medium leading-normal font-sans"><?php echo esc_html($item['name']); ?></p>
                            <p class="text-primary text-base font-semibold leading-normal font-sans"><?php echo esc_html($item['price']); ?></p>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
        
        <div class="text-center mt-8">
            <?php if (function_exists('wc_get_page_permalink')) : ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="inline-flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-8 bg-transparent border-2 border-primary text-primary text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary hover:text-background-dark transition-all">
                    <span class="truncate font-sans"><?php esc_html_e('View All Products', 'taoism-culture'); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
get_footer();
