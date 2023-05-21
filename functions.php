<?php
/**
 * Otterwp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @since Otterwp 1.1
 */


/**
 * Define Constants
 */
define( 'OTTERWP_THEME_VERSION', '1.0.10' );
define( 'OTTERWP_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'OTTERWP_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );



//require_once  'src/assets/blocks/font-block/icon-block.php';
require_once OTTERWP_THEME_DIR . 'lib/class-woo-otterwp.php';
// Add block patterns
require OTTERWP_THEME_DIR . '/inc/block-patterns.php';


	function run_otterwp_theme_cart() {

		$theme = new Otterwp_Woo_theme();
		$theme->run();
	
	}
	run_otterwp_theme_cart();






       /**
     * comment ajax
     */

	 add_action( 'wp_ajax_ajaxcomments', 'otterwp_submit_ajax_comment' ); 
	 add_action( 'wp_ajax_nopriv_ajaxcomments', 'otterwp_submit_ajax_comment' );
 
	 function otterwp_submit_ajax_comment(){
		$comment_content = sanitize_text_field( wp_unslash( $_POST['comment'] ) );
		$comment_post_ID = intval( filter_var( $_POST['comment_post_ID'], FILTER_SANITIZE_NUMBER_INT ) );
		$comment_parent = intval( filter_var( $_POST['comment_parent'], FILTER_SANITIZE_NUMBER_INT ) );
	
		/* validation  */
		if ( empty( $comment_content ) ) {
			wp_send_json_error( __( 'Please enter a comment.' ) );
		}
	
		if ( ! is_numeric( $comment_post_ID ) || $comment_post_ID <= 0 ) {
			wp_send_json_error( __( 'Invalid post ID.' ) );
		}
	
		if ( ! get_post( $comment_post_ID ) ) {
			wp_send_json_error( __( 'Invalid post ID.' ) );
		}
	
		 /*
		 
		  * Wow, this cool function appeared in WordPress 4.4.0, before that my code was muuuuch mooore longer
		  *
		  * @since 4.4.0
		  */
		 $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
		 if ( is_wp_error( $comment ) ) {
			 $error_data = intval( $comment->get_error_data() );
			 if ( ! empty( $error_data ) ) {
				 wp_die( '<p>' . $comment->get_error_message() . '</p>', __( 'Comment Submission Failure' ), array( 'response' => $error_data, 'back_link' => true ) );
			 } else {
				 wp_die( 'Unknown error' );
			 }
		 }
	  
		 /*
		  * Set Cookies
		  */
		 $user = wp_get_current_user();
		 do_action('set_comment_cookies', $comment, $user);
	  
		 /*
		  * If you do not like this loop, pass the comment depth from JavaScript code
		  */
		 $comment_depth = 1;
		 $comment_parent = $comment->comment_parent;
		 while( $comment_parent ){
			 $comment_depth++;
			 $parent_comment = get_comment( $comment_parent );
			 $comment_parent = $parent_comment->comment_parent;
		 }
	  
		  /*
		   * Set the globals, so our comment functions below will work correctly
		   */
		 $GLOBALS['comment'] = $comment;
		 $GLOBALS['comment_depth'] = $comment_depth;
		 
		 /*
		  * Here is the comment template, you can configure it for your website
		  * or you can try to find a ready function in your theme files
		  */
		 $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
		 $comment_html = '<li ' . comment_class('', null, null, false ) . ' id="comment-' . get_comment_ID() . '">
			  <article class="comment_container target" id="div-comment-' . get_comment_ID() . '">
						' . get_avatar( $comment, 60 ) . '
					 <div class="comment-text">
					 ' . wc_get_rating_html( $rating ) . '
						 <p class="meta"
						 <strong class="woocommerce-review__author">' . get_comment_author_link() . '</strong>
						 <time>' . sprintf('%1$s', get_comment_date()) . '</time>
						 </p>
						 <div class="description">' . apply_filters( 'comment_text', get_comment_text( $comment ), $comment )  . '</div>
					 </div>
					 <div class="comment-metadata">
						 
						 
						 ';
						 
						 if( $edit_link = get_edit_comment_link() )
							 $comment_html .= '<span class="edit-link"><a class="comment-edit-link" href="' . $edit_link . '">Edit</a></span>';
						 
					 $comment_html .= '</div>';
	 
	 
				 $comment_html .= '            
			 </article>';
			 if ( $comment->comment_approved == '0' )
			 $comment_html .= '<p class="comment-awaiting-moderation">Your comment is awaiting moderation.</p>';
			 '</li>';
		 echo $comment_html;
		 
	 
		  wp_die();
		 
	 }
	 function otterwp_search_products() {
		
		$search_query = sanitize_text_field( $_POST['search_query'] );
		 $args = array(
		   'post_type' => 'product',
		   's' => $search_query,
		   'orderby' => 'relevance',
		   'order' => 'ASC',
		   'posts_per_page' => 10
		 );
		 $products = new WP_Query($args);
		 if($products->have_posts()) {
		   while($products->have_posts()) {
			 $products->the_post();
			 // do something with the product post here
			 $title = get_the_title();
			 $permalink = get_permalink();
			 $thumbnail_id = get_post_thumbnail_id();
			 $thumbnail_url = wp_get_attachment_url($thumbnail_id);
			 $product_id = get_the_ID();
			 $product = wc_get_product($product_id);
			 $price = $product->get_price();
			 // you can use the $title, $permalink, and $thumbnail_url variables to create the search hints HTML
			 $html .= '<div class="break"></div>';
			 $html .= '<div class="search-hint otter-woo-data"  data-id='. $product_id .'>';
			 $html .= '<img src="' . $thumbnail_url . '" alt="' . $title . '">';
			 $html .= '<div class="search-hint-container">';
			 $html .= '<a href="' . $permalink . '">' . $title . '</a>';
			 // display the price
			 $html .= '<span class="price">' . wc_price($price) . '</span>';
			 // add the "Add to Cart" button
			 $custom_field = $product->get_meta('custom_field');
			 if ($product->get_type() === 'simple' && empty( $custom_field ) ) {	
				 $html .= '<a type="submit" data-product_id="' . esc_attr( $product_id ) . '" class="button wp-element-button product_type_simple add_to_cart_button ajax_add_to_cart">Add to cart</a>';
			 } else {
				 $product = wc_get_product($product_id);
				 if ($product->get_type() === 'grouped') {
					 $html .= '<a type="submit" data-product_id="' . esc_attr($product_id) . '" class="button wp-element-button">View products</a>';
				 } else {
					 $html .= '<a type="submit" data-product_id="' . esc_attr($product_id) . '" class="button wp-element-button">Select Option</a>';
				 }
			 }
			 $html .= '</div>';
			 $html .= '</div>';
			 $html .= '</div>';
		   }
		 }
		 
		 wp_reset_postdata();
		 echo $html;
		 die();
	   }
	 //   add_action('wp_ajax_search_products', 'search_products');
	 //   add_action('wp_ajax_nopriv_search_products', 'search_products');
 
 
  
 
 add_action( 'wc_ajax_add_to_cart', 'ajax_add_to_cart_handler' );
 add_action( 'wc_ajax_nopriv_add_to_cart', 'ajax_add_to_cart_handler' );
 
 
 function ace_ajax_add_to_cart_handler() {
	 WC_Form_Handler::add_to_cart_action();
	 WC_AJAX::get_refreshed_fragments();
 }
 
 /**
  * Add fragments for notices.
  */
 function ace_ajax_add_to_cart_add_fragments( $fragments ) {
 	$all_notices  = WC()->session->get( 'wc_notices', array() );
 	$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );
 
 	ob_start();
 	foreach ( $notice_types as $notice_type ) {
 		if ( wc_notice_count( $notice_type ) > 0 ) {
 			wc_get_template( "notices/{$notice_type}.php", array(
 				'notices' => array_filter( $all_notices[ $notice_type ] ),
 			) );
 		}
 	}
 	$fragments['notices_html'] = ob_get_clean();
 
 	wc_clear_notices();
 
 	return $fragments;
 }
 add_filter( 'woocommerce_add_to_cart_fragments', 'ace_ajax_add_to_cart_add_fragments' );
 
 // Remove WC Core add to cart handler to prevent double-add
 remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

// Function to add the checkbox
function add_wishlist_checkbox() {
    global $product;
    $product_id = $product->get_id();
    echo '<input type="checkbox" class="wishlist-checkbox" data-product-id="' . $product_id . '"> Add to Wishlist';
}

// Add the filter
add_filter( 'woocommerce_after_shop_loop_item', 'add_wishlist_checkbox', 10, 0 );
// Function to add the checkbox
function add_wishlist_checkbox_single_product() {
    global $product;
    $product_id = $product->get_id();
    echo '<input type="checkbox" class="wishlist-checkbox" data-product-id="' . $product_id . '"> Add to Wishlist';
}

// Add the filter
add_action( 'woocommerce_single_product_summary', 'add_wishlist_checkbox_single_product', 31 );
// Function to add the data-product-id attribute
function add_product_id_class( $classes, $class, $post_id ) {
    if( is_single() && 'product' === get_post_type( $post_id ) && !get_post_field('post_parent', $post_id) ) {
        $classes[] = 'data-product-id-'.$post_id;
    }
    return $classes;
}
add_filter( 'post_class', 'add_product_id_class', 10, 3 );

