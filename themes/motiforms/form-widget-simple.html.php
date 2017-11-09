<?php
/**
 * File provided for rendering simple input element
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
		'type' => isset( $type ) ? $type : 'text',
		'name' => $full_name,
		'value' => $value,
		'id' => $id,
		'disabled' => $disabled,
		'required' => $required,
	);
?>

<input <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine We will escape when we will display form
	'attr' => $attributes,
) ) ?> />
