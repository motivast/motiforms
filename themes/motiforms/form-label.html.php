<?php
/**
 * File provided for rendering form field label
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

if ( false !== $label ) {

	if ( $required ) {
		$label_attr['class'] = trim( (isset( $label_attr['class'] ) ? $label_attr['class'] : '') . ' required' );
	}

	if ( ! $compound ) {
		 $label_attr['for'] = $id;
	}

	if ( ! $label ) {

		if ( isset( $label_format ) ) {
			$label = strtr( $label_format, array(
				'%name%' => $name,
				'%id%' => $id,
			));
		} else {
			$label = $view['form']->humanize( $name );
		}
	}
}
?>
<?php if ( false !== $label ) : ?>
<label <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine Attribute block has own escape
	'attr' => $label_attr,
) ) ?>><?php echo esc_html( $label ); ?></label>
<?php endif ?>
