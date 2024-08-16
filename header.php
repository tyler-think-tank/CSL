<!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php wp_title('|', true, 'right'); ?></title>
            <?php wp_head(); ?>
        </head>
        <body <?php body_class(); ?>>
            
            <header class="header">
                <div class="header__inner">
                    <div class="container-wide">
                        <div class="header__wrapper">
                            <div class="header__logo">
                                <a class="logo" href="<?php echo home_url(); ?>" aria-label="Home">
                                    <?php echo svg('logo-light', ['aria-hidden' => 'true'], true); ?>
                                </a>
                            </div>
                            <div class="header__nav">
                                <nav class="desktop-nav--wrapper nav">
                                    <ul>
                                        <?php
                                            wp_nav_menu(array(
                                                'theme_location' => 'header-menu',
                                                'container' => false,
                                                'items_wrap' => '%3$s',
                                                'walker' => new Header_Nav_Menu()
                                            ));
                                        ?>
                                    </ul>
                                    <div class="header__cta">
                                        <?php echo generateButton('Contact', '#', 'button-primary button transparent'); ?>
                                    </div>
                                </nav>
                                <button class="burger-button" aria-label="Mobile menu toggle navigation">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                                <div class="mobile-nav--wrapper">
                                    <nav>
                                        <ul>
                                            <?php
                                                wp_nav_menu(array(
                                                    'theme_location' => 'header-menu',
                                                    'container' => false,
                                                    'items_wrap' => '%3$s',
                                                    'walker' => new Mobile_Nav()
                                                ));
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </header>