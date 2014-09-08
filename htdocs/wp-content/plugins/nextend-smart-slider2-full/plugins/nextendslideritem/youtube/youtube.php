<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemYoutube extends plgNextendSliderItemAbstract {
    
    var $_identifier = 'youtube';
    
    var $_title = 'YouTube';
    
    function getTemplate(){
        $html = '
        <img src="//img.youtube.com/vi/{code}/{defaultimage}.jpg" style="width: 100%; height: 100%;"/>
        <div id="{{uuid}}{code}" data-youtubecode="{code}" data-autoplay="{autoplay}" data-related="{related}" data-vq="{vq}" data-theme="{theme}" style="position: absolute; top:0; left: 0; display: none; width: 100%; height: 100%;"><!--smartslideryoutubeitem,{{uuid}},{code}--></div>';

        return $html;
    }
    
    function getValues(){
        return array(
            'code' => '_2jVG9Cihxs',
            'youtubeurl' => 'http://www.youtube.com/watch?v=_2jVG9Cihxs',
            'autoplay' => 0,
            'defaultimage' => 'maxresdefault',
            'related' => '1',
            'vq' => 'default'
        );
    }
    
    function getPath(){
        return dirname(__FILE__).DIRECTORY_SEPARATOR.$this->_identifier.DIRECTORY_SEPARATOR;
    } 
    
    function onNextendSliderRender(&$slider, $id){
        preg_match_all('/<!\-\-smartslideryoutubeitem,([a-zA-Z0-9\-]*?),([a-zA-Z0-9\-_]*?)\-\->/', $slider, $out, PREG_SET_ORDER);
        if(count($out)){
            $js = NextendJavascript::getInstance();
            $js->addLibraryJsFile('jquery', dirname(__FILE__) . '/youtube/youtube.js');            
            
            foreach($out AS $o){
                $slider .="<script type='text/javascript'>
                          njQuery(document).ready(function () {
                              ssCreateYouTubePlayer('".$o[1].$o[2]."', '".$id."');
                          });
                      </script>";
            }
        }
    }
}

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemYoutube');