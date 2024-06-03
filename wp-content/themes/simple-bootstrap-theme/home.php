<?php
/*
Template Name: Главная
*/
get_header();
?>
<main class="main">
    <section class="section banner">
        <div class="container">
            <div class="content">
                <h1 class="heading-l">
                    <?= CFS()->get('title') ?>
                </h1>
                <!-- Форма поиска -->
                <form id="search-form">

                    <div class="form-item">
                        <label for="area-min">Площадь м2</label>
                        <div class="form-labels">
                            <input type="number" id="area-min" name="area-min" min="0" placeholder="от">
                            <input type="number" id="area-max" name="area-max" min="0" placeholder="до">
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="price-min">Цена</label>
                        <div class="form-labels">
                            <input type="number" id="price-min" name="price-min" min="0" placeholder="от">
                            <input type="number" id="price-max" name="price-max" min="0" placeholder="до">
                        </div>
                    </div>

                    <button type="submit" class="btn">Поиск</button>
                </form>
            </div>
        </div>
    </section>


    <section class="section offers">
        <div class="container">
            <div class="content">
                <div class="headline">
                    <h2 class="heading-m text-up">
                        Лучшие предложения
                    </h2>
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="link-accent">Все
                        предложения</a>
                </div>
                <div class="cards">
                    <?php
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 8,
                        'order' => $order == 'asc' ? 'asc' : 'desc',
                        'post__in' => wc_get_featured_product_ids(),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat', // Название таксономии для категорий товаров
                                'field' => 'slug', // Используем slug для поиска категории
                                'terms' => 'spaces', // Slug категории, из которой нужно получить товары
                            ),
                        ),
                    );
                    $query = new WP_Query($args);
                    if ($query->have_posts()) :
                        $i = 1;
                        while ($query->have_posts()) :
                            $query->the_post();
                            $product = wc_get_product(get_the_ID());

                            if ($product && $product->is_visible()) :
                                $address = CFS()->get('address');
                                $area = CFS()->get('area-value');
                                $floor = CFS()->get('floor');
                                $price = $product->get_price();
                                $price_html = $product->get_price_html();

                                $attachment_ids = $product->get_gallery_image_ids();
                                $post_thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), array(500, 500));
                    ?>
                                <article class="card product">
                                    <div class="swiper-container products">
                                        <div class="swiper swiper-<?= $i ?>">
                                            <div class="swiper-wrapper">
                                                <?php if ($post_thumbnail_url) : ?>
                                                    <div class="swiper-slide">
                                                        <div class="swiper-img"><a href="<?php echo the_permalink() ?>"><img src="<?= esc_url($post_thumbnail_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></a></div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php foreach ($attachment_ids as $attachment_id) : ?>
                                                    <div class="swiper-slide">
                                                        <div class="swiper-img"><a href="<?php echo the_permalink() ?>"><img src="<?= esc_url(wp_get_attachment_url($attachment_id)) ?>" alt=""></a></div>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <div class="swiper-pagination-block swiper-pagination-<?= $i ?>"></div>
                                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title text-title"><?php the_title(); ?></h3>
                                        <div class="card-address text-value"><?php echo $address ?></div>
                                        <div class="card-description">
                                            <?php if ($price != 0) : ?>
                                                <div class="attribute">
                                                    <span class="text-attribute">Стоимость в месяц</span>
                                                    <span class="text-value"><?php echo number_format((float) $price, 0, '.', ' '); ?>
                                                        ₽</span>
                                                </div>
                                            <?php endif ?>
                                            <?php if ($area and $price) :
                                                $price_month_area = $price / $area; ?>
                                                <div class="attribute">
                                                    <span class="text-attribute">Стоимость за м2/мес.</span>
                                                    <span class="text-value"><?php echo number_format((float) $price_month_area, 2, '.', ' '); ?>
                                                        ₽</span>
                                                </div>
                                            <?php endif ?>

                                            <?php if ($area) : ?>
                                                <div class="attribute">
                                                    <span class="text-attribute">Площадь</span>
                                                    <span class="text-value"><?php echo number_format((float) $area, 0, '.', ' '); ?>
                                                        м2</span>
                                                </div>
                                            <?php endif ?>

                                            <?php if ($floor) : ?>
                                                <div class="attribute">
                                                    <span class="text-attribute">Этаж</span>
                                                    <span class="text-value"><?php echo $floor ?> этаж</span>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                        <div class="action-block">
                                            <button class="btn">Заказать звонок</button>
                                            <?php
                                            $phoneico = get_theme_mod('phoneico');
                                            if ($phoneico) { ?>
                                                <button>
                                                    <img src="<?= $phoneico ?>" alt="call-ico">
                                                </button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </article>

                    <?php
                            endif;
                            $i++;
                        endwhile;
                    endif;
                    // Восстанавливаем оригинальный запрос
                    wp_reset_postdata();
                    ?>
                </div>

            </div>
        </div>
    </section>
    <?php get_template_part('ad-banner') ?>
    <section class="section articles">
        <div class="container">
            <div class="content">
                <div class="headline">
                    <div class="title-control">
                        <h2 class="heading-m">
                            Статьи
                        </h2>
                        <div class="control">
                            <div class="control-element prev"></div>
                            <div class="control-element next"></div>
                        </div>
                    </div>
                    <a href="/" class="link-accent">Все статьи</a>
                </div>
                <div class="cards">
                    <div class="swiper articles">
                        <div class="swiper-wrapper">
                            <?php
                            $args = array(
                                'category_name' => 'articles', // Category slug
                            );
                            $query = new WP_Query($args);
                            if ($query->have_posts()) :
                                while ($query->have_posts()) : $query->the_post();
                                    $category = get_the_category();
                                    $category_name = $category[0]->cat_name;
                                    $post_tags = get_the_tags();
                                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            ?>
                                    <div class="swiper-slide">
                                        <a href="<?php the_permalink(); ?>" class="article card">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail(); ?>
                                            <?php endif; ?>
                                            <?php
                                            if ($post_tags) {
                                                foreach ($post_tags as $tag) {
                                                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="text-sub link">' . esc_html($tag->name) . '</a>';
                                                }
                                            } else {
                                                // Если меток нет, выводим категорию записи
                                                $category = get_the_category();
                                                if (!empty($category)) {
                                                    echo '<a href="' . esc_url(get_category_link($category[0]->term_id)) . '" class="text-sub link">' . esc_html($category[0]->name) . '</a>';
                                                }
                                            }
                                            ?>
                                            <a href="<?php the_permalink(); ?>" class="text link"><?php echo get_the_title(); ?></a>
                                            <span class="text-date"><?php echo get_the_date('d.m.Y'); ?></span>
                                        </a>
                                    </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<p>Записей нет</p>';
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section videos">
        <div class="container">
            <div class="content">
                <div class="headline">
                    <div class="title-control">
                        <h2 class="heading-m">
                            Лучшие видео
                        </h2>
                        <div class="control">
                            <div class="control-element prev"></div>
                            <div class="control-element next"></div>
                        </div>
                    </div>
                    <a href="/category/media/videos/" class="link-accent">еще видео</a>
                </div>
                <div class="cards">
                    <div class="swiper videos">
                        <div class="swiper-wrapper">
                            <?php
                            $args = array(
                                'category_name' => 'videos', // Category slug
                            );
                            $query = new WP_Query($args);
                            if ($query->have_posts()) :
                                while ($query->have_posts()) : $query->the_post();
                            ?>
                                    <div class="swiper-slide">
                                        <div class="video card">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail(); ?>
                                            <?php endif; ?>
                                            <p class="text">Ход строительства жилого комплекса CHKALOV от застройщика интергрупп</p>
                                            <span class="text-date"><?php echo get_the_date('d.m.Y'); ?></span>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<p>Записей нет</p>';
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php get_template_part('contact-form') ?>
</main>
<?php get_footer() ?>