<?php
/**
 * The template for displaying single culture article
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="site-main single-culture-article" role="main">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            
            <?php taoism_breadcrumbs(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('article-content'); ?>>
                <header class="article-header">
                    <h1 class="article-title"><?php the_title(); ?></h1>
                    
                    <div class="article-meta">
                        <span class="author"><?php echo esc_html(taoism_get_author_title()); ?></span>
                        <span class="separator"> • </span>
                        <time class="date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                        
                        <?php if (has_term('', 'culture_category')) : ?>
                            <span class="separator"> • </span>
                            <span class="category">
                                <?php
                                $terms = get_the_terms(get_the_ID(), 'culture_category');
                                if ($terms && !is_wp_error($terms)) {
                                    $term_names = wp_list_pluck($terms, 'name');
                                    echo esc_html(implode(', ', $term_names));
                                }
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="article-featured-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="article-body">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'taoism-culture'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="article-footer">
                    <?php if (has_tag()) : ?>
                        <div class="article-tags">
                            <span class="tags-label"><?php esc_html_e('Tags:', 'taoism-culture'); ?></span>
                            <?php the_tags('', ', ', ''); ?>
                        </div>
                    <?php endif; ?>

                    <?php taoism_social_share(); ?>
                </footer>
            </article>

            <?php
            // Related articles
            $related_args = array(
                'post_type'      => 'culture_article',
                'posts_per_page' => 3,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'rand',
            );

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) :
                ?>
                <section class="related-articles">
                    <h2 class="section-title"><?php esc_html_e('Related Articles', 'taoism-culture'); ?></h2>
                    <div class="culture-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
                        <?php
                        while ($related_query->have_posts()) :
                            $related_query->the_post();
                            get_template_part('template-parts/content', 'culture_article');
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </section>
                <?php
            endif;

            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();

