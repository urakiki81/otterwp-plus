<?php
/**
 * Otterwp woocomerces filters
 *
 *
 * @package     Otterwp-woo-plugin
 * @link        https://www.otterwp.io/
 * @since       1.1.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class otterwpFilter {

    private $stuff;

    public function __construct() {

        $this->stuff = $this->otterwp_filters();

    }


    public function otterwp_filters() {
        add_filter( 'post_class', 'otterwp_filter_product_post_class', 10, 3 );
        add_filter( 'body_class', 'otterwp_theme_body_classes' );
        add_action( 'woocommerce_before_shop_loop_item', 'otterwp_add_data_for_ajax', 10 );
        add_action('woocommerce_shop_loop_item_title', 'otterwp_product_heading_title_on_category_archives', 1 );
        add_filter( 'woocommerce_blocks_product_grid_item_html', 'otterwp_product_block', 10, 3);
        add_action('admin_head', 'otterwp_custom_fonts');
        add_action( 'after_setup_theme', 'otterwp_support' );
        add_action( 'wp_enqueue_scripts', 'otterwp_styles' );
        add_action( 'woocommerce_after_quantity_input_field', 'add_quantity_plus_button' );
        add_action( 'woocommerce_before_quantity_input_field', 'add_quantity_mines_button' );
 
    function otterwp_filter_product_post_class( $classes, $class, $product_id ){

            $classes[] = 'otw-woo-ative';
        
            return $classes;
        }
        if ( ! function_exists( 'otterwp_support' ) ) :

          /**
           * Sets up theme defaults and registers support for various Woocommerce features.
           *
           * @since Otterwp 1.0
           *
           * @return void
           */
          function otterwp_support() {
            //add_theme_support( 'woocommerce' );
        
            add_theme_support( 'wc-product-gallery-zoom' );
            add_theme_support( 'wc-product-gallery-lightbox' );
            add_theme_support( 'wc-product-gallery-slider' );
            // Add support for block styles.
            add_theme_support( 'wp-block-styles' );
        
            // Enqueue editor styles.
            add_editor_style( 'style.css' );
        
          }
        
        endif;
        

      
if ( ! function_exists( 'otterwp_styles' ) ) :
	/**
	 * Enqueue styles.
	 *
	 * @since Otterwp 1.0
	 *
	 * @return void
	 */
	function otterwp_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'otterwp-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Add styles inline.
		//wp_add_inline_style( 'otterwp-style', otterwp_get_font_face_styles() );

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'otterwp-style' );

	}

endif;
  
  if ( ! function_exists( 'otterwp_custom_fonts' ) ) :     
    function otterwp_custom_fonts() {
      $css = get_option('woo_amc_options');
      $custom_css = get_option( 'otterwp_custom_css' );
      
      $css = "$custom_css";


      $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
      // backup values within single or double quotes
      preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
      for ($i=0; $i < count($hit[1]); $i++) {
          $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
      }
      // remove traling semicolon of selector's last property
      $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
      // remove any whitespace between semicolon and property-name
      $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
      // remove any whitespace surrounding property-colon
      $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
      // remove any whitespace surrounding selector-comma
      $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
      // remove any whitespace surrounding opening parenthesis
      $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
      // remove any whitespace between numbers and units
      $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
      // shorten zero-values
      $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
      // constrain multiple whitespaces
      $css = preg_replace('/\p{Zs}+/ims',' ', $css);
      // remove newlines
      $css = str_replace(array("\r\n", "\r", "\n"), '', $css);
      // Restore backupped values within single or double quotes
      for ($i=0; $i < count($hit[1]); $i++) {
          $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
      }


     
	  echo '<style>'.$css .' </style>';
	}
endif;


if ( ! function_exists( 'otterwp_editor_styles' ) ) :

	/**
	 * Enqueue editor styles.
	 *
	 * @since Otterwp 1.0
	 *
	 * @return void
	 */
	function otterwp_editor_styles() {

		// Add styles inline.
		wp_add_inline_style( 'wp-block-library', otterwp_get_font_face_styles() );

	}

endif;
/** 
* Adds custom classes to the array of body classes Dark Mode. 
*
* @param array $classes Classes for the body element. 
* @return array 
*/ 
function otterwp_theme_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
	$dynamic_mode  = get_option('otterwp_dynamic_shopping_mode');
	$review_mode  = get_option('otterwp_review_mode');
    $search_mode  = get_option('otterwp_search_hint_mode');
	if (strlen( $dynamic_mode) === 0) {
		$classes[] = 'otterwp-disable-shopping';
	}else{
        $classes[] = 'otterwp-enabled-shopping';
    }
    // Adds a class of hfeed to non-singular pages.
    if (strlen( $review_mode) === 0) {
        $classes[] = 'otterwp-disable-reivew';
    }
    if (strlen( $search_mode) === 0) {
        $classes[] = 'otterwp-disable-search';
    }

    return $classes;
 } 
 function otterwp_product_block( $html, $data, $product ) {
    $html = '<li class="wc-block-grid__product otterwp-product-id" data-product_id="'. $product->get_id() . '">
    <a href="' . $data->permalink . '">
    <div class="image-wrap">
        <a href="' . $data->permalink . '" class="wc-block-grid__product-link">' . $data->image . '</a>
    </div>
    <h3><a href="' . $data->permalink . '">' . $data->title . '</a></h3>
    ' . $data->badge . '
    ' . $data->price . '
    ' . $data->rating . '
    ' . $data->button . '
</a>
    </li>';
    return $html;
}

     function otterwp_add_data_for_ajax() {
     echo '<div data-id='. get_the_ID() .' class="otter-woo-data" >';
     }
  
     function otterwp_product_heading_title_on_category_archives() {
         if( is_shop() ) { 
             remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
             add_action('woocommerce_shop_loop_item_title', 'otterwp_change_product_heading_title', 10 );
         }
         if( is_product_category() ) {
             remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
             add_action('woocommerce_shop_loop_item_title', 'otterwp_change_product_heading_title', 10 );
         }
     }
     function otterwp_change_product_heading_title() {
         echo '<h2 data-id='. get_the_ID() .'"class="otter-woo-data ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>';
     }
     function add_quantity_plus_button() {
        echo '<button type="button" class="plus">+</button>';
    }
    
    function add_quantity_mines_button() {
        echo '<button type="button" class="minus">-</button>';
    }
}

// Add plus and minus buttons to WooCommerce quantity input field




}