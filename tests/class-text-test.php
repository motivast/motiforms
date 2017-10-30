<?php
/**
 * Class Test
 *
 * @package Motiforms
 */

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Templating\PhpEngine;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DomCrawler\Crawler;


/**
 * Sample test case.
 */
class Text_Test extends WP_UnitTestCase {

	/**
	 * Test if get factory fucntion return proper class instance
	 */
	function test_get_factory_return_proper_class() {

		$factory = mf_get_factory();

		$this->assertInstanceOf( FormFactoryInterface::class, $factory );
	}

	/**
	 * Test if get engine function return proper class instance
	 */
	function test_get_engine_return_proper_class() {

		$engine = mf_get_engine();

		$this->assertInstanceOf( PhpEngine::class, $engine );
	}

	/**
	 * Test rendering simple form
	 */
	function test_creating_simple_form() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'tests/form/class-simple.php';

		$factory = mf_get_factory();
		$form = $factory->create( Motiforms\Tests\Form\Simple::class );

		$this->assertInstanceOf( FormInterface::class, $form );
	}

	/**
	 * Test rendering simple form
	 */
	function test_rendering_simple_form() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'tests/form/class-simple.php';

		$factory = mf_get_factory();
		$form = $factory->create( Motiforms\Tests\Form\Simple::class );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$first_name = $crawler->filter( 'form > #simple > .field > .field__label + .field__input > input#simple_first_name' );
		$last_name = $crawler->filter( 'form > #simple > .field > .field__label + .field__input > input#simple_last_name' );
		$message = $crawler->filter( 'form > #simple > .field > .field__label + .field__input > textarea#simple_message' );

		$this->assertEquals( 'input', $first_name->nodeName() );
		$this->assertEquals( 'text', $first_name->attr( 'type' ) );
		$this->assertEquals( 'simple_first_name', $first_name->attr( 'id' ) );
		$this->assertEquals( 'First name', $first_name->attr( 'placeholder' ) );

		$this->assertEquals( 'input', $last_name->nodeName() );
		$this->assertEquals( 'text', $last_name->attr( 'type' ) );
		$this->assertEquals( 'simple_last_name', $last_name->attr( 'id' ) );
		$this->assertEquals( 'Last name', $last_name->attr( 'placeholder' ) );

		$this->assertEquals( 'textarea', $message->nodeName() );
		$this->assertEquals( 'simple_message', $message->attr( 'id' ) );
		$this->assertEquals( 'Message', $message->attr( 'placeholder' ) );

	}

	/**
	 * Test rendering filled simple form
	 */
	function test_rendering_filled_simple_form() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'tests/form/class-simple.php';

		$factory = mf_get_factory();
		$form = $factory->create( Motiforms\Tests\Form\Simple::class, array(
			'first_name' => 'John',
			'last_name' => 'Smith',
			'message' => 'Hello world!',
		) );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$first_name = $crawler->filter( 'form > #simple > .field > .field__label + .field__input > input#simple_first_name' );
		$last_name = $crawler->filter( 'form > #simple > .field > .field__label + .field__input > input#simple_last_name' );
		$message = $crawler->filter( 'form > #simple > .field > .field__label + .field__input > textarea#simple_message' );

		$this->assertEquals( 'input', $first_name->nodeName() );
		$this->assertEquals( 'text', $first_name->attr( 'type' ) );
		$this->assertEquals( 'simple_first_name', $first_name->attr( 'id' ) );
		$this->assertEquals( 'First name', $first_name->attr( 'placeholder' ) );
		$this->assertEquals( 'John', $first_name->attr( 'value' ) );

		$this->assertEquals( 'input', $last_name->nodeName() );
		$this->assertEquals( 'text', $last_name->attr( 'type' ) );
		$this->assertEquals( 'simple_last_name', $last_name->attr( 'id' ) );
		$this->assertEquals( 'Last name', $last_name->attr( 'placeholder' ) );
		$this->assertEquals( 'Smith', $last_name->attr( 'value' ) );

		$this->assertEquals( 'textarea', $message->nodeName() );
		$this->assertEquals( 'simple_message', $message->attr( 'id' ) );
		$this->assertEquals( 'Message', $message->attr( 'placeholder' ) );
		$this->assertEquals( 'Hello world!', $message->html() );

	}

	/**
	 * Test rendering filled simple with errors
	 */
	function test_rendering_simple_form_with_errors() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'tests/form/class-simple.php';

		$factory = mf_get_factory();
		$form = $factory->create( Motiforms\Tests\Form\Simple::class );

		$_POST = array(
			'simple' => array(
				'first_name' => '',
				'last_name' => '',
				'message' => '',
			),
		);

		$request = Request::createFromGlobals();
		$request->setMethod( Request::METHOD_POST );

		$form->handleRequest( $request );

		// Validate form to force errors.
		$valid = $form->isValid();

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$first_name_errors = $crawler->filter( 'form > #simple > .field--errors:nth-child(1) > .field--errors__label + .field--errors__input + .field--text__errors > ul > li' );
		$last_name_errors = $crawler->filter( 'form > #simple > .field--errors:nth-child(2) > .field--errors__label + .field--errors__input + .field--text__errors > ul > li' );
		$message_errors = $crawler->filter( 'form > #simple > .field--errors:nth-child(3) > .field--errors__label + .field--errors__input + .field--textarea__errors > ul > li' );

		$this->assertEquals( 'This value should not be blank.', $first_name_errors->text() );
		$this->assertEquals( 'This value should not be blank.', $last_name_errors->text() );
		$this->assertEquals( 'This value should not be blank.', $message_errors->text() );

	}
}