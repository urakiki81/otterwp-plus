<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Otterwp_block_styles {
/**
 * Register all of the block styles functionality
 * of the theme.
 */
    public function otterwp_load_block_styles() {
		
		wp_register_style('otterwp-block-styles', get_template_directory_uri() . '/dist/assets/css/editor.css', false);
		register_block_style('core/heading', [
			'name' => 'one-text',
			'label' => __('Font One', 'otterwp'),
			'style_handle' => 'otterwp-block-styles'
		]);
		register_block_style('core/cover', [
			'name' => 'blob',
			'label' => __('Blob', 'otterwp'),
		]);
		register_block_style('core/heading', [
			'name' => 'two-text',
			'label' => __('Font Two', 'otterwp'),
		]);
		register_block_style('core/heading', [
			'name' => 'third-text',
			'label' => __('Font Three', 'otterwp'),
		]);
		register_block_style('core/heading', [
			'name' => 'four-text',
			'label' => __('Font Four', 'otterwp'),
		]);
		register_block_style('core/heading', [
			'name' => 'five-text',
			'label' => __('Font Five', 'otterwp'),
		]);

		register_block_style('core/paragraph', [
			'name' => 'one-text',
			'label' => __('Font One', 'otterwp'),
		]);
		register_block_style('core/paragraph', [
			'name' => 'two-text',
			'label' => __('Font Two', 'otterwp'),
		]);
		register_block_style('core/paragraph', [
			'name' => 'third-text',
			'label' => __('Font Three', 'otterwp'),
		]);
		register_block_style('core/paragraph', [
			'name' => 'four-text',
			'label' => __('Font Four', 'otterwp'),
		]);
		register_block_style('core/paragraph', [
			'name' => 'five-text',
			'label' => __('Font Five', 'otterwp'),
		]);
/**
 * Register all of the button block styles functionality
 * of the theme. offset-left-top
 */
/* button styles */

		register_block_style('core/button', [
			'name' => 'appear-hover-border',
			'label' => __('Colored bottom border', 'otterwp'),
		]);
        register_block_style('core/button', [
			'name' => 'underline',
			'label' => __('Underline', 'otterwp'),
		]);
        register_block_style('core/button', [
			'name' => 'underline-hover',
			'label' => __('Underline On Hover', 'otterwp'),
		]);
        register_block_style('core/button', [
			'name' => 'overline-hover',
			'label' => __('Overline On Hover', 'otterwp'),
		]);
        register_block_style('core/button', [
			'name' => 'arrow',
			'label' => __('Arrow Button', 'otterwp'),
		]);
		register_block_style('core/button', [
			'name' => 'button-shadow-outline',
			'label' => __('Shadow Button', 'otterwp'),
		]);
		register_block_style('core/navigation-link', [
			'name' => 'overline-hover',
			'label' => __('Overline On Hover', 'otterwp'),
		]);
		register_block_style('core/navigation-link', [
			'name' => 'appear-hover-border',
			'label' => __('Colored bottom border', 'otterwp'),
		]);
        register_block_style('core/navigation-link', [
			'name' => 'underline-hover',
			'label' => __('Underline On Hover', 'otterwp'),
		]);

	
		// woocommere styles
		$all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
		if (stripos(implode($all_plugins), 'woocommerce.php')) {
		
		/* Woocommerce New Products */
		register_block_style('woocommerce/product-new', [
			'name' => 'center-button-border',
			'label' => __('Center buttom', 'otterwp'),
		]);
		register_block_style('woocommerce/product-new', [
			'name' => 'all-woo-image',
			'label' => __('all Image', 'otterwp'),
		]);
		register_block_style('woocommerce/product-new', [
			'name' => 'all-snap',
			'label' => __('Snap too', 'otterwp'),
		]);
		/* Woocommerce Products By Attribute */
		register_block_style('woocommerce/products-by-attribute', [
			'name' => 'center-button-border',
			'label' => __('Center buttom', 'otterwp'),
		]);
		register_block_style('woocommerce/products-by-attribute', [
			'name' => 'all-woo-image',
			'label' => __('all Image', 'otterwp'),
		]);
		/* Woocommerce Products On Sale */
		register_block_style('woocommerce/product-on-sale', [
			'name' => 'center-button-border',
			'label' => __('Center buttom', 'otterwp'),
		]);
		register_block_style('woocommerce/product-on-sale', [
			'name' => 'all-woo-image',
			'label' => __('all Image', 'otterwp'),
		]);
		/* Woocommerce Top Rated Products styles */
		register_block_style('woocommerce/product-top-rated', [
			'name' => 'center-button-border',
			'label' => __('Center buttom', 'otterwp'),
		]);
		register_block_style('woocommerce/product-top-rated', [
			'name' => 'all-woo-image',
			'label' => __('all Image', 'otterwp'),
		]);
		/* Woocommerce All Products styles */
		register_block_style('woocommerce/all-products', [
			'name' => 'center-button-border',
			'label' => __('Center buttom', 'otterwp'),
		]);
		register_block_style('woocommerce/all-products', [
			'name' => 'all-woo-image',
			'label' => __('all Image', 'otterwp'),
		]);
		/* Woocommerce By Category styles */
		register_block_style('woocommerce/product-category', [
			'name' => 'center-button-border',
			'label' => __('Center buttom', 'otterwp-plus'),
		]);
		register_block_style('woocommerce/product-category', [
			'name' => 'all-woo-image',
			'label' => __('all Image', 'otterwp-plus'),
		]);
	}

		//Font styles for nav
		register_block_style('core/navigation', [
			'name' => 'one-text',
			'label' => __('Font One', 'otterwp'),
		]);
		register_block_style('core/navigation', [
			'name' => 'two-text',
			'label' => __('Font Two', 'otterwp'),
		]);
		register_block_style('core/navigation', [
			'name' => 'third-text',
			'label' => __('Font Three', 'otterwp'),
		]);
		register_block_style('core/navigation', [
			'name' => 'four-text',
			'label' => __('Font Four', 'otterwp'),
		]);
		register_block_style('core/navigation', [
			'name' => 'five-text',
			'label' => __('Font Five', 'otterwp'),
		]);
		//Font styles for nav
		register_block_style('core/site-title', [
			'name' => 'one-text',
			'label' => __('Font One', 'otterwp'),
		]);
		register_block_style('core/site-title', [
			'name' => 'two-text',
			'label' => __('Font Two', 'otterwp'),
		]);
		register_block_style('core/site-title', [
			'name' => 'third-text',
			'label' => __('Font Three', 'otterwp'),
		]);
		register_block_style('core/site-title', [
			'name' => 'four-text',
			'label' => __('Font Four', 'otterwp'),
		]);
		register_block_style('core/site-title', [
			'name' => 'five-text',
			'label' => __('Font Five', 'otterwp'),
		]);
		//Styles for group block
		register_block_style('core/group', [
			'name' => 'otterwp-shadow',
			'label' => __('Shadow', 'otterwp'),
		]);
		//Styles for group block
		register_block_style('core/cover', [
			'name' => 'image-zoom-hover',
			'label' => __('Image zoom on hover', 'otterwp'),
		]);
		register_block_style('core/cover', [
			'name' => 'blob',
			'label' => __('Blob', 'otterwp'),
		]);
		register_block_style('core/image', [
			'name' => 'blob',
			'label' => __('Blob', 'otterwp'),
		]);
		register_block_style('core/media-text', [
			'name' => 'otterwp-slice-left',
			'label' => __('Image Slice-left', 'otterwp'),
		]);
		register_block_style('core/media-text', [
			'name' => 'otterwp-slice-right',
			'label' => __('Image Slice-right', 'otterwp'),
		]);
	}
}

