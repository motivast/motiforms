<?php
/**
 * File provided for rendering textarea element
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
		'name' => $full_name,
		'id' => $id,
		'disabled' => $disabled,
		'required' => $required,
	);
?>
<textarea <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine We will escape when we will display form
	'attr' => $attributes,
) ) ?>><?php echo esc_textarea( $value ) ?></textarea>
