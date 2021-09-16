<?php
/**
 * Propaganda Report plugin
 *
 * The core, site-specific plugin for the Propaganda Report website.
 *
 * @package  Prop_Report
 * @category Core
 * @since    1.0.0
 * @link     https://github.com/ControlledChaos/propreport
 *
 * Plugin Name:  Propaganda Report
 * Plugin URI:   https://github.com/ControlledChaos/propreport
 * Description:  The core, site-specific plugin for the Propaganda Report website.
 * Version:      1.0.0
 * Author:       Controlled Chaos Design
 * Author URI:   https://ccdzine.com/
 * Text Domain:  propreport
 * Domain Path:  /languages
 * Requires PHP  5.4
 */

namespace PropReport;

// Alias namespaces.
use PropReport\Classes\Activate as Activate;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Constant: Plugin base name
 *
 * @since 1.0.0
 * @var   string The base name of this plugin file.
 */
define( 'PRP_BASENAME', plugin_basename( __FILE__ ) );

// Get the PHP version class.
require_once plugin_dir_path( __FILE__ ) . 'includes/classes/class-php-version.php';

// Get plugin configuration file.
require plugin_dir_path( __FILE__ ) . 'config.php';

/**
 * Activation & deactivation
 *
 * The activation & deactivation methods run here before the check
 * for PHP version which otherwise disables the functionality of
 * the plugin.
 */

// Get the plugin activation class.
include_once PRP_PATH . 'activate/classes/class-activate.php';

// Get the plugin deactivation class.
include_once PRP_PATH . 'activate/classes/class-deactivate.php';

/**
 * Register the activation & deactivation hooks
 *
 * The namspace of this file must remain escaped by use of the
 * backslash (`\`) prepending the activation hooks and corresponding
 * functions.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
\register_activation_hook( __FILE__, __NAMESPACE__ . '\activate_plugin' );
\register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate_plugin' );

/**
 * Run activation class
 *
 * The code that runs during plugin activation.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function activate_plugin() {

	// Instantiate the Activate class.
	$activate = new Activate\Activate;
}

/**
 * Run deactivation class
 *
 * The code that runs during plugin deactivation.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function deactivate_plugin() {

	// Instantiate the Activate class.
	$deactivate = new Activate\Deactivate;
}

/**
 * Disable plugin for PHP version
 *
 * Stop here if the minimum PHP version is not met.
 * Prevents breaking sites running older PHP versions.
 *
 * A notice is added to the plugin row on the Plugins
 * screen as a more elegant and more informative way
 * of disabling the plugin than putting the PHP minimum
 * in the plugin header, which activates a die() message.
 * However, the Requires PHP tag is included in the
 * plugin header with a minimum of version 5.4
 * because of the namespaces.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! Classes\php()->version() ) {

	// First add a notice to the plugin row.
	$activate = new Activate\Activate;
	$activate->get_row_notice();

	// Stop here.
	return;
}

// Get the plugin initialization file.
require_once PRP_PATH . 'init.php';
