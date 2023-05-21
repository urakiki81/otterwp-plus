<?php
/**
 * Image with caption block pattern
 */
return array(
	'title'      => __( 'Image with caption', 'otterwp' ),
	'categories' => array( 'featured', 'columns', 'gallery' ),
	'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"6rem","bottom":"6rem"}},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"backgroundColor":"foreground","textColor":"background","layout":{"inherit":true,"type":"constrained"}} -->
					<div class="wp-block-group alignfull has-background-color has-foreground-background-color has-text-color has-background has-link-color" style="padding-top:6rem;padding-bottom:6rem"><!-- wp:media-text {"mediaId":202,"mediaLink":"http://localhost:8888/wordpress/wp-content/themes/gutenburg-test/assets/images/bird-on-gray.jpg","mediaType":"image","verticalAlignment":"bottom","imageFill":false} -->
					<div class="wp-block-media-text alignwide is-stacked-on-mobile is-vertically-aligned-bottom"><figure class="wp-block-media-text__media"><img src=""' . esc_url( get_template_directory_uri() ) . '/assets/images/steamer-image-two.jpg" alt="' . esc_attr__( 'TBA.', 'otterwp' ) . '" class="wp-image-202 size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph -->
					<p><strong>Gaming</strong></p>
					<!-- /wp:paragraph -->
					
					<!-- wp:paragraph -->
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<!-- /wp:paragraph -->
					
					<!-- wp:buttons -->
					<div class="wp-block-buttons"><!-- wp:button {"textColor":"white","className":"is-style-appear-hover-border"} -->
					<div class="wp-block-button is-style-appear-hover-border"><a class="wp-block-button__link has-white-color has-text-color wp-element-button">' . esc_html__( 'Read more', 'otterwp' ) . '</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div></div>
					<!-- /wp:media-text --></div>
					<!-- /wp:group -->',
);
