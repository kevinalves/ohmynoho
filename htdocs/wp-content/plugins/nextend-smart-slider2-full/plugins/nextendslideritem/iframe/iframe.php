<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemiframe extends plgNextendSliderItemAbstract {
    
    var $_identifier = 'iframe';
    
    var $_title = 'iframe';
    
    function getTemplate(){
        return '<iframe frameborder="0" width="{width}" height="{height}" src="{url}" scrolling="{scroll}" data-click="{onmouseclick}" data-enter="{onmouseenter}" data-leave="{onmouseleave}" ></iframe>';
    }
    
    function getValues(){
        return array(
            'url' => 'about:blank',
            'width' => '100%',
            'height' => '100%',
            'scroll' => 'yes',
            'onmouseclick' => '',
            'onmouseenter' => '',
            'onmouseleave' => ''
        );
    }
    
    function getPath(){
        return dirname(__FILE__).DIRECTORY_SEPARATOR.$this->_identifier.DIRECTORY_SEPARATOR;
    } 
}

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemiframe');