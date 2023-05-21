<?php


function _themename_theme_support() {

    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array('search-form', 'comment-list', 'comment-form', 'gallery', 'caption') );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'custom-logo', array(
        'height' => 30,
        'width' => 30,
        'flex-height' => true,
        'flex-width' => true
    ) );
    add_theme_support('post-formats', array(
        'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
    ));
    add_theme_support( 'align-wide' );
    add_image_size('_themename-blog-image', 1200, 0);

}

add_action( 'after_setup_theme', '_themename_theme_support' );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );


