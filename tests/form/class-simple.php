<?php
/**
 * Class provided for creating simple form for testing
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motivast
 * @subpackage Motivast/tests/form
 * @author     Motivast <support@motivast.com>
 */

namespace Motiforms\Tests\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class provided for submission form
 *
 * @since      0.1.0
 * @package    Motivast
 * @subpackage Motivast/inc/submission
 * @author     Motivast <support@motivast.com>
 */
class Simple extends AbstractType {

	/**
	 * Build simple form
	 *
	 * @param FormBuilderInterface $builder Form builder.
	 * @param array                $options Form options.
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {

		$not_blank = new NotBlank();

		$builder
			->add('first_name', TextType::class, array(
				'attr' => array(
					'placeholder' => 'First name',
				),
				'constraints' => array(
					$not_blank
				),
			))
			->add('last_name', TextType::class, array(
				'attr' => array(
					'placeholder' => 'Last name',
				),
				'constraints' => array(
					$not_blank
				),
			))
			->add('message', TextareaType::class, array(
				'attr' => array(
					'placeholder' => 'Message',
				),
				'constraints' => array(
					$not_blank
				),
			));
	}
}
