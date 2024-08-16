<?php
    $block_meta_classes = get_block_meta_classes();
    $title = get_field('title');
    $title_type = get_field('title_type');
    $content = get_field('content');
    $ctas = get_field('ctas');
    $align = get_field('align');
    $width = get_field('width');

    switch($width) {
        case 'narrow':
            $container = 'container-narrow';
            break;
        case 'regular':
            $container = 'container';
            break;
        case 'wide':
            $container = 'container-wide';
            break;
        default:
            $container = 'container';
            break;
    }


    switch($align) {
        case 'left':
            $align = 'align-left';
            break;
        case 'center':
            $align = 'align-center';
            break;
        case 'right':
            $align = 'align-right';
            break;
        default:
            $align = 'align-center';
            break;
    }
?>


<section class="simple-text">
    <div class="simple-text__inner <?php echo $block_meta_classes; ?>">
        <div class="<?php echo $container; ?>">
            <div class="simple-text__content <?php echo $align; ?>" data-aos="fade-up">
                <?php if($title) : ?>
                    <h2 class="heading <?php echo $title_type; ?>"><?php echo $title; ?></h2>
                <?php endif; ?>
                <?php if($content) : ?>
                    <div class="simple-text__content-text">
                        <?php echo $content; ?>
                    </div>
                <?php endif; ?>
                <?php if($ctas) : ?>
                    <div class="simple-text__content-ctas">
                        <?php foreach($ctas as $cta) : ?>
                            <?php echo generateButton($cta['cta']['title'], $cta['cta']['url'], 'button-primary button-transparent', $cta['cta']['target']); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>