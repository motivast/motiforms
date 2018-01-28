<?php
/**
 * Class setup test
 *
 * @package Motiforms
 */

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\DomCrawler\Crawler;

use Motiforms\Init;
use Motiforms\Loader;

/**
 * Setup test case
 */
class Setup_Test extends WP_UnitTestCase {

	/**
	 * Test if mf_theme_directories filter is called
	 */
	function test_mf_theme_directories_filter_is_executed() {

		// Create plugin container.
		$plugin = new Init();

		// Theme directories.
		$theme_directories = array(
			VENDOR_THEME_DIR,
			plugin_dir_path( dirname( __FILE__ ) ) . 'themes/motiforms',
		);

		// Mock loader.
		$loader = $this
			->getMockBuilder( Loader::class )
			->setConstructorArgs( array( $plugin ) )
			->setMethods( array( 'apply_filters' ) )
			->getMock();

		// Expect that loader will call `apply_filters` method with
		// `mf_theme_directories` and theme directories array and return array.
		$loader
			->expects( $this->once() )
			->method( 'apply_filters' )
			->with(
				$this->equalTo( 'mf_theme_directories' ),
				$this->equalTo( $theme_directories )
			)
			// We do not test what filter will return but only if it will
			// be called.
			->will( $this->returnValue( array() ) );

		// Replace default loader with mock.
		$plugin['loader'] = $loader;

		// Call setup method from setup class and expect that `apply_filters`
		// will be called.
		$plugin['setup']->setup();
	}

	/**
	 * Test if mf_theme_directories filter is working
	 */
	function test_mf_theme_directories_filter_will_change_themes() {

		// Add filter which we want to test is executed.
		add_filter( 'mf_theme_directories', array( $this, 'get_theme_directories' ) );

		// Create plugin container.
		$plugin = new Init();

		$factory = $plugin['setup']->get_factory();
		$form = $factory->create();

		$form->add( 'text', TextType::class );
		$form->add( 'email', EmailType::class );

		$form_view = $form->createView();

		$engine = $plugin['setup']->get_engine();

		$crawler = new Crawler( $engine['form']->form( $form_view ) );

		$text = $crawler->filter( 'form > #form > .field > .field__label + .field__input > input#form_text' );
		$email = $crawler->filter( 'form > #form > .field > .field__label + .field__input > input#form_email' );

		// Check if template will be overwritten.
		$this->assertEquals( 'input', $text->nodeName() );
		$this->assertEquals( 'text', $text->attr( 'type' ) );
		$this->assertEquals( 'my-test-theme-unique-attr', $text->attr( 'my-test-theme-unique-attr' ) );

		// Check if email will inherit from form-widget-simple.html.php test template.
		$this->assertEquals( 'input', $email->nodeName() );
		$this->assertEquals( 'email', $email->attr( 'type' ) );
		$this->assertEquals( 'my-test-theme-unique-attr', $email->attr( 'my-test-theme-unique-attr' ) );
	}

	/**
	 * Add test theme directory to $theme_directories
	 *
	 * @param array $theme_directories Available theme directories.
	 *
	 * @return array
	 */
	function get_theme_directories( $theme_directories ) {

		return array_merge( $theme_directories, array(
			dirname( __FILE__ ) . '/themes/test'
		));
	}
}
