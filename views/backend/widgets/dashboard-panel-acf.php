<?php
/**
 * Custom dashboard panel ACF output
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Widgets
 * @since      1.0.0
 */

/**
 * Panel tabs
 *
 * The customize panel is only available
 * to user who can customize themes.
 */
if ( current_user_can( 'customize' ) ) {
	$theme_tab = sprintf(
        '<li class="content-tab"><a href="%1s"><span class="dashicons dashicons-art"></span> %2s</a></li>',
		'#customize',
       __( 'Customize', 'bernays' )
	);
} else {
	$theme_tab = null;
}

$tabs = apply_filters( 'scp_dashboard_panel_tabs', [

    // Welcome tab, initially active.
    sprintf(
        '<li class="content-tab active"><a href="%1s"><span class="dashicons dashicons-welcome-learn-more"></span> %2s</a></li>',
        '#welcome',
        __( 'Welcome', 'bernays' )
	),

	// Theme tab.
    $theme_tab
] );

?>
<div id="dashboard-panel" class="dashboard-panel">
	<div class="admin-tabs" data-tabbed="tabbed" data-tabdeeplinking="false">

		<ul class="admin-tabs-list hide-if-no-js">
			<?php echo implode( $tabs ); ?>
		</ul>
		<?php

		// Welcome tab.
		include_once( PRP_PATH . 'views/backend/widgets/welcome-dashboard-tab' . $acf->suffix() . '.php' );

		// Customize tab.
		if ( current_user_can( 'customize' ) ) {
			include_once( PRP_PATH . 'views/backend/widgets/customize-dashboard-tab' . $acf->suffix() . '.php' );
		}
		?>
	</div>
</div>
