<?php
/**
 * Plugin Name: Elementor WooCommerce Category Addon
 * Description: WooCommerce Categories listing with images for Elementor.
 * Version:     1.0.0
 * Author:      
 * Author URI:  
 * Text Domain: elementor-addon
 *
 * Requires Plugins: elementor, woocommerce
 * Elementor tested up to: 3.25.11
 * Elementor Pro tested up to: 3.25.4
 * WooCommerce tested up to: 9.4.3
 */

function register_woocommerce_categories_widget( $widgets_manager ) {
	require_once( __DIR__ . '/woocommerce-categories.php' );
	$widgets_manager->register( new \WooCommerce_Categories() );
}
add_action( 'elementor/widgets/register', 'register_woocommerce_categories_widget' );