<?php
 
/**
* @copyright  Bright Cloud Studio
* @author     Bright Cloud Studio
* @package    Contao CE Recaptcha
* @license    LGPL-3.0+
* @see	       https://github.com/bright-cloud-studio/contao-popups
*/

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['generatePage'][] 		 = array('ZyppyPopup\Frontend\Page', 'generatePage');


//$GLOBALS['TL_CTE']['media']['youtube'] = 'Bcs\Elements\ContentYouTube';

$GLOBALS['TL_HOOKS']['getContentElement'][] = array('ZyppyPopup\Backend\Content', 'getContentElementHook');
