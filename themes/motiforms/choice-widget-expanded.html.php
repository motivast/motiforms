<?php
/**
 * File provided for rendering expanded choice type elemenets
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

	$field_input_label_classes  = array( 'field__input__label' );
	$field_input_choice_classes = array( 'field__input__choice' );
	$field_input_choice_wrapper_classes = array( 'field__input__choice__wrapper' );

	if ( $multiple ) {
		$field_input_label_classes  = array( 'field__input__label--checkbox' );
		$field_input_choice_classes = array( 'field__input__choice--checkbox' );
		$field_input_choice_wrapper_classes = array( 'field__input__choice__wrapper--checkbox' );
	} else {
		$field_input_label_classes  = array( 'field__input__label--radio' );
		$field_input_choice_classes = array( 'field__input__choice--radio' );
		$field_input_choice_wrapper_classes = array( 'field__input__choice__wrapper--radio' );
	}
?>
<div <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine Attribute block has own escape
	'attr' => $container_attributes,
) ) ?>>
	<?php foreach ( $form as $child ) : ?>
		<div class="<?php echo esc_attr( join( ' ', $field_input_choice_wrapper_classes ) ); ?>">
			<div class="<?php echo esc_attr( join( ' ', $field_input_choice_classes ) ); ?>">
				<?php echo $view['form']->widget($child); // @codingStandardsIgnoreLine Radion and Checkbox widget has own escape ?>
			</div>
			<div class="<?php echo esc_attr( join( ' ', $field_input_label_classes ) ); ?>">
				<?php echo $view['form']->label($child);  // @codingStandardsIgnoreLine Label widget has own escape ?>
			</div>
		</div>
	<?php endforeach ?>
</div>
