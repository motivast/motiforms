# Motiforms [![travis](https://img.shields.io/travis/rust-lang/rust.svg)](https://travis-ci.org/motivast/motiforms/)
Motiforms is a WordPress plugin provided for creating forms programmatically using Symfony framework. If you do not need form builder and want to create advanced forms check out Motiforms.

Go to [get started](#user-content-get-started) section to see a simple example.

## WARNING
If you are not developer this plugin is not for you. Motiforms do not provide any WordPress admin interface to creating forms.

## Features
- Handle form logic
- Field serialization
- Field validation
- Built in html rendering helpers
- Flexibility
- Based on advanced Symfony framework

## Installation
1. Download plugin from wordpres.org repository or [release section](https://github.com/motivast/motiforms/releases/latest).
2. Upload the motiforms directory to your /wp-content/plugins/ directory
3. Activate the plugin through the ‘Plugins’ menu in WordPress

## Get started
To create simple contact form paste code bellow to your functions.php file. And paste ```[contact]``` shortcode to your contact page.

```php
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactForm {

	/**
	 * Form instance
	 *
	 * FormType
	 */
	private $form;

	/**
	 * ContacForm constructor
	 *
	 * @return ContacForm
	 */
	public function __construct() {

		$this->define_hooks();
	}

	/**
	 * Create and process contact form
	 *
	 * This method is executed by wp action hook.
	 * It will be executed only on page which has contact
	 * shortcode.
	 *
	 * @return void
	 */
	public function controller() {

		global $post;

		// Check if current view is page and page has content shortcode
		if ( is_page() && has_shortcode( $post->post_content, 'contact' ) ) {

			$factory = mf_get_factory();

			// Create form
			$this->form = $factory->create();

			// Add fields to form
			$this->form->add( 'full_name', TextType::class );
			$this->form->add( 'email', EmailType::class );
			$this->form->add( 'message', TextareaType::class );
			$this->form->add( 'submit', SubmitType::class );

			// Get request object
			$request = mf_get_request();

			// Handle request
			$this->form->handleRequest( $request );

			// Check if form is valid
			if ( $this->form->isSubmitted() && $this->form->isValid() ) {

				// Get data from the form
				$data = $this->form->getData();

				// Define filters
				$filters = array(
					'full_name' => FILTER_SANITIZE_STRING,
					'email' => FILTER_SANITIZE_STRING | FILTER_SANITIZE_EMAIL,
					'message' => FILTER_SANITIZE_STRING,
				);

				// Fields sanitization
				$sanitized_data = filter_var_array( $data, $filters );

				// Perform action with form data e.g. send an e-mail

				// Redirect user with success parameter to prevent double submitting form
				wp_safe_redirect( $this->get_redirect_url() );
			}
		}
	}

	/**
	 * Render contact form.
	 *
	 * This method is executed by contact shortcode.
	 *
	 * @return string
	 */
	public function render() {

		$success =  filter_input( INPUT_GET, 'success', FILTER_SANITIZE_NUMBER_INT );

		if( '1' === $success ) {
			return sprintf('<h2>%s</h2>', __('Thank you for submitting the form. We will contact you shortly.') );
		}

		$form_view = $this->form->createView();

		$engine = mf_get_engine();

		return $engine['form']->form( $form_view, array('attr' => array('novalidate' => 'novalidate') ) );

	}

	/**
	 * Method executed by constructor to define hooks and
	 * create and render contact form.
	 *
	 * @return void
	 */
	private function define_hooks() {

		add_action( 'wp', array( $this, 'controller' ) );

		add_shortcode( 'contact', array( $this, 'render' ) );
	}

	/**
	 * Build url for form redirect
	 *
	 * @return string
	 */
	private function get_redirect_url() {

		$url = get_permalink();

		$query = parse_url($url, PHP_URL_QUERY);

		// Returns a string if the URL has parameters or NULL if not
		if ($query) {
			$url .= '&success=1';
		} else {
			$url .= '?success=1';
		}

		return $url;
	}
}

// Initialize contact form
new ContactForm();
```

## Documentation
Documentation for Motiforms can be found on github [wiki pages](https://github.com/motivast/motiforms/wiki).

## Contribute
Please make sure to read the [Contribution guide](https://github.com/motivast/motiforms/blob/master/CONTRIBUTING.md) before making a pull request.

Thank you to all the people who already contributed to Motiforms!

## License
The project is licensed under the [GNU GPLv3](https://github.com/motivast/motiforms/blob/master/LICENSE).

Copyright (c) 2017-present, Motivast
