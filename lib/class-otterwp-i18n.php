<?php

class Otterwpi18n {

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'otterwp',
			false,
			OTTERWP_THEME_DIR  . '/languages/'
		);

	}



}
