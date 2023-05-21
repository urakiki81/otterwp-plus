<?php

/**
 * The admin-specific functionality of the theme.
 */
class Otterwp_Admin {
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
	 * The token. wp_die
	 *
	 * @var string
	 */
	
    /**
     * Initialize the class and set its properties.
     */
    public function __construct( $theme_name, $version ) {

        $this->theme_name = $theme_name;
        $this->version = $version;
    }
	/**
	 * Add styles for admin
	 */
	public function otterwp_enqueue_styles($hook) {

    wp_enqueue_style( 'otterwp-admin-stylesheet', get_template_directory_uri() . '/dist/assets/css/admin.css', array(), '1.0.0', 'all' );   
	}
	/**
	 * Add js code for admin
	 */
	public function otterwp_enqueue_scripts($hook) {
        //wp_enqueue_script( 'google-fonts-script-js', get_template_directory_uri() . '/admin/js/google-fonts.js', array( ), '1.0', false );
        //wp_enqueue_style(  'google-fonts-css', get_template_directory_uri() . '/css/google-fonts.css', array(), '1.0', false );
            if ( 'appearance_page_test-theme-options' == $hook ){ 
                wp_enqueue_script( 'ace', get_template_directory_uri() . '/inc/js/ace/ace.js', array( 'jquery' ), '1.2.1', true );
                wp_enqueue_script( 'otterwp-ace-css-script', get_template_directory_uri() . '/inc/js/otterwp-custom_css.js', array( 'jquery' ), '1.0.0', true );
            }else{return;}

	}

    /**
     * Add options page 
     */
    public function otterwp_add_page()
    {
        add_theme_page( 'Otterwp Settings', 'Otterwp Settings', 'edit_theme_options', 'test-theme-options', 'otterwp_font_admin_page' );
    }
    /**
     * Register and add settings
     */
    public function otterwp_page_init()
    {
        // Font register settings
        register_setting(
            'otterwp_fonts_group', // Option group
            'otterwp_dynamic_shopping_mode', // Option name
            array( $this, 'otterwp_sanitize_checkbox' ) // Sanitize
        );
        register_setting(
            'otterwp_fonts_group', // Option group
            'otterwp_review_mode', // Option name
            array( $this, 'otterwp_sanitize_checkbox' ) // Sanitize
        );
        register_setting(
            'otterwp_fonts_group', // Option group
            'otterwp_search_hint_mode', // Option name
            array( $this, 'otterwp_sanitize_checkbox' ) // Sanitize
        );
        register_setting(
            'otterwp_fonts_group', // Option group
            'otterwp_desktop_fullscreen', // Option name
            array( $this, 'otterwp_sanitize_checkbox' ) // Sanitize
        );
          // Additional theme register settings


        add_settings_section(
            'woo_amc_section_general', // ID
            'Font Settings', // Title
            '', // Callback
            'otterwp-font-settings' // Page
        );
        add_settings_section(
            'custom_css_theme_section_general', // ID
            'Otterwp Theme custom CSS', // Title
            '', // Callback
            'otterwp-font-settings' // Page
        );
        add_settings_section(
            'otterwp_woo_theme_section_general', // ID
            'Otterwp Theme Woo Settings', // Title
            '', // Callback
            'otterwp-font-settings' // Page
        );




         // Additional theme setting fields
         $all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
         if (stripos(implode($all_plugins), 'woocommerce.php')) {
             add_settings_field(
                 'otterwp_auto_desktop_mode', // ID
                 'Dynamic shopping', // Title
                 array( $this, 'otterwp_auto_desktop_activate' ), // Callback
                 'otterwp-font-settings', // Page
                 'otterwp_woo_theme_section_general' // Section
             );
            add_settings_field(
                'otterwp_auto_review_mode', // ID
                'Dynamic review', // Title
                array( $this, 'otterwp_auto_review_activate' ), // Callback
                'otterwp-font-settings', // Page
                'otterwp_woo_theme_section_general' // Section
            );
            add_settings_field(
                'otterwp_auto_search_hint_mode', // ID
                'Dynamic search', // Title
                array( $this, 'otterwp_search_hint_activate' ), // Callback
                'otterwp-font-settings', // Page
                'otterwp_woo_theme_section_general' // Section
            );
            add_settings_field(
                'otterwp_desktop_fullscreen_mode', // ID
                'Desktop split screen', // Title
                array( $this, 'otterwp_desktop_fullscreen_mode_activate' ), // Callback
                'otterwp-font-settings', // Page
                'otterwp_woo_theme_section_general' // Section
            );


         }
    }

    /**
     * Sanitize each setting field as needed
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['enabled'] ) )
            $new_input['enabled'] = sanitize_text_field( $input['enabled'] );
        return $new_input;
    }
    //Sanitization settings
        public function otterwp_sanitize_font_handler( $input ){
            $output = sanitize_text_field( $input );
            return $output;
        }
        public function otterwp_sanitize_custom_css( $input ){
            $output = esc_textarea( $input );
            return $output;
        }
        public function otterwp_auto_desktop_activate() {
            $options = get_option( 'otterwp_dynamic_shopping_mode' );
            $checked = ( @$options == 1 ? 'checked' : '' );
            echo '<label><input type="checkbox" id="otterwp_dynamic_shopping_mode" name="otterwp_dynamic_shopping_mode" class="switch" value="1" '.$checked.' /><div class="slider round"></div></label>';
        }
        public function otterwp_auto_review_activate() {
            $options = get_option( 'otterwp_review_mode' );
            $checked = ( @$options == 1 ? 'checked' : '' );
            echo '<label><input type="checkbox" id="otterwp_review_mode" name="otterwp_review_mode" class="switch" value="1" '.$checked.' /><div class="slider round"></div></label>';
        }
        public function otterwp_search_hint_activate() {
            $options = get_option( 'otterwp_search_hint_mode' );
            $checked = ( @$options == 1 ? 'checked' : '' );
            echo '<label><input type="checkbox" id="otterwp_search_hint_mode" name="otterwp_search_hint_mode" class="switch" value="1" '.$checked.' /><div class="slider round"></div></label>';
        }
        public function otterwp_desktop_fullscreen_mode_activate() {
            $options = get_option( 'otterwp_desktop_fullscreen' );
            $checked = ( @$options == 1 ? 'checked' : '' );
            echo '<label><input type="checkbox" id="otterwp_desktop_fullscreen" name="otterwp_desktop_fullscreen" class="switch" value="1" '.$checked.' /><div class="slider round"></div></label>';
        }
    /**
     * Get the settings option array and print one of its values
     */
    
  
}
function otterwp_font_admin_page(){
    
    ?>
    <div class="main-container">
        <div class="settings-area">
            <div class="main-header">
                <div class="header-menu">
                    <a class="main-header-link otterwp-woo" href="#"><?php print esc_html__('Theme settings', 'otterwp')?></a>
                    <a class="main-header-link otterwp-font" href="#"><?php print esc_html__('Google Fonts', 'otterwp')?></a>
                    <a class="main-header-link otterwp-support" href="#"><?php print esc_html__('Support', 'otterwp')?></a>
                    
                </div>
            </div>
            <div class="content-wrapper">
                    <form id="save-custom-css-form"  method="post" action="options.php" class="otterwp-general-form">
                        
                        <?php
                        
                        // This prints out all hidden setting fields
                            do_settings_sections( 'otterwp-font-settings' );
                            settings_fields( 'otterwp_fonts_group' );
                            submit_button();
                        ?>

                <div class="otterwp-supper-page" style="display:none;">
                    <div class="otterwp-container">
                        <h3><?php echo wp_kses_post( __( 'Need help? We\'re here for you!', 'otterwp' ) ); ?></h3>
                        <p><?php esc_html_e( 'Have a question? Hit a bug? Having a idea for something you would like to see? Get the help you need', 'otterwp' ); ?></p>
                        <a href="<?php echo esc_url('https://www.otterwp.io/support/')?>" class="otterwp-button button" target="_blank">
											<?php echo esc_html_e( 'Get Support', 'otterwp' ); ?>
										</a>
                    </div>
                </div>
                <div class="otterwp-font-page" style="display:none;">
                    <div class="otterwp-container">
                    <h1 class="wp-heading-inline"><?php _e('Manage Theme Fonts', 'otterwp-plus'); ?></h1>
                        <a href="<?php echo admin_url( 'themes.php?page=manage-fonts' ); ?>" class="page-title-action"><?php _e('Manage Font', 'otterwp-plus'); ?></a>
                        <a href="<?php echo admin_url( 'themes.php?page=add-google-font-to-theme-json' ); ?>" class="page-title-action"><?php _e('Add Google Font', 'otterwp-plus'); ?></a>
                        <hr class="wp-header-end" />
                    </div>
                </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
}
