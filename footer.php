<?php
    get_template_part('blocks/banners/cta-banner/cta-banner');
?>


<footer class="footer">
    <div class="footer__inner">
        <div class="container-wide">
            <div class="footer__grid">
                <div class="footer__column">
                    <div class="footer__logo">
                        <a href="<?php echo home_url(); ?>" class="footer__logo">
                            <?php echo svg('logo-light', [], true); ?>
                        </a>
                    </div>
                    <div class="footer__cta">
                        <?php echo generateButton("Connect to CSL", "#", "button-primary button-transparent"); ?>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="footer__menu">
                        <?php
                            $menu_name = wp_get_nav_menu_name('footer-menu-1');
                            if ($menu_name) {
                                echo '<span class="footer__menu-name">' . $menu_name . '</span>';
                            }
                        ?>
                        <ul>
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'footer-menu-1',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                ));
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="footer__menu">
                        <?php
                            $menu_name = wp_get_nav_menu_name('footer-menu-2');
                            if ($menu_name) {
                                echo '<span class="footer__menu-name">' . $menu_name . '</span>';
                            }
                        ?>
                        <ul>
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'footer-menu-2',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                ));
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="footer__menu">
                        <?php
                            $menu_name = wp_get_nav_menu_name('footer-menu-3');
                            if ($menu_name) {
                                echo '<span class="footer__menu-name">' . $menu_name . '</span>';
                            }
                        ?>
                        <ul>
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'footer-menu-3',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                ));
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="footer__column">
                    <div class="footer__menu">
                        <?php
                            $menu_name = wp_get_nav_menu_name('footer-menu-1');
                            if ($menu_name) {
                                echo '<span class="footer__menu-name">' . $menu_name . '</span>';
                            }
                        ?>
                        <ul>
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'footer-menu-4',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                ));
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <span>Text &copy; 2024. All rights reserved.</span>
                <div class="footer__socials">
                    <?php for($i = 0; $i < 4; $i++) : ?>
                        <a href="#" class="footer__social-link">
                            <?php echo svg('linkedin', [], true); ?>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
