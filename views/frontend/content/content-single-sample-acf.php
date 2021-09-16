<?php
/**
 * ACF content for singular sample post type
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Front
 * @since      1.0.0
 */

printf(
	'<p>%s%s</p>',
	__( 'ACF content for post #', 'propreport' ),
	get_the_ID()
);
