<?php
/**
 * ACF welcome dashboard tab
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Widgets
 * @since      1.0.0
 */

// Get the current user data for the greeting.
$current_user = wp_get_current_user();
$user_id      = get_current_user_id();
$user_name    = $current_user->display_name;
$avatar       = get_avatar(
	$user_id,
	64,
	'',
	$current_user->display_name,
	[
		'class'         => 'dashboard-panel-avatar alignnone',
		'force_display' => true
		]
);

?>
<div id="welcome" class="dashboard-panel-content dashboard-welcome-content">

	<?php echo sprintf(
		'<h2>%s %s</h2>',
		__( 'Welcome to', 'bernays' ),
		get_bloginfo( 'name' )
	); ?>
	<p class="about-description"><?php _e( 'We\'ve assembled some links to get you started.', 'bernays' ); ?></p>

	<div class="dashboard-panel-column-container">

		<div id="dashboard-get-started" class="dashboard-panel-column">
			<h3><?php _e( 'Get Started', 'bernays' ); ?></h3>
			<div class="dashboard-panel-section-intro dashboard-panel-user-greeting">

				<figure>
					<a href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>">
						<?php echo $avatar; ?>
					</a>
					<figcaption class="screen-reader-text"><?php echo $user_name; ?></figcaption>
				</figure>

				<div>
					<?php echo sprintf(
						'<h4>%1s %2s.</h4>',
						esc_html__( 'Howdy,', 'bernays' ),
						$user_name
					); ?>
					<p class="about-description"><?php _e( 'This site may display your profile in posts that you author, and it offers user-defined color schemes.', 'bernays' ); ?></p>
					<p class="dashboard-panel-call-to-action"><a class="button button-primary button-hero" href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>"><?php _e( 'Manage Your Profile', 'bernays' ); ?></a></p>
					<p class="description"><?php _e( 'Edit your display name & bio.', 'bernays' ); ?></p>
				</div>

			</div>
		</div>

		<div id="dashboard-next-steps" class="dashboard-panel-column">
			<h3><?php _e( 'Next Steps', 'bernays' ); ?></h3>
			<ul>

			<?php if (
				'page' == get_option( 'show_on_front' ) &&
				! get_option( 'page_for_posts' )
			) : ?>
				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-edit-page">' . __( 'Edit your front page', 'bernays' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>

				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-add-page">' . __( 'Add additional pages', 'bernays' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>

			<?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-edit-page">' . __( 'Edit your front page', 'bernays' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>

				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-add-page">' . __( 'Add additional pages', 'bernays' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>

				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-write-blog">' . __( 'Add a blog post', 'bernays' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>

			<?php else : ?>
				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-write-blog">' . __( 'Write your first blog post', 'bernays' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>

				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-add-page">' . __( 'Add an About page', 'bernays' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>

				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-setup-home">' . __( 'Set up your homepage', 'bernays' ) . '</a>', current_user_can( 'customize' ) ? add_query_arg( 'autofocus[section]', 'static_front_page', admin_url( 'customize.php' ) ) : admin_url( 'options-reading.php' ) ); ?></li>
			<?php endif; ?>

			<?php if ( current_user_can( 'manage_options' ) ) : ?>
				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-settings">' . __( 'Manage your settings', 'bernays' ) . '</a>', admin_url( 'options-general.php' ) ); ?></li>
			<?php endif; ?>
			</ul>
		</div>

		<div id="dashboard-more-actions" class="dashboard-panel-column dashboard-panel-last">
			<h3><?php _e( 'More Actions', 'bernays' ); ?></h3>
			<ul>

			<?php if ( current_user_can( 'upload_files' ) ) : ?>
				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-media">' . __( 'Manage media', 'bernays' ) . '</a>', admin_url( 'upload.php' ) ); ?></li>
			<?php endif; ?>

			<?php if ( current_theme_supports( 'widgets' ) ) : ?>
				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-widgets">' . __( 'Manage widgets', 'bernays' ) . '</a>', admin_url( 'widgets.php' ) ); ?></li>
			<?php endif; ?>

			<?php if ( current_theme_supports( 'menus' ) ) : ?>
				<li><?php printf( '<a href="%s" class="dashboard-icon dashboard-menus">' . __( 'Manage menus', 'bernays' ) . '</a>', admin_url( 'nav-menus.php' ) ); ?></li>
			<?php endif; ?>
			</ul>
		</div>

	</div>
</div>
