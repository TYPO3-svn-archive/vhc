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
 * @package vhc
 * @subpackage ViewHelpers\Format
 * @author Daniel Regelein <daniel.regelein@diehl-informatik.de>
 */
class Tx_Vhc_ViewHelpers_Format_AgeViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Calculates the age of the given DateTime Object
	 *
	 * @param DateTime $date The Datetime-Object to calculate the age for
	 * @param string $label Rule how to format the age (default  min| hrs| days| yrs)
	 * @param string $agoLabel
	 * @param string $toLabel
	 * @param bool $allowNegativeValues
	 * @return string The formatted age
	 * @api
	 */
	public function render( DateTime $date = null, $labels = ' min| hrs| days| yrs', $agoLabel='', $toLabel='', $allowNegativeValues=true ) {
		if ( $date === 0 ) {
			$date = $this->renderChildren();
			if ( $date === NULL ) {
				return '';
			}
		}
		$seconds = $GLOBALS['EXEC_TIME'] - $date->format('U');
		
		if (t3lib_div::testInt($labels)) {
			$labels = ' min| hrs| days| yrs';
		} else {
			$labels=str_replace('"','',$labels);
		}

		$labelArr = explode('|',$labels);
		$absSeconds = abs($seconds);
		if ($absSeconds<3600)	{
			$seconds = round ($seconds/60).$labelArr[0];
		} elseif ($absSeconds<24*3600)	{
			$seconds = round ($seconds/3600).$labelArr[1];
		} elseif ($absSeconds<365*24*3600)	{
			$seconds = round ($seconds/(24*3600)).$labelArr[2];
		} else {
			$seconds = round ($seconds/(365*24*3600)).$labelArr[3];
		}
		
		return ($seconds > 0 ? $agoLabel : $toLabel ) . ( $allowNegativeValues ? $seconds : ltrim( $seconds, '-' ) );
	}
}
?>