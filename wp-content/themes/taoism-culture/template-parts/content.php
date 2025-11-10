<?php
/**
 * Template part for displaying posts
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large'); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="post-content">
        <header class="post-header">
            <?php
            if (is_singular()) :
                the_title('<h1 class="post-title">', '</h1>');
            else :
                the_title('<h2 class="post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            if ('post' === get_post_type()) :
                ?>
                <div class="post-meta">
                    <?php taoism_post_meta(); ?>
                </div>
                <?php
            endif;
            ?>
        </header>

        <div class="post-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <?php if (!is_singular()) : ?>
            <div class="post-footer">
                <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                    <?php esc_html_e('Read More', 'taoism-culture'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</article>

