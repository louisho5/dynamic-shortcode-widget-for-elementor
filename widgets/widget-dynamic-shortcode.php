<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Custom_Ele_Widget_Dynamic_Shortcode extends \Elementor\Widget_Base {

    public function get_name() {
        return 'widget-dynamic-shortcode';
    }

    public function get_title() {
        return __( 'Dynamic Shortcode', 'plugin-name' );
    }

    public function get_icon() {
        return 'eicon-shortcode';
    }

    public function get_categories() {
        return ['basic'];
    }

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	// Create a custom content section
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
		
		$repeater = new \Elementor\Repeater();
		
		// Attribute input (Textarea)
        $repeater->add_control(
            'attribute',
            [
                'label' => __( 'Attribute name:', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 1,
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        // Content Type (Select)
        $repeater->add_control(
			'content_type',
			[
				'label' => esc_html__( 'Select type', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'text'  => esc_html__( 'Text', 'plugin-name' ),
					'image' => esc_html__( 'Image', 'plugin-name' ),
				],
			]
		);
		// Content input (Textarea)
		$repeater->add_control(
            'content',
            [
                'label' => __( 'Content:', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'condition' => [
                    'content_type' => 'text',
                ],
                'dynamic' => [
					'active' => true,
				],
            ]
        );
        // Content input (Image)
        $repeater->add_control(
            'content_image',
            [
                'label' => __( 'Select Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'content_type' => 'image',
                ],
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        // Text input (Text)
        $this->add_control(
            'name',
            [
                'label' => __( 'Shortcode name', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'A complete shortcode be like: [ShortcodeName attr1="Something" attr2="Something else"]', 'plugin-name' ),
                'dynamic' => [
					'active' => true,
				],
            ]
        );

        // Displays a separator between controls
		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Export repeater items to widget
		$this->add_control(
			'list',
			[
				'label' => __( 'Attributes (Optional)', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '{{{ attribute }}}',
			]
		);
		
        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
		$output = "";
		
		$output .= "[" . $settings['name'];
		
		if ( $settings['list'] ) {
			foreach (  $settings['list'] as $item ) {
                $content = esc_html( $item['content'] );
				$output .= " " . $item['attribute'] . "='" . $content . $item['content_image']['url'] . "'";
			}
		}
        $output .= "]";

        echo do_shortcode( $output );

    }

}