<?php
/**
 * File provided for rendering single form element
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

	$field_classes 		  	   = array( 'field' );
	$field_label_classes  	   = array( 'field__label' );
	$field_input_classes  	   = array( 'field__input' );
	$field_description_classes = array( 'field__description' );
	$field_errors_classes      = array( 'field__errors' );

if ( isset( $form->vars ) && isset( $form->vars['block_prefixes'] ) ) {

	$type_index = count( $form->vars['block_prefixes'] ) - 2;

	if ( isset( $form->vars['block_prefixes'][ $type_index ] ) ) {

		$type = $form->vars['block_prefixes'][ $type_index ];

		$field_classes[] 		  	 = 'field--' . $type;
		$field_label_classes[]  	 = 'field--' . $type . '__label';
		$field_input_classes[]  	 = 'field--' . $type . '__input';
		$field_description_classes[] = 'field--' . $type . '__description';
		$field_errors_classes[]      = 'field--' . $type . '__errors';
	}
}

if ( isset( $errors ) && count( $errors ) > 0 ) {

	$field_classes[] = 'field--errors';
	$field_label_classes[]  = 'field--errors__label';
	$field_input_classes[]  = 'field--errors__input';
}

?>

<div class="<?php echo esc_attr( join( ' ', $field_classes ) ) ?>">

	<?php if ( false !== $label ) : ?>
		<div class="<?php echo esc_attr( join( ' ', $field_label_classes ) ) ?>">
			<?php echo $view['form']->label( $form ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
		</div>
	<?php endif; ?>

	<div class="<?php echo esc_attr( join( ' ', $field_input_classes ) ) ?>">
		<?php echo $view['form']->widget( $form ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
	</div>

	<?php if ( isset( $errors ) && count( $errors ) > 0 ) : ?>
		<div class="<?php echo esc_attr( join( ' ', $field_errors_classes ) ) ?>">
			<?php echo $view['form']->errors( $form ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
		</div>
	<?php endif; ?>

	<?php if ( isset( $attr['description'] ) && ! empty( $attr['description'] ) ) : ?>
		<div class="<?php echo esc_attr( join( ' ', $field_description_classes ) ) ?>">
			<p><?php echo esc_html( $attr['description'] ); ?></p>
		</div>
	<?php endif; ?>

</div>

