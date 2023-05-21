<?php
/**
 * Contact One page
 */
return array(
	'title'      => __( 'Contact One', 'otterwp' ),
	'categories' => array( 'contact' ),
	'content'    => '<!-- wp:group {"style":{"spacing":{"margin":{"top":"30px","bottom":"30px"}}}} -->
    <div class="wp-block-group" style="margin-top:30px;margin-bottom:30px"><!-- wp:heading {"className":"is-style-four-text"} -->
    <h2 class="is-style-four-text">' . esc_html__( 'Heading Title', 'otterwp' ) . '</h2>
    <!-- /wp:heading -->
    
    <!-- wp:columns -->
    <div class="wp-block-columns"><!-- wp:column {"style":{"spacing":{"blockGap":"29px"}}} -->
    <div class="wp-block-column"><!-- wp:heading {"level":3,"className":"is-style-four-text"} -->
    <h3 class="is-style-four-text" id="tel">Tel:</h3>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph {"className":"is-style-four-text"} -->
    <p class="is-style-four-text">+1-123-456-789</p>
    <!-- /wp:paragraph --></div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column"><!-- wp:heading {"level":3,"className":"is-style-four-text"} -->
    <h3 class="is-style-four-text" id="tel">' . esc_html__( 'Address', 'otterwp' ) . ':</h3>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph {"className":"is-style-four-text"} -->
    <p class="is-style-four-text">' . esc_html__( 'Address Line', 'otterwp' ) . '1</p>
    <!-- /wp:paragraph --></div>
    <!-- /wp:column -->
    
    <!-- wp:column -->
    <div class="wp-block-column"><!-- wp:heading {"level":3,"className":"is-style-four-text"} -->
    <h3 class="is-style-four-text" id="tel">' . esc_html__( 'Email', 'otterwp' ) . ':</h3>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph {"className":"is-style-four-text"} -->
    <p class="is-style-four-text">info@email.com</p>
    <!-- /wp:paragraph --></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns --></div>
    <!-- /wp:group -->
    <!-- wp:group {"style":{"spacing":{"padding":{"bottom":"20px","top":"20px","right":"20px","left":"20px"}}},"backgroundColor":"primary","className":"is-style-default","layout":{"wideSize":""}} -->
    <div class="wp-block-group is-style-default has-primary-background-color has-background" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:image {"id":827,"width":640,"sizeSlug":"full","linkDestination":"none","className":"is-style-offset-left-top"} -->
    <figure class="wp-block-image size-full is-resized is-style-offset-left-top"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/otterwp-mail.jpg" alt="' . esc_attr_x( 'TBD', 'Short for to be determined', 'otterwp' ) . '" class="wp-image-827" width="640"/></figure>
    <!-- /wp:image --></div>
    <!-- /wp:group -->
    ',
);
