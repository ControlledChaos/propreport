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

class Dashboard extends Classes\Base {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Run the parent constructor method.
		parent :: __construct();

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

		// Site Health.
		if ( defined( 'PRP_ALLOW_SITE_HEALTH' ) && ! PRP_ALLOW_SITE_HEALTH ) {
			remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
		}

		// PHP update nag.
		unset( $wp_meta_boxes['dashboard']['normal']['high']['dashboard_php_nag'] );
	}
}
