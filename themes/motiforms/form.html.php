<?php
/**
 * File provided for rendering form html element
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php echo $view['form']->start( $form ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
	<?php echo $view['form']->widget( $form ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
<?php echo $view['form']->end( $form ); // @codingStandardsIgnoreLine We will escape when we will display form
