<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Otterwp_Woo_Public {

    /**
     * The ID of this theme.
     */
    private $theme_name;

    /**
     * The version of this theme.
     */
    private $version;
	/**
	 * The theme assets URL.
	 *
	 * @var string
	 */
	public $assets_url;
    /**
     * Initialize the class and set its properties.
     */
    public function __construct( $theme_name, $version ) {

        $this->theme_name = $theme_name;
        $this->version = $version;

    }
        /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function enqueue_styles() {
        
       wp_enqueue_style( $this->theme_name, get_template_directory_uri() . '/dist/assets/css/bundle.css', array(), $this->version, 'all');
        $inline_css = $this->get_inline_css();
        wp_add_inline_style( $this->theme_name, $inline_css );
        $options = get_option('woo_amc_options');

 

    
        // use $_POST[] value first to get immediate change effect

    }
    public function enqueue_scripts() {

        $wc_api_params = array(
            'nonce' => wp_create_nonce('wp_rest'), // nonce for authentication
          );
        wp_enqueue_script('jquery');
        wp_enqueue_script( $this->theme_name, get_template_directory_uri() . '/dist/assets/js/bundle.js', array('jquery', 'flexslider', 'wc-single-product', 'zoom', 'photoswipe-ui-default',  'wc-add-to-cart-variation'), '1.0.0', true );
        wp_localize_script( $this->theme_name, 'otterwp_ajax_comment_params', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'woo-otterwp-security' ),
             ) 
        );
        wp_localize_script( $this->theme_name, 'wooOtterwpVars', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'woo-otterwp-cart-security' ),
            )
        );
        wp_localize_script( $this->theme_name, 'woo_my_ajax_object', array( 
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'woo-otterwp-security' ),
             ) 
        );
        wp_localize_script( $this->theme_name, 'wc_api_params', $wc_api_params );
        wp_localize_script($this->theme_name,
        "site",
        array(
                "theme_path"    => plugin_dir_url( '' ) . 'woocommerce/assets/js/frontend/add-to-cart-variation.min.js'
            )
    );


    }
    public function free_enqueue_scripts() {


        wp_enqueue_script('jquery');
        wp_enqueue_script( 'free-js', get_template_directory_uri() . '/inc/js/woo-button.js', array('jquery'), '1.0.0', true );



    }
/*

    ========================
        AJAX FUNCTIONS
    ========================
*/


public function otterwp_woo_load_more()
{
    
    $pid = intval($_POST['postid']);
    if(!is_numeric($pid)){ // validate postid
        echo "Invalid postid";
        wp_die();
    }
    $args = array(
        'post_type' => 'product',
        'p'         => $pid, // ID of a page, post, or custom type
        'post_id' => $pid,
      );
    // $id = $product->get_id();
    $comments = get_comments( $args );
    $the_query  = new WP_Query($args);
    $data =  '';

    if ( $the_query-> have_posts() ) : ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); {
            ob_start();
            require_once get_template_directory() . '/template-parts/ajax-single.php';
            $output = ob_get_contents();
            ob_end_clean();
            $data = $output;
            $cart['nonce'] = wp_create_nonce( 'woo-otterwp-security' );
    
    
        
}endwhile;

 endif;  wp_reset_postdata();
    echo $data;

    wp_die();
}

/**
 * Get Cart HTML
 */

public function get_cart_templates(){
    $cart_count = WC()->cart->cart_contents_count;
    $items = WC()->cart->get_cart();
    $cart_total = WC()->cart->get_cart_total();
	require_once get_template_directory() . '/template-parts/loader.php';


    }


    private function get_inline_css(){
        $css = get_option('woo_amc_options');
        $custom_css = get_option( 'otterwp_custom_css' );
        // or set defaults
    

        //print_r($css);
        
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


        return $css;
    }

     /**
     * Add To Cart
     */
    public function add_to_cart(){
    WC_AJAX::get_refreshed_fragments();
    wp_die();
}
        /**
     * Remove Added to Cart Notice
     */
    public function remove_added_to_cart_notice(){
        return false;
    }
}