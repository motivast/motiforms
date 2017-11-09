<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://motivast.com
 * @since             0.1.0
 * @package           Motiforms
 *
 * @wordpress-plugin
 * Plugin Name:       Motiforms
 * Plugin URI:        https://github.com/motivast/motiforms
 * Description:       Motiforms is a plugin provided for creating forms programmatically using symfony framework.
 * Version:           0.1.0
 * Author:            Motivast
 * Author URI:        http://motivast.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       motiforms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Load autoloader to not bother to requiring classes.
 */
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/autoloader.php';
require_once plugin_dir_path( __FILE__ ) . 'functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function motiforms() {

	static $plugin;

	if ( isset( $plugin ) && $plugin instanceof \Motiforms\Init ) {
		return $plugin;
	}

	$plugin = new \Motiforms\Init();
	$plugin->run();

}

motiforms();
