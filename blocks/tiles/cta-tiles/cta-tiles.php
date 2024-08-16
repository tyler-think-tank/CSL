<?php
    $title = get_field('title');
    $content = get_field('content');
    $ctaTiles = get_field('tiles');
    $postContent = get_field('post_content');
    $link = get_field('link');
    $classes = get_block_meta_classes();
?>

<section class="cta-tiles component">
    <div class="cta-tiles__inner <?php echo $classes; ?>">
        <div class="container">
            <div class="cta-tiles__top" data-aos="fade-up">
                <h2 class="section-title"><?php echo $title; ?></h2>
                <?php echo $content; ?>
            </div>
            <div class="lightbox-gallery cta-tiles__grid">
                <?php foreach($ctaTiles as $index => $tile) :  ?>
                    <a class="cta-tiles__item" href="<?php echo $tile['link']['url']; ?>" title="<?php echo $tile['title']; ?>" data-aos="fade-up" data-aos-delay="<?php echo ($index % 4) * 100; ?>">
                        <div class="cta-tiles__item-image">
                            <?php echo wp_get_attachment_image($tile['image']['id'], 'medium', false); ?>
                        </div>
                        <div class="cta-tiles__item-content">
                            <h3 class="cta-tiles__item-title"><?php echo $tile['title']; ?></h3>
                            <button class="cta-tiles__item-button"><span>Discover</span> <?php echo svg('arrow-right', [], true); ?></button>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php if($postContent || $link) : ?>
                <div class="cta-tiles__bottom" data-aos="fade-up">
                    <div class="cta-tiles__post">
                        <?php echo $postContent; ?>
                    </div>
                    <?php if($link) : ?>
                        <?php echo generateButton($link['title'], $link['url'], 'button-primary button-transparent', $link['target']); ?>
                    <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
