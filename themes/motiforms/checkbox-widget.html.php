<?php
/**
 * File provided for rendering checkbox input element
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

	$attributes = array(
		'type' => 'checkbox',
		'name' => $full_name,
		'value' => $value,
		'id' => $id,
		'disabled' => $disabled,
		'required' => $required,
		'checked' => $checked,
	);
?>

<input <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine Attribute block has own escape
	'attr' => $attributes,
) ) ?> />
