<?php
/*                                                                        *
 * This script belongs to the TYPO3 package "vhc".                        *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Formats the given string with htmlspecialchars()
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <vhc:format.htmlspecialchars>Me & you</vhc:format.htmlspecialchars>
 * </code>
 *
 * Output:
 * Me &amp; you
 *
 * @package vhc
 * @subpackage ViewHelpers\Format
 * @author Daniel Regelein <daniel.regelein@diehl-informatik.de>
 */
class Tx_Vhc_ViewHelpers_Format_HtmlSpecialCharsViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * hsc's the given string
	 *
	 * @param string $content The string to format
	 * @return string The hsc'd string
	 * @author Daniel Regelein <daniel.regelein@diehl-informatik.de>
	 * @api
	 */
	public function render( $content = null ) {
		if ( $content === null ) {
			$content = $this->renderChildren();
			if ( $content === NULL ) {
				return '';
			}
		}
		return htmlspecialchars( $content );
	}
}
?>