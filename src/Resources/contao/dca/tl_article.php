<?php


/* Add Custom Fields */
$GLOBALS['TL_DCA'['tl_article'['fields']['popup'] = array(
  'label' => &$GLOBALS['TL_LANG']['tl_article']['popup'],
  'inputType' => 'checkbox',
  'eval' => array('submitOnChange'=>true),
  'sql' => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_article']['fields']['popup_class'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_article']['popup_class'],
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
