<?php
/**
 * File provided for rendering form opening tag
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php
	$method = strtoupper( $method );
	$form_method = 'GET' === $method || 'POST' === $method ? $method : 'POST';

	$attributes = array(
		'name' => $name,
		'method' => strtolower( $form_method ),
		'action' => $action,
		'enctype' => ($multipart) ? 'multipart/form-data' : false,
	);

	$attributes = array_merge( $attributes, $attr );
?>

<form <?php echo $view['form']->block( $form, 'attributes', array( // @codingStandardsIgnoreLine We will escape when we will display form
	'attr' => $attributes,
) ); ?>>

<?php if ( $form_method !== $method ) : ?>
	<input type="hidden" name="_method" value="<?php echo esc_attr( $method ); ?>" />
<?php endif ?>
