<?php
/**
 * File provided for rendering date type field
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php if ( 'single_text' === $widget ) : ?>
	<?php echo $view['form']->block($form, 'form_widget_simple'); // @codingStandardsIgnoreLine Form widget simple has own escape ?>
<?php else: ?>
	<?php
		$attributes = $attr;
		$attributes['id'] = ( ! empty( $id )) ? $id : false;
	?>
	<div <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine Attribute block has own escape
		'attr' => $attributes,
	) ) ?>>
		<?php echo str_replace(array( '{{ year }}', '{{ month }}', '{{ day }}' ), array( // @codingStandardsIgnoreLine Form widget has own escape
			$view['form']->widget( $form['year'] ),
			$view['form']->widget( $form['month'] ),
			$view['form']->widget( $form['day'] ),
		), $date_pattern) ?>
	</div>
<?php endif ?>
