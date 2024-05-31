<?php get_header() ?>
<main class="main">
    <section class="section category">
        <div class="container">
            <div class="content">
                <?php get_template_part('breadcrumb') ?>
                <div class="headline">
                    <h2 class="heading-m text-up">
                        <?php if (is_category())
                            echo get_queried_object()->name; ?>
                    </h2>
                </div>
                <div class="videos-page">
                    <div class="cards">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <div class="video card">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail(); ?>
                                    <?php endif; ?>
                                    <h5 class="text-sub"><?php the_title(); ?></h5>
                                    <span class="text-date"><?php echo get_the_date('d.m.Y'); ?></span>
                                </div>
                            <?php endwhile;
                        else : ?>
                            <p><?php _e('Извините, записей не найдено.'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php get_template_part('ad-banner') ?>

</main>
<?php get_footer() ?>