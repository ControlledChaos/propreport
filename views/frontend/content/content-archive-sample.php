<?php
/**
 * Content for sample post type archive
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Front
 * @since      1.0.0
 */

printf(
	'<p>%s%s</p>',
	__( 'Filtered content for archived post #', 'propreport' ),
	get_the_ID()
);

// Or use...
// echo get_the_excerpt( get_the_ID() );
// echo get_the_content( get_the_ID() );
