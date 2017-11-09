<?php
/**
 * File provided for rendering form/element container with element inside
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php
	$container_attributes = array(
		'id' => $id,
	);
?>

<div <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine We will escape when we will display form
	'attr' => $container_attributes,
) ) ?>>

	<?php if ( ! $form->parent && $errors ) : ?>
		<?php echo $view['form']->errors( $form ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
	<?php endif ?>

	<?php echo $view['form']->block( $form, 'form_rows' ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
	<?php echo $view['form']->rest( $form ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
</div>
