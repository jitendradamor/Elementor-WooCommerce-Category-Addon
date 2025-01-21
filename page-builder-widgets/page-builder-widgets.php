<?php
/**
 * Plugin Name:       Page Builder Widgets
 * Description:       Page Builder Widgets for Elementor.
 * Version:           1.0.0
 * Requires at least: 6.3
 * Requires PHP:      7.4
 * Author:            Agreem Technologies
 * Author URI:        https://agreemtech.com/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       page-builder-widgets
 * Requires Plugins:  elementor, woocommerce
 * Elementor tested up to: 3.27.0
 * Elementor Pro tested up to: 3.25.4
 * WooCommerce tested up to: 9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'PBW_VERSION', '1.0.0' );
define( 'PBW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

class PBW_Module {

    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
    }

    public function init() {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'pbw_elementor_not_found_notice' ] );
            return;
        }

        // Register the widget
        add_action( 'elementor/widgets/register', [ $this, 'pbw_register_product_category_elementor_addon' ] );

        // Enqueue widget styles
        add_action( 'wp_enqueue_scripts', [ $this, 'pbw_enqueue_widget_styles' ] );
    }

    public function pbw_register_product_category_elementor_addon( $widgets_manager ) {
        require_once( __DIR__ . '/widget/pbw-product-categories.php' );
        $widgets_manager->register( new \PBW_Product_Categories() );
    }

    public function pbw_enqueue_widget_styles() {        
        wp_enqueue_style( 'PBW-product-categories-style', PBW_PLUGIN_URL . 'assets/css/pbw-product-categories.css', [], PBW_VERSION );
    }

    public function pbw_elementor_not_found_notice() {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php esc_html_e( 'Elementor is not installed or activated. Please install and activate Elementor to use the WC Product Category Addon.', 'page-builder-widgets' ); ?></p>
        </div>
        <?php
    }
}

// Initialize the addon
new PBW_Module();