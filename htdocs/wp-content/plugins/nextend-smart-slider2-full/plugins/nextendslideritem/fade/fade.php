<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemFade extends plgNextendSliderItemAbstract {

    var $_identifier = 'fade';

    var $_title = 'Fade';

    function getTemplate() {
        return '
        <div style="line-height:0; {css} position: relative;cursor:{cursor};" class="nextend-smartslider-fade-container nextend-smartslider-fade-{fadeclass}" data-click="{onmouseclick}" data-enter="{onmouseenter}" data-leave="{onmouseleave}">
          <a href="{url}" target="{target}" style="background: none !important; display:block;"> 
            <span class="nextend-smartslider-fade">
                <img alt="{alt}" src="{imagefront}" style="max-width: 100%; width: {width};" class="nextend-smartslider-fade-front-img" >
                <img alt="{alt}" src="{imageback}" style="max-width: 100%; width: {width};" class="nextend-smartslider-fade-back-img" >
                <style>
                  div#{{id}} .nextend-smartslider-fade-container{
                    display: block;
                  }          
                  
                  div#{{id}} .nextend-smartslider-fade-container .nextend-smartslider-fade .nextend-smartslider-fade-back-img{
                  	-webkit-transition:opacity .4s ease-in-out;
                  	-moz-transition:opacity .4s ease-in-out;
                  	-o-transition:opacity .4s ease-in-out;
                  	transition:opacity .4s ease-in-out;
                  	opacity:0
                  }
                  
                  div#{{id}} .nextend-smartslider-fade-container .nextend-smartslider-fade:HOVER .nextend-smartslider-fade-back-img{
                  	opacity:0.9999;
                  }
                  div#{{id}} .nextend-smartslider-fade-container .nextend-smartslider-fade-back-img{
                  	position:absolute;
                  	top:0;
                  	left:0
                  }
        
        
                </style>
            </span>
          </a>
        </div>
        ';
    }

    function getValues() {
        return array(
            'imagefront' => NextendSmartSliderSettings::get('placeholder'),
            'imageback' => NextendSmartSliderSettings::get('placeholder'),
            'alt' => 'Image not available',
            'link' => '#|*|_self',
            'url' => '',
            'target' => '_self',
            'width' => '100%',
            'fadeclass' => 'myfade',
            'css' => '',
            'class' => '',
            'onmouseclick' => '',
            'onmouseenter' => '',
            'onmouseleave' => ''
        );
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->_identifier . DIRECTORY_SEPARATOR;
    }
}

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemFade');