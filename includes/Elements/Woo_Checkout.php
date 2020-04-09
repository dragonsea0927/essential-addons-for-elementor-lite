<?php

namespace Essential_Addons_Elementor\Elements;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Frontend;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;

class Woo_Checkout extends Widget_Base {
	use \Essential_Addons_Elementor\Traits\Helper;
	use \Essential_Addons_Elementor\Template\Woocommerce\Checkout\Layouts\Woo_Checkout_Default;

	public function get_name() {
		return 'eael-woo-checkout';
	}

	public function get_title() {
		return esc_html__( 'EA Woo Checkout', 'essential-addons-for-elementor-lite' );
	}

	public function get_icon() {
		return 'eicon-cart-medium';
	}

	public function get_categories() {
		return [ 'essential-addons-elementor' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 3.5.2
	 * @access public
	 *
	 */
	public function get_keywords() {
		return [ 'woocommerce', 'checkout', 'ea', 'woocommerce checkout' ];
	}

	protected function _register_controls() {
		/**
		 * General Settings
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_general_settings',
			[
				'label' => esc_html__( 'General Settings', 'essential-addons-for-elementor-lite' ),
			]
		);
		$this->add_control(
			'ea_woo_checkout_layout',
			[
				'label' => esc_html__( 'Layout', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'label_block' => false,
				'options' => [
					'default' => esc_html__( 'Default', 'essential-addons-for-elementor-lite' ),
//					'split' => esc_html__( 'Split', 'essential-addons-for-elementor-lite' ),
//					'steps' => esc_html__( 'Steps', 'essential-addons-for-elementor-lite' ),
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Order Review Settings
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_order_review_settings',
			[
				'label' => esc_html__( 'Order Review', 'essential-addons-for-elementor-lite' ),
			]
		);

		// Table Header
		$this->add_control(
			'ea_woo_checkout_table_header_text',
			[
				'label' => esc_html__( 'Change Header Text', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'ea_woo_checkout_table_product_text',
			[
				'label' => __( 'Product Column', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Product', 'essential-addons-for-elementor-lite' ),
				'condition' => [
					'ea_woo_checkout_table_header_text' => 'yes',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_table_quantity_text',
			[
				'label' => __( 'Quantity Column', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Quantity', 'essential-addons-for-elementor-lite' ),
				'condition' => [
					'ea_woo_checkout_table_header_text' => 'yes',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_table_price_text',
			[
				'label' => __( 'Price Column', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Price', 'essential-addons-for-elementor-lite' ),
				'condition' => [
					'ea_woo_checkout_table_header_text' => 'yes',
				],
			]
		);

		// Shop Link
		$this->add_control(
			'ea_woo_checkout_shop_link',
			[
				'label' => esc_html__( 'Shop Link', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'ea_woo_checkout_shop_link_text',
			[
				'label' => __( 'Link Text', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Continue Shopping', 'essential-addons-for-elementor-lite' ),
				'condition' => [
					'ea_woo_checkout_shop_link' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Coupon Settings
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_settings',
			[
				'label' => esc_html__( 'Coupon', 'essential-addons-for-elementor-lite' ),
			]
		);
		$this->add_control(
			'ea_woo_checkout_coupon_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-percent',
					'library' => 'fa-solid',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Login Settings
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ea_section_woo_login_settings',
			[
				'label' => esc_html__( 'Login', 'essential-addons-for-elementor-lite' ),
			]
		);
		$this->add_control(
			'ea_woo_checkout_login_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'fa-solid',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Section title
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_section_title',
			[
				'label' => esc_html__( 'Section Title', 'essential-addons-for-elementor-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ea_woo_checkout_section_title_typography',
				'selector' => '{{WRAPPER}} h3, {{WRAPPER}} #ship-to-different-address span',
			]
		);
		$this->add_control(
			'ea_woo_checkout_section_title_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} h3, {{WRAPPER}} .woo-checkout-section-title, {{WRAPPER}} #ship-to-different-address span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_section_bottom_gap',
			[
				'label' => esc_html__( 'Bottom Gap', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} h3, {{WRAPPER}} .woo-checkout-section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Order Review Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_order_review_style',
			[
				'label' => esc_html__( 'Order Review', 'essential-addons-for-elementor-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#443e6d',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_order_review_padding',
			[
				'label' => esc_html__( 'Padding', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_order_review_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_head',
			[
				'label' => __( 'Table Head', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_header_color',
			[
				'label' => esc_html__( 'Header Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .table-header, {{WRAPPER}} .ea-woo-checkout-order-review .back-to-shopping' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_body',
			[
				'label' => __( 'Table Body', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_row_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .table-row' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_row_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .table-row' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ea_woo_checkout_order_review_row_typography',
				'selector' => '{{WRAPPER}} .ea-woo-checkout-order-review .table-row',
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_order_review_row_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .table-row, {{WRAPPER}} .ea-woo-checkout-order-review .product-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ea_woo_checkout_order_review_footer',
			[
				'label' => __( 'Table Footer', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_footer_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .footer-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_footer_color',
			[
				'label' => esc_html__( 'Content Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .footer-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ea_woo_checkout_order_review_footer_typography',
				'selector' => '{{WRAPPER}} .ea-woo-checkout-order-review .footer-content',
			]
		);
		$this->add_control(
			'ea_woo_checkout_order_review_footer_border_color',
			[
				'label' => esc_html__( 'Border Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .footer-content > div' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_order_review_footer_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .footer-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ea_woo_checkout_order_review_shop_link',
			[
				'label' => __( 'Shop Link', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'ea_woo_checkout_shop_link' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'ea_woo_checkout_shop_link_color_tabs',
			[
				'condition' => [
					'ea_woo_checkout_shop_link' => 'yes',
				],
			]
		);

		$this->start_controls_tab( 'ea_woo_checkout_shop_link_color_tab_normal', [ 'label' => esc_html__( 'Normal', 'essential-addons-for-elementor-lite' ) ] );

		$this->add_control(
			'ea_woo_checkout_shop_link_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .back-to-shopping' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'eea_woo_checkout_shop_link_color_tab_hover', [ 'label' => esc_html__( 'Hover', 'essential-addons-for-elementor-lite' ) ] );

		$this->add_control(
			'ea_woo_checkout_shop_link_color_hover',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7866ff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout-order-review .back-to-shopping:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Login
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_login_style',
			[
				'label' => esc_html__( 'Login', 'essential-addons-for-elementor-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ea_woo_checkout_login_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ea-woo-checkout .woo-login-coupon',
			]
		);
		$this->add_control(
			'ea_woo_checkout_login_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-login' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_login_icon_color',
			[
				'label' => __( 'Icon Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .ea-login-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ea-woo-checkout .ea-login-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_login_links_color',
			[
				'label' => __( 'Links Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7866ff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .woocommerce-form-coupon-toggle .woocommerce-info a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_login_links_color_hover',
			[
				'label' => __( 'Links Hover Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .woocommerce-form-coupon-toggle .woocommerce-info a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_login_padding',
			[
				'label' => esc_html__( 'Padding', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ea-woo-checkout .ea-login-icon' => 'top: {{TOP}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_login_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-login' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Coupon
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_coupon_style',
			[
				'label' => esc_html__( 'Coupon', 'essential-addons-for-elementor-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ea_woo_checkout_coupon_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ea-woo-checkout .woo-checkout-coupon',
			]
		);
		$this->add_control(
			'ea_woo_checkout_coupon_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .woo-checkout-coupon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_coupon_icon_color',
			[
				'label' => __( 'Icon Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#404040',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .ea-coupon-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ea-woo-checkout .ea-coupon-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_coupon_links_color',
			[
				'label' => __( 'Links Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7866ff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .woocommerce-form-coupon-toggle .woocommerce-info a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_coupon_links_color_hover',
			[
				'label' => __( 'Links Hover Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .woocommerce-form-coupon-toggle .woocommerce-info a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ea_woo_checkout_coupon_border',
				'label' => __( 'Border', 'essential-addons-for-elementor-lite' ),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .ea-woo-checkout .woo-checkout-coupon',
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_coupon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-coupon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ea_woo_checkout_coupon_box_shadow',
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .ea-woo-checkout .woo-checkout-coupon',
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_coupon_padding',
			[
				'label' => esc_html__( 'Padding', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-coupon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ea-woo-checkout .ea-coupon-icon' => 'top: {{TOP}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Customer Details
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_customer_details',
			[
				'label' => esc_html__( 'Billing Details', 'essential-addons-for-elementor-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'ea_woo_checkout_customer_details_label',
			[
				'label' => __( 'Label', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ea_woo_checkout_customer_details_label_typography',
				'selector' => '{{WRAPPER}} #customer_details label',
			]
		);
		$this->add_control(
			'ea_woo_checkout_customer_details_label_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#443e6d',
				'selectors' => [
					'{{WRAPPER}} #customer_details label' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_customer_details_label_spacing',
			[
				'label' => esc_html__( 'Spacing', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '5',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #customer_details label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'ea_woo_checkout_customer_details_fields',
			[
				'label' => __( 'Fields', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ea_woo_checkout_customer_details_field_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#443e6d',
				'selectors' => [
					'{{WRAPPER}} #customer_details input, {{WRAPPER}} #customer_details select, {{WRAPPER}} #customer_details textarea' => 'color: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs( 'ea_woo_checkout_customer_details_field_tabs' );

		$this->start_controls_tab( 'ea_woo_checkout_customer_details_field_tab_normal', [ 'label' => esc_html__( 'Normal', 'essential-addons-for-elementor-lite' ) ] );

		$this->add_control(
			'ea_woo_checkout_customer_details_field_border_color',
			[
				'label' => esc_html__( 'Border Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#cccccc',
				'selectors' => [
					'{{WRAPPER}} #customer_details input, {{WRAPPER}} #customer_details .select, {{WRAPPER}} #customer_details .select2-container--default .select2-selection--single, , {{WRAPPER}} #customer_details textarea' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'ea_woo_checkout_customer_details_field_tab_normal_hover', [ 'label' => esc_html__( 'Hover', 'essential-addons-for-elementor-lite' ) ] );

		$this->add_control(
			'ea_woo_checkout_customer_details_field_border_color_hover',
			[
				'label' => esc_html__( 'Border Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7866ff',
				'selectors' => [
					'{{WRAPPER}} #customer_details input:hover, {{WRAPPER}} #customer_details input:focus, {{WRAPPER}} #customer_details input:active' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} #customer_details textarea:hover, {{WRAPPER}} #customer_details textarea:focus, {{WRAPPER}} #customer_details textarea:active' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'ea_woo_checkout_customer_details_field_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #customer_details input, {{WRAPPER}} #customer_details select, {{WRAPPER}} #customer_details .select2-container--default .select2-selection--single, {{WRAPPER}} #customer_details textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_customer_details_field_spacing',
			[
				'label' => __( 'Bottom Spacing (PX)', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #customer_details .form-row' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Payment
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'ea_section_woo_checkout_payment_style',
			[
				'label' => esc_html__( 'Payment', 'essential-addons-for-elementor-lite' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'ea_woo_checkout_payment_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#443e6d',
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-payment, {{WRAPPER}} #payment' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_payment_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-payment .woo-checkout-section-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_payment_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-payment' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_payment_padding',
			[
				'label' => esc_html__( 'Padding', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-payment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_payment_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-payment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Button
		$this->add_control(
			'ea_woo_checkout_payment_label',
			[
				'label' => __( 'Label', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ea_woo_checkout_payment_label_typography',
				'selector' => '{{WRAPPER}} #place_order',
			]
		);

		$this->start_controls_tabs( 'ea_woo_checkout_payment_label_tabs' );
		$this->start_controls_tab(
			'ea_woo_checkout_payment_label_tab_normal',
			[
				'label' => __( 'Normal', 'essential-addons-for-elementor-lite' ),
			]
		);

		$this->add_control(
			'ea_woo_checkout_payment_label_color',
			[
				'label' => __( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .wc_payment_method label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ea_woo_checkout_payment_label_tab_hover',
			[
				'label' => __( 'Selected', 'essential-addons-for-elementor-lite' ),
			]
		);

		$this->add_control(
			'ea_woo_checkout_payment_label_color_select',
			[
				'label' => __( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ea-woo-checkout .wc_payment_method input[type=radio]:checked + label' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		// Info
		$this->add_control(
			'ea_woo_checkout_payment_info',
			[
				'label' => __( 'Methods Info', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ea_woo_checkout_payment_methods_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#2d284b',
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-payment .payment_box' => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .woo-checkout-payment .payment_box::before' => 'border-bottom-color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'ea_woo_checkout_payment_methods_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-payment .payment_box' => 'color: {{VALUE}}!important;',
				],
			]
		);

		// Privacy Policy
		$this->add_control(
			'ea_woo_checkout_privacy_policy',
			[
				'label' => __( 'Privacy Policy', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'ea_woo_checkout_privacy_policy_color',
			[
				'label' => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#b8b6ca',
				'selectors' => [
					'{{WRAPPER}} .woo-checkout-payment .woocommerce-privacy-policy-text' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ea_woo_checkout_privacy_policy_typo',
				'selector' => '{{WRAPPER}} .woo-checkout-payment .woocommerce-privacy-policy-text',
			]
		);

		// Button
		$this->add_control(
			'ea_woo_checkout_payment_button',
			[
				'label' => __( 'Button', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ea_woo_checkout_payment_button_typography',
				'selector' => '{{WRAPPER}} #place_order',
			]
		);

		$this->start_controls_tabs( 'ea_woo_checkout_payment_button_tabs' );
		$this->start_controls_tab(
			'ea_woo_checkout_payment_button_tab_normal',
			[
				'label' => __( 'Normal', 'essential-addons-for-elementor-lite' ),
			]
		);

		$this->add_control(
			'ea_woo_checkout_payment_button_bg_color',
			[
				'label' => __( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7866ff',
				'selectors' => [
					'{{WRAPPER}} #place_order' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ea_woo_checkout_payment_button_color',
			[
				'label' => __( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #place_order' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'ea_woo_checkout_payment_button_border',
				'selector' => '{{WRAPPER}} #place_order',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ea_woo_checkout_payment_button_tab_hover',
			[
				'label' => __( 'Hover', 'essential-addons-for-elementor-lite' ),
			]
		);

		$this->add_control(
			'ea_woo_checkout_payment_button_bg_color_hover',
			[
				'label' => __( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7866ff',
				'selectors' => [
					'{{WRAPPER}} #place_order' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ea_woo_checkout_payment_button_color_hover',
			[
				'label' => __( 'Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} #place_order' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ea_woo_checkout_payment_button_border_color_hover',
			[
				'label' => __( 'Border Color', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #place_order:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'ea_woo_checkout_payment_button_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'ea_woo_checkout_payment_button_border_radius',
			[
				'label' => __( 'Border Radius', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} #place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ea_woo_checkout_payment_button_align',
			[
				'label' => __( 'Alignment', 'essential-addons-for-elementor-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'essential-addons-for-elementor-lite' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'essential-addons-for-elementor-lite' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} #place_order' => 'float: {{VALUE}}!important;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		if ( is_null( WC()->cart ) ) {
			include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
			include_once WC_ABSPATH . 'includes/class-wc-cart.php';
			wc_load_cart();
		}

		$settings = $this->get_settings();

		$this->add_render_attribute( 'container', 'class', [
			'ea-woo-checkout'
		] );

		?>
        <div <?php echo $this->get_render_attribute_string( 'container' ); ?>>
            <div class="woocommerce">
                <style>
                    .woocommerce .blockUI.blockOverlay:before {
                        background-image: url('<?php echo WC_ABSPATH . 'assets/images/icons/loader.svg' ?>') center center !important;
                    }
                </style>
				<?php
				global $wp;
				$checkout = WC()->checkout();
				if ( $settings['ea_woo_checkout_layout'] == 'default' ) {
					// Handle checkout actions.
					if ( ! empty( $wp->query_vars['order-pay'] ) ) {

						self::order_pay( $wp->query_vars['order-pay'] );

					} elseif ( isset( $wp->query_vars['order-received'] ) ) {

						self::order_received( $wp->query_vars['order-received'] );

					} else {

						echo self::render_default_template_( $checkout, $settings );

					}
				}
				?>
            </div>
        </div>
		<?php
	}
}