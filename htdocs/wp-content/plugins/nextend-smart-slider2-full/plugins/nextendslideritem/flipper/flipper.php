<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemFlipper extends plgNextendSliderItemAbstract {

    var $_identifier = 'flipper';

    var $_title = 'Flipper';

    function getTemplate() {
        return '
        <div style="line-height:0; {css}" class="nextend-smartslider-flip-container nextend-smartslider-flip-{flipclass}"  data-click="{onmouseclick}" data-enter="{onmouseenter}" data-leave="{onmouseleave}">
          <a href="{url}" target="{target}" style="background: none !important;display: block;">
            <div class="nextend-smartslider-flip">
                <img alt="{alt}" src="{imagefront}" style="max-width: 100%;" class="nextend-smartslider-flip-front-img" > 
                <img alt="{alt}" src="{imageback}" style="max-width: 100%;" class="nextend-smartslider-flip-back-img" >
            </div>
          </a>
        
        <style>
          div#{{id}} .nextend-smartslider-flip-container{
            -webkit-perspective:10000px;
            -moz-perspective:10000px;
            -ms-perspective: 10000px;
            perspective:10000px;
            position:relative;
            width: {width};
          }
          div#{{id}} .nextend-smartslider-flip{
            display:block;
          }
          div#{{id}} .nextend-smartslider-flip img{
            -webkit-backface-visibility:hidden;
            -moz-backface-visibility:hidden;
            -ms-backface-visibility:hidden;
            backface-visibility:hidden;
            border:1px solid transparent;
            
            -webkit-transition:all 0.5s;
            -moz-transition:all 0.5s;
            -ms-transition:all 0.5s;
            transition:all 0.5s;
            -moz-transform-origin:50% 50%;
            transform-origin:50% 50%;
          }
          
          div#{{id}} .nextend-smartslider-flip .nextend-smartslider-flip-back-img{
            -webkit-transform:rotateY(180deg);
            -moz-transform:rotateY(180deg);
            -ms-transform:rotateY(180deg);
            transform:rotateY(180deg);
          }
          
          div#{{id}} .nextend-smartslider-flip-container:hover .nextend-smartslider-flip-front-img{
            -webkit-transform:rotateY(180deg);
            -moz-transform:rotateY(180deg);
            -ms-transform:rotateY(180deg);
            transform:rotateY(180deg);
          }
          
          div#{{id}} .nextend-smartslider-flip-container:hover .nextend-smartslider-flip-back-img{
            -webkit-transform:rotateY(0deg);
            -moz-transform:rotateY(0deg);
            -ms-transform:rotateY(0deg);
            transform:rotateY(0deg);
          }
          
          div#{{id}} .nextend-smartslider-flip-back-img{
            position:absolute;
            top:0;
            left:0;
          }
        </style>
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
            'flipclass' => 'myflip',
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

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemFlipper');