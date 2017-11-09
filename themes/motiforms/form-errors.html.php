<?php
/**
 * File provided for rendering form errors
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php if ( count( $errors ) > 0 ) : ?>
	<ul>
		<?php foreach ( $errors as $error ) : ?>
			<li><?php echo $error->getMessage(); // @codingStandardsIgnoreLine We will escape when we will display form ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif ?>
