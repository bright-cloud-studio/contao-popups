<?php

/** Palettes */
foreach($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $value) {
	$GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = str_replace(',type', ',type;{popup_legend},popup', $value);
}	

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'popup';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'popupAccept';

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['popup'] = 'popupUuid,popupClass,popupDelay,popupReshowDelay,popupScrollTrigger,popupFadeDuration,popupTrigger,popupAddClose,popupAccept';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['popupAccept'] 	= 'popupRejectUrl';


/* Modify the existing youtube palette by adding our submit field */
$GLOBALS['TL_DCA']['tl_content']['palettes']['youtube'] = str_replace('youtube;', 'youtube,popupSubmit;', $GLOBALS['TL_DCA']['tl_content']['palettes']['youtube']);



/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['inColumn']['options_callback'] = array('ZyppyPopup\Backend\Content', 'getActiveLayoutSections');

$GLOBALS['TL_DCA']['tl_content']['fields']['popup'] = array(
	'filter'				  => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popup'],
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupUuid'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupUuid'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
	'save_callback' => array
	(
		array('ZyppyPopup\Backend\Content', 'generateContentUuid')
	),
	'sql'                     => "varchar(255) BINARY NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupClass'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupClass'],
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupDelay'] = array
(
	'filter'				  => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupDelay'],
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'natural', 'tl_class'=>'w50'),
	'sql'                     => "varchar(10) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupReshowDelay'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupReshowDelay'],
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'                     => "varchar(10) NOT NULL default ''"
);
		
$GLOBALS['TL_DCA']['tl_content']['fields']['popupScrollTrigger'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupScrollTrigger'],
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'natural', 'tl_class'=>'w50'),
	'sql'                     => "varchar(10) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupFadeDuration'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupFadeDuration'],
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'natural', 'tl_class'=>'w50'),
	'sql'                     => "varchar(10) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupTrigger'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupTrigger'],
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupAddClose'] = array(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupAddClose'],
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'m12 w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupClear'] = array(
	'exclude'                 => true,
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupClear'],
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'m12 w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupAccept'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupAccept'],
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 clr'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupRejectUrl'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupRejectUrl'],
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'dcaPicker'=>true, 'addWizardClass'=>false, 'tl_class'=>'long clr'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['popupSubmit'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['popupSubmit'],
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
