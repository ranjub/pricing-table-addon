<?php

class Elementor_Pricing_Table_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'pricing_table_widget';
    }

    public function get_title()
    {
        return esc_html__('Pricing Table', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-price-table';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['pricing', 'table', 'pricing table'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Plan Title', 'elementor-addon'),
                'placeholder' => esc_html__('Enter your title', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$99', 'elementor-addon'),
                'placeholder' => esc_html__('Enter the price', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__('Features', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Feature 1\nFeature 2\nFeature 3", 'elementor-addon'),
                'placeholder' => esc_html__('Enter the features', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Sign Up', 'elementor-addon'),
                'placeholder' => esc_html__('Enter button text', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://example.com', 'elementor-addon'),
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="pricing-table-container">
            <div class="pricing-table">
                <div class="pricing-header">
                    <h3><?php echo esc_html($settings['title']); ?></h3>
                    <div class="price"><?php echo esc_html($settings['price']); ?></div>
                </div>
                <ul class="features">
                    <?php foreach (explode("\n", $settings['features']) as $feature) : ?>
                        <li><?php echo esc_html($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a class="pricing-button" href="<?php echo esc_url($settings['button_link']['url']); ?>">
                    <?php echo esc_html($settings['button_text']); ?>
                </a>
            </div>
        </div>
<?php
    }
}
