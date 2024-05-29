<?php get_header() ?>
<main class="main">
    <section class="section single">
        <div class="container">
            <div class="content">
                <?php get_template_part('breadcrumb') ?>
                <div class="headline">
                    <h2 class="heading-m text-up">
                        <?php the_title() ?>
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <section class="section single-content">
        <div class="container">
            <div class="content wysiwyg">
                <?php the_content() ?>
                <div class="post-thumbnail-socials">
                    <?php
                    // Выводим изображение записи
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('alt' => get_the_title()));
                    } else {
                        echo '<img src="' . get_template_directory_uri() . '/path/to/your/default/image.png" alt="' . get_the_title() . '">';
                    }
                    ?>
                    <div class="socials">
                        <p>Поделиться: <span>мяу</span> <span>мяу</span> <span>мяу</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php get_footer() ?>