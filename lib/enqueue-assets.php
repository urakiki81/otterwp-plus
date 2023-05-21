<?php

function _themename_assets() {
    wp_enqueue_style( '_themename-stylesheet', get_template_directory_uri() . '/dist/assets/css/bundle.css', array(), '1.0.0', 'all' );

    include(get_template_directory() . '/lib/inline-css.php');
    wp_add_inline_style( '_themename-stylesheet', $inline_styles );
    
    wp_enqueue_style('_themename-linje-css');
    wp_enqueue_script( '_themename-scripts', get_template_directory_uri() . '/dist/assets/js/bundle.js', array('jquery'), '1.0.0', true );

    if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
// Localize the script with mini nav ative or not
$translation_array = array(
    'mini_nav' => esc_html(get_theme_mod('_themename_display_mininav')),
);
wp_localize_script( '_themename-scripts', 'object_miniNav', $translation_array );


wp_localize_script( '_themename-scripts', 'wooAmcVars', array(
	'ajaxurl' => admin_url( 'admin-ajax.php' ),
	'nonce' => wp_create_nonce( 'otter-security' ),
)
);
wp_localize_script( '_themename-scripts', 'woo_my_ajax_object', array(
	'ajaxurl'    => admin_url( 'admin-ajax.php' ),
)
);
wp_localize_script( '_themename-scripts', 'i18n',
array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', '_themename_assets');

function _themename_block_editor_assets() {
    wp_enqueue_style( '_themename-block-editor-styles', get_template_directory_uri() . '/dist/assets/css/editor.css', array(), '1.0.0', 'all' );
}

add_action( 'enqueue_block_editor_assets', '_themename_block_editor_assets' );


function _themename_admin_assets() {
    wp_enqueue_style( '_themename-admin-stylesheet', get_template_directory_uri() . '/dist/assets/css/admin.css', array(), '1.0.0', 'all' );

    wp_enqueue_script( '_themename-admin-scripts', get_template_directory_uri() . '/dist/assets/js/admin.js', array(), '1.0.0', true );
}

add_action('admin_enqueue_scripts', '_themename_admin_assets');




