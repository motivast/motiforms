<?php
/**
 * The file that defines other test class
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/tests
 */

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Templating\PhpEngine;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\DomCrawler\Crawler;

/**
 * The class provided for test other fields
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/tests
 */
class Other_Test extends WP_UnitTestCase {

	/**
	 * Test rendering checkbox type field
	 */
	function test_rendering_checkbox_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'checkbox', CheckboxType::class );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$checkbox = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_checkbox' );

		$this->assertEquals( 'input', $checkbox->nodeName() );
		$this->assertEquals( 'checkbox', $checkbox->attr( 'type' ) );
		$this->assertEquals( 'form[checkbox]', $checkbox->attr( 'name' ) );
	}

	/**
	 * Test rendering file type field
	 */
	function test_rendering_file_type_field() {

		$factory = mf_get_factory();
		$form = $factory->create();

		$form->add( 'file', FileType::class );

		$form_view = $form->createView();

		$engine = mf_get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$file = $crawler->filter( 'form > #form > .field > .field__label + .field__input > #form_file' );

		$this->assertEquals( 'input', $file->nodeName() );
		$this->assertEquals( 'file', $file->attr( 'type' ) );
		$this->assertEquals( 'form[file]', $file->attr( 'name' ) );
	}
}
