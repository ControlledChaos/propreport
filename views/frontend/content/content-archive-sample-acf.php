<?php
/**
 * ACF content for sample post type archive
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Front
 * @since      1.0.0
 */

printf(
	'<p>%s%s</p>',
	__( 'ACF content for archived post #', 'propreport' ),
	get_the_ID()
);
