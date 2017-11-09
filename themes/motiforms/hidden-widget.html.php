<?php
/**
 * File provided for rendering hidden type input elemenet
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php echo $view['form']->block( $form, 'form_widget_simple', array( // @codingStandardsIgnoreLine We will escape when we will display form
	'type' => isset( $type ) ? $type : 'hidden'
) );
