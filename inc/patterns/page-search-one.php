<?php
/**
 * Search page layout one layout.
 */
return array(
	'title'      => __( 'Page layout search', 'otterwp' ),
	'categories' => array( 'pages' ),
	'content'    => '<!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/search-one.jpg","id":6273,"dimRatio":50,"overlayColor":"foreground","focalPoint":{"x":"0.35","y":"0.38"},"align":"full","className":"is-style-image-zoom-hover","style":{"spacing":{"padding":{"top":"10vw","right":"30px","bottom":"10vw","left":"30px"}}}} -->
                    <div class="wp-block-cover alignfull is-style-image-zoom-hover" style="padding-top:10vw;padding-right:30px;padding-bottom:10vw;padding-left:30px"><span aria-hidden="true" class="wp-block-cover__background has-foreground-background-color has-background-dim"></span><img class="wp-block-cover__image-background wp-image-6273" alt="" src="' . esc_url( get_template_directory_uri() ) . '/assets/images/search-one.jpg" style="object-position:35% 38%" data-object-fit="cover" data-object-position="35% 38%"/><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","layout":{"inherit":true}} -->
                    <div class="wp-block-group alignwide"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0px"}},"layout":{"inherit":false}} -->
                    <div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"center","textColor":"background"} -->
                    <h2 class="has-text-align-center has-background-color has-text-color">  ' . esc_html__( 'Search Now', 'otterwp' ) . '</h2>
                    <!-- /wp:heading --></div>
                    <!-- /wp:group -->
                    
                    <!-- wp:group {"style":{"spacing":{"padding":{"bottom":"50px"}}},"layout":{"inherit":true}} -->
                    <div class="wp-block-group" style="padding-bottom:50px"><!-- wp:search {"label":"' . esc_html__( 'Search', 'otterwp' ) . '","showLabel":false,"placeholder":"' . esc_html__( 'Search', 'otterwp' ) . '","width":100,"widthUnit":"%","buttonText":"Search","buttonPosition":"button-inside","align":"center","style":{"border":{"radius":"100px"}},"borderColor":"background","backgroundColor":"luminous-vivid-amber","textColor":"black"} /--></div>
                    <!-- /wp:group --></div>
                    <!-- /wp:group --></div></div>
                    <!-- /wp:cover -->',
);
