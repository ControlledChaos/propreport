<?php
/**
 * BuddyBoss plugin compatibility
 *
 * @package    Prop_Report
 * @subpackage Classes
 * @category   Vendor
 * @since      1.0.0
 */

namespace PropReport\Classes\Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Plugin_BuddyBoss extends Plugin {

	/**
	 * Installed plugin directory
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The directory of the installed plugin.
	 */
	protected $installed_dir = 'buddyboss-platform';

	/**
	 * Installed plugin file
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The core file of the installed plugin.
	 */
	protected $installed_file = 'bp-loader.php';

	/**
	 * Bundled plugin directory
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The directory of the bundled plugin.
	 */
	protected $bundled_dir = 'buddyboss';

	/**
	 * Bundled plugin file
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The core file of the bundled plugin.
	 */
	protected $bundled_file = 'buddyboss.php';

	/**
	 * Upgrade plugin directory
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The directory of the upgrade plugin.
	 */
	protected $upgrade_dir = '';

	/**
	 * Upgrade plugin file
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The core file of the upgrade plugin.
	 */
	protected $upgrade_file = '';

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		parent :: __construct();

		// Change menu label.
		if ( class_exists( 'BP_Admin' ) ) {
			add_action( 'admin_menu', [ $this, 'add_admin_menu' ], 5 );
			add_action( 'admin_init', [ $this, 'remove_admin_menu' ] );
		}

		// Print admin styles to head.
		add_action( 'admin_print_styles', [ $this, 'admin_print_styles' ], 20 );
	}

	/**
	 * Change menu label
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function add_admin_menu() {

		if ( function_exists( 'bp_core_do_network_admin' ) ) {
			if ( bp_core_do_network_admin() ) {
				$capability = 'manage_network_options';
			} else {
				$capability = 'manage_options';
			}
		} elseif ( is_network_admin() ) {
			$capability = 'manage_network_options';
		} else {
			$capability = 'manage_options';
		}

		add_menu_page(
			__( 'Community', 'propreport' ),
			__( 'Community', 'propreport' ),
			$capability,
			'buddyboss-platform',
			'bp_core_admin_hook',
			'dashicons-groups',
			3
		);
	}

	/**
	 * Remove menu items
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function remove_admin_menu() {
		remove_menu_page( 'buddyboss-platform' );
		remove_submenu_page( 'buddyboss-platform', 'buddyboss-platform' );
	}

	/**
	 * Use bundled plugin
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean Default should be true. False only
	 *                 if defined as such elsewhere.
	 */
	public function use_bundled() {

		// Override constant.
		if ( defined( 'PRP_USE_BUDDYBOSS' ) && false == PRP_USE_BUDDYBOSS ) {
			return false;
		}
		return true;
	}

	/**
	 * Print page styles
	 *
	 * This is for styles that shall not be
	 * overridden by class extension. Specific
	 * screens should use print_styles() to
	 * print styles for its screen.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function admin_print_styles() {

		// Styles for the tabbed content.
		$style  = '<style>';
		if ( ! current_user_can( 'develop' ) ) {
			$style .= '.nav-tab-wrapper .bp-help { display: none; }';
		}
		$style .= '.nav-tab-wrapper .bp-credits { display: none; }';
		$style .= '</style>';
		echo $style;
	}
}
