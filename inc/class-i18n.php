<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this theme
 * so that it is ready for translation.
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/inc
 * @author     Motivast <support@motivast.com>
 */

namespace Motiforms;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this themes
 * so that it is ready for translation.
 *
 * @since      0.1.0
 * @package    Motiforms
 * @subpackage Motiforms/inc
 * @author     Motivast <support@motivast.com>
 */
class I18n {

	/**
	 * Theme container.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object $theme Motiforms Theme container
	 */
	private $theme;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    object $theme Motiforms Theme container.
	 */
	public function __construct( $theme ) {

		$this->theme = $theme;

	}

	/**
	 * Load the theme text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_theme_textdomain() {

		load_theme_textdomain(
			'motiforms',
			$this->theme['path'] . '/languages'
		);

	}
}
