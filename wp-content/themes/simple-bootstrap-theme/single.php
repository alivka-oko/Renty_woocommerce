<?php get_header() ?>
<main class="main single-page">
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
                        <p class="link social-links">Поделиться: </p>
                        <div class="socials-icons">
                            <a href="https://vk.com/share.php?url=<?php echo get_permalink(); ?>" target="_blank">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4 0C1.79086 0 0 1.79086 0 4V20C0 22.2091 1.79086 24 4 24H20C22.2091 24 24 22.2091 24 20V4C24 1.79086 22.2091 0 20 0H4ZM17.5711 12.64C17.357 12.9573 17.2712 13.1153 17.5711 13.4703C17.5935 13.4995 17.7071 13.6063 17.8788 13.7679C18.6044 14.4507 20.368 16.1102 20.6798 17.0049C20.8483 17.531 20.5554 17.7976 19.9774 17.7976H17.9497C17.4086 17.7976 17.1357 17.5183 16.5451 16.9139C16.294 16.6569 15.9854 16.3411 15.5743 15.9629C14.3688 14.8942 13.8526 14.755 13.5527 14.755C13.0034 14.755 13.0048 14.8993 13.0177 16.2399C13.02 16.4777 13.0226 16.7532 13.0226 17.0723C13.0226 17.531 12.865 17.7976 11.5737 17.7976C9.42544 17.7976 7.0639 16.597 5.38703 14.3812C2.87094 11.135 2.18164 8.67789 2.18164 8.18372C2.18164 7.90403 2.29833 7.65404 2.87712 7.65404H4.9056C5.42566 7.65404 5.62117 7.86273 5.82132 8.37936C6.81276 11.0422 8.48577 13.3689 9.17507 13.3689C9.43394 13.3689 9.55063 13.258 9.55063 12.6552V9.9039C9.50381 9.12 9.20686 8.78111 8.98693 8.53012C8.8511 8.37511 8.74465 8.25363 8.74465 8.08155C8.74465 7.87505 8.93706 7.65332 9.26085 7.65332H12.4492C12.8766 7.65332 13.0211 7.86563 13.0211 8.34096V12.04C13.0211 12.4364 13.2181 12.5755 13.3449 12.5755C13.6022 12.5755 13.8201 12.4364 14.2915 12.0023C15.752 10.5002 16.7844 8.183 16.7844 8.183C16.9119 7.9033 17.1499 7.65332 17.6661 7.65332H19.6938C20.3066 7.65332 20.4333 7.94461 20.3066 8.34096L20.3051 8.34168C20.05 9.42929 17.5749 12.6363 17.5711 12.64Z" fill="#2F80ED" />
                                </svg>
                            </a>
                            <!-- Яндекс Дзен -->
                            <a href="https://dzen.ru/share?url=<?php echo get_permalink(); ?>" target="_blank">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5 0C2.23858 0 0 2.23858 0 5V19C0 21.7614 2.23858 24 5 24H19C21.7614 24 24 21.7614 24 19V5C24 2.23858 21.7614 0 19 0H5ZM21 11.9036V12.0964C17.0143 12.2186 15.195 12.3214 13.7357 13.7357C12.3214 15.195 12.225 17.0143 12.0964 21H11.9036C11.7814 17.0143 11.6786 15.195 10.2643 13.7357C8.805 12.3214 6.98571 12.225 3 12.0964V11.9036C6.98571 11.7814 8.805 11.6786 10.2643 10.2643C11.6786 8.805 11.775 6.98571 11.9036 3H12.0964C12.2186 6.98571 12.3214 8.805 13.7357 10.2643C15.195 11.6786 17.0143 11.775 21 11.9036Z" fill="#3A374F" />
                                </svg>
                            </a>
                            <!-- Телеграм -->
                            <a href="https://t.me/share/url?url=<?php echo get_permalink(); ?>&text=<?php echo get_the_title(); ?>" target="_blank">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5 0C2.23858 0 0 2.23858 0 5V19C0 21.7614 2.23858 24 5 24H19C21.7614 24 24 21.7614 24 19V5C24 2.23858 21.7614 0 19 0H5ZM16.6937 17.8203L18.9573 7.1452C19.1582 6.20424 18.619 5.83596 18.0029 6.06699L4.69592 11.1936C3.78851 11.5485 3.80188 12.0575 4.54191 12.2885L7.94401 13.3534L15.8465 8.37745C16.2182 8.12966 16.5564 8.26697 16.2785 8.51473L9.88613 14.291L9.63836 17.8036C9.99331 17.8036 10.1474 17.6496 10.3315 17.4654L11.9957 15.8648L15.4446 18.4064C16.0775 18.7612 16.5229 18.5738 16.6937 17.8203Z" fill="#2D9CDB" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php
    // Получить текущий пост
    global $post;

    // Получить метки текущего поста
    $post_tags = get_the_tags();

    // Получить категории текущего поста
    $categories = get_the_category();
    $category_id = !empty($categories) ? $categories[0]->term_id : null;

    ?>

    <section class="section articles">
        <div class="container">
            <div class="content">
                <div class="headline">
                    <div class="title-control">
                        <h2 class="heading-m">
                            Читайте также
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
                            <?php
                            // Запрос похожих записей
                            $related_args = array(
                                'category__in' => array($category_id),
                                'post__not_in' => array($post->ID),
                                'posts_per_page' => 4, // Количество похожих записей
                                'ignore_sticky_posts' => 1
                            );
                            $related_query = new WP_Query($related_args);

                            if ($related_query->have_posts()) :
                                while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                    <div class="swiper-slide">
                                        <a href="<?php the_permalink(); ?>" class="article card">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title(); ?>">
                                            <?php endif; ?>
                                            <a href="<?php echo $post_tags ? esc_url(get_tag_link($post_tags[0]->term_id)) : esc_url(get_category_link($category_id)); ?>">
                                                <h5 class="text-sub"><?php echo $post_tags ? esc_html($post_tags[0]->name) : esc_html($categories[0]->name); ?></h5>
                                            </a>
                                            <p class="text"><?php the_title(); ?></p>
                                            <span class="text-date"><?php echo get_the_date(); ?></span>
                                        </a>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata();
                            else : ?>
                                <p><?php _e('No related posts found.', 'textdomain'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php get_template_part('ad-banner') ?>
</main>
<?php get_footer() ?>