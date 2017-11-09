<?php
/**
 * File provided for rendering text type input elemenet with provided money data
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php echo str_replace( '{{ widget }}', $view['form']->block( $form, 'form_widget_simple' ), $money_pattern );  // @codingStandardsIgnoreLine We will escape when we will display form
