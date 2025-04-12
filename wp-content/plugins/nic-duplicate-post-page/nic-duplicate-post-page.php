<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://www.indianic.com/enquiry
 * @since             1.0.0
 * @package           Nic_Duplicate_Post_Page
 *
 * @wordpress-plugin
 * Plugin Name:       NIC Duplicate post page
 * Plugin URI:        https://https://www.indianic.com
 * Description:       This plugin is the duplicate posts, pages and custom post types easily using single click. You can duplicate your pages, posts and custom post by just one click and It will be duplicated as a draft.
 * Version:           1.0.1
 * Author:            MageINIC
 * Author URI:        https://https://www.indianic.com/enquiry
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       nic-duplicate-post-page
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NIC_DUPLICATE_POST_PAGE_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nic-duplicate-post-page-activator.php
 */
function activate_nic_duplicate_post_page() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nic-duplicate-post-page-activator.php';
	Nic_Duplicate_Post_Page_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nic-duplicate-post-page-deactivator.php
 */
function deactivate_nic_duplicate_post_page() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nic-duplicate-post-page-deactivator.php';
	Nic_Duplicate_Post_Page_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nic_duplicate_post_page' );
register_deactivation_hook( __FILE__, 'deactivate_nic_duplicate_post_page' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nic-duplicate-post-page.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_nic_duplicate_post_page() {

	$plugin = new Nic_Duplicate_Post_Page();
	$plugin->run();

}
run_nic_duplicate_post_page();
