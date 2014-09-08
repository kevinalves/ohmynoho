<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemParagraph extends plgNextendSliderItemAbstract {
    
    var $_identifier = 'paragraph';
    
    var $_title = 'Paragraph';
    
    function getTemplate(){
        return "<p class='{fontclass} {class}' style='{fontsizer}{fontcolorr}{css}' data-click='{onmouseclick}' data-enter='{onmouseenter}' data-leave='{onmouseleave}'>{content}</p>";
    }
    
    function getValues(){
        return array(
            'fontsizer' => '',
            'fontcolorr' => '',
            'content' => 'Empty paragraph...',
            'fontclass' => 'sliderfont6',
            'class' => '',
            'css' => '',
            'onmouseclick' => '',
            'onmouseenter' => '',
            'onmouseleave' => ''
            
        );
    }
    
    function getPath(){
        return dirname(__FILE__).DIRECTORY_SEPARATOR.$this->_identifier.DIRECTORY_SEPARATOR;
    } 
}

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemParagraph');