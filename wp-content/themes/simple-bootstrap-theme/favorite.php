<?php
/* Template Name: Избранное */
get_header();
?>

<section class="section favorites">
    <div class="container">
        <div class="content">
            <div class="headline">
                <h2 class="heading-m text-up">
                    Избранное
                </h2>
            </div>
            <div class="cards">
                <?php
                if (function_exists('YITH_WCWL')) {
                    $wishlist_items = YITH_WCWL()->get_products(array(
                        'wishlist_id' => 'all',
                        'is_default'  => true,
                    ));

                    if (!empty($wishlist_items)) :
                        $i = 1;
                        foreach ($wishlist_items as $item) :
                            $product = wc_get_product($item['prod_id']);

                            if ($product && $product->is_visible()) :
                                $address = get_post_meta($product->get_id(), 'address', true);
                                $area = get_post_meta($product->get_id(), 'area', true);
                                $floor = get_post_meta($product->get_id(), 'floor', true);
                                $price = $product->get_price();
                                $price_html = $product->get_price_html();
                                $attachment_ids = $product->get_gallery_image_ids();
                                $post_thumbnail_url = get_the_post_thumbnail_url($product->get_id(), array(500, 500));
                ?>
                                <article class="card product">
                                    <div class="swiper-container products">
                                        <div class="swiper swiper-<?= $i ?>">
                                            <div class="swiper-wrapper">
                                                <?php if ($post_thumbnail_url) : ?>
                                                    <div class="swiper-slide">
                                                        <div class="swiper-img">
                                                            <a href="<?php echo get_permalink($product->get_id()); ?>">
                                                                <img src="<?= esc_url($post_thumbnail_url); ?>" alt="<?php echo esc_attr($product->get_name()); ?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php foreach ($attachment_ids as $attachment_id) : ?>
                                                    <div class="swiper-slide">
                                                        <div class="swiper-img">
                                                            <a href="<?php echo get_permalink($product->get_id()); ?>">
                                                                <img src="<?= esc_url(wp_get_attachment_url($attachment_id)); ?>" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="swiper-pagination-block swiper-pagination-<?= $i ?>"></div>
                                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title text-title"><?php echo $product->get_name(); ?></h3>
                                        <div class="card-address text-value"><?php echo esc_html($address); ?></div>
                                        <div class="card-description">
                                            <?php if ($price) : ?>
                                                <div class="attribute">
                                                    <span class="text-attribute">Стоимость в месяц</span>
                                                    <span class="text-value"><?php echo number_format((float) $price, 0, '.', ' '); ?> ₽</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($area && $price) :
                                                $price_month_area = $price / $area;
                                            ?>
                                                <div class="attribute">
                                                    <span class="text-attribute">Стоимость за м2/мес.</span>
                                                    <span class="text-value"><?php echo number_format((float) $price_month_area, 2, '.', ' '); ?> ₽</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($area) : ?>
                                                <div class="attribute">
                                                    <span class="text-attribute">Площадь</span>
                                                    <span class="text-value"><?php echo number_format((float) $area, 0, '.', ' '); ?> м2</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($floor) : ?>
                                                <div class="attribute">
                                                    <span class="text-attribute">Этаж</span>
                                                    <span class="text-value"><?php echo esc_html($floor); ?> этаж</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="action-block">
                                            <button class="btn">Заказать звонок</button>
                                            <?php if ($phoneico = get_theme_mod('phoneico')) : ?>
                                                <button>
                                                    <img src="<?= esc_url($phoneico); ?>" alt="call-ico">
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </article>
                <?php
                            endif;
                            $i++;
                        endforeach;
                    endif;
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>