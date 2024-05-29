<?php

/**
 * Template part for displaying posts
 *
 * @package YourThemeName
 */

// Проверяем, существует ли пост
if (!defined('ABSPATH')) {
    exit; // Защита от прямого доступа к файлу
}
?>

<div class="article card">
    <a href="<?php the_permalink(); ?>">
        <?php
        // Выводим изображение записи
        if (has_post_thumbnail()) {
            the_post_thumbnail('full', array('alt' => get_the_title()));
        } else {
            echo '<img src="' . get_template_directory_uri() . '/path/to/your/default/image.png" alt="' . get_the_title() . '">';
        }
        ?>
    </a>
    <!-- Выводим метки (теги) записи -->
    <?php
    $post_tags = get_the_tags();
    if ($post_tags) {
        foreach ($post_tags as $tag) {
            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="text-sub link">' . esc_html($tag->name) . '</a>';
        }
    } else {
        // Если меток нет, выводим категорию записи
        $category = get_the_category();
        if (!empty($category)) {
            echo '<a href="' . esc_url(get_category_link($category[0]->term_id)) . '" class="text-sub link">' . esc_html($category[0]->name) . '</a>';
        }
    }
    ?>

    <!-- Выводим название записи -->
    <a class="text" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

    <!-- Выводим дату публикации записи -->
    <span class="text-date"><?php echo get_the_date('d.m.Y'); ?></span>
</div>