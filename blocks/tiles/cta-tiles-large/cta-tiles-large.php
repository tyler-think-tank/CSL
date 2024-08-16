<?php
    $classes = get_block_meta_classes();
    $background = get_field('background_image');
    $tiles = get_field('tiles');
?>


<section class="cta-tiles-large">
    <div class="cta-tiles-large__inner <?php echo $classes; ?>">
        <div class="cta-tiles-large__background">
            <?php echo wp_get_attachment_image($background['id'], 'full', false); ?>
        </div>
        <div class="container">
            <div class="cta-tiles-large__grid">
                <?php foreach($tiles as $index => $tile) : ?>
                    <div class="cta-tiles-large__item" data-aos="fade-up" data-aos-delay="<?php echo ($index % 4) * 100; ?>">
                        <a href="<?php echo $tile['link']['url']; ?>" class="cta-tiles-large__item-link">
                            <div class="cta-tiles-large__item-background">
                                <?php echo wp_get_attachment_image($tile['image']['id'], 'full', false); ?>
                            </div>
                            <div class="cta-tiles-large__item-content">
                                <div class="cta-tiles-large__item-content-top">
                                    <h3 class="cta-tiles-large__item-title"><?php echo $tile['title']; ?></h3>
                                    <?php echo svg('arrow-right-small', [], true); ?>
                                </div>
                                <div class="cta-tiles-large__item-content-text">
                                    <?php echo $tile['content']; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>