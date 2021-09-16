<?php
/**
 * Form fields for admin settings menu tab
 *
 * @package    Prop_Report
 * @subpackage Views
 * @category   Forms
 * @since      1.0.0
 */

namespace PropReport\Views\Admin;
use PropReport\Classes\Admin as Admin;

// Instance of the Manage_Website_Page class.
$page = new Admin\Admin_Settings_Page;


settings_fields( 'prp-site-admin-menu' );
do_settings_sections( 'prp-site-admin-menu' );

