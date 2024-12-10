<?php
/**
 * Plugin Name: Elementor WooCommerce Category
 * Description: WooCommerce Categories listing with images for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addon
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.24.0
 * Elementor Pro tested up to: 3.24.0
 */

function register_woocommerce_categories_widget( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/woocommerce-categories.php' );
	$widgets_manager->register( new \WooCommerce_Categories() );
}
add_action( 'elementor/widgets/register', 'register_woocommerce_categories_widget' );