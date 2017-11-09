<?php
/**
 * File provided for rendering button element
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

if ( ! $label ) {
	$label = isset( $label_format ) ? strtr( $label_format, array(
		'%name%' => $name,
		'%id%' => $id,
	) ) : $view['form']->humanize( $name );
}

	$attributes = array(
		'type' => isset( $type ) ? $type : 'button',
		'id' => $id,
		'name' => $full_name,
		'disabled' => $disabled,
	);
?>
<button <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine Attribute block has own escape
	'attr' => $attributes,
) ) ?>><?php echo esc_html( $label ); ?></button>
