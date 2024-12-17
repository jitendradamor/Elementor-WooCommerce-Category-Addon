# WC Product Category Elementor Addon

A custom Elementor widget to display WooCommerce product categories with their images, names, and permalinks. This plugin provides a flexible and customizable way to showcase WooCommerce product categories on your website.

## Features
- Display WooCommerce product categories dynamically.
- Show category images, names, and links to the category pages.
- Fully customizable through Elementor's interface.
- Supports multiple category selection.
- Supports sorting

## Installation

1. **Download the Plugin:**
   Download the plugin files and extract them.

2. **Upload to WordPress:**
   - Go to your WordPress Admin Dashboard.
   - Navigate to `Plugins > Add New`.
   - Click `Upload Plugin` and select the plugin ZIP file.
   - Install and activate the plugin.

3. **Use in Elementor:**
   - Open any page with Elementor.
   - Search for the "WooCommerce Categories" widget in the Elementor panel.
   - Drag and drop it onto your page.

## Usage

1. Drag the **WC Product Categories** widget onto your Elementor page.
2. Configure the following options:
   - **Title:** Add a title to display above the categories.
   - **Description:** Add a short description below the title.
   - **Select Categories:** Choose the WooCommerce categories you want to display.
3. Style the widget using Elementor's styling options.

## Code Example

The widget dynamically displays the selected WooCommerce product categories using their images and links:

```php
if (!empty($settings['selected_categories'])) {
    foreach ($settings['selected_categories'] as $category_id) {
        $category = get_term($category_id, 'product_cat');
        if ($category) {
            $image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $image_url = $image_id ? wp_get_attachment_url($image_id) : wc_placeholder_img_src();
            $category_link = get_term_link($category);
            echo "<a href='{$category_link}'><img src='{$image_url}' alt='{$category->name}' /></a>";
        }
    }
}