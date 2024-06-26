<?php
function load_theme_scripts()
{
    // bootstrap theme
    // wp_enqueue_style("bootstrap-style", get_template_directory_uri() . '/assets/css/styles.css', array(), "1.0", "all");

    // wp_enqueue_script("bootstrap-script", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js", array(), "1.0", true);

    // theme styles

    wp_enqueue_style('main_style', get_template_directory_uri() . '/main.css', array(), '1.0');

    wp_enqueue_style("theme-style", get_stylesheet_uri(), array(), "1.0", "all");

    // js file

    // wp_enqueue_script("theme-js", get_template_directory_uri() . '/assets/js/scripts.js', array("jquery"), "1.0", true);
    wp_enqueue_script('webpack', get_stylesheet_directory_uri() . '/scripts/index.js', array('jquery'), null, true);


    // Подключаем JS Lightbox2
    wp_enqueue_script('lightbox2-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), null, true);

    wp_enqueue_style('lightbox2-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', array(), "1.0", "all");
    // Скрипты
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, false);
    wp_enqueue_script('jquery');

    // Подключаем jQuery UI
    wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '1.12.1', true);
    wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', false, '1.12.1', 'all');
}

add_action("wp_enqueue_scripts", "load_theme_scripts");

add_theme_support('post-thumbnails'); // для всех типов постов

function simple_basic_theme_nav_config()
{
    register_nav_menus(
        array(
            "theme_primary_menu" => "Главное меню",
            "theme_footer_menu" => "Нижнее меню"
        )
    );

    // register theme support
    add_theme_support("post-thumbnails");

    add_theme_support('woocommerce', array(
        "thumbnaul_image_width" => 500,
        "single_image_width" => 500,
        "product_grid" => array(
            "default_columns" => 10,
            "min_columns" => 2,
            "max_columns" => 3
        )
    ));

    add_theme_support("wc-product-gallery-zoom");
    add_theme_support("wc-product-gallery-lightbox");
    add_theme_support("wc-product-gallery-slider");
}
add_action("after_setup_theme", "simple_basic_theme_nav_config");

function theme_add_li_class($classes, $item, $args)
{
    $classes[] = "nav-item";
    return $classes;
}
add_filter("nav_menu_css_class", "theme_add_li_class", 1, 3);

function theme_add_anchor_links($classes, $item, $args)
{
    $classes['class'] = "nav-link";
    return $classes;
}
add_filter("nav_menu_link_attributes", "theme_add_anchor_links", 1, 3);


if (class_exists("Woocommerce")) {
    include_once 'include/wc-modifications.php';
};


// ADMINS
// Регистрируем возможности темы
add_action('after_setup_theme', function () {

    // возможность изменять фон из админки
    add_theme_support('custom-background');

    // возможность изменять изображения в шапке из админки
    add_theme_support('custom-header');

    // включаем меню в админке
    add_theme_support('menus');

    // создание метатега <title> через хук
    add_theme_support('title-tag');

    // возможность загрузить картинку логотипа в админке
    add_theme_support('custom-logo', [
        'height'      => 190,
        'width'       => 190,
        'flex-width'  => false,
        'flex-height' => false,
        'header-text' => '',
    ]);
});


function custom_logo_output($html)
{
    if (strpos($html, '.svg') !== false) {
        $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
        $html = preg_replace('/<a.*?>(.*?)<\/a>/', '$1', $html);
    }
    return $html;
}

add_filter('get_custom_logo', 'custom_logo_output');

add_theme_support('post-thumbnails'); // для всех типов постов



add_action('customize_register', function ($customizer) {
    $customizer->add_section(
        'example_section_one',
        array(
            'title' => 'Настройки сайта',
            'description' => 'Контактная информация на сайте',
            'priority' => 11,
        )
    );

    $customizer->add_setting(
        'phone',
        array(
            'default' => '84822123456'
        )
    );
    $customizer->add_control(
        'phone',
        array(
            'label' => 'Телефон',
            'section' => 'example_section_one',
            'type' => 'text',
        )
    );

    // Добавляем поле для адреса
    $customizer->add_setting(
        'address',
        array(
            'default' => ''
        )
    );
    $customizer->add_control(
        'address',
        array(
            'label' => 'Адрес',
            'section' => 'example_section_one',
            'type' => 'text',
        )
    );
    //
    // Добавляем поле для адреса
    $customizer->add_setting(
        'mail',
        array(
            'default' => ''
        )
    );
    $customizer->add_control(
        'mail',
        array(
            'label' => 'Почта',
            'section' => 'example_section_one',
            'type' => 'text',
        )
    );
    //
    $customizer->add_setting(
        'phoneico',
        array(
            'default' => ''
        )
    );
    $customizer->add_control(
        new WP_Customize_Image_Control(
            $customizer,
            'phoneico',
            array(
                'label' => __('Иконка связи', 'Renty'),
                'section' => 'title_tagline',
                'settings' => 'phoneico',
            )
        )
    );


    $customizer->add_setting(
        'weekdays',
        array(
            'default' => ''
        )
    );
    $customizer->add_control(
        'weekdays',
        array(
            'label' => 'График работы в будни (Пн-Пт)',
            'section' => 'example_section_one',
            'type' => 'text',
        )
    );

    $customizer->add_setting(
        'weekends',
        array(
            'default' => ''
        )
    );
    $customizer->add_control(
        'weekends',
        array(
            'label' => 'График работы в выходные (Сб-Вс)',
            'section' => 'example_section_one',
            'type' => 'text',
        )
    );


    $customizer->add_setting(
        'map',
        array(
            'default' => ''
        )
    );
    $customizer->add_control(
        'map',
        array(
            'label' => 'Карта',
            'section' => 'example_section_one',
            'type' => 'textarea',
        )
    );
});

// БАННЕР
function mytheme_customize_register($wp_customize)
{
    // Добавляем секцию для рекламного баннера
    $wp_customize->add_section('advertisement_banner_section', array(
        'title'      => __('Рекламный баннер', 'mytheme'),
        'priority'   => 30,
    ));

    // Добавляем настройку для загрузки изображения
    $wp_customize->add_setting('advertisement_banner_image', array(
        'default'    => '',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'advertisement_banner_image_control', array(
        'label'      => __('Загрузите баннер (1235px x 155px)', 'mytheme'),
        'section'    => 'advertisement_banner_section',
        'settings'   => 'advertisement_banner_image',
    )));

    // Добавляем настройку для ссылки
    $wp_customize->add_setting('advertisement_banner_url', array(
        'default'    => '',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control('advertisement_banner_url_control', array(
        'label'      => __('Ссылка', 'mytheme'),
        'section'    => 'advertisement_banner_section',
        'settings'   => 'advertisement_banner_url',
        'type'       => 'text',
    ));


    // Добавляем настройку для заголовка
    $wp_customize->add_setting('advertisement_banner_title', array(
        'default'    => '',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control('advertisement_banner_title_control', array(
        'label'      => __('Заголовок', 'mytheme'),
        'section'    => 'advertisement_banner_section',
        'settings'   => 'advertisement_banner_title',
        'type'       => 'text',
    ));


    // Добавляем настройку для описания
    $wp_customize->add_setting('advertisement_banner_description', array(
        'default'    => '',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control('advertisement_banner_description_control', array(
        'label'      => __('Описание', 'mytheme'),
        'section'    => 'advertisement_banner_section',
        'settings'   => 'advertisement_banner_description',
        'type'       => 'textarea',
    ));
    // Добавляем настройку для загрузки изображения
    $wp_customize->add_setting('advertisement_banner_small_image', array(
        'default'    => '',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'advertisement_banner_small_image_control', array(
        'label'      => __('Небольшое изображение у текста', 'mytheme'),
        'section'    => 'advertisement_banner_section',
        'settings'   => 'advertisement_banner_small_image',
    )));
}
add_action('customize_register', 'mytheme_customize_register');

function sosials_register($wp_customize)
{
    // Добавляем секцию для рекламного баннера
    $wp_customize->add_section('sosials_section', array(
        'title'      => __('Социальные сети', 'mytheme'),
        'priority'   => 30,
    ));

    // ВК
    $wp_customize->add_setting('vk_url', array(
        'default'    => 'https://vk.com/',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control('vk_url_control', array(
        'label'      => __('ВКонтакте', 'mytheme'),
        'section'    => 'sosials_section',
        'settings'   => 'vk_url',
        'type'       => 'text',
    ));

    // Дзен
    $wp_customize->add_setting('dzen_url', array(
        'default'    => 'https://dzen.ru/',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control('dzen_url_control', array(
        'label'      => __('Дзен', 'mytheme'),
        'section'    => 'sosials_section',
        'settings'   => 'dzen_url',
        'type'       => 'text',
    ));

    // youtube
    $wp_customize->add_setting('youtube_url', array(
        'default'    => 'https://youtube.com/',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control('youtube_url_control', array(
        'label'      => __('YouTube', 'mytheme'),
        'section'    => 'sosials_section',
        'settings'   => 'youtube_url',
        'type'       => 'text',
    ));

    // Telegram
    $wp_customize->add_setting('tg_url', array(
        'default'    => 'https://t.me/',
        'transport'  => 'refresh',
    ));

    $wp_customize->add_control('tg_url_control', array(
        'label'      => __('Телеграм', 'mytheme'),
        'section'    => 'sosials_section',
        'settings'   => 'tg_url',
        'type'       => 'text',
    ));
}
add_action('customize_register', 'sosials_register');


// ________убираем лишние теги в CF7_____________
add_filter('wpcf7_autop_or_not', '__return_false');
// END ADMINS


// MENU


// Добавление классов для меню
function add_additional_class_on_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}

function add_additional_class_on_a($atts, $item, $args)
{
    if (isset($args->add_a_class)) {
        $atts['class'] = $args->add_a_class;
    }
    return $atts;
}

function add_svg_inside_menu_link($item_output, $item, $depth, $args)
{
    if ($args->theme_location == 'additional_menu') {
        $svg = '';
        if (isset($args->add_a_item)) {
            $svg = $args->add_a_item;
        }
        $item_output = str_replace('</a>', $svg . '</a>', $item_output);
    }
    return $item_output;
}

add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);
add_filter('walker_nav_menu_start_el', 'add_svg_inside_menu_link', 10, 4);
// END MENU

add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'update_wishlist_count');
add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'update_wishlist_count');

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_get_items_count')) {
    function yith_wcwl_get_items_count()
    {
        ob_start();
?>
        <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" class="favorite-item">
            <span class="yith-wcwl-items-count">
                <?php echo esc_html(yith_wcwl_count_all_products()); ?>
        </a> <?php
                return ob_get_clean();
            }

            add_shortcode('yith_wcwl_items_count', 'yith_wcwl_get_items_count');
        }

        if (defined('YITH_WCWL') && !function_exists('yith_wcwl_ajax_update_count')) {
            function yith_wcwl_ajax_update_count()
            {
                wp_send_json(array(
                    'count' => yith_wcwl_count_all_products()
                ));
            }

            add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
            add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
        }

        if (defined('YITH_WCWL') && !function_exists('yith_wcwl_enqueue_custom_script')) {
            function yith_wcwl_enqueue_custom_script()
            {
                wp_add_inline_script(
                    'jquery-yith-wcwl',
                    "
    jQuery( function( $ ) {
    $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
    $.get( yith_wcwl_l10n.ajax_url, {
    action: 'yith_wcwl_update_wishlist_count'
    }, function( data ) {
    $('.yith-wcwl-items-count').html( data.count );
    } );
    } );
    } );
    "
                );
            }

            add_action('wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20);
        }

        if (!function_exists('yith_wcwl_product_removed_text_custom')) {
            function yith_wcwl_product_removed_text_custom()
            {
                return __('Удалено из избранного', 'yith-woocommerce-wishlist');
            }
            add_filter('yith_wcwl_product_removed_text', 'yith_wcwl_product_removed_text_custom');
        }
        function custom_remove_from_wishlist()
        {
            if (isset($_POST['product_id'])) {
                $product_id = intval($_POST['product_id']);

                if (YITH_WCWL()->remove($product_id)) {
                    wp_send_json_success();
                } else {
                    wp_send_json_error('Could not remove item from wishlist');
                }
            } else {
                wp_send_json_error('Invalid product ID');
            }
        }
        add_action('wp_ajax_remove_from_wishlist', 'custom_remove_from_wishlist');
        add_action('wp_ajax_nopriv_remove_from_wishlist', 'custom_remove_from_wishlist');


        function filter_products()
        {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
            );

            if (isset($_POST['sort_by'])) {
                if ($_POST['sort_by'] == 'price-asc') {
                    $args['orderby'] = 'meta_value_num';
                    $args['meta_key'] = '_price';
                    $args['order'] = 'ASC';
                } elseif ($_POST['sort_by'] == 'price-desc') {
                    $args['orderby'] = 'meta_value_num';
                    $args['meta_key'] = '_price';
                    $args['order'] = 'DESC';
                }
            }

            if (isset($_POST['min_price']) && isset($_POST['max_price'])) {
                $args['meta_query'] = array(
                    array(
                        'key' => '_price',
                        'value' => array($_POST['min_price'], $_POST['max_price']),
                        'compare' => 'BETWEEN',
                        'type' => 'NUMERIC'
                    )
                );
            }

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    wc_get_template_part('content', 'product');
                endwhile;
            else :
                echo '<p>Товары не найдены</p>';
            endif;

            wp_reset_postdata();
            die();
        }
        add_action('wp_ajax_filter_products', 'filter_products');
        add_action('wp_ajax_nopriv_filter_products', 'filter_products');


        function register_shop_sidebar()
        {
            register_sidebar(array(
                'name' => __('Shop Sidebar', 'simple-bootstrap-theme'),
                'id' => 'shop-sidebar',
                'description' => __('Widgets in this area will be shown on the shop page.', 'simple-bootstrap-theme'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
        }
        function register_home_sidebar()
        {
            register_sidebar(array(
                'name' => __('Home Sidebar', 'simple-bootstrap-theme'),
                'id' => 'home-sidebar',
                'description' => __('Widgets in this area will be shown on the home page.', 'simple-bootstrap-theme'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));
        }
        add_action('widgets_init', 'register_shop_sidebar');
        add_action('widgets_init', 'register_home_sidebar');


        function husky_product_count_shortcode()
        {
            return 'hi';
        }
        add_shortcode('husky_product_count', 'husky_product_count_shortcode');


        function display_shown_products_count()
        {
            global $wp_query;
            $count = $wp_query->post_count;
            echo $count;
        }

        function get_min_max_values()
        {
            global $wpdb;

            // Получение минимальной и максимальной цены
            $price_min = $wpdb->get_var("SELECT MIN(meta_value + 0) FROM {$wpdb->postmeta} WHERE meta_key = '_price'");
            $price_max = $wpdb->get_var("SELECT MAX(meta_value + 0) FROM {$wpdb->postmeta} WHERE meta_key = '_price'");

            // Получение минимальной и максимальной площади
            $area_min = $wpdb->get_var("SELECT MIN(meta_value + 0) FROM {$wpdb->postmeta} WHERE meta_key = 'area-value'");
            $area_max = $wpdb->get_var("SELECT MAX(meta_value + 0) FROM {$wpdb->postmeta} WHERE meta_key = 'area-value'");

            // Локализация скрипта для передачи данных в JavaScript
            wp_localize_script('webpack', 'productData', array(
                'priceMin' => $price_min,
                'priceMax' => $price_max,
                'areaMin' => $area_min,
                'areaMax' => $area_max,
            ));
        }
        add_action('wp_enqueue_scripts', 'get_min_max_values');
