<?php
/**
 * Default header block pattern
 */
return array(
	'title'      => __( 'Default header', 'otterwp' ),
	'categories' => array( 'header' ),
	'blockTypes' => array( 'core/template-part/header' ),
	'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"20px"}}}} -->
	<div class="wp-block-group alignfull" style="padding-top:20px"><!-- wp:group {"layout":{"contentSize":"1000px"}} -->
	<div class="wp-block-group"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"flex"}} -->
	<div class="wp-block-group"><!-- wp:site-logo {"width":64} /-->
	
	<!-- wp:site-title {"style":{"typography":{"fontStyle":"italic","fontWeight":"400","textTransform":"uppercase"}},"textColor":"vivid-green-cyan","className":"is-style-five-text","fontSize":"small"} /--></div>
	<!-- /wp:group -->
	
	<!-- wp:navigation {"layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"}} -->
	<!-- wp:page-list /-->
	<!-- /wp:navigation --></div>
	<!-- /wp:group -->
	
	<!-- wp:cover {"minHeight":943,"minHeightUnit":"px","isDark":false,"align":"full"} -->
	<div class="wp-block-cover alignfull is-light" style="min-height:943px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","layout":{"type":"default","wideSize":"1000px"}} -->
	<div class="wp-block-group alignwide"><!-- wp:paragraph {"align":"left","style":{"typography":{"lineHeight":"1.1","fontSize":"4vw"}},"className":"is-style-five-text"} -->
	<p class="has-text-align-left is-style-five-text" style="font-size:4vw;line-height:1.1"><strong>' . esc_html__( 'Grow Faster', 'otterwp' ) . '.</strong></p>
	<!-- /wp:paragraph -->
	
	<!-- wp:columns -->
	<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"49.5%"} -->
	<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:49.5%"><!-- wp:heading {"className":"is-style-third-text","fontSize":"small"} -->
	<h2 class="is-style-third-text has-small-font-size"><strong>— ' . esc_html__( 'WHAT WE DO', 'otterwp' ) . '</strong></h2>
	<!-- /wp:heading -->
	
	<!-- wp:paragraph {"className":"is-style-one-text","fontSize":"extra-small"} -->
	<p class="is-style-one-text has-extra-small-font-size"><strong><em>Nature</em>, in the common sense, refers to essences unchanged by man.</strong></p>
	<!-- /wp:paragraph -->
	
	<!-- wp:paragraph -->
	<p>try this cool thing with use</p>
	<!-- /wp:paragraph -->
	
	<!-- wp:buttons -->
	<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-appear-hover-border","fontSize":"small"} -->
	<div class="wp-block-button has-custom-font-size is-style-appear-hover-border has-small-font-size"><a class="wp-block-button__link">' . esc_html__( 'Continue Reading', 'otterwp' ) . ' →</a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons --></div>
	<!-- /wp:column -->
	
	<!-- wp:column {"width":"25%"} -->
	<div class="wp-block-column" style="flex-basis:25%"><!-- wp:image {"id":1893,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":{"topLeft":"30px","topRight":null,"bottomLeft":null,"bottomRight":null}}}} -->
	<figure class="wp-block-image size-full" style="border-top-left-radius:30px"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-four-image-one.jpg" alt="' . esc_attr_x( 'TBD', 'Short for to be determined', 'otterwp' ) . '" class="wp-image-1893"/></figure>
	<!-- /wp:image -->
	
	<!-- wp:image {"id":1893,"sizeSlug":"large","linkDestination":"none"} -->
	<figure class="wp-block-image size-large"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-four-image-two.jpg" alt="' . esc_attr_x( 'TBD', 'Short for to be determined', 'otterwp' ) . '" class="wp-image-1893"/></figure>
	<!-- /wp:image --></div>
	<!-- /wp:column -->
	
	<!-- wp:column {"width":"25%"} -->
	<div class="wp-block-column" style="flex-basis:25%"><!-- wp:image {"id":1892,"sizeSlug":"full","linkDestination":"none"} -->
	<figure class="wp-block-image size-full"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-four-image-three.jpg" alt="' . esc_attr_x( 'TBD', 'Short for to be determined', 'otterwp' ) . '" class="wp-image-1892"/></figure>
	<!-- /wp:image -->
	
	<!-- wp:image {"id":1880,"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"topLeft":null,"topRight":null,"bottomLeft":null,"bottomRight":"30px"}}}} -->
	<figure class="wp-block-image size-large" style="border-bottom-right-radius:30px"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-four-image-four.jpg" alt="' . esc_attr_x( 'TBD', 'Short for to be determined', 'otterwp' ) . '" class="wp-image-1880"/></figure>
	<!-- /wp:image --></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
	<!-- /wp:group --></div></div>
	<!-- /wp:cover --></div>
	<!-- /wp:group --></div>
	<!-- /wp:group -->',
);
