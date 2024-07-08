<?php

class Elementor_Custom_Dropdown_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'custom-dropdown-widget';
    }

    public function get_title()
    {
        return esc_html__('Custom dropdown Widget', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['dropdown', 'post', 'custom-dropdown', 'ascending', 'descending'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'elementor-addon'),
            ]
        );

        // Add control for selecting category
        $this->add_control(
            'selected_category',
            [
                'label' => __('Select Category', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_categories_options(),
            ]
        );

        // Add control for selecting order
        $this->add_control(
            'order',
            [
                'label' => __('Select Order', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' => __('Ascending', 'elementor-addon'),
                    'desc' => __('Descending', 'elementor-addon'),
                ],
                'default' => 'desc',
            ]
        );

        $this->end_controls_section();
    }
    private function get_categories_options()
    {
        $categories = get_categories();
        $options = [];
        foreach ($categories as $category) {
            $options[$category->slug] = $category->name;
        }
        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Get selected category and order
        $category = $settings['selected_category'];
        $order = $settings['order'];

        // Query posts
        $args = [
            'category_name' => $category,
            'order' => $order,
            'posts_per_page' => -1,
        ];
        $query = new WP_Query($args);

        // Display posts in three columns
        if ($query->have_posts()) {
            echo '<div class="custom-posts-widget">';
            echo '<div class="posts-grid">';
            $count = 0;
            while ($query->have_posts()) {
                $query->the_post();
                if ($count % 3 == 0) {
                    echo '</div><div class="posts-grid">';
                }

                echo '<div class="post-item">';
                if (has_post_thumbnail()) {
                    echo '<div class="post-thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</a></div>';
                }
                echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                echo '<div class="post-content">' . get_the_excerpt() . '</div>';
                echo '</div>';
                $count++;
            }
            echo '</div>';
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>No posts found.</p>';
        }
    }
}
