<?php get_header() ?>
<main class="main">

	<section class="section product-page">
		<div class="container">
			<div class="content">
				<?php get_template_part('breadcrumb') ?>
				<?php
				if (have_posts()) {
					while (have_posts()) {
						the_post();
						$attachment_ids = $product->get_gallery_image_ids();
						$address = CFS()->get('address');
						$area = CFS()->get('area-value');
						$floor = CFS()->get('floor');
						$price = $product->get_price();
						$price_html = $product->get_price_html();
						$post_thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), array(500, 500));
						$building_type = CFS()->get('building_type');
						$project_type = CFS()->get('project_type');
						$floors = CFS()->get('floors');
						$ready = CFS()->get('ready');

						$parking = CFS()->get('parking');
				?>
						<div class="object">
							<div class="object__card">
								<div class="gallery">
									<div class="swiper swiper_main">
										<div class="swiper-wrapper">
											<?php foreach ($attachment_ids as $attachment_id) : ?>
												<div class="swiper-slide">
													<a href="<?= esc_url(wp_get_attachment_url($attachment_id)) ?>" data-lightbox="gallery">
														<img src="<?= esc_url(wp_get_attachment_url($attachment_id)) ?>" alt="">
													</a>
												</div>
											<?php endforeach ?>
											<?php if ($post_thumbnail_url) : ?>
												<div class="swiper-slide">
													<a href="<?= esc_url($post_thumbnail_url); ?>" data-lightbox="gallery">
														<img src="<?= esc_url($post_thumbnail_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
													</a>
												</div>
											<?php endif; ?>
										</div>
										<div class="swiper-product-prev"></div>
										<div class="swiper-product-next"></div>
										<div class="swiper-fullscreen"></div>
									</div>
									<div class="swiper swiper_thumbnail">
										<div class="swiper-wrapper">
											<?php foreach ($attachment_ids as $attachment_id) : ?>
												<div class="swiper-slide">
													<img src="<?= esc_url(wp_get_attachment_url($attachment_id)) ?>" alt="">
												</div>
											<?php endforeach ?>
											<?php if ($post_thumbnail_url) : ?>
												<div class="swiper-slide">
													<img src="<?= esc_url($post_thumbnail_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="options">
									<div class="option__card">
										<div class="option__id">
											<div class="card-id text-attribute">id: <?php echo get_the_ID(); ?></div>
											<div class="card-category text-sub"><?php the_title(); ?></div>
										</div>
									</div>
									<div class="option__card">
										<?php if ($address) : ?>
											<p class="option__card-title"><?= $address ?></p>
										<?php endif ?>
										<?php if ($area) : ?>
											<div class="attribute">
												<span class="text-sub">Площадь</span>
												<span class="text-value"><?= $area ?> м²</span>
											</div>
										<?php endif ?>
										<?php if ($floor) : ?>
											<div class="attribute">
												<span class="text-sub">Этаж</span>
												<span class="text-value"><?= $floor ?></span>
											</div>
										<?php endif ?>
									</div>
									<div class="option__card">
										<div class="attribute">
											<span class="text-sub">Аренда в месяц</span>
											<span class="text-value"><?php echo number_format((float)$price, 0, '.', ' '); ?> ₽</span>
										</div>
										<?php if ($area and $price) :
											$price_month_area = $price / $area; ?>
											<div class="attribute">
												<span class="text-sub">Цена за м²</span>
												<span class="text-value"><?php echo number_format((float)$price_month_area, 2, '.', ' '); ?> ₽/м²</span>
											</div>
										<?php endif ?>
									</div>
									<div class="card__ad-block">
										<p class="option__card-title">Помощь с подбором помещений от наших специалистов</p>
										<div class="attribute">
											<span class="text-sub">Телефон офиса</span>
											<span class="text-value"><?= get_theme_mod('phone', ''); ?></span>
										</div>
										<a href="#contact-form" class="btn">Заказать звонок</a>
									</div>
								</div>
							</div>

							<div class="object__info">
								<div class="object__content wysiwyg">
									<?php the_content() ?>
								</div>
								<div class="object__descriptions">
									<h2>Описание</h2>
									<div class="descriptions">
										<div class="item">
											<span class="text-attribute">Парковка</span>
											<span class="text-sub">
												<?php
												foreach ($parking as $key => $label) {
													echo $label;
												} ?>
											</span>
										</div>
										<div class="item">
											<span class="text-attribute">Тип здания</span>
											<span class="text-sub">
												<?php
												foreach ($building_type as $key => $label) {
													echo $label;
												} ?>
											</span>
										</div>
										<div class="item">
											<span class="text-attribute">Проект</span>
											<span class="text-sub"><?= CFS()->get('project_type') ?></span>
										</div>
										<div class="item">
											<span class="text-attribute">Количество этажей</span>
											<span class="text-sub"><?= $floors ?></span>
										</div>
										<div class="item">
											<span class="text-attribute">Готовность</span>
											<span class="text-sub">
												<?php
												foreach ($ready as $key => $label) {
													echo $label;
												} ?>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</section>
	<? if (CFS()->get('map')) : ?>
		<section class="section">
			<?= CFS()->get('map') ?>
		</section>
	<?php endif ?>
	<?php get_template_part('ad-banner') ?>
	<section class="section similar">
		<div class="container">
			<div class="content">
				<div class="headline">
					<div class="title-control">
						<h2 class="heading-m">
							Похожие помещения
						</h2>
						<div class="control">
							<div class="control-element prev"></div>
							<div class="control-element next"></div>
						</div>
					</div>
				</div>
				<?php
				// Вывод похожих товаров
				$related_products = wc_get_related_products(get_the_ID(), 12);

				if ($related_products) : ?>
					<div class="cards">
						<div class="swiper similar">
							<div class="swiper-wrapper">
								<?php foreach ($related_products as $related_product_id) :
									$post_object = get_post($related_product_id);
									setup_postdata($GLOBALS['post'] = &$post_object);
									$product = wc_get_product($related_product_id);
									$price = $product->get_price();
									$url = $product->get_permalink();
									$address = CFS()->get('address', $related_product_id);
								?>
									<div class="swiper-slide">
										<div class="card">
											<a href="<?= $url ?>"><img src="<?php echo get_the_post_thumbnail_url($related_product_id, 'full'); ?>" alt="<?php the_title(); ?>"></a>
											<div class="card-content">
												<div class="text-title"><?php the_title(); ?></div>
												<div class="price"><?php echo number_format((float)$price, 0, '.', ' '); ?> ₽
													<?php if (!$product->is_taxable()) : ?>
														<span class="text-value vat">НДС не облагается</span>
													<?php endif; ?>
												</div>
												<?php if ($address) : ?>
													<div class="text-value address"><?php echo $address ?></div>
												<?php endif ?>
												<div class="action-block">
													<button class="btn">Заказать звонок</button>
													<button>
														<img src="http://renty/wp-content/uploads/2024/04/ic_call.svg" alt="call-ico">
													</button>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php get_template_part('contact-form') ?>
</main>
<?php get_footer() ?>