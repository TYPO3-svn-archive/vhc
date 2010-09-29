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

class Tx_Vhc_ViewHelpers_PagebrowserViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	
	private $internal = array(
		'showRange' => false,
		'dontLinkActivePage' => 1,
		'pagefloat' => 'CENTER',
		'showFirstLast' => 1,
		'pointerName' => 'pointer',
		'alwaysPrev' => 0
	);
	
	
	private $wrapper = array(
		'disabledLinkWrap' => '<li class="disabledLinkWrap">|</li>',
		'inactiveLinkWrap' => '<li>|</li>',
		'activeLinkWrap' => '<li class="activeLinkWrap">|</li>',
		'browseLinksWrap' => '<ul class="browsebox">|</ul>',
		'showResultsWrap' => '<div class="showResultsWrap">|</div>',
		'browseBoxWrap' => '<div class="pagebrowser">|</div>',
		'showResultsNumbersWrap' => '|'
	);
	

	/**
	 * Renders a pagebrowser
	 *
	 * @param  integer $resCount Total result of the query
	 * @param  integer $resultsPerPage Results to display per page
	 * @param  integer $maxPages Maximum number of pages
	 * @param  boolean $forceOutput Return the Pagebrowser even there is only one page
	 * @param  integer $showResultCount Define whether to show he resultcount - or not
	 * @return string the rendered Pagebrowser
	 */
	public function render( $resCount=0, $resultsPerPage=30, $maxPages=5, $forceOutput=false, $showResultCount=1 ) {
		$count = intval( $resCount );
		$results_at_a_time = t3lib_div::intInRange( $resultsPerPage, 1, 1000 );
		$totalPages = ceil( $count / $results_at_a_time );
		$maxPages = t3lib_div::intInRange( $maxPages, 1, 100 );
		
		try {
			$pointer = intval( $this->controllerContext->getRequest()->getArgument( $this->internal['pointerName'] ) );
		} catch( Tx_Extbase_MVC_Exception_NoSuchArgument $nsaexc ) {
			$pointer = 0;
		}
		
		
		if ( !$forceOutput && $count <= $results_at_a_time ) {
			return '';
		}
		
			// $showResultCount determines how the results of the pagerowser will be shown.
			// If set to 0: only the result-browser will be shown
			//	 		 1: (default) the text "Displaying results..." and the result-browser will be shown.
			//	 		 2: only the text "Displaying results..." will be shown
		$showResultCount = intval( $showResultCount );
		
			// if this is set, two links named "<< First" and "LAST >>" will be shown and point to the very first or last page.
		$showFirstLast = $this->internal['showFirstLast'];

			// if this has a value the "previous" button is always visible (will be forced if "showFirstLast" is set)
		$alwaysPrev = $showFirstLast ? 1 : $this->internal['alwaysPrev'];
		

		if ( isset( $this->internal['pagefloat'] ) ) {
			if ( strtoupper( $this->internal['pagefloat'] ) == 'CENTER' ) {
				$pagefloat = ceil( ( $maxPages - 1 ) / 2 );
			} else {
				// pagefloat set as integer. 0 = left, value >= $this->internal['maxPages'] = right
				$pagefloat = t3lib_div::intInRange( $this->internal['pagefloat'], -1, $maxPages-1 );
			}
		} else {
			$pagefloat = -1; // pagefloat disabled
		}
		
		
		if ( $showResultCount != 2 ) { //show pagebrowser
			if ($pagefloat > -1) {
				$lastPage = min( $totalPages, max( $pointer+1 + $pagefloat, $maxPages ) );
				$firstPage = max( 0, $lastPage - $maxPages );
			} else {
				$firstPage = 0;
				$lastPage = t3lib_div::intInRange( $totalPages, 1, $maxPages );
			}
			$links=array();

				// Make browse-table/links:
			if ($showFirstLast) { // Link to first page
				if ($pointer>0)	{
					$links[]=$this->wrap( $this->makeLink( $this->getLL( 'pageBrowser_first' ), '' ), $this->wrapper['inactiveLinkWrap'] );
				} else {
					$links[]=$this->wrap( $this->getLL( 'pageBrowser_first' ), $this->wrapper['disabledLinkWrap'] );
				}
			}
			if ($alwaysPrev>=0)	{ // Link to previous page
				if ($pointer>0)	{
					$links[]=$this->wrap( $this->makeLink( $this->getLL( 'pageBrowser_prev' ), ( $pointer-1 ? $pointer-1 : '' ) ), $this->wrapper['inactiveLinkWrap'] );
				} elseif ($alwaysPrev)	{
					$links[]=$this->wrap( $this->getLL( 'pageBrowser_prev' ), $this->wrapper['disabledLinkWrap'] );
				}
			}
			
			
			for( $a=$firstPage; $a<$lastPage; $a++ ) {
				if ( $this->internal['showRange'] ) {
					$pageText = ( ( $a*$results_at_a_time ) +1 ) . '-' . min( $count, ( ( $a+1 ) * $results_at_a_time ) );
				} else {
					$pageText = trim( sprintf( $this->getLL( 'pageBrowser_page' ), ( $a+1 ) ) );
				}
				
				if ( $pointer == $a ) { // current page
					if ( $this->internal['dontLinkActivePage'] ) {
						$links[] = $this->wrap( $pageText, $this->wrapper['activeLinkWrap'] );
					} else {
						$links[] = $this->wrap( $this->makeLink( $pageText, ( $a ? $a : '' ) ), $this->wrapper['activeLinkWrap'] );
					}
				} else {
					$links[] = $this->wrap( $this->makeLink( $pageText, ( $a ? $a : '' ) ), $this->wrapper['inactiveLinkWrap'] );
				}
			}
			
			
			if ($pointer<$totalPages-1 || $showFirstLast)	{
				if ($pointer>=$totalPages-1) { // Link to next page
					$links[]=$this->wrap( $this->getLL( 'pageBrowser_next' ), $this->wrapper['disabledLinkWrap'] );
				} else {
					$links[]=$this->wrap( $this->makeLink( $this->getLL( 'pageBrowser_next' ), ( $pointer+1 ) ), $this->wrapper['inactiveLinkWrap'] );
				}
			}
			if ($showFirstLast) { // Link to last page
				if ($pointer<$totalPages-1) {
					$links[]=$this->wrap( $this->makeLink( $this->getLL( 'pageBrowser_last' ), ( $totalPages-1 ) ), $this->wrapper['inactiveLinkWrap'] );
				} else {
					$links[]=$this->wrap( $this->getLL( 'pageBrowser_last' ), $this->wrapper['disabledLinkWrap'] );
				}
			}
			$theLinks = $this->wrap( implode( LF, $links ), $this->wrapper['browseLinksWrap'] );
		} else {
			$theLinks = '';
		}
		
		if ( $showResultCount ) {
			$pR1 = $pointer*$results_at_a_time+1;
			$pR2 = $pointer*$results_at_a_time+$results_at_a_time;
			
			$resultCountMsg = sprintf(
				$this->getLL( 'pageBrowser_displays' ),
				$count > 0 ? $pR1 : 0,
				min( $count, $pR2 ),
				$count
			);
			$resultCountMsg = $this->wrap( $resultCountMsg, $this->wrapper['showResultsWrap'] );
		} else {
			$resultCountMsg = '';
		}
		$content = $this->wrap( $resultCountMsg . $theLinks, $this->wrapper['browseBoxWrap'] );

		
		return $content;
	}


	/**
	 * Wrap a string using another
	 * 
	 * @param string $content The content to wrap
	 * @param string $wrap The wrap (splitted by |)
	 * @return string
	 */
	private function wrap($content,$wrap)	{
		if ( $wrap )	{
			$wrapArr = explode( '|', $wrap );
			return trim( $wrapArr[0] ) . $content . trim($wrapArr[1] );
		} else {
			return $content;
		}
	}
	
	
	
	private function getLL( $key ) {
		$extensionName = $this->controllerContext->getRequest()->getControllerExtensionName();
		$value = Tx_Extbase_Utility_Localization::translate( $key, $extensionName );
		return $value;
	}
	
	
	/**
	 * Uses the typolink function to return a link with the corresponding GET-parameter for page browsing
	 * 
	 * @return string returns an a-tag with a link to the same page and an additional parameter for the pagebrowser
	 * @param string the text of the link (<a>text</a>)
	 * @param int $page = the page to be linked by the pagebrowser (f.e. the next or previous page)
	 */
	private function makeLink( $linktext, $page ) {
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$uri = $uriBuilder
			->reset()
			->uriFor( 
				$this->controllerContext->getRequest()->getControllerActionName(), 
				array(
					$this->internal['pointerName'] => $page ? $page : '0'
				) 
			);		

		$tag = t3lib_div::makeInstance( 'Tx_Fluid_Core_ViewHelper_TagBuilder' );	
		$tag->setTagName( 'a' );
		$tag->setContent( $linktext );
		$tag->addAttribute( 'href', $uri );
		return $tag->render();
	}
}
?>