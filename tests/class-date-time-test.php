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
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

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
	 * Test rendering date type field
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
	 * Test rendering single date type field
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

	/**
	 * Test rendering time type field
	 */
	function test_rendering_time_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'time', TimeType::class, array(
			'with_minutes' => true,
			'with_seconds' => true,
		));

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$selects = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_time' );

		$this->assertEquals( 3, count( $selects->children() ) );

		$this->assertEquals( 'form[time][hour]', $selects->filter( '#form_time_hour' )->attr( 'name' ) );
		$this->assertEquals( 'form[time][minute]', $selects->filter( '#form_time_minute' )->attr( 'name' ) );
		$this->assertEquals( 'form[time][second]', $selects->filter( '#form_time_second' )->attr( 'name' ) );
	}

	/**
	 * Test rendering single time type field
	 */
	function test_rendering_single_time_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'time', TimeType::class, array(
			'widget' => 'single_text',
			'with_minutes' => true,
			'with_seconds' => true,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$input = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_time' );

		$this->assertEquals( 'time', $input->attr( 'type' ) );
	}

	/**
	 * Test rendering choice date interval type field
	 */
	function test_rendering_choice_date_interval_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'interval', DateIntervalType::class, array(
			'widget' => 'choice',
			'with_days' => true,
			'with_hours' => true,
			'with_minutes' => true,
			'with_months' => true,
			'with_seconds' => true,
			'with_years' => true,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$selects = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_interval' );

		$this->assertEquals( 6, count( $selects->children() ) );

		$this->assertEquals( 'select', $selects->filter( '#form_interval_seconds' )->nodeName() );
		$this->assertEquals( 'select', $selects->filter( '#form_interval_minutes' )->nodeName() );
		$this->assertEquals( 'select', $selects->filter( '#form_interval_hours' )->nodeName() );
		$this->assertEquals( 'select', $selects->filter( '#form_interval_days' )->nodeName() );
		$this->assertEquals( 'select', $selects->filter( '#form_interval_months' )->nodeName() );
		$this->assertEquals( 'select', $selects->filter( '#form_interval_years' )->nodeName() );

		$this->assertEquals( 'form[interval][seconds]', $selects->filter( '#form_interval_seconds' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][minutes]', $selects->filter( '#form_interval_minutes' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][hours]', $selects->filter( '#form_interval_hours' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][days]', $selects->filter( '#form_interval_days' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][months]', $selects->filter( '#form_interval_months' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][years]', $selects->filter( '#form_interval_years' )->attr( 'name' ) );
	}

	/**
	 * Test rendering text date interval type field
	 */
	function test_rendering_text_date_interval_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'interval', DateIntervalType::class, array(
			'widget' => 'text',
			'with_days' => true,
			'with_hours' => true,
			'with_minutes' => true,
			'with_months' => true,
			'with_seconds' => true,
			'with_years' => true,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$selects = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_interval' );

		$this->assertEquals( 6, count( $selects->children() ) );

		$this->assertEquals( 'input', $selects->filter( '#form_interval_seconds' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_minutes' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_hours' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_days' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_months' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_years' )->nodeName() );

		$this->assertEquals( 'text', $selects->filter( '#form_interval_seconds' )->attr( 'type' ) );
		$this->assertEquals( 'text', $selects->filter( '#form_interval_minutes' )->attr( 'type' ) );
		$this->assertEquals( 'text', $selects->filter( '#form_interval_hours' )->attr( 'type' ) );
		$this->assertEquals( 'text', $selects->filter( '#form_interval_days' )->attr( 'type' ) );
		$this->assertEquals( 'text', $selects->filter( '#form_interval_months' )->attr( 'type' ) );
		$this->assertEquals( 'text', $selects->filter( '#form_interval_years' )->attr( 'type' ) );

		$this->assertEquals( 'form[interval][seconds]', $selects->filter( '#form_interval_seconds' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][minutes]', $selects->filter( '#form_interval_minutes' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][hours]', $selects->filter( '#form_interval_hours' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][days]', $selects->filter( '#form_interval_days' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][months]', $selects->filter( '#form_interval_months' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][years]', $selects->filter( '#form_interval_years' )->attr( 'name' ) );
	}

	/**
	 * Test rendering integer date interval type field
	 */
	function test_rendering_integer_date_interval_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'interval', DateIntervalType::class, array(
			'widget' => 'integer',
			'with_days' => true,
			'with_hours' => true,
			'with_minutes' => true,
			'with_months' => true,
			'with_seconds' => true,
			'with_years' => true,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$selects = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_interval' );

		$this->assertEquals( 6, count( $selects->children() ) );

		$this->assertEquals( 'input', $selects->filter( '#form_interval_seconds' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_minutes' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_hours' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_days' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_months' )->nodeName() );
		$this->assertEquals( 'input', $selects->filter( '#form_interval_years' )->nodeName() );

		$this->assertEquals( 'number', $selects->filter( '#form_interval_seconds' )->attr( 'type' ) );
		$this->assertEquals( 'number', $selects->filter( '#form_interval_minutes' )->attr( 'type' ) );
		$this->assertEquals( 'number', $selects->filter( '#form_interval_hours' )->attr( 'type' ) );
		$this->assertEquals( 'number', $selects->filter( '#form_interval_days' )->attr( 'type' ) );
		$this->assertEquals( 'number', $selects->filter( '#form_interval_months' )->attr( 'type' ) );
		$this->assertEquals( 'number', $selects->filter( '#form_interval_years' )->attr( 'type' ) );

		$this->assertEquals( 'form[interval][seconds]', $selects->filter( '#form_interval_seconds' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][minutes]', $selects->filter( '#form_interval_minutes' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][hours]', $selects->filter( '#form_interval_hours' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][days]', $selects->filter( '#form_interval_days' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][months]', $selects->filter( '#form_interval_months' )->attr( 'name' ) );
		$this->assertEquals( 'form[interval][years]', $selects->filter( '#form_interval_years' )->attr( 'name' ) );
	}

	/**
	 * Test rendering single text date interval type field
	 */
	function test_rendering_single_text_date_interval_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'interval', DateIntervalType::class, array(
			'widget' => 'single_text',
			'with_days' => true,
			'with_hours' => true,
			'with_minutes' => true,
			'with_months' => true,
			'with_seconds' => true,
			'with_years' => true,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$selects = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_interval' );

		$this->assertEquals( 'input', $selects->filter( '#form_interval' )->nodeName() );
		$this->assertEquals( 'text', $selects->filter( '#form_interval' )->attr( 'type' ) );
		$this->assertEquals( 'form[interval]', $selects->filter( '#form_interval' )->attr( 'name' ) );
	}

	/**
	 * Test rendering date time type field
	 */
	function test_rendering_date_time_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'date_time', DateTimeType::class, array(
			'with_minutes' => true,
			'with_seconds' => true,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$selects_date = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_date_time > #form_date_time_date' );
		$selects_time = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_date_time > #form_date_time_time' );

		$this->assertEquals( 3, count( $selects_date->children() ) );
		$this->assertEquals( 3, count( $selects_time->children() ) );

		$this->assertEquals( 'form[date_time][date][day]', $selects_date->filter( '#form_date_time_date_day' )->attr( 'name' ) );
		$this->assertEquals( 'form[date_time][date][month]', $selects_date->filter( '#form_date_time_date_month' )->attr( 'name' ) );
		$this->assertEquals( 'form[date_time][date][year]', $selects_date->filter( '#form_date_time_date_year' )->attr( 'name' ) );

		$this->assertEquals( 'form[date_time][time][hour]', $selects_time->filter( '#form_date_time_time_hour' )->attr( 'name' ) );
		$this->assertEquals( 'form[date_time][time][minute]', $selects_time->filter( '#form_date_time_time_minute' )->attr( 'name' ) );
		$this->assertEquals( 'form[date_time][time][second]', $selects_time->filter( '#form_date_time_time_second' )->attr( 'name' ) );
	}

	/**
	 * Test rendering single date time type field
	 */
	function test_rendering_single_date_time_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'datetime', DateTimeType::class, array(
			'widget' => 'single_text',
			'with_minutes' => true,
			'with_seconds' => true,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$input = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_datetime' );

		$this->assertEquals( 'datetime', $input->attr( 'type' ) );
	}

	/**
	 * Test rendering birthday type field
	 */
	function test_rendering_birthday_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'birthday', BirthdayType::class );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$selects = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_birthday' );

		$this->assertEquals( 3, count( $selects->children() ) );

		$this->assertEquals( 'form[birthday][day]', $selects->filter( '#form_birthday_day' )->attr( 'name' ) );
		$this->assertEquals( 'form[birthday][month]', $selects->filter( '#form_birthday_month' )->attr( 'name' ) );
		$this->assertEquals( 'form[birthday][year]', $selects->filter( '#form_birthday_year' )->attr( 'name' ) );
	}

	/**
	 * Test rendering single birthday type field
	 */
	function test_rendering_single_birthday_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'birthday', BirthdayType::class, array(
			'widget' => 'single_text',
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$input = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_birthday' );

		$this->assertEquals( 'date', $input->attr( 'type' ) );
	}
}
