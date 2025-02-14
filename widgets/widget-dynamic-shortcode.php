<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Dynamic_Shortcode_Widget_For_Elementor extends \Elementor\Widget_Base {

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
                    'url' => esc_html__( 'URL', 'plugin-name' ),
                    'wysiwyg' => esc_html__( 'WYSIWYG Editor', 'plugin-name' ),
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
        // Content input (URL)
        $repeater->add_control(
            'content_url',
            [
				'label' => esc_html__( 'Link', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'plugin-name' ),
				'options' => false,
                'condition' => [
                    'content_type' => 'url',
                ],
                'dynamic' => [
					'active' => true,
				],
			]
        );
        // Content input (WYSIWYG Editor)
        $repeater->add_control(
            'content_wysiwyg',
            [
                'label' => esc_html__( 'Link', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__( 'Type your own text', 'plugin-name' ),
                'options' => false,
                'condition' => [
                    'content_type' => 'wysiwyg',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Shortcode name input (Text)
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
        
        if ( !empty( $settings['list'] ) ) { // Check if list is not empty
            foreach (  $settings['list'] as $item ) {
                $content_text = isset($item['content']) ? str_replace(array("'"), array('&apos;'), $item['content']) : '';
                $content_image = isset($item['content_image']['url']) ? esc_url( $item['content_image']['url'] ) : '';
                $content_url = isset($item['content_url']['url']) ? esc_url( $item['content_url']['url'] ) : '';
                $content_wysiwyg = isset($item['content_wysiwyg']) ? str_replace(array("'"), array('&apos;'), $item['content_wysiwyg']) : '';
                $content = $content_text . $content_image . $content_url . $content_wysiwyg;
    
                if (isset($item['attribute'])) {
                    $output .= " " . $item['attribute'] . "='" . $content . "'";
                }
            }
        }
        
        $output .= "]";
    
        echo do_shortcode( $output );
    }

}
