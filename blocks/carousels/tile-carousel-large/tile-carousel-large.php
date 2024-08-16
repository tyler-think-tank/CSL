<?php
    if (!wp_style_is('slick', 'enqueued')) {
        wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css', array(), '1.9.0', 'all', true);
    }

    if (!wp_script_is('slick', 'enqueued')) {
        wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array('jquery'), '1.9.0', true);
    }
?>


<section class="tile-carousel-large component">
    <?php 
        $classes = get_block_meta_classes();
        $title = get_field('title') ? get_field('title') : ($args['title'] ? $args['title'] : 'Header line');
        $content = get_field('content') ? get_field('content') : ($args['content'] ? $args['content'] : '');
    ?>

    <div class="tile-slider-lg acf-block">
        <div class="tile-slider-lg-inner <?php echo $classes; ?>">
            <div class="tile-slider-lg__top">
                <div class="container">
                    <div class="tile-slider-lg__top-inner" data-aos="fade-up">
                        <?php if($title) : ?>
                            <h2 class="heading section-title"><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <?php if($content) : ?>
                            <?php echo $content; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="slider-container">
                <div class="slider">
                    <?php $slides = get_field('slides'); ?>

                    <?php if(isset($slides) && is_array($slides)) : ?>

                    <?php foreach($slides as $slide) : ?>

                        <?php

                            $title = $slide['title'] ?? 'Header';
                            $excerpt = $slide['excerpt'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eleifend mattis orci, ac rutrum leo posuere nec. Aliquam sodales magna id erat tempus, faucibus suscipit purus sodales. ';
                            $link = $slide['link'] ?? array('url' => '#', 'target' => '_self', 'title' => $title);
                            $image = $slide['image'] ?? false;
                            $preHeading = $slide['pre_heading'] ?? 'Text';
                            $subHeading = $slide['sub_heading'] ?? 'Sub heading';

                        ?>

                        <div class="slide">
                            <div class="slide-image">
                                <div class="slide-image-inner">
                                    <?php if($image) : ?>
                                        <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="slide-content">
                                <div class="slide-content-inner d-flex justify-content-between" data-aos="fade-up">
                                    <div class="slider-content-col d-flex justify-content-center flex-wrap flex-column">
                                        <span><?php echo $preHeading; ?></span>
                                        <h3 class="project-title"><?php echo $title; ?></h3>
                                        <h3 class="product-name text-color-secondary"><?php echo $subHeading; ?></h3>
                                    </div>
                                    <div class="slider-content-col d-flex align-items-center">
                                        <p><?php echo $excerpt; ?></p>
                                    </div>
                                    <div class="slider-content-col d-flex align-items-end">
                                        <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" aria-label="View '<?php echo $title; ?>'">
                                          <?php echo svg('arrow-right', [], true); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>