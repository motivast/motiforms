<?php
/**
 * Class provided for setup symfony forms
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/inc
 * @author     Motivast <support@motivast.com>
 */

namespace Motiforms;

use Symfony\Component\Form\Forms;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Extension\Templating\TemplatingExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\Loader\FilesystemLoader;

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class provided for setup symfony forms
 *
 * @since      0.1.0
 * @package    Motiforms
 * @subpackage Motiforms/inc
 * @author     Motivast <support@motivast.com>
 */
class Setup {

	/**
	 * Determine if plugin is setup
	 *
	 * @var bool
	 */
	private $is_setup = false;

	/**
	 * Symfony validator
	 *
	 * @var ValidatorInterface
	 */
	private $validator;

	/**
	 * Symfony translator
	 *
	 * @var TranslatorInterface
	 */
	private $translator;

	/**
	 * Symfony template engine
	 *
	 * @var PhpEngine;
	 */
	private $engine;

	/**
	 * Symfony request object
	 *
	 * @var Request;
	 */
	private $request;

	/**
	 * Symfony form builder
	 *
	 * @var FormBuilderInterface;
	 */
	private $builder;

	/**
	 * Theme container.
	 *
	 * @param Motiforms\Init $plugin Motiforms plugin container.
	 */
	public function __construct( $plugin ) {

		$this->plugin = $plugin;

		define( 'VENDOR_FORM_DIR', plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/symfony/form' );
		define( 'VENDOR_VALIDATOR_DIR', plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/symfony/validator' );
		define( 'VENDOR_THEME_DIR', plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/symfony/framework-bundle/Resources/views/Form' );

		$this->define_hooks();
	}

	/**
	 * Setup symfony forms
	 */
	public function setup() {

		$this->setup_validator();
		$this->setup_translator();
		$this->setup_engine();
		$this->setup_form_factory();
		$this->setup_request_object();

		$this->is_setup = true;
	}

	/**
	 * Check if symfony forms are setup
	 *
	 * @return bool
	 */
	public function is_setup() {

		return $this->is_setup;
	}

	/**
	 * Get form factory
	 *
	 * @return FormFactoryInterface
	 */
	public function get_factory() {

		if ( ! $this->is_setup() ) {
			$this->setup();
		}

		return $this->builder->getFormFactory();
	}

	/**
	 * Get template engine
	 *
	 * @return PhpEngine
	 */
	public function get_engine() {

		if ( ! $this->is_setup() ) {
			$this->setup();
		}

		return $this->engine;
	}

	/**
	 * Get request object
	 *
	 * @return Request
	 */
	public function get_request() {

		if ( ! $this->is_setup() ) {
			$this->setup();
		}

		return $this->request;
	}

	/**
	 * Allow form related html elements
	 *
	 * Method executed by wp_kses_allowed_html hook to provide e.g. input
	 * element to $allowedposttags global variable to not be filtered
	 * by wp_kses function.
	 *
	 * @param array $allowed Array of allowed elements.
	 *
	 * @return array
	 */
	public function allow_form_related_html_elements( $allowed ) {

		if ( is_array( $allowed ) ) {

			$allowed['form'] = array();
			$allowed['form']['action'] = true;
			$allowed['form']['method'] = true;
			$allowed['form']['enctype'] = true;
			$allowed['form']['id'] = true;
			$allowed['form']['class'] = true;

			$allowed['input'] = array();

			$allowed['input']['type'] = true;
			$allowed['input']['name'] = true;
			$allowed['input']['value'] = true;
			$allowed['input']['id'] = true;
			$allowed['input']['class'] = true;
			$allowed['input']['placeholder'] = true;
			$allowed['input']['checked'] = true;

			$allowed['textarea']['type'] = true;
			$allowed['textarea']['name'] = true;
			$allowed['textarea']['value'] = true;
			$allowed['textarea']['id'] = true;
			$allowed['textarea']['class'] = true;
			$allowed['textarea']['placeholder'] = true;
		}

		return $allowed;
	}

	/**
	 * Define hooks for setup class
	 */
	public function define_hooks() {

		$this->plugin['loader']->add_filter( 'wp_kses_allowed_html', $this, 'allow_form_related_html_elements' );
	}

	/**
	 * Setup symfony validator
	 */
	private function setup_validator() {

		$this->validator = Validation::createValidator();
	}

	/**
	 * Setup symfony translator
	 */
	private function setup_translator() {

		$this->translator = new Translator( get_locale() );
	}

	/**
	 * Setup symfony engine
	 */
	private function setup_engine() {

		$this->engine = new PhpEngine( new TemplateNameParser(), new FilesystemLoader( array(
			get_template_directory() . '/%name%',
			plugin_dir_path( dirname( __FILE__ ) ) . '/%name%',
		) ) );
		$this->engine->addHelpers( array( new TranslatorHelper( $this->translator ) ) );
	}

	/**
	 * Setup form factory
	 */
	private function setup_form_factory() {

		$this->builder = Forms::createFormFactoryBuilder();

		$this->builder->addExtension( new HttpFoundationExtension() );
		$this->builder->addExtension( new TemplatingExtension( $this->engine , null, array(
			VENDOR_THEME_DIR,
			plugin_dir_path( dirname( __FILE__ ) ) . 'themes/motiforms',
		)));

		$this->builder->addExtension( new ValidatorExtension( $this->validator ) );
	}

	/**
	 * Setup request object
	 */
	private function setup_request_object() {

		$this->request = Request::createFromGlobals();
	}
}
