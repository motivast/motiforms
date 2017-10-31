<?php
/**
 * The file that defines choice test class
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/tests
 */

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Templating\PhpEngine;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DomCrawler\Crawler;

/**
 * The class provided for test choice fields
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/tests
 */
class Choice_Test extends WP_UnitTestCase {

	/**
	 * Test rendering collapsed choice type field
	 */
	function test_creating_collapsed_choice_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$available_choices = array(
			'Red'  => 'red',
			'Green' => 'green',
			'Blue' => 'blue',
		);

		$form->add( 'choice', ChoiceType::class, array(
			'choices' => $available_choices,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$red   = $crawler->filter( 'form > #form > .field > .field__label + .field__input > select > option:nth-child(1)' );
		$green = $crawler->filter( 'form > #form > .field > .field__label + .field__input > select > option:nth-child(2)' );
		$blue  = $crawler->filter( 'form > #form > .field > .field__label + .field__input > select > option:nth-child(3)' );

		$this->assertEquals( 'option', $red->nodeName() );
		$this->assertEquals( 'red', $red->attr( 'value' ) );
		$this->assertEquals( 'Red', $red->html() );

		$this->assertEquals( 'option', $green->nodeName() );
		$this->assertEquals( 'green', $green->attr( 'value' ) );
		$this->assertEquals( 'Green', $green->html() );

		$this->assertEquals( 'option', $blue->nodeName() );
		$this->assertEquals( 'blue', $blue->attr( 'value' ) );
		$this->assertEquals( 'Blue', $blue->html() );
	}

	/**
	 * Test rendering collapsed choice type field with enabled multiple option
	 */
	function test_creating_collapsed_choice_type_field_with_enabled_multiple_option() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$available_choices = array(
			'Red'  => 'red',
			'Green' => 'green',
			'Blue' => 'blue',
		);

		$form->add( 'choice', ChoiceType::class, array(
			'choices' => $available_choices,
			'multiple' => true,
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$select   = $crawler->filter( 'form > #form > .field > .field__label + .field__input > select' );

		$red   = $crawler->filter( 'form > #form > .field > .field__label + .field__input > select > option:nth-child(1)' );
		$green = $crawler->filter( 'form > #form > .field > .field__label + .field__input > select > option:nth-child(2)' );
		$blue  = $crawler->filter( 'form > #form > .field > .field__label + .field__input > select > option:nth-child(3)' );

		$this->assertEquals( 'multiple', $select->attr( 'multiple' ) );

		$this->assertEquals( 'option', $red->nodeName() );
		$this->assertEquals( 'red', $red->attr( 'value' ) );
		$this->assertEquals( 'Red', $red->html() );

		$this->assertEquals( 'option', $green->nodeName() );
		$this->assertEquals( 'green', $green->attr( 'value' ) );
		$this->assertEquals( 'Green', $green->html() );

		$this->assertEquals( 'option', $blue->nodeName() );
		$this->assertEquals( 'blue', $blue->attr( 'value' ) );
		$this->assertEquals( 'Blue', $blue->html() );
	}
}
