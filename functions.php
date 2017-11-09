<?php
/**
 * Plugins functions file
 *
 * This file provide api function
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms
 * @author     Motivast <support@motivast.com>
 */

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\HttpFoundation\Request;

if ( ! function_exists( 'mf_get_factory' ) ) {

	/**
	 * Get form factory
	 *
	 * @since 1.0.0
	 *
	 * @return FormFactoryInterface
	 */
	function mf_get_factory() {

		$motiforms = motiforms();

		return $motiforms['setup']->get_factory();
	}
}

if ( ! function_exists( 'mf_get_engine' ) ) {

	/**
	 * Get view engine
	 *
	 * @since 1.0.0
	 *
	 * @return PhpEngine
	 */
	function mf_get_engine() {

		$motiforms = motiforms();

		return $motiforms['setup']->get_engine();
	}
}

if ( ! function_exists( 'mf_get_request' ) ) {

	/**
	 * Get request
	 *
	 * @since 1.0.0
	 *
	 * @return Request
	 */
	function mf_get_request() {

		$motiforms = motiforms();

		return $motiforms['setup']->get_request();
	}
}
