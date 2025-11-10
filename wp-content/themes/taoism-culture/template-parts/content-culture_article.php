<?php
/**
 * Template part for displaying culture articles
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('culture-card'); ?>>
    <a href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <div class="culture-card-image" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(null, 'taoism-culture-card')); ?>');"></div>
        <?php else : ?>
            <div class="culture-card-image" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>');"></div>
        <?php endif; ?>
        
        <div class="culture-card-content">
            <h3><?php the_title(); ?></h3>
            <div class="post-meta">
                <span class="author"><?php echo esc_html(taoism_get_author_title()); ?></span>
                <span class="separator"> • </span>
                <time class="date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
            </div>
            <p><?php echo esc_html(get_the_excerpt()); ?></p>
        </div>
    </a>
</article>

