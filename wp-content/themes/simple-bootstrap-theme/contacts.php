<?php
/*
Template Name: Контакты
*/
?>
<?php get_header() ?>
<section class="section contacts">
    <div class="container">
        <div class="content">
            <div class="left-side">
                <h1 class="heading-m text-up">
                    Контакты
                </h1>
                <address class="contacts-info">
                    <div class="info-item">
                        <div class="text-sub-title">Офис продаж:</div>
                        <span class="text-sub"><?php echo esc_html(get_theme_mod('address')); ?></span>
                    </div>
                    <div class="info-item">
                        <div class="text-sub-title">Время работы:</div>
                        <span class="text-sub"><? if (get_theme_mod('weekdays', '')) : ?>Пн-Пт <?= get_theme_mod('weekdays', ''); ?><?php endif ?><? if (get_theme_mod('weekends', '')) : ?></span>
                        <span class="text-sub">Сб-Вс <?= get_theme_mod('weekends', ''); ?><?php endif ?> </span>
                    </div>
                    <div class="info-item">
                        <div class="text-sub-title">Адрес электронной почты:</div>
                        <a class="text-sub" href="mailto:"><?= get_theme_mod('mail', ''); ?></a>
                    </div>
                    <div class="info-item">
                        <div class="text-sub-title">Единый телефон офиса продаж:</div>
                        <a class="text-sub" href="tel:+<?= get_theme_mod('phone', ''); ?>"><?= get_theme_mod('phone', ''); ?></a>
                    </div>
                </address>
            </div>
            <div class="right-side">
                <?= get_theme_mod('map', ''); ?>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('ad-banner') ?>
<?php get_footer() ?>