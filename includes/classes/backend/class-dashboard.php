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
use PropReport\Classes as Classes,
	PropReport\Classes\Vendor as Vendor;

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

		/**
		 * Custom dashboard panel
		 *
		 * This replaces the core welcome panel which is
		 * limited to admins. With this, a custom welcome
		 * panel can be offered to all user roles.
		 *
		 * @todo Option to use the panel in addition to
		 * the config file constant.
		 */
		// if ( defined( 'PRP_USE_CUSTOM_DASHBOARD' ) && false != PRP_USE_CUSTOM_DASHBOARD ) :

			// Enqueue dashboard panel styles.
			add_action( 'admin_enqueue_scripts', [ $this, 'dashboard_panel_styles' ] );

			// Widgets area layout.
			$this->layout();

			// Widget order.
			add_action( 'admin_init', [ $this, 'widget_order' ], 25 );

			// Remove core welcome panel.
			remove_action( 'welcome_panel', 'wp_welcome_panel' );

			// Add custom dashboard panel.
			add_action( 'wp_dashboard_setup', [ $this, 'dashboard_panel' ] );

		// endif; // PRP_USE_CUSTOM_DASHBOARD
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

	/**
	 * Enqueue admin scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function dashboard_panel_styles() {

		// Script suffix.
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			$suffix = '';
		} else {
			$suffix = '.min';
		}

		// Get the screen ID to target the dashboard.
		$screen = get_current_screen();

		// Enqueue only on the Dashboard screen.
		if ( $screen->id == 'dashboard' ) {
			wp_enqueue_style( PRP_CONFIG['admin_slug'] . '-dashboard', PRP_URL .  'assets/css/dashboard-panel' . $suffix . '.css', [], null, 'screen' );
		}
	}

	/**
	 * Widgets area layout
	 *
	 * @return void
	 */
	public function layout() {

		// Make dashboard one column because of the big user panel.
		add_filter( 'screen_layout_columns', function( $columns ) {
			$columns['dashboard'] = 1;
    		return $columns;
		} );
		add_filter( 'get_user_option_screen_layout_dashboard', function() { return 1; } );
	}

	/**
	 * Widget order
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function widget_order() {

		$id = get_current_user_id();
		$meta_value = [
			'normal'  => 'scp-dashboard',
			'side'    => '',
			'column3' => '',
			'column4' => '',
		];
		update_user_meta( $id, 'meta-box-order_dashboard', $meta_value );
	}

	/**
	 * Dashboard panel
	 *
	 * This and some CSS replicates the custom welcome panel.
	 * It is used instead because the welcome panel hook is
	 * only available to users who can customize the site.
	 * With this content can be made available to all users
	 * then conditionally displayed by user role.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function dashboard_panel() {

		$heading = sprintf(
			'%s %s',
			get_bloginfo( 'name' ),
			__( 'Dashboard', 'bernays' )
		);

		wp_add_dashboard_widget(
			'scp-dashboard',
			$heading,
			[ $this, 'dashboard_template' ],
			null,
			null,
			'normal',
			'high'
		);
	}

	/**
	 * Get the custom dashboard panel
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function dashboard_template() {

		// Instantiate Plugin_ACF class to get the suffix.
		$acf = new Vendor\Plugin_ACF;

		// Look first in the active theme for a dashboard panel template.
		$dashboard = locate_template( 'template-parts/admin/dashboard-panel' . $acf->suffix() . '.php' );

		if ( ! empty( $dashboard ) ) {
			get_template_part( 'template-parts/admin/dashboard-panel' . $acf->suffix() );
		} else {
			include_once PRP_PATH . 'views/backend/widgets/dashboard-panel' . $acf->suffix() . '.php';
		}
	}
}
