<?php
/**
 * The main template file
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="site-main" role="main">
    <div class="container">
        <?php
        if (have_posts()) :
            ?>
            <div class="posts-grid grid-auto-fit">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', get_post_type());
                endwhile;
                ?>
            </div>

            <?php
            taoism_pagination();
        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </div>
</main>

<?php
get_footer();

