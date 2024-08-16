<?php


  // Register cta-banner
  acf_register_block_type(array(
      'name'              => 'Cta Banner',
      'title'             => __('Cta Banner'),
      'description'       => __('A custom Cta Banner block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/banners/cta-banner/cta-banner.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/banners/cta-banner/cta-banner.css',
      
      'category'          => 'banners',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'cta', 'banner' ),
  ));
  
  // Register page-banner
  acf_register_block_type(array(
      'name'              => 'Page Banner',
      'title'             => __('Page Banner'),
      'description'       => __('A custom Page Banner block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/banners/page-banner/page-banner.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/banners/page-banner/page-banner.css',
      'enqueue_script'    => get_template_directory_uri() . '/dist/assets/js/banners/page-banner/page-banner.js',
      'category'          => 'banners',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'page', 'banner' ),
  ));
  
  // Register text-overlay-banner
  acf_register_block_type(array(
      'name'              => 'Text Overlay Banner',
      'title'             => __('Text Overlay Banner'),
      'description'       => __('A custom Text Overlay Banner block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/banners/text-overlay-banner/text-overlay-banner.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/banners/text-overlay-banner/text-overlay-banner.css',
      
      'category'          => 'banners',
      'icon'              => 'editor-textcolor',
      'keywords'          => array( 'text', 'overlay', 'banner' ),
  ));
  
  // Register logo-carousel
  acf_register_block_type(array(
      'name'              => 'Logo Carousel',
      'title'             => __('Logo Carousel'),
      'description'       => __('A custom Logo Carousel block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/carousels/logo-carousel/logo-carousel.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/carousels/logo-carousel/logo-carousel.css',
      'enqueue_script'    => get_template_directory_uri() . '/dist/assets/js/carousels/logo-carousel/logo-carousel.js',
      'category'          => 'carousels',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'logo', 'carousel' ),
  ));
  
  // Register tile-carousel-large
  acf_register_block_type(array(
      'name'              => 'Tile Carousel Large',
      'title'             => __('Tile Carousel Large'),
      'description'       => __('A custom Tile Carousel Large block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/carousels/tile-carousel-large/tile-carousel-large.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/carousels/tile-carousel-large/tile-carousel-large.css',
      'enqueue_script'    => get_template_directory_uri() . '/dist/assets/js/carousels/tile-carousel-large/tile-carousel-large.js',
      'category'          => 'carousels',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'tile', 'carousel', 'large' ),
  ));
  
  // Register simple-text
  acf_register_block_type(array(
      'name'              => 'Simple Text',
      'title'             => __('Simple Text'),
      'description'       => __('A custom Simple Text block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/text/simple-text/simple-text.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/text/simple-text/simple-text.css',
      
      'category'          => 'text',
      'icon'              => 'editor-textcolor',
      'keywords'          => array( 'simple', 'text' ),
  ));
  
  // Register cta-tiles
  acf_register_block_type(array(
      'name'              => 'Cta Tiles',
      'title'             => __('Cta Tiles'),
      'description'       => __('A custom Cta Tiles block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/tiles/cta-tiles/cta-tiles.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/tiles/cta-tiles/cta-tiles.css',
      
      'category'          => 'tiles',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'cta', 'tiles' ),
  ));
  
  // Register cta-tiles-large
  acf_register_block_type(array(
      'name'              => 'Cta Tiles Large',
      'title'             => __('Cta Tiles Large'),
      'description'       => __('A custom Cta Tiles Large block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/tiles/cta-tiles-large/cta-tiles-large.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/tiles/cta-tiles-large/cta-tiles-large.css',
      
      'category'          => 'tiles',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'cta', 'tiles', 'large' ),
  ));
  
  // Register statistics
  acf_register_block_type(array(
      'name'              => 'Statistics',
      'title'             => __('Statistics'),
      'description'       => __('A custom Statistics block.'),
      'render_callback'   => function($block, $content = '', $is_preview = false) {
        include(get_theme_file_path('/blocks/tiles/statistics/statistics.php'));
      },
      'enqueue_style'     => get_template_directory_uri() . '/dist/assets/css/tiles/statistics/statistics.css',
      'enqueue_script'    => get_template_directory_uri() . '/dist/assets/js/tiles/statistics/statistics.js',
      'category'          => 'tiles',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'statistics' ),
  ));
  