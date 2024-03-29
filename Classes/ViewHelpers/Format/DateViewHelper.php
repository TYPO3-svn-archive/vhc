<?php

/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
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
 * Formats a DateTime object.
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <vhc:format.date>{dateObject}</vhc:format.date>
 * </code>
 *
 * Output:
 * 1980-12-13
 * (depending on the current date)
 *
 * <code title="Custom date format">
 * <vhc:format.date format="H:i">{dateObject}</vhc:format.date>
 * </code>
 *
 * Output:
 * 01:23
 * (depending on the current time)
 *
 * <code title="strtotime string">
 * <vhc:format.date format="d.m.Y - H:i:s">+1 week 2 days 4 hours 2 seconds</vhc:format.date>
 * </code>
 *
 * Output:
 * 13.12.1980 - 21:03:42
 * (depending on the current time, see http://www.php.net/manual/en/function.strtotime.php)
 *
 * <code title="inline notation">
 * {vhc:format.date(date: dateObject)}
 * </code>
 *
 * Output:
 * 1980-12-13
 * (depending on the current date)
 *
 * @package VHC
 * @subpackage ViewHelpers\Format
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @api
 * @scope prototype
 */
class Tx_Vhc_ViewHelpers_Format_DateViewHelper extends Tx_Fluid_ViewHelpers_Format_DateViewHelper {

	/**
	 * Render the supplied DateTime object as a formatted date.
	 *
	 * @param mixed $date either a DateTime object or a string that is accepted by DateTime constructor
	 * @param string $format Format String which is taken to format the Date/Time
	 * @return string Formatted date
	 * @author Christopher Hlubek <hlubek@networkteam.com>
	 * @author Bastian Waidelich <bastian@typo3.org>
	 * @author Daniel Regelein <daniel.regelein@diehl-informatik.de>
	 * @api
	 */
	public function render($date = NULL, $format = '%Y-%m-%d') {
		if ($date === NULL) {
			$date = $this->renderChildren();
			if ($date === NULL) {
				return '';
			}
		}
		if (!$date instanceof DateTime) {
			try {
				$date = new DateTime($date);
			} catch (Exception $exception) {
				throw new Tx_Fluid_Core_ViewHelper_Exception('"' . $date . '" could not be parsed by DateTime constructor.', 1241722579);
			}
		}
		$ts = mktime( $date->format( 'H' ), $date->format( 'i' ), $date->format( 's' ), $date->format( 'n' ), $date->format( 'j' ), $date->format( 'Y' ) );
		return strftime( $format, $ts );
	}
}
?>
