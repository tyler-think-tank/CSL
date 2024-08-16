<?php
    $title = get_field('title') ?: 'Critical Connectivity <span class="text-primary">Experts</span>';
    $background = get_field('background_image');
    $content = get_field('content');
    $link = get_field('link');

    $animatedImage = get_field('animated_image');

    if ($animatedImage) {
        $image = '<div class="lottie" data-path="' . $animatedImage['url'] . '"></div>';
    }
?>


<section class="page-banner">
    <div class="page-banner__background">
        <?php echo wp_get_attachment_image($background['id'], 'full', false, ['class' => 'page-banner__image']); ?>
        <?php if($image) : ?>
            <div class="animation">
                <?php echo $image; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="page-banner__inner">
        <div class="container-wide">
            <div class="page-banner__content" data-aos="fade-right">
                <h1 class="page-banner__title section-title"><?php echo $title; ?></h1>
                <?php echo $content ?: ''; ?>
                <?php echo generateButton($link['title'], $link['url'], 'button-primary button-transparent', $link['target']); ?>
            </div>
        </div>
    </div>
</section>