<?php
    $background = get_field('background_image');
    $title = get_field('title');
    $subtitle = get_field('subtitle');
    $content = get_field('content');
    $link = get_field('link');
?>

<section class="text-overlay-banner">
    <div class="text-overlay-banner__inner">
        <div class="text-overlay-banner__background">
            <?php echo wp_get_attachment_image($background['id'], 'full', false); ?>
        </div>
        <div class="text-overlay-banner__content">
            <div class="container">
                <div class="text-overlay-banner__content-wrap" data-aos="fade-up">
                    <h2 class="section-title"><?php echo $title; ?></h2>
                    <?php if($subtitle) : ?>
                        <div class="text-overlay-banner__subtitle"><span><?php echo $subtitle; ?></span></div>
                    <?php endif; ?>
                    <div class="text-overlay-banner__content-text">
                        <?php echo $content; ?>
                    </div>
                    <?php if($link) : ?>
                        <div class="text-overlay-banner__content-link">
                            <?php echo generateLink($link, 1); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>