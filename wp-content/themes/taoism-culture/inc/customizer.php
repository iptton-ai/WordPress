<?php
/**
 * Theme Customizer
 *
 * @package Taoism_Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add postMessage support for site title and description
 */
function taoism_culture_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    // Theme Options Section
    $wp_customize->add_section('taoism_theme_options', array(
        'title'    => __('Theme Options', 'taoism-culture'),
        'priority' => 130,
    ));

    // Enable Dark Mode
    $wp_customize->add_setting('taoism_dark_mode', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('taoism_dark_mode', array(
        'label'    => __('Enable Dark Mode by Default', 'taoism-culture'),
        'section'  => 'taoism_theme_options',
        'type'     => 'checkbox',
    ));

    // Hero Section
    $wp_customize->add_section('taoism_hero_section', array(
        'title'    => __('Hero Section', 'taoism-culture'),
        'priority' => 131,
    ));

    // Hero Image
    $wp_customize->add_setting('taoism_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'taoism_hero_image', array(
        'label'    => __('Hero Background Image', 'taoism-culture'),
        'section'  => 'taoism_hero_section',
        'settings' => 'taoism_hero_image',
    )));

    // Hero Title
    $wp_customize->add_setting('taoism_hero_title', array(
        'default'           => __('The Way of Nature', 'taoism-culture'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('taoism_hero_title', array(
        'label'    => __('Hero Title', 'taoism-culture'),
        'section'  => 'taoism_hero_section',
        'type'     => 'text',
    ));

    // Hero Description
    $wp_customize->add_setting('taoism_hero_description', array(
        'default'           => __('Embrace the harmony of the natural world and discover tranquility within.', 'taoism-culture'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('taoism_hero_description', array(
        'label'    => __('Hero Description', 'taoism-culture'),
        'section'  => 'taoism_hero_section',
        'type'     => 'textarea',
    ));

    // Hero Button Text
    $wp_customize->add_setting('taoism_hero_button_text', array(
        'default'           => __('Explore More', 'taoism-culture'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('taoism_hero_button_text', array(
        'label'    => __('Hero Button Text', 'taoism-culture'),
        'section'  => 'taoism_hero_section',
        'type'     => 'text',
    ));

    // Hero Button Link
    $wp_customize->add_setting('taoism_hero_button_link', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('taoism_hero_button_link', array(
        'label'    => __('Hero Button Link', 'taoism-culture'),
        'section'  => 'taoism_hero_section',
        'type'     => 'url',
    ));

    // Footer Section
    $wp_customize->add_section('taoism_footer_section', array(
        'title'    => __('Footer Settings', 'taoism-culture'),
        'priority' => 132,
    ));

    // Footer Text
    $wp_customize->add_setting('taoism_footer_text', array(
        'default'           => __('Embracing the path of balance and harmony. A curated space for cultural exploration and mindful living.', 'taoism-culture'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('taoism_footer_text', array(
        'label'    => __('Footer Description', 'taoism-culture'),
        'section'  => 'taoism_footer_section',
        'type'     => 'textarea',
    ));

    // Copyright Text
    $wp_customize->add_setting('taoism_copyright_text', array(
        'default'           => '© ' . date('Y') . ' 道 • All Rights Reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('taoism_copyright_text', array(
        'label'    => __('Copyright Text', 'taoism-culture'),
        'section'  => 'taoism_footer_section',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'taoism_culture_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously
 */
function taoism_culture_customize_preview_js() {
    wp_enqueue_script(
        'taoism-culture-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('customize-preview'),
        TAOISM_THEME_VERSION,
        true
    );
}
add_action('customize_preview_init', 'taoism_culture_customize_preview_js');

