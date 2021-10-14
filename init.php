<?php
/**
 * Initialize plugin functionality
 *
 * @package    Prop_Report
 * @subpackage Init
 * @category   Core
 * @since      1.0.0
 */

namespace PropReport;

// Alias namespaces.
use
PropReport\Classes            as Classes,
PropReport\Classes\Core       as Core,
PropReport\Classes\Settings   as Settings,
PropReport\Classes\Tools      as Tools,
PropReport\Classes\Media      as Media,
PropReport\Classes\Users      as Users,
PropReport\Classes\Admin      as Admin,
PropReport\Classes\Front      as Front,
PropReport\Classes\Front\Meta as Meta,
PropReport\Classes\Widgets    as Widgets,
PropReport\Classes\Vendor     as Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Initialization function
 *
 * Loads PHP classes and text domain.
 * Instantiates various classes.
 * Adds settings link in the plugin row.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function init() {

	// Standard plugin installation.
	load_plugin_textdomain(
		'propreport',
		false,
		dirname( PRP_BASENAME ) . '/languages'
	);

	// If this is in the must-use plugins directory.
	load_muplugin_textdomain(
		'propreport',
		dirname( PRP_BASENAME ) . '/languages'
	);

	/**
	 * Class autoloader
	 *
	 * The autoloader registers plugin classes for later use,
	 * such as running new instances below.
	 */
	require_once PRP_PATH . 'includes/autoloader.php';

	// Get compatibility functions.
	require PRP_PATH . 'includes/vendor/compatibility.php';

	// Instantiate core classes.
	new Core\Type_Tax;
	new Core\Register_Podcast;
	new Core\Register_Video;
	new Core\Register_Admin;
	new Core\Register_Site_Help;

	// If the Customizer is disabled in the system config file.
	if ( ( defined( 'PRP_ALLOW_CUSTOMIZER' ) && false == PRP_ALLOW_CUSTOMIZER ) && ! current_user_can( 'develop' ) ) {
		new Core\Remove_Customizer;
	}

	/**
	 * Editor options for WordPress
	 *
	 * Not run for ClassicPress and the default antibrand system.
	 * The `classicpress_version()` function checks for ClassicPress.
	 * The `APP_INC_PATH` constant checks for the default antibrand system.
	 *
	 * Not run if the Classic Editor plugin is active.
	 */
	if ( ! function_exists( 'classicpress_version' ) || ! defined( 'APP_INC_PATH' ) ) {
		if ( ! is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
			new Core\Editor_Options;
		}
	}

	// Run tools.
	// @todo Put into a settings page.
	$prp_tools = new Tools\Tools;
	$prp_tools->rtl_test();
	$prp_tools->customizer_reset();
	$prp_tools->disable_floc();

	// Instantiate media class.
	new Media\Media;

	// Register media type taxonomy.
	new Media\Register_Media_Type;

	// Include Advanced Custom Fields.
	$prp_acf = new Vendor\Plugin_ACF;
	$prp_acf->include();

	// Include Advanced Custom Fields: Extended.
	$prp_acfe = new Vendor\Plugin_ACFE;
	$prp_acfe->include();

	// BuddyBoss compatibility.
	$prp_boss = new Vendor\Plugin_BuddyBoss;

	// Instantiate backend classes.
	if ( is_admin() ) {
		new Admin\Admin;
	}

	// Instantiate users classes.
	new Users\Users;

	// Instantiate frontend classes.
	if ( ! is_admin() ) {
		new Front\Frontend;
		new Front\Template_Filters;
		new Meta\Meta_Data;
		new Meta\Meta_Tags;
	}

	// Disable Site Health notifications.
	if ( defined( 'PRP_ALLOW_SITE_HEALTH' ) && ! PRP_ALLOW_SITE_HEALTH ) {
		add_filter( 'wp_fatal_error_handler_enabled', '__return_false' );
	}

	/**
	 * Disable block widgets
	 *
	 * Not checking the `wp-config.php` file so the condition is
	 * commented out. Only use the classic widgets interface.
	 */
	// if ( defined( 'PRP_ALLOW_BLOCK_WIDGETS' ) && ! PRP_ALLOW_BLOCK_WIDGETS ) {
		add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
		add_filter( 'use_widgets_block_editor', '__return_false' );
	// }

	// Remove the Draconian capital P filters.
	remove_filter( 'the_title', 'capital_P_dangit', 11 );
	remove_filter( 'the_content', 'capital_P_dangit', 11 );
	remove_filter( 'comment_text', 'capital_P_dangit', 31 );

	/**
	 * Disable emoji script
	 *
	 * Emojis will still work in modern browsers. This removes the script
	 * that makes emojis work in old browsers.
	 */
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// System email from text.
	add_filter( 'wp_mail_from_name', function( $name ) {
		return apply_filters( 'prp_mail_from_name', get_bloginfo( 'name' ) );
	} );

	// Disable WordPress administration email verification prompt.
	add_filter( 'admin_email_check_interval', '__return_false' );
}

// Run initialization function.
init();

/**
 * Admin initialization function
 *
 * Instantiates various classes.
 *
 * @since  1.0.0
 * @access public
 * @global $pagenow Get the current admin screen.
 * @return void
 */
function admin_init() {

	// Access current admin page.
	global $pagenow;
}
add_action( 'admin_init', __NAMESPACE__ . '\admin_init' );
