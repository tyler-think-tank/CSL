<?php

// Automatically allow all ACF blocks
function my_allowed_block_types($allowed_blocks, $post) {

    $acf_blocks = array();
    $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

    // Loop through registered blocks to find ACF blocks
    foreach ($registered_blocks as $name => $block) {
        if (strpos($name, 'acf/') === 0) {
            $acf_blocks[] = $name;
        }
    }

    // If you are targeting a specific post type, uncomment the following lines
    // if ($post->post_type === 'your_post_type') {
    //     return $acf_blocks;
    // }

    return $acf_blocks;
}

add_filter('allowed_block_types', 'my_allowed_block_types', 10, 2);



function custom_scripts() {

    if(!is_admin()) {
        // Enqueue custom styles
        wp_enqueue_style( 'custom-styles', get_stylesheet_directory_uri() . '/dist/assets/css/global.css', array(), '1.0.0', 'all' );
        wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
        // Enqueue custom scripts
        wp_enqueue_script( 'custom-scripts', get_stylesheet_directory_uri() . '/dist/assets/js/global.js', array( 'jquery' ), '1.0.0', true );
    }
    else {
        wp_enqueue_style( 'glidertech-custom-editor-styles', get_stylesheet_directory_uri() . '/dist/assets/css/global-backend.css', array(), '1.0.0', 'all');
    }


    wp_localize_script('main', 'ajax_params', array('ajax_url' => admin_url('admin-ajax.php')));

}

add_action( 'wp_enqueue_scripts', 'custom_scripts' );
add_action( 'enqueue_block_editor_assets', 'custom_scripts' );


function remove_default_block_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'remove_default_block_styles', 100 );
add_action( 'admin_enqueue_scripts', 'remove_default_block_styles', 100 );


add_filter('show_admin_bar', '__return_false');


  // localise script ajaxurl variable WP Rest API endpoint
function custom_ajaxurl() {
    echo '<script type="text/javascript">
        var ajaxurl = "' . admin_url('admin-ajax.php') . '";
    </script>';
}

add_action('wp_head', 'custom_ajaxurl');



function get_post_type_singular_name() {
    $post_type = get_post_type_object(get_post_type());
    return isset($post_type->labels->singular_name) ? $post_type->labels->singular_name : '';
}


// register nav menus array

function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu-1' => __( 'Footer Menu 1' ),
            'footer-menu-2' => __( 'Footer Menu 2' ),
            'footer-menu-3' => __( 'Footer Menu 3' ),
            'footer-menu-4' => __( 'Footer Menu 4' ),
        )
    );
}

add_action( 'init', 'register_my_menus' );



function get_block_meta_classes() {
    $padding_top = get_field('padding_top');
    $padding_bottom = get_field('padding_bottom');
    $background_color = get_field('background_color');

    $classes = [];

    if ($padding_top) {
        $classes[] = 'pt-' . strtolower($padding_top);
    }

    if ($padding_bottom) {
        $classes[] = 'pb-' . strtolower($padding_bottom);
    }

    if ($background_color) {
        $classes[] = 'bg-' . $background_color;
    }

    return implode(' ', $classes);
}



function modify_image_tag_to_eager($html, $id, $alt, $title, $align, $size) {
    // Check if the image has the specific class
    if (strpos($html, 'class="page-banner__background-image') !== false) {
        // Replace loading="lazy" with loading="eager"
        $html = str_replace('loading="lazy"', 'loading="eager"', $html);
        // Ensure the loading attribute is set to eager if not present
        if (strpos($html, 'loading="eager"') === false) {
            $html = str_replace('<img', '<img loading="eager"', $html);
        }
    }
    return $html;
}
add_filter('get_image_tag', 'modify_image_tag_to_eager', 10, 6);


