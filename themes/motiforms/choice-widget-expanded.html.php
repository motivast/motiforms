<?php
/**
 * File provided for rendering expanded choice type elemenets
 *
 * @link       http://motivast.com
 * @since      1.0.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php
	$container_attributes = array(
		'id' => $id,
	);
?>
<div <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine We will escape when we will display form
	'attr' => $container_attributes,
) ) ?>>
	<?php foreach ( $form as $child ) : ?>
	    <?php echo $view['form']->widget($child); // @codingStandardsIgnoreLine We will escape when we will display form ?>
	    <?php echo $view['form']->label($child); // @codingStandardsIgnoreLine We will escape when we will display form ?>
	<?php endforeach ?>
</div>
