<?php
/**
 * File provided for rendering time type field
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
	<?php echo $view['form']->block( $form, 'form_widget_simple' ); // @codingStandardsIgnoreLine Form widget simple has own escape ?>
<?php else : ?>
	<?php
		$attributes = $attr;
		$attributes['id'] = ( ! empty( $id )) ? $id : false;
	?>
	<?php $vars = $widget == 'text' ? array( 'attr' => array( 'size' => 1 ) ) : array(); // @codingStandardsIgnoreLine Prefer inline array notation in this case ?>
	<div <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine Attribute block has own escape
		'attr' => $attributes,
	) ) ?>>
		<?php
			// There should be no spaces between the colons and the widgets, that's why
			// this block is written in a single PHP tag
			echo $view['form']->widget( $form['hour'], $vars ); // @codingStandardsIgnoreLine Form widget simple has own escape

		if ( $with_minutes ) {
			echo ':';
			echo $view['form']->widget( $form['minute'], $vars ); // @codingStandardsIgnoreLine Form widget simple has own escape
		}

		if ( $with_seconds ) {
			echo ':';
			echo $view['form']->widget( $form['second'], $vars ); // @codingStandardsIgnoreLine Form widget simple has own escape
		}
		?>
	</div>
<?php endif ?>
