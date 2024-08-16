<?php 

if(!wp_style_is('block-acf-cta-banner-css', 'enqueued')) {
    wp_enqueue_style('block-acf-cta-banner-css', get_template_directory_uri() . '/dist/assets/css/banners/cta-banner/cta-banner.css', array(), '1.0.0', 'all');
}

?>


<section class="cta-banner">
    <div class="cta-banner__inner">
        <div class="container">
            <div class="cta-banner__content" data-aos="fade-right">
                <h2 class="section-title">Connect to CSL</h2>
                <p>Contact us today to learn more about our Critical Connectivity solutions linking you to the Internet of Things (IoT). Our experts are always on call, 24/7, to provide the answers and support you need. Whether the situation is Life-, Mission- or Business- Critical, call on CSL.</p>
                <?php echo generateButton("Contact us", '#', 'button-primary button-transparent'); ?>
            </div>
        </div>
    </div>
</section>