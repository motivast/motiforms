<?php
/**
 * Class provided for parsing symfony form templates names to paths
 *
 * @link       http://motivast.com
 * @since      1.0.0
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
 * @since      1.0.0
 * @package    Motiforms
 * @subpackage Motiforms/inc
 * @author     Motivast <support@motivast.com>
 */
class TemplateNameParser implements TemplateNameParserInterface {

	/**
	 * Root path
	 *
	 * @var string
	 */
	private $root;

	/**
	 * Template name parser constructor.
	 *
	 * @param string $root Root path.
	 */
	public function __construct( $root ) {
		$this->root = $root;
	}

	/**
	 * Convert a template name to a TemplateReferenceInterface instance.
	 *
	 * @param string|TemplateReferenceInterface $name A template name or a TemplateReferenceInterface instance.
	 *
	 * @return TemplateReferenceInterface A template
	 */
	public function parse( $name ) {

		if ( false !== strpos( $name, ':' ) ) {
			$path = str_replace( ':', '/', $name );
		} else {
			$path = $this->root . '/' . $name;
		}

		$filename = basename( $path );
		$filename_converted = str_replace( '_', '-', $filename );

		$path = str_replace( $filename, $filename_converted, $path );

		return new TemplateReference( $path, 'php' );
	}
}
