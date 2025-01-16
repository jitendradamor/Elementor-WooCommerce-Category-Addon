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
 * Elementor tested up to: 3.25.11
 * Elementor Pro tested up to: 3.25.4
 * WooCommerce tested up to: 9.4.3
 */
class Page_Builder_Widgets {

    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
    }

    public function init() {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'elementor_not_found_notice' ] );
            return;
        }

        // Register the widget
        add_action( 'elementor/widgets/register', [ $this, 'register_WC_product_category_elementor_addon' ] );
    }

    public function register_WC_product_category_elementor_addon( $widgets_manager ) {
        require_once( __DIR__ . '/widget/wc-product-categories.php' );
        $widgets_manager->register( new \WC_Product_Categories() );
    }

    public function elementor_not_found_notice() {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php esc_html_e( 'Elementor is not installed or activated. Please install and activate Elementor to use the WC Product Category Addon.', 'page-builder-widgets' ); ?></p>
        </div>
        <?php
    }
}

// Initialize the addon
new Page_Builder_Widgets();