<?php
/**
 * File provided for rendering collapsed choice type option elements
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php use Symfony\Component\Form\ChoiceList\View\ChoiceGroupView; ?>
<?php foreach ( $choices as $group_label => $choice ) : ?>
	<?php if ( is_array( $choice ) || $choice instanceof ChoiceGroupView ) : ?>
		<optgroup label="<?php echo esc_attr( $group_label ); ?>">
			<?php // @codingStandardsIgnoreStart Choice widget options has own escape ?>
			<?php echo $view['form']->block( $form, 'choice_widget_options', array(
				'choices' => $choice,
			) ) ?>
			<?php // @codingStandardsIgnoreEnd ?>
		</optgroup>
	<?php else : ?>
		<?php
			$choice_attr = $choice->attr;
			$choice_attr['value'] = $choice->value;
			$choice_attr['selected'] = $is_selected($choice->value, $value);
		?>
		<?php // @codingStandardsIgnoreStart Attribute block has own escape ?>
		<option <?php echo $view['form']->block( $form, 'attributes', array(
			'attr' => $choice_attr,
		) ); ?>><?php echo esc_html( $choice->label ); ?></option>
		<?php // @codingStandardsIgnoreEnd ?>
	<?php endif ?>
<?php endforeach ?>
