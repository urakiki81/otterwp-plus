<?php
/**
 * Page layout with image and text.
 */
return array(
	'title'      => __( 'Page layout with image and image', 'otterwp' ),
	'categories' => array( 'pages' ),
	'content'    => '<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group"><!-- wp:columns {"style":{"spacing":{"blockGap":"55px"}}} -->
	<div class="wp-block-columns"><!-- wp:column {"width":"","style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}},"layout":{"inherit":true}} -->
	<div class="wp-block-column" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:image {"id":6040,"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"20px"}},"className":"is-style-otterwp-shadow"} -->
	<figure class="wp-block-image size-large is-style-otterwp-shadow" style="border-radius:20px"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/steamer-image-five.jpg" alt="' . esc_attr_x( 'TBD', 'Short for to be determined', 'otterwp' ) . '" class="wp-image-6040"/></figure>
	<!-- /wp:image -->
	
	<!-- wp:heading {"level":3} -->
	<h3><strong>—</strong> <strong>' . esc_html__( 'Title one', 'otterwp' ) . '</strong></h3>
	<!-- /wp:heading -->
	
	<!-- wp:buttons -->
	<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-appear-hover-border","typeFonts":"fourth-text"} -->
	<div class="wp-block-button is-style-appear-hover-border fourth-text"><a class="wp-block-button__link">' . esc_html__( 'Read More', 'otterwp' ) . '</a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons --></div>
	<!-- /wp:column -->
	
	<!-- wp:column {"width":"","style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"},"blockGap":"20px"}},"layout":{"inherit":true}} -->
	<div class="wp-block-column" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading -->
	<h2><strong>— ' . esc_html__( 'Title Two', 'otterwp' ) . ' </strong></h2>
	<!-- /wp:heading -->
	
	<!-- wp:paragraph -->
	<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'otterwp' ) . '.</p>
	<!-- /wp:paragraph -->
	
	<!-- wp:buttons -->
	<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-appear-hover-border","typeFonts":"fourth-text"} -->
	<div class="wp-block-button is-style-appear-hover-border fourth-text"><a class="wp-block-button__link">' . esc_html__( 'Read More', 'otterwp' ) . '</a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons -->
	
	<!-- wp:image {"id":6040,"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"20px"}},"className":"is-style-otterwp-shadow"} -->
	<figure class="wp-block-image size-large is-style-otterwp-shadow" style="border-radius:20px"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/steamer-image-five.jpg" alt="' . esc_attr_x( 'TBD', 'Short for to be determined', 'otterwp' ) . '" class="wp-image-6040"/></figure>
	<!-- /wp:image --></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
	<!-- /wp:group -->',
);
