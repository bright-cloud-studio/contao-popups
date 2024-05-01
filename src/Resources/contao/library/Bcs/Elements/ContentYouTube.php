<?php

namespace Bcs\Elements;


class ContentYouTube extends \Contao\ContentYouTube
{
    protected function compile()
    {
        // perform our normal compilation functions
        parent::compile();

        if ($this->popupTrigger != '') {
            
            $GLOBALS['TL_BODY'][] = '<script src="/bundles/bcspopup/js/fresco.min.js"></script>';
            $GLOBALS['TL_CSS'][] = '/bundles/bcspopup/css/fresco.css';
            
        }
        
    }
  
}
