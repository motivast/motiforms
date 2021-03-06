<?php
/**
 * File provided for rendering form elements without acctual form
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php foreach ( $form as $child ) : ?>
	<?php echo $view['form']->row( $child ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
<?php endforeach;
