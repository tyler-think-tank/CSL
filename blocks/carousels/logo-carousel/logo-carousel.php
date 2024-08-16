<?php

    if (!wp_style_is('slick', 'enqueued')) {
        wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css', array(), '1.9.0', 'all', true);
    }

    if (!wp_script_is('slick', 'enqueued')) {
        wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '1.9.0', true);
    }

    $classes = get_block_meta_classes();
    $title = get_field('title');
    $content = get_field('content');
    $logos = get_field('logos');
?>

<section class="logo-carousel">
    <div class="logo-carousel__inner <?php echo $classes; ?>">
        <div class="container">
            <div class="logo-carousel__grid">
                <div class="logo-carousel__content" data-aos="fade-up">
                    <h2 class="section-title"><?php echo $title; ?></h2>
                    <?php echo $content; ?>
                </div>
                <div class="logo-carousel__slider" data-aos="fade-up" data-aos-delay="100">
                    <div class="logo-carousel__slider-wrapper">
                        <?php foreach($logos as $index => $logo) : ?>
                            <?php if ($index % 6 === 0) : ?>
                                <div class="logo-carousel__slide-group">
                            <?php endif; ?>

                            <div class="logo-carousel__slide" data-aos="fade-up" data-aos-delay="<?php echo ($index % 6) * 100; ?>">
                                <?php echo wp_get_attachment_image($logo['id'], 'medium', false); ?>
                            </div>

                            <?php if ($index % 6 === 5 || $index === count($logos) - 1) : ?>
                                </div> 
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="logo-carousel__dots"></div>
                </div>
            </div>
        </div>
    </div>
</section>
