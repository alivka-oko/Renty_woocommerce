<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <meta charset="<?php echo bloginfo('charset') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        <?php
        if (is_404()) {
            echo 'Ошибка 404';
        } else {
            if (is_category()) {
                echo bloginfo('title') . '|' . single_cat_title();
            } else {
                bloginfo('title');
            }
        }
        ?>
    </title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <header class="header" id="header" <?php if (!is_home()) echo 'style="background: #FBFBFD;"' ?>>
        <section class="section">
            <div class="container">
                <div class="content">
                    <?php if (has_custom_logo()) : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                            <?php the_custom_logo(); ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-link"><?php bloginfo('name'); ?></a>
                    <?php endif; ?>

                    <button class="burger-menu" id="burger-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <nav class="menu__block" id="menu-block">
                        <ul class="menu">
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'theme_primary_menu',
                                'container' => '',
                                'menu_class' => 'collapse navbar-collapse sub-menu-bar',
                                'menu_id' => '',
                                'items_wrap' => '%3$s',
                                'add_li_class' => 'link',
                            ])
                            ?>
                            <li id="menu-item" class="menu-item menu-item-type-post_type menu-item-object-page nav-item link"><a href="http://rentytry/favorite/" class="nav-link">Избранное</a> <?php echo do_shortcode('[yith_wcwl_items_count]'); ?> </li>
                        </ul>
                    </nav>
                    <div class="action-block">
                        <?php
                        $phoneico = get_theme_mod('phoneico');
                        if ($phoneico) { ?>
                            <a href="tel:<?= get_theme_mod('phone', ''); ?>">
                                <img src="<?= $phoneico ?>" alt="call-ico">
                            </a>
                        <?php
                        }
                        ?>
                        <div class="text-block">
                            <a href="tel:<?= get_theme_mod('phone', ''); ?>" class="phone main"><?= get_theme_mod('phone', ''); ?></a>
                            <p class="text-action">Звонок бесплатный</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </header>