<?php

$ad_banner_view = CFS()->get('ad_banner_view');
if (!$ad_banner_view) {
    $ad_banner_view = array('text' => true);
}
if ($ad_banner_view) :
    foreach ($ad_banner_view as $key => $item) {
?>
        <?php if ($key != 'no') : ?>
            <section class="section banner-ad">
                <div class="container">
                    <div class="content" style="<?php if ($key == 'reverse') echo 'flex-direction: column-reverse;' ?>">
                        <a class="advertisement" style="<?php if ($key == 'text') echo 'display: none;' ?>" href="<?php echo esc_url(get_theme_mod('advertisement_banner_url')); ?>"><img src="<?php echo esc_url(get_theme_mod('advertisement_banner_image')); ?>" alt="Рекламный баннер"></a>
                        <div class="banner-ad__text-block" style="<?php if ($key == 'banner') echo 'display: none;' ?>">
                            <div class="left-side">
                                <h3 class="heading-m"><?php echo esc_html(get_theme_mod('advertisement_banner_title')); ?></h3>
                                <p><?php echo esc_html(get_theme_mod('advertisement_banner_description')); ?></p>
                                <div class="buttons">
                                    <a href="tel:<?= get_theme_mod('phone', ''); ?>" class="btn">Заказать звонок</a>
                                    <a href="#contact-form" class="btn btn-transparent">Оставить заявку</a>
                                </div>
                            </div>
                            <div class="right-side">
                                <img src="<?php echo esc_url(get_theme_mod('advertisement_banner_small_image')); ?>" alt="excursion">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
<?php
    }
endif;
?>