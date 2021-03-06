<?php
/**
 * Plugin activation class
 *
 * The minimum PHP version is not included in the
 * plugin header because the admin notices here are
 * more elegant than the native `die()` screen
 * proveded by the management system.
 *
 * @package    Prop_Report
 * @subpackage Classes
 * @category   Activate
 * @since      1.0.0
 */

namespace PropReport\Classes\Activate;

// Alias namespaces.
use PropReport\Classes as Classes;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Activate {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {}

	/**
	 * Add & update options
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function options() {

		// Get default avatar option.
		$avatar = get_option( 'avatar_default' );
		$fresh  = get_option( 'fresh_site' );

		// Gravatar options to update/override.
		$gravatar = [
			'mystery',
			'mm',
			'blank',
			'gravatar_default',
			'identicon',
			'wavatar',
			'monsterid',
			'retro'
		];

		// Local avatars for option update.
		$mystery = esc_url( PRP_URL . 'assets/images/mystery.png' );
		$blank   = esc_url( PRP_URL . 'assets/images/blank.png' );

		/**
		 * If this is a fresh site, if no default is set, or if mystery Gravatar
		 * is set then update to the local mystery person avatar.
		 */
		if ( true == $fresh || ! $avatar || 'mystery' == $avatar ) {
			update_option( 'avatar_default', $mystery );

		// If the blank Gravatar is set then update to the local blank avatar.
		} elseif ( 'blank' == $avatar ) {
			update_option( 'avatar_default', $blank );

		// If any Gravatar is set then update to the local mystery person avatar.
		} elseif ( in_array( $avatar, $gravatar ) ) {
			update_option( 'avatar_default', $mystery );
		}
	}

	/**
	 * Get plugin row notice
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function get_row_notice() {

		// Add notice if the PHP version is insufficient.
		if ( ! Classes\php()->version() ) {
			add_action( 'after_plugin_row_' . PRP_BASENAME, [ $this, 'row_notice' ], 5, 3 );
		}
	}

	/**
	 * PHP deactivation notice: after plugin row
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the markup of the plugin row notice.
	 */
	public function row_notice( $plugin_file, $plugin_data, $status ) {

		$colspan = 4;

		// If WP  version< 5.5.
		if ( version_compare( $GLOBALS['wp_version'], '5.5', '<' ) ) {
			$colspan = 3;
		}

		?>
		<style>
			.plugins tr[data-plugin='<?php echo PRP_BASENAME; ?>'] th,
			.plugins tr[data-plugin='<?php echo PRP_BASENAME; ?>'] td {
				box-shadow: none;
			}

			<?php if ( isset( $plugin_data['update'] ) && ! empty( $plugin_data['update'] ) ) : ?>

				.plugins tr.<?php echo 'propreport'; ?>-plugin-tr td {
					box-shadow: none ! important;
				}

				.plugins tr.<?php echo 'propreport'; ?>-plugin-tr .update-message {
					margin-bottom: 0;
				}

			<?php endif; ?>
		</style>

		<tr id="plugin-php-notice" class="plugin-update-tr active <?php echo 'propreport'; ?>-plugin-tr">
			<td colspan="<?php echo $colspan; ?>" class="plugin-update colspanchange">
				<div class="update-message notice inline notice-error notice-alt">
					<?php echo sprintf(
						'<p>%s %s %s %s %s %s</p>',
						__( 'Functionality of the', 'propreport' ),
						PRP_NAME,
						__( 'plugin has been disabled because it requires PHP version', 'propreport' ),
						Classes\php()->minimum(),
						__( 'or greater. Your system is running PHP version', 'propreport' ),
						phpversion()
					); ?>
				</div>
			</td>
		</tr>
		<?php
	}

	/**
	 * PHP deactivation notice: admin header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the markup of the admin notice.
	 */
	public function php_deactivate_notice_header() {

	?>
		<div id="plugin-php-notice" class="notice notice-error is-dismissible">
			<?php echo sprintf(
				'<p>%s %s %s %s %s %s</p>',
				__( 'Functionality of the', 'propreport' ),
				PRP_NAME,
				__( 'plugin has been disabled because it requires PHP version', 'propreport' ),
				php()->minimum(),
				__( 'or greater. Your system is running PHP version', 'propreport' ),
				phpversion()
			); ?>
		</div>
	<?php

	}
}

/**
 * Activate plugin
 *
 * Puts an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function activation_class() {
	return new Activate;
}
