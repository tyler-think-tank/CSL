<?php
class Header_Nav_Menu extends Walker_Nav_Menu {
    // Start Level
    function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $classes = array( 'sub-menu' );
        $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }

    // Start Element
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $args = (object) $args;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output = $args->before;
        $icon = get_field('icon', $item);
        $description = get_field('description', $item);

        $item_output .= '<a'. $attributes;
        if ($description) {
            $item_output .= ' class="has-description"';
        }
        $item_output .= '>';


        // Check if icon field has a value and print image for sub-menu items
        if ($depth > 0 && $icon) {
            $item_output .= '<div class="menu-icon">';
                $item_output .= wp_get_attachment_image($icon['id'], 'full') . ' ';
            $item_output .= '</div>';
        }

        $item_output .= $args->link_before . '<span>' . $title;
        if($depth > 0 && $description) {
            $item_output .= '<div class="menu-description"><span>' . $description . '</span></div>';
        }
        $item_output .= '</span>' . $args->link_after;

        $item_output .= '</a>';
        
        // Check if menu item has children
        if (in_array('menu-item-has-children', $item->classes)) {
            $item_output .= svg('chev-right', [], true); // Add SVG next to link
        }
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


class Mobile_Nav extends Walker_Nav_Menu {
    private $currentItem = null;

    // Start each element in the menu
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $this->currentItem = $item; // Store the current menu item

        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = ' class="' . esc_attr($class_names) . '"';
        $output .= $indent . '<li' . $class_names . ' data-level="' . $depth . '" data-menu-item="' . $item->ID . '">';

        $atts = array();
        $atts['title']  = !empty($item->title) ? $item->title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

        // Append the down-arrow SVG for menu items that have children
        if (in_array('menu-item-has-children', $item->classes)) {
            $item_output .= svg('arrow-right', array('class' => 'arrow-right', 'alt' => 'Arrow Right', 'width' => '13.3px', 'height' => '10.05px'), true);
        }

        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    // Start the sub-menu levels
    function start_lvl(&$output, $depth = 0, $args = null, $id = 0) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class=\"sub-menu\" data-level=\"" . ($depth + 1) . "\" data-parent-item=\"" . $this->currentItem->ID . "\">\n";

        // Add the "Back" item
        $output .= "$indent<li class=\"menu-item-back\" data-level=\"" . ($depth + 1) . "\"><a href=\"#\">" . svg('arrow-right', array('class' => 'arrow-right', 'alt' => 'Arrow Right', 'width' => '13.3px', 'height' => '10.05px'), true) . "<span>Back</span></a></li>\n";

        if ($depth > 0 && $this->currentItem && $this->currentItem->url != '#') {
            // Get classes and remove 'current-menu-ancestor' if present
            $classes = empty($this->currentItem->classes) ? array() : (array) $this->currentItem->classes;
            if (($key = array_search('current-menu-ancestor', $classes)) !== false) {
                unset($classes[$key]);
            }

            if (($key = array_search('menu-item-has-children', $classes)) !== false) {
                unset($classes[$key]);
            }

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $this->currentItem, $args, $depth));
            $class_names = ' class="' . esc_attr($class_names) . '"';

            // Attribute string for the parent item's anchor tag
            $atts = array();
            $atts['title']  = !empty($this->currentItem->title) ? $this->currentItem->title : '';
            $atts['target'] = !empty($this->currentItem->target) ? $this->currentItem->target : '';
            $atts['rel']    = !empty($this->currentItem->xfn) ? $this->currentItem->xfn : '';
            $atts['href']   = !empty($this->currentItem->url) ? $this->currentItem->url : '';

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            // Add the parent item with modified attributes
            $output .= "$indent<li$class_names data-level=\"" . ($depth + 1) . "\"><a" . $attributes . ">" . esc_html($this->currentItem->title) . "</a></li>\n";
        }
    }

    // End the sub-menu levels
    function end_lvl(&$output, $depth = 0, $args = null, $id = 0) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // End each element in the menu
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}