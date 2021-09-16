<?php
/**
 * ACF content for sample post type in taxonomy archive
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Front
 * @since      1.0.0
 */

printf(
	'<p>%s%s</p>',
	__( 'ACF content for taxonomy post #', 'propreport' ),
	get_the_ID()
);
