<?php

$includes = array(
    'inc/general.php',
    'inc/navwalkers.php',
    'inc/ajax-functions.php',
    'inc/acf-blocks.php',
);

foreach ($includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);



function generateButton($text, $link, $customClasses = '', $target = '_self', $ariaLabel = '') {
    $class = 'button ' . $customClasses;
    $targetAttr = $target ? 'target="' . $target . '"' : '';
    $ariaLabelAttr = $ariaLabel ? 'aria-label="' . $ariaLabel . '"' : '';
    
    return '<a href="' . $link . '" class="' . $class . '" ' . $targetAttr . ' role="button" ' . $ariaLabelAttr . '>' . '<span>' . $text . '</span>' . '</a>';
}


function generateLink($link, $video = false) {
    $target = $link['target'] ? 'target="' . $link['target'] . '"' : '';
    $title = $link['title'] ? $link['title'] : '';
    $classes = 'link';
    $classes .= $link['classes'] ? ' ' . $link['classes'] : '';
    $ariaLabel = $link['aria-label'] ? 'aria-label="' . $link['aria-label'] . '"' : 'aria-label="' . $title . '"';

    $renderedLink = '<a href="' . $link['url'] . '" class="' . $classes . '" ' . $target . ' ' . $ariaLabel . '><span>' . $title . '</span>' . svg('arrow-right', [], true) . '</a>';

    if($video) {
        if (!wp_style_is('lity', 'enqueued')) {
            wp_enqueue_style('lity', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css', array(), '2.4.1', 'all', true);
        }

        if (!wp_script_is('lity', 'enqueued')) {
            wp_enqueue_script('lity', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js', array('jquery'), '2.4.1', true);
        }

        $classes .= ' video-link button button-primary button-transparent';
        $renderedLink = '<a href="' . $link['url'] . '" class="' . $classes . '" ' . $target . ' ' . $ariaLabel . ' data-lity><span>' . $title . '</span>' . svg('play', [], true) . '</a>';
    }
    
    return $renderedLink;
}


function svg($filename, $attributes = array(), $inline = false) {
    $svg_path = get_template_directory() . '/dist/assets/images/icons/' . $filename . '.svg';
    if (file_exists($svg_path)) {
        ob_start(); // Start output buffering
        readfile($svg_path); // Read the file and write to output buffer
        $svg = ob_get_clean(); // Get output buffer contents and clean buffer

        if ($inline) {
            $dom = new DOMDocument();
            $dom->loadXML($svg);
            $root = $dom->documentElement;
            foreach ($attributes as $key => $value) {
                $root->setAttribute($key, $value);
            }
            return $dom->saveXML($root);
        } else {
            $img_attributes = '';
            foreach ($attributes as $key => $value) {
                $img_attributes .= $key . '="' . $value . '" ';
            }
            return '<img src="data:image/svg+xml;base64,' . base64_encode($svg) . '" ' . $img_attributes . '>';
        }
    } else {
        return 'Error: Could not read ' . $svg_path;
    }
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Global Settings',
        'menu_title'    => 'Global Settings',
        'menu_slug'     => 'global-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}


// Modify the main image URL
function modify_image_src($image, $attachment_id, $size, $icon) {
    // Check if the MIME type is an image type we want to change
    $mime_type = get_post_mime_type($attachment_id);

    if ($mime_type == 'image/jpeg' || $mime_type == 'image/png') {
        // Convert URL to server path
        $upload_dir = wp_get_upload_dir();
        $image_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $image[0]);

        // Check if .webp file exists
        if (file_exists($image_path . '.webp')) {
            $image[0] .= '.webp';
        }
    }

    return $image;
}


// Modify the srcset
function modify_image_srcset($sources, $size_array, $image_src, $image_meta, $attachment_id) {
    $mime_type = get_post_mime_type($attachment_id);

    if ($mime_type == 'image/jpeg' || $mime_type == 'image/png') {
        $upload_dir = wp_get_upload_dir();

        foreach ($sources as $key => $source) {
            $image_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $source['url']);

            if (file_exists($image_path . '.webp')) {
                $sources[$key]['url'] .= '.webp';
            }
        }
    }

    return $sources;
}

// Modify the image attributes to add lazy loading
function add_lazy_loading($attr, $attachment, $size) {
    $attr['loading'] = 'lazy';
    return $attr;
}


add_filter('wp_get_attachment_image_attributes', 'add_lazy_loading', 10, 3);
add_filter('wp_get_attachment_image_src', 'modify_image_src', 10, 4);
add_filter('wp_calculate_image_srcset', 'modify_image_srcset', 10, 5);



function custom_excerpt($excerpt, $length = 10) {
    $words = explode(' ', $excerpt);
    if (count($words) > $length) {
        $last_word = $words[$length - 1];
        if (substr($last_word, -1) === ',') {
            $words[$length - 1] = substr($last_word, 0, -1);
        }
        return implode(' ', array_slice($words, 0, $length)) . '...';
    } else {
        return $excerpt;
    }
}



function hide_posts_menu() {
    remove_menu_page('edit.php');
}

// add_action('admin_menu', 'hide_posts_menu');


function disable_comments_support() {
    // Post types for which comments should be disabled
    $post_types = get_post_types();
    
    // Loop through each post type and disable support for comments and trackbacks
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}

// Hook the function to the 'init' action
add_action('init', 'disable_comments_support');

// Optional: Remove comments from the admin menu
function remove_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'remove_comments_admin_menu');



function allow_json_upload_for_admins($mime_types) {
    // Check if the current user has the 'manage_options' capability
    if (current_user_can('manage_options')) {
        // Allow uploading JSON files
        $mime_types['json'] = 'application/json';
    } else {
        // If not an admin or does not have the 'manage_options' capability, ensure JSON is not allowed
        unset($mime_types['json']);
    }
    return $mime_types;
}
add_filter('upload_mimes', 'allow_json_upload_for_admins', 999, 1);



function allow_json_filetype_check($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext === 'json') {
        $data['ext']  = 'json';
        $data['type'] = 'application/json';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'allow_json_filetype_check', 10, 4);





