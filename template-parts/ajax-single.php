<?php
/**
 * Ajax woocommerce single item template
 *
 * @package     Otterwp
 * @author      Otterwp
 * @link        https://www.otterwp.io/
 * @since       Otterwp 1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
global $product;
$review_count = $product->get_review_count();
$product_link = $product->get_permalink();
$product_title = $product->get_title();
$desktop_mode  = get_option('otterwp_desktop_fullscreen');
?>
<div data-id="<?php echo get_the_ID() ?>" class="otw-woocommerce-single otw-top otw-not-compared otw-maximize woocommerce" tabindex="0">
<div class="traffic-lights">
			<button class="traffic-light traffic-light-close" id="close"><span class="Notification"><?php esc_html_e('Close', 'otterwp'); ?></span></button>
			<button class="traffic-light traffic-light-minimize" id="minimize"></button>
			<button class="traffic-light traffic-light-split" id="split"><?php esc_html_e('Compare Mode', 'otterwp'); ?></button>
			<button class="traffic-light traffic-light-maximize" id="maximize"></button>
			<button class="traffic-light traffic-light-switch" id="switch"><?php esc_html_e('Keep Item', 'otterwp'); ?></button>
			<button class="traffic-light traffic-light-close-comp" id="close-comp"><?php esc_html_e('Remove Item', 'otterwp'); ?></button>
		</div><!-- .traffic-lights -->
    <div class="otw-woocommerce-header otw-swipe">            
            <div class="otw-woocommerce-header__thumbnail">
                <?php echo woocommerce_get_product_thumbnail(); ?>
            </div><!--- .otw-woocommerce-header__thumbnail --->

        <div class="otw-woocommerce-header__content">

        
            <?php echo woocommerce_template_single_title(); ?>

     
            <?php echo woocommerce_template_single_price(); ?>

        </div> <!--- .otw-woocommerce-header__content --->
        <?php echo woocommerce_template_loop_add_to_cart(); ?>
        <p class="otw-swipe-msg"><?php esc_html_e('Sipe Down To Close', 'otterwp'); ?></p>

    </div><!--- .otw-woocommerce-header --->

	<?php
		if ( comments_open() || have_comments() ) :
?>



		<div class="otw-woo-reviews-bg"></div><!--- .otw-woo-reviews-bg --->
            <div class="otw-woo-reviews"> 
               

            <div class="otw-woo-reviews__header">
                <h2>
					<?php echo $review_count;?>
					<?php printf(__('Reviews', 'otterwp')); ?>
                </h2>
                <div class="otw-woo-reviews-close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.008 16.008">
                        <g transform="translate(-1865.147 -163.146)">
                            <line x1="15.301" y2="15.301" transform="translate(1865.5 163.5)"/>
                            <line x2="15.301" y2="15.301" transform="translate(1865.5 163.5)"/>
                        </g>
                    </svg>
                </div><!--- .otw-woo-reviews-close-btn --->
            </div><!--- .otw-woo-reviews__header --->
           <div class="otw-woo-reviews__body">
 
                <div id="reviews" class="woocommerce-Reviews">
				<ul class="commentlist">
                	<?php 
					wp_list_comments( array(  'callback' => 'woocommerce_comments'  ), $comments)  
					?>
				</ul>
	<div id="comments">
		<h2 class="otw-woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( 'Leave a review for %2$s', 'Leave a reviews for %2$s', $count, 'otterwp' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'woocommerce' );
			}
			?>
		</h2>

		<?php if ( have_comments() ) : ?>
			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '&larr;',
							'next_text' => '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
		endif;
		if(empty($review_count)){
			?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'otterwp' ); ?></p>

			<?php }?>
		
	</div>
	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<div class="comment-form-rating">
				<div class="otw-status-msg">
				<label>
								<input  class="rating_msg" type="hidden" name="rating_msg" value=""/>
							</label>
				</div> 
				<p class="stars otw-star">
				<span>
					<a href="#" title="5 star" data-message=<?php  esc_html_e( 'Poor', 'otterwp' );?> data-value="1" class="star star-1">5</a>
					<a href="#" title="4 star" data-message="<?php esc_html_e( 'Bad', 'otterwp' );?>" data-value="2" class="star star-2">4</a>
					<a href="#" title="3 star" data-message="<?php esc_html_e( 'Average', 'otterwp' );?>" data-value="3" class="star star-3">3</a>
					<a href="#" title="2 star" data-message="<?php esc_html_e( 'Nice', 'otterwp' );?>" data-value="4" class="star star-4">2</a>
					<a href="#" title="1 star" data-message="<?php esc_html_e( 'Very good qality', 'otterwp' );?>" data-value="5" class="star star-5">1</a>
				</span>
				</p>

				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(					
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Review to %s', 'otterwp' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit', 'otterwp' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'otterwp' ),
						'type'     => 'text',
						'value'    => $commenter['otterwp'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => __( 'Email', 'otterwp' ),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
					$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					if ( $field['required'] ) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'otterwp' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating otw-display-none"><label for="rating">' . esc_html__( 'Your rating', 'otterwp' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'otterwp' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'otterwp' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'otterwp' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'otterwp' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'otterwp' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'otterwp' ) . '</option>
					</select></div>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'otterwp' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'otterwp' ); ?></p>
	<?php endif; ?>

	<div class="clear"></div>
</div>
            <div class="otw-reply">
                <?php echo '<a class="button otw-reply" href=' . $product_link . '>'. esc_html__('Leave Shop Page For ', 'otterwp') . $product_title . '</a>';?>
            </div><!--- .otw-reply --->			
        </div><!--- .otw-woo-reviews__body --->
		
    </div><!--- .otw-woo-reviews --->

  
<?php endif; ?>

</div>

    <div id="project-content" class="otterwp-content ">
        <div class="entry-content otterwp-opactiy">
        <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        

                <?php do_action( 'woocommerce_before_single_product_summary' ); ?>

                <div class="summary entry-summary">
                    <?php
   
   do_action( 'woocommerce_single_product_summary' );
                     
                    ?>
                    
                </div><!--- .summary entry-summary --->
            </div><!--- .product --->
            
        
        <div class="otw-woo-description"> 
            <h2><?php printf(__('Description', 'otterwp')); ?></h2>
            <?php the_content(); ?>
        </div><!--- .otw-woo-description --->
        <div class="otw-woo-additional">
            <?php woocommerce_product_additional_information_tab(); ?>
        </div><!--- .otw-woo-additional --->
		<div class="otw-woo-review otw-woo-review-closed">
            
            <div class="otw-woo-review__avatar">
            <h2>
                        <?php echo $review_count;?>
						<?php printf(__('Reviews', 'otterwp')); ?>
                    </h2>
                <?php echo get_avatar($comments[0]->comment_author_email); ?> 
            </div><!--- .otw-woo-review__avatar --->
            <div class="otw-woo-review__content">
			<?php if(empty($review_count)){?>
				<div class="otw-review-text">
					<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'otterwp' ); ?></p>
					<p class="woocommerce-noreviews"><?php esc_html_e( 'Be the frist to review this product.', 'otterwp' ); ?></p>
				</div>
			<?php }else{ ?>
				<?php echo wc_get_rating_html( $product->get_average_rating() ) ?>
				<p><?php echo  get_comment_excerpt($comments[0])?> </p>
				
			<?php } ?>
            </div><!--- .otw-woo-review__content --->
			<div class="icon">
			</div><!--- .icon --->
        </div> <!--- .otw-woo-review --->
		<div class="otw-woocommerce-related">
		  <?php echo woocommerce_output_related_products();?>
		</div><!--- .otw-woocommerce-related --->

	  <div class="otw-reply">
				<?php echo '<a class="button otw-reply" href=' . $product_link . '>'. esc_html__('Leave Shop Page For ', 'otterwp') . $product_title . '</a>';?>
            </div><!--- .otw-reply --->
        </div><!--- .entry-content --->

            

            <div class="otw-margin"></div><!--- .otw-margin --->

            <div class="otw-margin"></div><!--- .otw-margin --->
           
        </div><!--- .otterwp-content --->

 
  