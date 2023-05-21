<?php
/**
 * Page layout with image and text.
 */
return array(
	'title'      => __( 'Otterwp layout with image and text', 'otterwp' ),
	'categories' => array( 'pages' ),
	'content'    => '<!-- wp:group {"align":"full","style":{"color":{"gradient":"linear-gradient(327deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%)"},"spacing":{"padding":{"top":"50px","right":"50px","bottom":"50px","left":"50px"}}},"layout":{"contentSize":"1300px"}} -->
					<div class="wp-block-group alignfull has-background" style="background:linear-gradient(327deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);padding-top:50px;padding-right:50px;padding-bottom:50px;padding-left:50px"><!-- wp:group -->
					<div class="wp-block-group"><!-- wp:columns {"style":{"spacing":{"blockGap":"55px"}}} -->
					<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center"} -->
					<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"align":"center","id":6052,"width":500,"height":500,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
					<figure class="wp-block-image aligncenter size-full is-resized is-style-rounded"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/person-three.jpg" alt="' . esc_attr_x( 'TBD', 'Short for to be determined', 'otterwp' ) . '" class="wp-image-6052" width="500" height="500"/></figure>
					<!-- /wp:image --></div>
					<!-- /wp:column -->
					
					<!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"blockGap":"20px"}}} -->
					<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"9px"}},"layout":{"type":"flex","orientation":"horizontal"}} -->
					<div class="wp-block-group"><!-- wp:separator {"backgroundColor":"vivid-red"} -->
					<hr class="wp-block-separator has-text-color has-vivid-red-color has-alpha-channel-opacity has-vivid-red-background-color has-background"/>
					<!-- /wp:separator -->
					
					<!-- wp:paragraph {"textColor":"vivid-red"} -->
					<p class="has-vivid-red-color has-text-color"><strong>' . esc_html__( 'WE ARE ALWAYS FOCUSED ON', 'otterwp' ) . '</strong></p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:group -->
					
					<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}},"textColor":"background","className":"is-style-two-text"} -->
					<h2 class="is-style-two-text has-background-color has-text-color" style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px"><strong>' . esc_html__( 'Why Choose Us', 'otterwp' ) . ' ?</strong></h2>
					<!-- /wp:heading -->
					
					<!-- wp:paragraph {"textColor":"background","className":"is-style-two-text"} -->
					<p class="is-style-two-text has-background-color has-text-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					<!-- /wp:paragraph -->
					
					<!-- wp:buttons -->
					<div class="wp-block-buttons"><!-- wp:button {"textColor":"background","className":"is-style-arrow"} -->
					<div class="wp-block-button is-style-arrow"><a class="wp-block-button__link has-background-color has-text-color">' . esc_html__( 'Read More', 'otterwp' ) . '</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></div>
					<!-- /wp:group --></div>
					<!-- /wp:group -->',
);
