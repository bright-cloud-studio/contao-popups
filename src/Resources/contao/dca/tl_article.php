<?php


  /* Add Custom Fields */
  $GLOBALS['TL_DCA'['tl_article'['fields']['popup'] = array(
      'label' => &$GLOBALS['TL_LANG']['tl_article']['popup'],
      'inputType' => 'checkbox',
      'eval' => array('submitOnChange'=>true),
      'sql' => "char(1) NOT NULL default ''"
  );
