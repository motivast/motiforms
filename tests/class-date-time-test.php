<?php
/**
 * The file that defines date time test class
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/tests
 */

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Templating\PhpEngine;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DomCrawler\Crawler;

/**
 * The class provided for test date and time fields
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/tests
 */
class Date_Time_Test extends WP_UnitTestCase {

	/**
	 * Test rendering date time type field
	 */
	function test_rendering_date_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'date', DateType::class );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$selects = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_date' );

		$this->assertEquals( 3, count( $selects->children() ) );

		$this->assertEquals( 'form[date][day]', $selects->filter( '#form_date_day' )->attr( 'name' ) );
		$this->assertEquals( 'form[date][month]', $selects->filter( '#form_date_month' )->attr( 'name' ) );
		$this->assertEquals( 'form[date][year]', $selects->filter( '#form_date_year' )->attr( 'name' ) );
	}

	/**
	 * Test rendering single date time type field
	 */
	function test_rendering_single_date_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'date', DateType::class, array(
			'widget' => 'single_text',
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$input = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_date' );

		$this->assertEquals( 'date', $input->attr( 'type' ) );
	}
}
