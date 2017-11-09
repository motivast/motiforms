<?php
/**
 * File provided for rendering submit type button elemenet
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php echo $view['form']->block( $form, 'button_widget', array( // @codingStandardsIgnoreLine Button widget has own escape
	'type' => isset( $type ) ? $type : 'submit'
) );
