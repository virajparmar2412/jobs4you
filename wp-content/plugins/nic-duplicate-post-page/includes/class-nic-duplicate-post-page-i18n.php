<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://www.indianic.com/enquiry
 * @since      1.0.0
 *
 * @package    Nic_Duplicate_Post_Page
 * @subpackage Nic_Duplicate_Post_Page/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Nic_Duplicate_Post_Page
 * @subpackage Nic_Duplicate_Post_Page/includes
 * @author     MageINIC <bhavesh.vala@indianic.com>
 */
class Nic_Duplicate_Post_Page_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'nic-duplicate-post-page',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
