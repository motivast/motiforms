<?php
/**
 * The file that defines hidden test class
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/tests
 */

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use Symfony\Component\Templating\PhpEngine;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DomCrawler\Crawler;

/**
 * The class provided for test hidden fields
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/tests
 */
class Hidden_Test extends WP_UnitTestCase {

	/**
	 * Test rendering hidden type field
	 */
	function test_rendering_hidden_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'hidden', HiddenType::class );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$hidden = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_hidden' );

		$this->assertEquals( 'input', $hidden->nodeName() );
		$this->assertEquals( 'hidden', $hidden->attr( 'type' ) );
		$this->assertEquals( 'form[hidden]', $hidden->attr( 'name' ) );
	}
}
