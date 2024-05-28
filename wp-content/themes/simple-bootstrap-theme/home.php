<?php
/* Template  me: Homepage */
get_header();
?>
<main class="main">
    <section class="section banner">
        <div class="container">
            <div class="content">
                <h1 class="heading-l">
                    Коммерческие помещения<br>
                    в Петрозаводске
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
    <section class="section banner-ad">
        <div class="container">
            <div class="content">
                <a class="advertisement" href="#" style="background:url('../wp-content/uploads/2024/05/advertisement.png')"></a>
                <div class="banner-ad__text-block">
                    <div class="left-side">
                        <h3 class="heading-m">Бесплатный подбор офиса и экскурсии по объектам!</h3>
                        <p>Оставьте заявку или позвоните и наши специалисты расскажут вам подробную информацию.</p>
                        <div class="buttons">
                            <button class="btn">Заказать звонок</button>
                            <button class="btn btn-transparent">Оставить заявку</button>
                        </div>
                    </div>
                    <div class="right-side">
                        <img src="../wp-content/uploads/2024/05/Frame-18136.png" alt="excursion">
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                            <div class="swiper-slide">
                                <a href="#" class="article card">
                                    <img src="../wp-content/uploads/2024/05/lead_form.png" alt="">
                                    <h5 class="text-sub">Финансы</h5>
                                    <p class="text">Как изменятся цены на московское жилье к началу 2023 года. Как можно
                                        к этому подготовиться?</p>
                                    <span class="text-date">22.01.2022</span>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="article card">
                                    <img src="../wp-content/uploads/2024/05/lead_form.png" alt="">
                                    <h5 class="text-sub">Финансы</h5>
                                    <p class="text">Как изменятся цены на московское жилье к началу 2023 года. Как можно
                                        к этому подготовиться?</p>
                                    <span class="text-date">22.01.2022</span>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="article card">
                                    <img src="../wp-content/uploads/2024/05/lead_form.png" alt="">
                                    <h5 class="text-sub">Финансы</h5>
                                    <p class="text">Как изменятся цены на московское жилье к началу 2023 года. Как можно
                                        к этому подготовиться?</p>
                                    <span class="text-date">22.01.2022</span>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="article card">
                                    <img src="../wp-content/uploads/2024/05/lead_form.png" alt="">
                                    <h5 class="text-sub">Финансы</h5>
                                    <p class="text">Как изменятся цены на московское жилье к началу 2023 года. Как можно
                                        к этому подготовиться?</p>
                                    <span class="text-date">22.01.2022</span>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="#" class="article card">
                                    <img src="../wp-content/uploads/2024/05/lead_form.png" alt="">
                                    <h5 class="text-sub">Финансы</h5>
                                    <p class="text">Как изменятся цены на московское жилье к началу 2023 года. Как можно
                                        к этому подготовиться?</p>
                                    <span class="text-date">22.01.2022</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="section videos">
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
                    <a href="/" class="link-accent">еще видео</a>
                </div>
                <div class="cards">
                    <div class="swiper videos">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="video card">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/u_pnia4Xhlw?si=7pl_-LXbafGw_Gga" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    <p class="text">Ход строительства жилого комплекса CHKALOV от застройщика интергрупп</p>
                                    <span class="text-date">22.01.2022</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video card">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/u_pnia4Xhlw?si=7pl_-LXbafGw_Gga" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    <p class="text">Ход строительства жилого комплекса CHKALOV от застройщика интергрупп</p>
                                    <span class="text-date">22.01.2022</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video card">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/u_pnia4Xhlw?si=7pl_-LXbafGw_Gga" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    <p class="text">Ход строительства жилого комплекса CHKALOV от застройщика интергрупп</p>
                                    <span class="text-date">22.01.2022</span>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="video card">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/u_pnia4Xhlw?si=7pl_-LXbafGw_Gga" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    <p class="text">Ход строительства жилого комплекса CHKALOV от застройщика интергрупп</p>
                                    <span class="text-date">22.01.2022</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <?php get_template_part('contact-form') ?>
</main>
<?php get_footer() ?>