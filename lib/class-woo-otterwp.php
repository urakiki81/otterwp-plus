<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Otterwp_Woo_theme {

/**
 * The loader that's responsible for maintaining and registering all hooks that power
 * the theme.
 */
protected $loader;

/**
 * The unique identifier of this theme.
 */
protected $theme_name;

/**
 * The current version of the theme.
 */
protected $version;

/**
 * Define the core functionality of the theme.
 */
public function __construct() {
    if ( defined( 'OTTERWP_THEME_VERSION' ) ) {
        $this->version = OTTERWP_THEME_VERSION;
    } else {
        $this->version = '1.0.0';
    }
    $this->theme_name = 'woo-otterwp';

            $this->load_dependencies();
            $this->set_locale();
            $this->define_public_hooks(); 
            $this->define_admin_hooks();
            $this->define_block_hooks();

}

/**
 * Load the required dependencies for this theme.
 */
private function load_dependencies() {


    /**
     * The class responsible for orchestrating the actions and filters of the
     * core theme.
     */
    require_once OTTERWP_THEME_DIR . 'lib/class-woo-otterwp-loader.php';
    /**
	* The class responsible for defining internationalization functionality
	* of the theme.
	*/
    require_once OTTERWP_THEME_DIR  . 'lib/class-otterwp-i18n.php';
	/**
	* The class responsible for orchestrating the actions and filters of the
	* core theme.
	*/
    require_once OTTERWP_THEME_DIR  . 'lib/class-otterwp-filter.php';
    /**
	* The class responsible for defining all actions that occur in the admin area.
	*/
	require_once OTTERWP_THEME_DIR . 'admin/class-woo-amc-admin.php';
    /**
     * The class responsible for defining all actions that occur in the public-facing
     * side of the theme.
     */
    require_once OTTERWP_THEME_DIR . 'public/class-woo-otterwp-public.php';
	/**
	*responsible gutenburg styles.
	*/
    require_once OTTERWP_THEME_DIR . 'lib/block-styles.php';

    //require_once OTTERWP_THEME_DIR . 'admin/class-create-block-theme-admin.php';
    require_once OTTERWP_THEME_DIR . 'admin/class-manage-fonts.php';
   


    $this->loader = new OtterwpWooLoader();
    //$this->loader = new Create_Block_Theme_Loader();
    $this->filter = new otterwpFilter();
  
        }

/**
 * Define the locale for this theme for internationalization.
 */
private function set_locale() {

    $theme_i18n = new Otterwpi18n();

   $this->loader->add_action( 'themes_loaded', $theme_i18n, 'load_theme_textdomain' );

}
/**
 * Register all of the hooks related to the customizer area functionality
 * of the theme.
 */
private function define_block_hooks() {
    //$plugin_admin = new Create_Block_Theme_Admin();
     new Otterwp_Fonts_Admin();

    $theme_admin = new Otterwp_block_styles( $this->get_theme_name(), $this->get_version() );

    $this->loader->add_action( 'init', $theme_admin, 'otterwp_load_block_styles' );

}
/**
 * Register all of the hooks related to the customizer area functionality
 * of the theme.
 */
private function define_admin_hooks() {

    $theme_admin = new Otterwp_Admin( $this->get_theme_name(), $this->get_version() );
    $this->loader->add_action( 'admin_enqueue_scripts', $theme_admin, 'otterwp_enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $theme_admin, 'otterwp_enqueue_scripts' );
    $this->loader->add_action( 'admin_menu', $theme_admin, 'otterwp_add_page' );
    $this->loader->add_action( 'admin_init', $theme_admin, 'otterwp_page_init' ); 

}

/**
 * Register all of the hooks related to the public-facing functionality
 * of the theme.
 */
private function define_public_hooks() {
  

        add_action( 'wc_ajax_ace_add_to_cart', 'ace_ajax_add_to_cart_handler' );
        add_action( 'wc_ajax_nopriv_ace_add_to_cart', 'ace_ajax_add_to_cart_handler' );
        add_action('wp_ajax_search_products', 'otterwp_search_products');
        add_action('wp_ajax_nopriv_search_products', 'otterwp_search_products');

    $theme_public = new Otterwp_Woo_Public( $this->get_theme_name(), $this->get_version() );
    
    $this->loader->add_action( 'wp_head', $theme_public, 'enqueue_styles', 1);
    $this->loader->add_action( 'wp_enqueue_scripts', $theme_public, 'enqueue_scripts' );
    $this->loader->add_action( 'wp_enqueue_scripts', $theme_public, 'free_enqueue_scripts' );
    $this->loader->add_action( 'wp_footer', $theme_public, 'get_cart_templates' );
    $this->loader->add_action( 'wp_ajax_nopriv_otterwp_woo_load_more', $theme_public, 'otterwp_woo_load_more' );
    $this->loader->add_action( 'wp_ajax_otterwp_woo_load_more', $theme_public, 'otterwp_woo_load_more' );



}

/**
 * Run the loader to execute all of the hooks with WordPress.
 */
public function run() {
    $this->loader->run();
}

/**
 * The name of the theme used to uniquely identify it within the context of
 * WordPress and to define internationalization functionality.
 */
public function get_theme_name() {
    return $this->theme_name;
}

/**
 * The reference to the class that orchestrates the hooks with the theme.
 */
public function get_loader() {
    return $this->loader;
}

/**
 * Retrieve the version number of the theme.
 */
public function get_version() {
    return $this->version;
}



}
