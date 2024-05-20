<?php
get_header();
?>

<section class="section catalog">
	<div class="container">
		<div class="content">
			<div class="headline">
				<h2 class="heading-m text-up">
					Коммерческие помещения
				</h2>
			</div>
			<div class="cards">
				<?php
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => -1, // Получить все товары
					'orderby'        => 'date',
					'order'          => 'DESC',
				);
				$query = new WP_Query($args);
				if ($query->have_posts()) :
					$i = 1;
					while ($query->have_posts()) : $query->the_post();
						$product = wc_get_product(get_the_ID());

						if ($product && $product->is_visible()) :
							$address = CFS()->get('address');
							$area = CFS()->get('area');
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
												<span class="text-value"><?php echo number_format((float)$price, 0, '.', ' '); ?> ₽</span>
											</div>
										<?php endif ?>
										<?php if ($area and $price) :
											$price_month_area = $price / $area; ?>
											<div class="attribute">
												<span class="text-attribute">Стоимость за м2/мес.</span>
												<span class="text-value"><?php echo number_format((float)$price_month_area, 2, '.', ' '); ?> ₽</span>
											</div>
										<?php endif ?>

										<?php if ($area) : ?>
											<div class="attribute">
												<span class="text-attribute">Площадь</span>
												<span class="text-value"><?php echo number_format((float)$area, 0, '.', ' '); ?> м2</span>
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

<?php get_footer(); ?>
