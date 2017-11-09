<?php
/**
 * File provided for rendering collapsed choice type elemenets
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php if ( $required && null === $placeholder && false === $placeholder_in_choices && false === $multiple && ( ! isset( $attr['size'] ) || $attr['size'] <= 1) ) :
	$required = false;
endif; ?>
<?php
	$attributes = array(
		'name' => $full_name,
		'id' => $id,
		'disabled' => $disabled,
		'required' => $required,
		'multiple' => ($multiple) ? true : false,
	);
	 // @codingStandardsIgnoreStart Attribute block has own escape ?>
<select <?php echo $view['form']->block( $form, 'attributes', array(
		'attr' => $attributes,
) ) ?>>
<?php // @codingStandardsIgnoreEnd ?>
	<?php if ( null !== $placeholder ) : ?>
		<?php // @codingStandardsIgnoreStart Attribute block has own escape ?>
		<option <?php echo $view['form']->block( $form, 'attributes', array(
			'attr' => array(
				'value' => '',
				'selected' => ($required && empty( $value ) && '0' !== $value) ? true : false,
			),
		) ) ?>><?php echo esc_html( $placeholder ); ?></option>
		<?php // @codingStandardsIgnoreEnd ?>
	<?php endif; ?>
	<?php if ( count( $preferred_choices ) > 0 ) : ?>
		<?php // @codingStandardsIgnoreStart Choice widget options has own escape ?>
		<?php echo $view['form']->block( $form, 'choice_widget_options', array(
			'choices' => $preferred_choices,
		) ) ?>
		<?php // @codingStandardsIgnoreEnd ?>
		<?php if ( count( $choices ) > 0 && null !== $separator ) : ?>
			<option disabled="disabled"><?php echo esc_html( $separator ); ?></option>
		<?php endif ?>
	<?php endif ?>
	<?php // @codingStandardsIgnoreStart Choice widget options has own escape ?>
	<?php echo $view['form']->block( $form, 'choice_widget_options', array(
		'choices' => $choices,
	) ) ?>
	<?php // @codingStandardsIgnoreEnd ?>
</select>
