<?php
/**
 * File provided for rendering choice type elemenets
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php if ( $expanded ) : ?>
	<?php echo $view['form']->block($form, 'choice_widget_expanded'); // @codingStandardsIgnoreLine We will escape when we will display form ?>
<?php else: ?>
	<?php echo $view['form']->block($form, 'choice_widget_collapsed'); // @codingStandardsIgnoreLine We will escape when we will display form ?>
<?php endif ?>
