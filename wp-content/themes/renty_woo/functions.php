<?php

function load_theme_scripts()
{
    wp_enqueue_style("theme-css", get_template_directory_uri() . '/assets/css/theme.css', array(), "1.0", "all");

    wp_enqueue_style("theme-style", get_stylesheet_uri(), array(), "1.0", "all");

    wp_enqueue_script("script-js", get_template_directory_uri() . '/assets/js/script.js', array("jquery"), "1.0", true);
}

add_action("wp_enqueue_scripts", "load_theme_scripts");

// register nav menu

function simple_basic_theme_nav_config()
{
    register_nav_menus(
        array(
            "theme_primary_menu" => "Главное меню",
            "theme_footer_menu" => "Нижнее меню",
            "theme_sidebar_menu" => "Боковое меню"
        )
    );
}
add_action("after_setup_theme", "simple_basic_theme_nav_config");
