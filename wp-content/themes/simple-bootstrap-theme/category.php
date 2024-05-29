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
                <div class="articles-page">
                    <div class="cards">
                        <?php
                        // Получаем текущую категорию
                        $category = get_queried_object();

                        // Параметры для WP_Query
                        $args = array(
                            'post_type' => 'post', // Тип записей
                            'category_name' => $category->slug, // Имя текущей категории
                            'posts_per_page' => -1, // Количество записей (-1 означает все записи)
                        );

                        // Запрос WP_Query
                        $query = new WP_Query($args);

                        // Проверяем, есть ли записи в категории
                        if ($query->have_posts()) :
                            // Начинаем выводить записи
                            while ($query->have_posts()) : $query->the_post();
                                // Здесь выводим каждую запись
                                get_template_part('template-parts/content', get_post_format());
                            endwhile;

                            // Пагинация (если нужна)
                            the_posts_pagination();

                        else :
                            // Если записей нет, выводим сообщение
                            get_template_part('template-parts/content', 'none');

                        endif;

                        // Сбрасываем постовые данные
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php get_footer() ?>