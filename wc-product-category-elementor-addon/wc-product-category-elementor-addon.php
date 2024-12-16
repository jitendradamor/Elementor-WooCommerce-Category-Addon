<?php
/**
 * Plugin Name: WC Product Category Elementor Addon
 * Description: WooCommerce Categories listing Addon with images for Elementor.
 * Version:     1.0.0
 * Author: Akash Patel
 * Author URI:
 * Text Domain: elementor-addon
 *
 * Requires Plugins: elementor, woocommerce
 * Elementor tested up to: 3.25.11
 * Elementor Pro tested up to: 3.25.4
 * WooCommerce tested up to: 9.4.3
 */

function register_WC_product_category_elementor_addon( $widgets_manager ) {
	require_once( __DIR__ . '/widget/wc-product-categories.php' );
	$widgets_manager->register( new \WC_Product_Categories() );
}
add_action( 'elementor/widgets/register', 'register_WC_product_category_elementor_addon' );