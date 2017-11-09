<?php
/**
 * Class provided for parsing symfony form templates names to paths
 *
 * @link       http://motivast.com
 * @since      0.1.0
 *
 * @package    Motiforms
 * @subpackage Motiforms/inc
 * @author     Motivast <support@motivast.com>
 */

namespace Motiforms;

use Symfony\Component\Templating\TemplateNameParserInterface;
use Symfony\Component\Templating\TemplateReference;

/**
 * Class provided for parsing symfony form templates names to paths
 *
 * @since      0.1.0
 * @package    Motiforms
 * @subpackage Motiforms/inc
 * @author     Motivast <support@motivast.com>
 */
class TemplateNameParser implements TemplateNameParserInterface {

	/**
	 * Convert a template name to a TemplateReferenceInterface instance.
	 *
	 * @param string|TemplateReferenceInterface $name A template name or a TemplateReferenceInterface instance.
	 *
	 * @return TemplateReferenceInterface A template
	 */
	public function parse( $name ) {

		if ( false !== strpos( $name, ':' ) ) {
			$name = str_replace( ':', '/', $name );
		}

		$filename = basename( $name );
		$filename_converted = str_replace( '_', '-', $filename );

		$name = str_replace( $filename, $filename_converted, $name );

		return new TemplateReference( $name, 'php' );
	}
}
