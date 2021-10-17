<?php
/**
 * Dashboard class
 *
 * @package    Prop_Report
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace PropReport\Classes\Admin;
use PropReport\Classes as Classes;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Dashboard {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Remove widgets.
		add_action( 'wp_dashboard_setup', [ $this, 'remove_widgets' ] );
	}

	/**
	 * Remove widgets
	 *
	 * @since  1.0.0
	 * @access public
	 * @global array wp_meta_boxes The metaboxes array holds all the widgets for wp-admin.
	 * @return void
	 */
	public function remove_widgets() {

		global $wp_meta_boxes;

		// WordPress news.
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );

		// ClassicPress petitions.
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_petitions'] );

		// Hide Quick Draft (QuickPress) widget.
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );

		// Hide At a Glance widget.
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );

		// Hide Activity widget.
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );

		// Site Health.
		remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );

		// PHP update nag.
		unset( $wp_meta_boxes['dashboard']['normal']['high']['dashboard_php_nag'] );

		// Hide forums activity.
		if (
			is_plugin_active( 'bbpress/bbpress.php' ) ||
			is_plugin_active( 'buddyboss-platform/bp-loader.php' ) ||
			is_plugin_active( 'buddyboss-platform-pro/buddyboss-platform-pro.php' )
		) {
			remove_meta_box( 'bbp-dashboard-right-now', 'dashboard', 'normal' );
		}
	}
}
