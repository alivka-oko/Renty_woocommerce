<span class="anchor" id="contact-form"></span>
<footer class="section footer">
    <div class="container">
        <div class="footer-col footer-logo-tel">
            <?php if (has_custom_logo()) : the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
            <?php endif; ?>
            <a href="tel:<?= get_theme_mod('phone', ''); ?>" class="big-tel"><?= get_theme_mod('phone', ''); ?></a>
            <a href="#header" class="btn-up text">Наверх</a>
        </div>
        <div class="footer-col footer-menu">
            <ul>
                <?php
                wp_nav_menu([
                    'theme_location' => 'theme_footer_menu',
                    'container' => '',
                    'menu_class' => 'collapse navbar-collapse sub-menu-bar',
                    'menu_id' => '',
                    'items_wrap' => '%3$s',
                    'add_li_class' => 'link',
                ])
                ?>
            </ul>
        </div>
        <div class="footer-col footer-info">
            <div class="working-hours text-attribute"><? if (get_theme_mod('weekdays', '')) : ?>пн-пт <?= get_theme_mod('weekdays', ''); ?><?php endif ?>,<? if (get_theme_mod('weekends', '')) : ?> сб-вс <?= get_theme_mod('weekends', ''); ?><?php endif ?></div>
            <div class="address"><?php echo esc_html(get_theme_mod('address')); ?></div>
            <div class="offer form-text">Материалы, представленные на сайте, не являются публичной офертой</div>
            <div class="socials">
                <a href="<?php echo esc_html(get_theme_mod('vk_url')); ?>" class="vk" target="_blank"><svg width="19" height="11" viewBox="0 0 19 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.7019 6.25558C15.4021 5.87377 15.4878 5.7039 15.7019 5.3626C15.7058 5.3587 18.1809 1.90987 18.4359 0.74026L18.4374 0.73948C18.5642 0.313247 18.4374 0 17.8247 0H15.7969C15.2807 0 15.0427 0.268831 14.9152 0.56961C14.9152 0.56961 13.8828 3.06156 12.4223 4.67688C11.9509 5.14364 11.733 5.29325 11.4757 5.29325C11.349 5.29325 11.1519 5.14364 11.1519 4.7174V0.73948C11.1519 0.228312 11.0074 0 10.5801 0H7.3917C7.06792 0 6.8755 0.238442 6.8755 0.46052C6.8755 0.945195 7.60575 1.05662 7.68148 2.42026V5.37896C7.68148 6.02727 7.5648 6.14649 7.30592 6.14649C6.61663 6.14649 4.94361 3.64442 3.95217 0.780779C3.75203 0.225195 3.55652 0.000779164 3.03646 0.000779164H1.00798C0.429186 0.000779164 0.3125 0.26961 0.3125 0.57039C0.3125 1.10182 1.0018 3.74416 3.51788 7.23506C5.19476 9.61792 7.5563 10.9091 9.70455 10.9091C10.9958 10.9091 11.1535 10.6223 11.1535 10.1291C11.1535 7.85221 11.0368 7.63714 11.6836 7.63714C11.9834 7.63714 12.4996 7.78675 13.7051 8.9361C15.0829 10.299 15.3093 10.9091 16.0805 10.9091H18.1083C18.6863 10.9091 18.9791 10.6223 18.8107 10.0566C18.4251 8.86675 15.8194 6.41922 15.7019 6.25558Z" fill="#3A86B7" />
                    </svg></a>
                <a href="<?php echo esc_html(get_theme_mod('youtube_url')); ?>" class="youtube" target="_blank"><svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.2818 2.15692C19.055 1.3135 18.39 0.64864 17.5467 0.421532C16.0061 0 9.84351 0 9.84351 0C9.84351 0 3.68119 0 2.14058 0.40555C1.3135 0.632418 0.632298 1.31362 0.40543 2.15692C0 3.69741 0 6.89219 0 6.89219C0 6.89219 0 10.1031 0.40543 11.6274C0.632538 12.4708 1.29728 13.1356 2.1407 13.3627C3.69741 13.7844 9.84375 13.7844 9.84375 13.7844C9.84375 13.7844 16.0061 13.7844 17.5467 13.3788C18.3901 13.1518 19.055 12.487 19.2821 11.6437C19.6874 10.1031 19.6874 6.90841 19.6874 6.90841C19.6874 6.90841 19.7036 3.69741 19.2818 2.15692ZM7.88149 9.84363V3.94074L13.006 6.89219L7.88149 9.84363Z" fill="#3A86B7" />
                    </svg>
                </a>
                <a href="<?php echo esc_html(get_theme_mod('dzen_url')); ?>" class="dzen" target="_blank"><svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.104 12.1286V11.8714C18.7897 11.7 16.364 11.5714 14.4183 9.68571C12.5326 7.74 12.3954 5.31429 12.2326 0H11.9754C11.804 5.31429 11.6754 7.74 9.78972 9.68571C7.844 11.5714 5.41829 11.7086 0.104004 11.8714V12.1286C5.41829 12.3 7.844 12.4286 9.78972 14.3143C11.6754 16.26 11.8126 18.6857 11.9754 24H12.2326C12.404 18.6857 12.5326 16.26 14.4183 14.3143C16.364 12.4286 18.7897 12.2914 24.104 12.1286Z" fill="#3A86B7" />
                    </svg>
                </a>
                <a href="<?php echo esc_html(get_theme_mod('tg_url')); ?>" class="tg" target="_blank"><svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.943 1.52693L16.9249 15.7604C16.6972 16.765 16.1033 17.0149 15.2595 16.5418L10.6609 13.153L8.44198 15.2872C8.1965 15.5327 7.99107 15.7382 7.51781 15.7382L7.84816 11.0546L16.3712 3.35297C16.7418 3.02262 16.2909 2.83954 15.7953 3.16993L5.25868 9.80446L0.722542 8.38472C-0.264154 8.07663 -0.281981 7.39797 0.92789 6.92476L18.6706 0.0893178C19.492 -0.218726 20.2109 0.272318 19.943 1.52693Z" fill="#3A86B7" />
                    </svg>
                </a>
            </div>
            <div class="policy form-text">
                <a href="<?= CFS()->get('agreement', 198) ?>" class="link" target="_blank">Пользовательское соглашение</a>
                <span class="separator">|</span>
                <a href="<?= CFS()->get('policy', 198) ?>" class="link" target="_blank">Политика конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>