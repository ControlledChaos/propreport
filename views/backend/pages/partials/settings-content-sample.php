<?php
/**
 * Content settings sample tab
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Forms
 * @since      1.0.0
 */

namespace PropReport\Views\Admin;
use PropReport\Classes\Admin as Admin;

// Instance of the Manage_Website_Page class.
$page = new Admin\Content_Settings;

?>
<div>
	<p><?php _e( 'Sample tab content.', 'propreport' ); ?></p>
</div>
