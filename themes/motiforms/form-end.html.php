<?php
/**
 * File provided for rendering closing html form tag
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php if ( ! isset( $render_rest ) || $render_rest ) : ?>
<?php echo $view['form']->rest( $form ); // @codingStandardsIgnoreLine We will escape when we will display form ?>
<?php endif ?>
</form>
