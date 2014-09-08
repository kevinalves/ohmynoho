<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemTag extends plgNextendSliderItemAbstract {

    var $_identifier = 'tag';

    var $_title = 'Tag';

    function getTemplate() {
        return "
        <div class='{fontclass}' data-click='{onmouseclick}' data-enter='{onmouseenter}' data-leave='{onmouseleave}'>
          <a href='{url}' target='{target}'>
              <span class='nextend-smartslider-tag-{tagclass} {class}'>
                    {content}
              </span>
          </a>
        
          <style>
          div#{{id}} span.nextend-smartslider-tag-{tagclass}{
          	float:right;
          	height:24px;
          	line-height: 24px !important;
          	position:relative;
          	padding:0 10px 0 12px !important;
          	margin-left: 12px;
          	background: {color} !important;
          	-moz-border-radius-bottomright:4px;
          	-webkit-border-bottom-right-radius:4px;	
          	border-bottom-right-radius:4px;
          	-moz-border-radius-topright:4px;
          	-webkit-border-top-right-radius:4px;	
          	border-top-right-radius:4px;	
        	} 
        	
        	div#{{id}} span.nextend-smartslider-tag-{tagclass}:before{
          	content:\"\";
          	float:right;
          	position:absolute;
          	left:-9px;
          	border-color:transparent {color} transparent transparent;
          	border-style:solid;
          	border-width:12px 9px 12px 0;
        	}
        	
        	div#{{id}} span.nextend-smartslider-tag-{tagclass}:after{
          	content:\"\";
          	position:absolute;
          	top:10px;
          	left:0;
          	float:right;
          	width:4px;
          	height:4px;
          	-moz-border-radius:99px;
          	-webkit-border-radius:99px;
          	border-radius:99px;
          	background: #fff;
          	-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
          	-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
          	box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
        	}
        	
        	
          div#{{id}} span.nextend-smartslider-tag-{tagclass}:hover{
            background:{hovercolor} !important;
          }	
        
          div#{{id}} span.nextend-smartslider-tag-{tagclass}:hover:before{
            border-color: transparent {hovercolor} transparent transparent;
          }
          </style>
        </div>
        ";
    }

    function getValues() {
        return array(
            'class' => '',
            'tagclass' => 'tagclass',
            'url' => '#',
            'target' => '_self',
            'content' => 'mytag',
            'fontclass' => 'sliderfont7',
            'color' => '#357cbd',
            'hovercolor' => '#01add3',
            'onmouseclick' => '',
            'onmouseenter' => '',
            'onmouseleave' => ''
        );
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->_identifier . DIRECTORY_SEPARATOR;
    }
}

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemTag');