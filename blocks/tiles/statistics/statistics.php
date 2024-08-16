<?php
    $classes = get_block_meta_classes();
    $title = get_field('title');
    $stats = get_field('stats');
?>

<section class="statistics">
    <div class="statistics__inner <?php echo $classes; ?>">
        <div class="container">
            <div class="statistics__top" data-aos="fade-up">
                <h2 class="section-title"><?php echo $title; ?></h2>
            </div>
            <div class="statistics__grid">
                <?php foreach($stats as $index => $stat) : ?>
                    <div class="statistics__item" data-aos="fade-up" data-aos-delay="<?php echo ($index % 4) * 100; ?>">
                        <div class="statistics__item-image">
                            <?php echo wp_get_attachment_image($stat['image']['id'], 'medium'); ?>
                        </div>
                        <div class="statistics__item-content">
                            <h3 class="statistics__item-title">
                                <?php if($stat['value']): ?>
                                    <span class="stat-value"><?php echo $stat['value']; ?></span>
                                <?php endif; ?>
                                <?php if($stat['metric']) : ?>
                                    <span class="stat-metric"><?php echo $stat['metric']; ?></span>
                                <?php endif; ?>
                            </h3>
                            <p class="statistics__item-description"><?php echo $stat['description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>