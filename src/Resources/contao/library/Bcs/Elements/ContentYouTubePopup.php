<?php

namespace Bcs\Elements;


class ContentYouTubePopup extends \Contao\ContentYouTube
{
    protected function compile()
    {
        // perform our normal compilation functions
        parent::compile();

        echo "POW!";
        die();
        // This is where our custom code will go
    }
  
}
