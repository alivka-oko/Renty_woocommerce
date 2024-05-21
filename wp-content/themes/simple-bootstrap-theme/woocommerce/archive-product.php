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
			<?php
			// Получение минимальной цены
			$min_price_query = new WP_Query(array(
				'post_type'      => 'product',
				'posts_per_page' => 1,
				'orderby'        => 'meta_value_num',
				'order'          => 'ASC',
				'meta_key'       => '_price',
				'meta_query'     => array(
					array(
						'key'     => '_stock_status',
						'value'   => 'instock',
						'compare' => '='
					)
				)
			));
			$min_price = $min_price_query->have_posts() ? get_post_meta($min_price_query->posts[0]->ID, '_price', true) : 0;

			// Получение максимальной цены
			$max_price_query = new WP_Query(array(
				'post_type'      => 'product',
				'posts_per_page' => 1,
				'orderby'        => 'meta_value_num',
				'order'          => 'DESC',
				'meta_key'       => '_price',
				'meta_query'     => array(
					array(
						'key'     => '_stock_status',
						'value'   => 'instock',
						'compare' => '='
					)
				)
			));
			$max_price = $max_price_query->have_posts() ? get_post_meta($max_price_query->posts[0]->ID, '_price', true) : 0;

			// Получение минимальной и максимальной площади для формы
			global $wpdb;

			$min_area_result = $wpdb->get_var("
    SELECT MIN(CAST(meta_value AS UNSIGNED)) 
    FROM $wpdb->postmeta 
    WHERE meta_key = 'area'
    AND post_id IN (
        SELECT ID FROM $wpdb->posts WHERE post_type = 'product' AND post_status = 'publish'
    )
    AND meta_value != ''
");

			$max_area_result = $wpdb->get_var("
    SELECT MAX(CAST(meta_value AS UNSIGNED)) 
    FROM $wpdb->postmeta 
    WHERE meta_key = 'area'
    AND post_id IN (
        SELECT ID FROM $wpdb->posts WHERE post_type = 'product' AND post_status = 'publish'
    )
    AND meta_value != ''
");

			$min_area = $min_area_result ? $min_area_result : 0;
			$max_area = $max_area_result ? $max_area_result : 0;


			?>

			<form method="get">
				<select name="orderby">
					<option value="default">По умолчанию</option>
					<option value="price_asc" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'price_asc') ? 'selected' : ''; ?>>Сначала дешевле</option>
					<option value="price_desc" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'price_desc') ? 'selected' : ''; ?>>Сначала дороже</option>
				</select>
				Цена от: <input type="number" step="0.01" name="min_price" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : $min_price / 1000000; ?>">
				до: <input type="number" step="0.01" name="max_price" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : $max_price / 1000000; ?>">
				Площадь от: <input type="number" step="0.01" name="min_area" value="<?php echo isset($_GET['min_area']) ? $_GET['min_area'] : $min_area; ?>">
				до: <input type="number" step="0.01" name="max_area" value="<?php echo isset($_GET['max_area']) ? $_GET['max_area'] : $max_area; ?>">
				<button type="submit">Сортировать</button>
			</form>



			<div class="cards">
				<?php
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => -1, // Получить все товары
					'orderby'        => 'meta_value_num',
					'order'          => 'ASC',
					'meta_key'       => 'area',
					'meta_query'     => array(
						'relation' => 'AND',
						array(
							'key'     => '_stock_status',
							'value'   => 'instock',
							'compare' => '='
						),
						array(
							'key'     => 'area',
							'compare' => 'EXISTS', // Проверяем, что мета-поле существует
						)
					)
				);

				// Добавляем фильтр по цене, если задан
				if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
					$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) * 1000000 : 0;
					$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) * 1000000 : PHP_INT_MAX;

					$args['meta_query'][] = array(
						'key'     => '_price',
						'value'   => array($min_price, $max_price),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC',
					);
				}

				// Добавляем фильтр по площади, если задан
				if (isset($_GET['min_area']) || isset($_GET['max_area'])) {
					$min_area_filter = isset($_GET['min_area']) ? floatval($_GET['min_area']) : $min_area;
					$max_area_filter = isset($_GET['max_area']) ? floatval($_GET['max_area']) : $max_area;

					$args['meta_query'][] = array(
						'key'     => 'area',
						'value'   => array($min_area_filter, $max_area_filter),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC',
					);
				}

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