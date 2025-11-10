/**
 * Theme Customizer enhancements for a better user experience.
 *
 * @package Taoism_Culture
 */

(function($) {
    // Site title
    wp.customize('blogname', function(value) {
        value.bind(function(to) {
            $('.site-title a').text(to);
        });
    });

    // Site description
    wp.customize('blogdescription', function(value) {
        value.bind(function(to) {
            $('.site-description').text(to);
        });
    });

    // Hero title
    wp.customize('taoism_hero_title', function(value) {
        value.bind(function(to) {
            $('.hero-content h2').text(to);
        });
    });

    // Hero description
    wp.customize('taoism_hero_description', function(value) {
        value.bind(function(to) {
            $('.hero-content p').text(to);
        });
    });

    // Hero button text
    wp.customize('taoism_hero_button_text', function(value) {
        value.bind(function(to) {
            $('.hero-content .btn-primary span').text(to);
        });
    });

    // Footer text
    wp.customize('taoism_footer_text', function(value) {
        value.bind(function(to) {
            $('.footer-description').text(to);
        });
    });

    // Copyright text
    wp.customize('taoism_copyright_text', function(value) {
        value.bind(function(to) {
            $('.footer-copyright').text(to);
        });
    });
})(jQuery);

