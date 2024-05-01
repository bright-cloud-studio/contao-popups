<?php

namespace Bcs\Elements;


class ContentYouTubePopup extends \Contao\ContentYouTube
{
    protected function compile()
    {
        // perform our normal compilation functions
        parent::compile();

        if ($this->popup) {
            echo "WE GOT US A POPUP HERE!";
            die();
        }
        
    }
  
}
