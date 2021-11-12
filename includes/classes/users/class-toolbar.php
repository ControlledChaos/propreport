<?php
/**
 * User toolbar class
 *
 * User and social media methods for
 * use in the user toolbar. Largely
 * built for compatibility with the
 * BuddyBoss Platform plugin but should
 * also work with BuddyPress & bbPress.
 *
 * @package    Prop_Report
 * @subpackage Classes
 * @category   Users
 * @since      1.0.0
 */

namespace PropReport\Classes\Users;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Toolbar {

	/**
	 * The class object
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected static $class_object;

	/**
	 * Instance of the class
	 *
	 * This method can be used to call an instance
	 * of the class from outside the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns an instance of the class.
	 */
	public static function instance() {

		if ( is_null( self :: $class_object ) ) {
			self :: $class_object = new self();
		}

		// Return the instance.
		return self :: $class_object;
	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {}

	/**
	 * Profile link
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the URL of the link.
	 */
	public function profile_link() {}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object Toolbar Returns an instance of the class.
 */
function toolbar() {
	return Toolbar :: instance();
}
