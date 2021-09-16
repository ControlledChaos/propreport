<?php
/**
 * Register plugin classes
 *
 * The autoloader registers plugin classes for later use.
 *
 * @package    Prop_Report
 * @subpackage Includes
 * @category   Classes
 * @since      1.0.0
 */

namespace PropReport;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class files
 *
 * Defines the class directories and file prefixes.
 *
 * @since 1.0.0
 * @var   array Defines an array of class file paths.
 */
define( 'PRP_CLASS', [
	'core'     => PRP_PATH . 'includes/classes/core/class-',
	'settings' => PRP_PATH . 'includes/classes/settings/class-',
	'tools'    => PRP_PATH . 'includes/classes/tools/class-',
	'media'    => PRP_PATH . 'includes/classes/media/class-',
	'users'    => PRP_PATH . 'includes/classes/users/class-',
	'vendor'   => PRP_PATH . 'includes/classes/vendor/class-',
	'admin'    => PRP_PATH . 'includes/classes/backend/class-',
	'front'    => PRP_PATH . 'includes/classes/frontend/class-',
	'general'  => PRP_PATH . 'includes/classes/class-',
] );

/**
 * Classes namespace
 *
 * @since 1.0.0
 * @var   string Defines the namespace of class files.
 */
define( 'PRP_CLASS_NS', __NAMESPACE__ . '\Classes' );

/**
 * Array of classes to register
 *
 * When you add new classes to your version of this plugin you may
 * add them to the following array rather than requiring the file
 * elsewhere. Be sure to include the precise namespace.
 *
 * SAMPLES: Uncomment sample classes to load them.
 *
 * @since 1.0.0
 * @var   array Defines an array of class files to register.
 */
define( 'PRP_CLASSES', [

	// Base class.
	PRP_CLASS_NS . '\Base' => PRP_CLASS['general'] . 'base.php',

	// Core classes.
	PRP_CLASS_NS . '\Core\Editor_Options'       => PRP_CLASS['core'] . 'editor-options.php',
	PRP_CLASS_NS . '\Core\Type_Tax'             => PRP_CLASS['core'] . 'type-tax.php',
	PRP_CLASS_NS . '\Core\Register_Type'        => PRP_CLASS['core'] . 'register-type.php',
	PRP_CLASS_NS . '\Core\Register_Sample_Type' => PRP_CLASS['core'] . 'register-sample-type.php',
	PRP_CLASS_NS . '\Core\Register_Admin'       => PRP_CLASS['core'] . 'register-admin.php',
	PRP_CLASS_NS . '\Core\Register_Site_Help'   => PRP_CLASS['core'] . 'register-site-help.php',
	PRP_CLASS_NS . '\Core\Register_Tax'         => PRP_CLASS['core'] . 'register-tax.php',
	PRP_CLASS_NS . '\Core\Register_Sample_Tax'  => PRP_CLASS['core'] . 'register-sample-tax.php',
	PRP_CLASS_NS . '\Core\Types_Taxes_Order'    => PRP_CLASS['core'] . 'types-taxes-order.php',
	PRP_CLASS_NS . '\Core\Taxonomy_Templates'   => PRP_CLASS['core'] . 'taxonomy-templates.php',
	PRP_CLASS_NS . '\Core\Remove_Blog'          => PRP_CLASS['core'] . 'remove-blog.php',
	PRP_CLASS_NS . '\Core\Remove_Customizer'    => PRP_CLASS['core'] . 'remove-customizer.php',

	// Settings classes.
	PRP_CLASS_NS . '\Settings\Settings' => PRP_CLASS['settings'] . 'settings.php',

	// Tools classes.
	PRP_CLASS_NS . '\Tools\Tools'            => PRP_CLASS['tools'] . 'tools.php',
	PRP_CLASS_NS . '\Tools\Disable_FloC'     => PRP_CLASS['tools'] . 'disable-google-floc.php',
	PRP_CLASS_NS . '\Tools\RTL_Test'         => PRP_CLASS['tools'] . 'rtl-test.php',
	PRP_CLASS_NS . '\Tools\Customizer_Reset' => PRP_CLASS['tools'] . 'customizer-reset.php',

	// Media classes.
	PRP_CLASS_NS . '\Media\Media'               => PRP_CLASS['media'] . 'media.php',
	PRP_CLASS_NS . '\Media\Register_Media_Type' => PRP_CLASS['media'] . 'register-media-type.php',

	// Users classes.
	PRP_CLASS_NS . '\Users\Users'           => PRP_CLASS['users'] . 'users.php',
	PRP_CLASS_NS . '\Users\User_Roles_Caps' => PRP_CLASS['users'] . 'user-roles-caps.php',
	PRP_CLASS_NS . '\Users\User_Toolbar'    => PRP_CLASS['users'] . 'user-toolbar.php',
	PRP_CLASS_NS . '\Users\User_Avatars'    => PRP_CLASS['users'] . 'user-avatars.php',

	// Vendor classes.
	PRP_CLASS_NS . '\Vendor\Plugin'        => PRP_CLASS['vendor'] . 'plugin.php',
	PRP_CLASS_NS . '\Vendor\Plugin_Sample' => PRP_CLASS['vendor'] . 'plugin-sample.php',
	PRP_CLASS_NS . '\Vendor\Plugin_ACF'    => PRP_CLASS['vendor'] . 'plugin-acf.php',
	PRP_CLASS_NS . '\Vendor\Plugin_ACFE'   => PRP_CLASS['vendor'] . 'plugin-acfe.php',
	PRP_CLASS_NS . '\Vendor\ACF_Columns'   => PRP_CLASS['vendor'] . 'acf-columns.php',
	PRP_CLASS_NS . '\Vendor\Add_ACF_Options'    => PRP_CLASS['vendor'] . 'add-acf-options.php',
	PRP_CLASS_NS . '\Vendor\Add_ACF_Suboptions' => PRP_CLASS['vendor'] . 'add-acf-suboptions.php',
	PRP_CLASS_NS . '\Vendor\ACF_Manage_Site'    => PRP_CLASS['vendor'] . 'acf-manage-site.php',
	PRP_CLASS_NS . '\Vendor\Sample_ACF_Options'    => PRP_CLASS['vendor'] . 'sample-acf-options.php',
	PRP_CLASS_NS . '\Vendor\Sample_ACF_Suboptions' => PRP_CLASS['vendor'] . 'sample-acf-suboptions.php',

	// Backend/admin classes,
	PRP_CLASS_NS . '\Admin\Admin'                   => PRP_CLASS['admin'] . 'admin.php',
	PRP_CLASS_NS . '\Admin\Add_Page'                => PRP_CLASS['admin'] . 'add-page.php',
	PRP_CLASS_NS . '\Admin\Add_Subpage'             => PRP_CLASS['admin'] . 'add-subpage.php',
	PRP_CLASS_NS . '\Admin\Admin_Settings_Page'     => PRP_CLASS['admin'] . 'admin-settings-page.php',
	PRP_CLASS_NS . '\Admin\Add_Settings_Page'       => PRP_CLASS['admin'] . 'add-settings-page.php',
	PRP_CLASS_NS . '\Admin\Admin_ACF_Settings_Page' => PRP_CLASS['admin'] . 'admin-acf-settings-page.php',
	PRP_CLASS_NS . '\Admin\Content_Settings'        => PRP_CLASS['admin'] . 'content-settings.php',
	PRP_CLASS_NS . '\Admin\Manage_Website_Page'     => PRP_CLASS['admin'] . 'manage-website-page.php',
	PRP_CLASS_NS . '\Admin\User_Colors'             => PRP_CLASS['admin'] . 'user-colors.php',
	PRP_CLASS_NS . '\Admin\Dashboard'               => PRP_CLASS['admin'] . 'dashboard.php',
	PRP_CLASS_NS . '\Admin\Posts_List_Table'        => PRP_CLASS['admin'] . 'posts-list-table.php',
	PRP_CLASS_NS . '\Admin\Post_Edit'               => PRP_CLASS['admin'] . 'post-edit.php',

	// Frontend classes.
	PRP_CLASS_NS . '\Front\Frontend'         => PRP_CLASS['front'] . 'frontend.php',
	PRP_CLASS_NS . '\Front\Title_Filter'     => PRP_CLASS['front'] . 'title-filter.php',
	PRP_CLASS_NS . '\Front\Content_Filter'   => PRP_CLASS['front'] . 'content-filter.php',
	PRP_CLASS_NS . '\Front\Template_Filters' => PRP_CLASS['front'] . 'template-filters.php',
	PRP_CLASS_NS . '\Front\Content_Sample'   => PRP_CLASS['front'] . 'content-sample.php',
	PRP_CLASS_NS . '\Front\Meta\Meta_Data'   => PRP_CLASS['front'] . 'meta-data.php',
	PRP_CLASS_NS . '\Front\Meta\Meta_Tags'   => PRP_CLASS['front'] . 'meta-tags.php'

	// General/miscellaneous classes.

] );

/**
 * Autoload class files
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
spl_autoload_register(
	function ( string $class ) {
		if ( isset( PRP_CLASSES[ $class ] ) ) {
			require PRP_CLASSES[ $class ];
		}
	}
);
