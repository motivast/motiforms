<?php
/**
 * Class Test
 *
 * @package Motiforms
 */

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Templating\PhpEngine;

use Symfony\Component\Form\FormInterface;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Sample test case.
 */
class Test extends WP_UnitTestCase {

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
}
