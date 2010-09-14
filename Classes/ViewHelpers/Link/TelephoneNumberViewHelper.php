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
 * Telephone number link view helper.
 * Generates a link to a telephone number for the usage with smart phones.
 *
 * = Examples
 *
 * <code title="basic tel link">
 * <l:Link.TelephoneNumber number="+49 (911) 947-2824" />
 * </code>
 *
 * Output:
 * <a href="tel:+499119470">+49 (911) 947-2824</a>
 *
 * <code title="Telephone number link with custom linktext">
 * <l:Link.TelephoneNumber number="+49 (911) 947-2824">some custom content</l:Link.TelephoneNumber number>
 * </code>
 *
 * Output:
 * <a href="tel:+499119470">some custom content</a>
 *
 * @package vhc
 * @subpackage ViewHelpers\Link
 * @author Daniel Regelein <daniel.regelein@diehl-informatik.de>
 */
class Tx_Vhc_ViewHelpers_Link_TelephoneNumberViewHelper extends Tx_Fluid_Core_ViewHelper_TagBasedViewHelper {

	protected $tagName = 'a';
	
	/**
	 * Arguments initialization
	 *
	 * @return void
	 * @author Bastian Waidelich <bastian@typo3.org>
	 */
	public function initializeArguments() {
		$this->registerUniversalTagAttributes();
		$this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
		$this->registerTagAttribute('rel', 'string', 'Specifies the relationship between the current document and the linked document');
		$this->registerTagAttribute('rev', 'string', 'Specifies the relationship between the linked document and the current document');
	}

	/**
	 * @param string $number The Number to parse
	 * @param string $type The Link type (default: "tel"), may also be "skype", "callme",...
	 * @return string Rendered telephone link
	 * @author Daniel Regelein <daniel.regelein@diehl-informatik.de>
	 */
	public function render( $number, $type='tel' ) {
		$linkText = $number;
		
		$tagContent = $this->renderChildren();
		if ($tagContent !== NULL) {
			$linkText = $tagContent;
		}
		$this->tag->setContent($linkText);
		$this->tag->addAttribute('href', $type.':' . self::clearPhoneNumber( $number ) );

		return $this->tag->render();
	}
	
	
	/**
	 * This method strips unwanted characters from the given telephone number, such as white spaces or brakets
	 * If found, the method Tx_DiehlCompanydatabase_Div::clearPhoneNumber is prefered thus it is already used 
	 * in other places
	 * 
	 * @param string $number The number to be parsed
	 * @return string parsed
	 * @static
	 * @author Daniel Regelein <daniel.regelein@diehl-informatik.de>
	 */
	private static function clearPhoneNumber( $number ) {
		$search = array( '(', ')', '-', ' ' );
		return str_replace( $search, '', $content );
	}
}


?>