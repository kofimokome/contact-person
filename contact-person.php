<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              i-mbu.com
 * @since             1.0.0
 * @package           Contact_Person
 *
 * @wordpress-plugin
 * Plugin Name:       Contact Person
 * Plugin URI:        http://i-mbu.com/
 * Description:       Searches for available persons based on their ZIP Code
 * Version:           1.0.0
 * Author:            iMbu On-Demand IT Solutions
 * Author URI:        i-mbu.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       contact-person
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-contact-person-activator.php
 */
function activate_contact_person() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-contact-person-activator.php';
	Contact_Person_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-contact-person-deactivator.php
 */
function deactivate_contact_person() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-contact-person-deactivator.php';
	Contact_Person_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_contact_person' );
register_deactivation_hook( __FILE__, 'deactivate_contact_person' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-contact-person.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_contact_person() {

	$plugin = new Contact_Person();
	$plugin->run();

}

run_contact_person();
