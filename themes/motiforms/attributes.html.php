<?php
/**
 * File provided for rendering atributes html elements
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/theme/motiform
 * @author     Motivast <support@motivast.com>
 */

?>
<?php foreach ( $attr as $k => $v ) : ?>
<?php if ( 'placeholder' === $k || 'title' === $k ) : ?>
<?php printf( '%s="%s" ', esc_attr( $k ), esc_attr( $v ) ); // @codingStandardsIgnoreLine Translate $v , we do not know string ?>
<?php elseif ( true === $v ) : ?>
<?php printf( '%s="%s" ', esc_attr( $k ), esc_attr( $k ) ) ?>
<?php elseif ( false !== $v && ( ! empty( $v ) || is_numeric( $v )) ) : ?>
<?php printf( '%s="%s" ', esc_attr( $k ), esc_attr( $v ) ) ?>
<?php endif ?>
<?php endforeach;
