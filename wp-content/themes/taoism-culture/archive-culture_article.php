<?php
/**
 * The template for displaying culture articles archive
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- PageHeading -->
<div class="px-4 sm:px-8 md:px-16 lg:px-24 xl:px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col w-full max-w-screen-xl flex-1">
        <div class="flex flex-wrap justify-between gap-3 p-4">
            <div class="flex min-w-72 flex-col gap-3">
                <p class="text-black dark:text-white text-4xl font-black font-display leading-tight tracking-[-0.033em]">
                    <?php esc_html_e('文化交流中心', 'taoism-culture'); ?>
                </p>
                <p class="text-gray-600 dark:text-[#92c9b7] text-base font-normal leading-normal">
                    <?php esc_html_e('弘扬道教文化，促进用户交流，分享智慧与见解。', 'taoism-culture'); ?>
                </p>
            </div>
        </div>
        
        <!-- Tabs -->
        <div class="pb-3 mt-4">
            <div class="flex border-b border-gray-200 dark:border-[#326755] px-4 gap-8">
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-primary pb-[13px] pt-4" href="<?php echo esc_url(get_post_type_archive_link('culture_article')); ?>">
                    <p class="text-primary text-sm font-bold leading-normal tracking-[0.015em]"><?php esc_html_e('文化文章', 'taoism-culture'); ?></p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-gray-500 dark:text-[#92c9b7] pb-[13px] pt-4 hover:text-primary hover:border-b-primary/50 transition-all duration-300" href="<?php echo esc_url(get_post_type_archive_link('taoism_lecture')); ?>">
                    <p class="text-sm font-bold leading-normal tracking-[0.015em]"><?php esc_html_e('道法讲座', 'taoism-culture'); ?></p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-gray-500 dark:text-[#92c9b7] pb-[13px] pt-4 hover:text-primary hover:border-b-primary/50 transition-all duration-300" href="<?php echo esc_url(home_url('/community')); ?>">
                    <p class="text-sm font-bold leading-normal tracking-[0.015em]"><?php esc_html_e('互动论坛', 'taoism-culture'); ?></p>
                </a>
            </div>
        </div>
        
        <!-- ImageGrid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-4 mt-4">
            <?php
            if (have_posts()) :
                $placeholder_keys = array('culture-daodejing', 'culture-seasons', 'culture-zhuangzi', 'culture-neidan', 'culture-art', 'culture-yijing');
                $post_index = 0;
                while (have_posts()) :
                    the_post();
                    $author_title = get_post_meta(get_the_ID(), '_author_title', true);
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'taoism-culture-card');
                    if (!$thumbnail_url) {
                        // Try custom thumbnail URL
                        $thumbnail_url = get_post_meta(get_the_ID(), '_thumbnail_url', true);
                        if (!$thumbnail_url) {
                            // Use culture-related placeholders
                            $thumbnail_url = taoism_get_placeholder($placeholder_keys[$post_index % count($placeholder_keys)]);
                        }
                    }
                    $post_index++;
                    ?>
                    <article class="flex flex-col gap-3 pb-3 group">
                        <a href="<?php the_permalink(); ?>">
                            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg overflow-hidden transform group-hover:scale-105 transition-transform duration-300" style='background-image: url("<?php echo esc_url($thumbnail_url); ?>");'></div>
                        </a>
                        <div>
                            <a href="<?php the_permalink(); ?>">
                                <p class="text-black dark:text-white text-lg font-medium leading-normal font-display group-hover:text-primary transition-colors">
                                    <?php the_title(); ?>
                                </p>
                            </a>
                            <p class="text-gray-500 dark:text-[#92c9b7] text-sm font-normal leading-normal mt-1">
                                <?php 
                                if ($author_title) {
                                    echo esc_html($author_title);
                                } else {
                                    the_author();
                                }
                                echo ' • ';
                                echo get_the_date();
                                ?>
                            </p>
                            <p class="text-gray-600 dark:text-[#92c9b7] text-sm font-normal leading-normal mt-2">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>
                        </div>
                    </article>
                    <?php
                endwhile;
            else :
                ?>
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 dark:text-[#92c9b7] text-lg">
                        <?php esc_html_e('No articles found. Please check back later.', 'taoism-culture'); ?>
                    </p>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <!-- Pagination -->
        <?php if (get_the_posts_pagination()) : ?>
        <div class="flex items-center justify-center p-4 mt-8">
            <?php
            $prev_link = get_previous_posts_link();
            $next_link = get_next_posts_link();
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $max_pages = $GLOBALS['wp_query']->max_num_pages;
            ?>
            
            <?php if ($prev_link) : ?>
                <a href="<?php echo esc_url(get_previous_posts_page_link()); ?>" class="flex size-10 items-center justify-center text-gray-500 dark:text-white hover:text-primary transition-colors">
                    <span class="material-symbols-outlined" style="font-size: 18px;">chevron_left</span>
                </a>
            <?php else : ?>
                <span class="flex size-10 items-center justify-center text-gray-300 dark:text-gray-600">
                    <span class="material-symbols-outlined" style="font-size: 18px;">chevron_left</span>
                </span>
            <?php endif; ?>
            
            <?php
            // Show page numbers
            for ($i = 1; $i <= $max_pages; $i++) :
                if ($i == $paged) :
                    ?>
                    <span class="text-sm font-bold leading-normal tracking-[0.015em] flex size-10 items-center justify-center text-white rounded-full bg-primary">
                        <?php echo $i; ?>
                    </span>
                    <?php
                elseif ($i == 1 || $i == $max_pages || ($i >= $paged - 1 && $i <= $paged + 1)) :
                    ?>
                    <a href="<?php echo esc_url(get_pagenum_link($i)); ?>" class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-black dark:text-white rounded-full hover:bg-primary/20 transition-colors">
                        <?php echo $i; ?>
                    </a>
                    <?php
                elseif ($i == $paged - 2 || $i == $paged + 2) :
                    ?>
                    <span class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-black dark:text-white rounded-full">...</span>
                    <?php
                endif;
            endfor;
            ?>
            
            <?php if ($next_link) : ?>
                <a href="<?php echo esc_url(get_next_posts_page_link()); ?>" class="flex size-10 items-center justify-center text-gray-500 dark:text-white hover:text-primary transition-colors">
                    <span class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span>
                </a>
            <?php else : ?>
                <span class="flex size-10 items-center justify-center text-gray-300 dark:text-gray-600">
                    <span class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span>
                </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
