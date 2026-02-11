<?php
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Easy_Currency_Switcher_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'rt_currecny_switcher';
    }   
    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Easy Currency Switcher', 'easy-currency' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-price';
    }


    public function get_categories() {
        return [ 'easy_currency_category' ];
    }

    public function get_keywords() {
        return [ 'currency switcher', 'currency' ];
    }

	protected function register_controls() {

		$this->start_controls_section(
		    '_section_shortcode_content',
		    [
		        'label' => esc_html__( 'General', 'easy-currency' ),
		        'tab' => Controls_Manager::TAB_CONTENT,
		    ]
		);

		$shortcode_options = eccw_get_shortcodes();

		$this->add_control(
			'shortcode_id',
			[
				'label'       => esc_html__( 'Select Shortcode', 'easy-currency' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => $shortcode_options,
				'default'     => key( $shortcode_options ),
				'description' => esc_html__( 'Choose which currency switcher to display.', 'easy-currency' ),
			]
		);

		$this->end_controls_section();


        $this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Dropdown Button', 'easy-currency' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'easy-currency' ),
            ]
        ); 

		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'easy-currency' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'btn_toggle_icon_color',
		    [
		        'label' => esc_html__( 'Toggle Icon Color', 'easy-currency' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle .dropdown-icon::before' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle .dropdown-icon::after' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'btn_text_padding',
		    [
		        'label' => esc_html__( 'Padding', 'easy-currency' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
				'label' => esc_html__( 'Border', 'easy-currency' ),
		        'name' => 'btn_text_border',
		        'selector' => '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__( 'Background', 'easy-currency' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle',
			]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'easy-currency' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',  
		        ],
                'separator' => 'before',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'easy-currency' ),
            ]
        ); 
		$this->add_control(
		    'btn_hover_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'easy-currency' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'btn_toggle_icon_hover_color',
		    [
		        'label' => esc_html__( 'Toggle Icon Color', 'easy-currency' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle:hover .dropdown-icon::before' => 'background-color: {{VALUE}};',
		            '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle:hover .dropdown-icon::after' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_hover_normal',
				'label' => esc_html__( 'Background', 'easy-currency' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .easy-currency-switcher .easy_currency_switcher_form .easy-currency-switcher-toggle:hover',
			]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		// dropdown list view 

		$this->start_controls_section(
		    '_section_list_style',
		    [
		        'label' => esc_html__( 'Dropdown List', 'easy-currency' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label' => esc_html__( 'Width', 'easy-currency' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 4000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_max_height',
			[
				'label' => esc_html__( 'Max Height', 'easy-currency' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dropdown_background',
			[
				'label' => esc_html__( 'Background Color', 'easy-currency' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'dropdown_border',
				'selector' => '{{WRAPPER}} .easy-currency-switcher-select',
			]
		);

		$this->add_control(
		    'dropdown_list_padding',
		    [
		        'label' => esc_html__( 'Padding', 'easy-currency' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .easy-currency-switcher-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
			'dropdown_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'easy-currency' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select' =>
						'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'dropdown_shadow',
				'selector' => '{{WRAPPER}} .easy-currency-switcher-select',
			]
		);

		$this->add_responsive_control(
			'dropdown_offset_top',
			[
				'label' => esc_html__( 'Top Offset', 'easy-currency' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_dropdown_list_item_style',
			[
				'label' => esc_html__( 'Dropdown List Item', 'easy-currency' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
		    'list_item_gap',
		    [
		        'label' => esc_html__( 'Item Gap', 'easy-currency' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .easy-currency-switcher-select li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		/* Tabs */
		$this->start_controls_tabs( '_tabs_dropdown_list_item' );

		/* ================= NORMAL ================= */
		$this->start_controls_tab(
			'style_list_item_normal',
			[
				'label' => esc_html__( 'Normal', 'easy-currency' ),
			]
		);

		/* Text Color */
		$this->add_control(
			'list_item_text_color',
			[
				'label' => esc_html__( 'Text Color', 'easy-currency' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select li' => 'color: {{VALUE}};',
				],
			]
		);

		/* Typography */
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_item_typography',
				'selector' => '{{WRAPPER}} .easy-currency-switcher-select li span',
			]
		);

		/* Background */
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'list_item_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .easy-currency-switcher-select li',
			]
		);

		/* Padding */
		$this->add_responsive_control(
			'list_item_padding',
			[
				'label' => esc_html__( 'Padding', 'easy-currency' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select li' =>
						'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		/* Border */
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'list_item_border',
				'selector' => '{{WRAPPER}} .easy-currency-switcher-select li',
			]
		);

		/* Border Radius */
		$this->add_responsive_control(
			'list_item_radius',
			[
				'label' => esc_html__( 'Border Radius', 'easy-currency' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select li' =>
						'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		/* ================= HOVER ================= */
		$this->start_controls_tab(
			'style_list_item_hover',
			[
				'label' => esc_html__( 'Hover', 'easy-currency' ),
			]
		);

		/* Hover Text Color */
		$this->add_control(
			'list_item_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'easy-currency' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .easy-currency-switcher-select li:hover' => 'color: {{VALUE}};',
				],
			]
		);

		/* Hover Background */
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'list_item_hover_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .easy-currency-switcher-select li:hover',
			]
		);

		/* Hover Border */
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'list_item_hover_border',
				'selector' => '{{WRAPPER}} .easy-currency-switcher-select li:hover',
			]
		);

		/* Hover Shadow */
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'list_item_hover_shadow',
				'selector' => '{{WRAPPER}} .easy-currency-switcher-select li:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$shortcode_id = isset( $settings['shortcode_id'] ) ? $settings['shortcode_id'] : '1' ;

		$is_editor = \Elementor\Plugin::$instance->editor->is_edit_mode()
			|| \Elementor\Plugin::$instance->preview->is_preview_mode();

		$currency_view = new ECCW_CURRENCY_VIEW();

		/**
		 * Force render in Elementor editor
		 * Frontend behaviour remains unchanged
		 */
		$switcher_html = $currency_view->eccw_get_currency_switcher([
			'shortcode_id'  => $shortcode_id,
			'force_render'  => $is_editor,
			'wrapper_class'=> 'switcher-list-content',
		]);

		if ( empty( $switcher_html ) && $is_editor ) {
			echo '<div style="padding:10px;border:1px dashed #ccc;">
				Easy Currency Switcher will appear on frontend.
			</div>';
			return;
		}

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf( '%s', $switcher_html );
	}
    
}