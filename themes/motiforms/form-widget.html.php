<?php
/**
 * File provided for decide which widget to render compound or not
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php if ( $compound ) : ?>
	<?php echo $view['form']->block( $form, 'form_widget_compound' ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
<?php else : ?>
	<?php echo $view['form']->block( $form, 'form_widget_simple' ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
<?php endif;
