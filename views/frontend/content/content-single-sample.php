<?php
/**
 * Content for singular sample post type
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Front
 * @since      1.0.0
 */

printf(
	'<p>%s%s</p>',
	__( 'Filtered content for post #', 'propreport' ),
	get_the_ID()
);

// Or use...
// echo get_the_content( get_the_ID() );
