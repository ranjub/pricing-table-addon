<?php

/**
 * Plugin Name: Elementor Addon(Pricing Table)
 * Description: Simple pricing table widgets for Elementor.
 * Version:     1.0.0
 * Author:      Ranju
 * Text Domain: elementor-addon
 * Requires Plugins: elementor
 */

function register_custom_widgets($widgets_manager)
{

    require_once(plugin_dir_path(__FILE__) . '/widgets/hello-world-widget.php');
    require_once(plugin_dir_path(__FILE__) . '/widgets/pricing-table-widget.php');
    require_once(plugin_dir_path(__FILE__) . '/widgets/custom-dropdown-widget.php');

    $widgets_manager->register(new \Elementor_Hello_World_Widget());
    $widgets_manager->register(new \Elementor_Pricing_Table_Widget());
    $widgets_manager->register(new \Elementor_Custom_Dropdown_Widget());
}
add_action('elementor/widgets/register', 'register_custom_widgets');

function elementor_addon_scripts()
{
    wp_enqueue_style('pricing-table', plugins_url('/css/pricing-table.css', __FILE__));
    wp_enqueue_style('custom-dropdown', plugins_url('/css/custom-dropdown.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'elementor_addon_scripts');

// Add a new column to the posts list
function add_post_id_column($columns)
{
    $columns['post_id'] = 'Post ID';
    return $columns;
}
add_filter('manage_post_posts_columns', 'add_post_id_column');

// Display the post ID in the new column
function display_post_id_column($column, $post_id)
{
    if ($column === 'post_id') {
        echo $post_id;
    }
}
add_action('manage_posts_custom_column', 'display_post_id_column', 10, 2);
