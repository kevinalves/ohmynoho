<?php


class plgNextendSliderWidgetAutoplayImage extends NextendPluginBase {

    var $_name = 'image';

    function onNextendAutoplayList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';   
        
        $autoplayimage = $params->get('autoplayimage', false);
        if($autoplayimage && $autoplayimage != -1){

            $display = NextendParse::parse($params->get('widgetautoplaydisplay', '0|*|always'));

            $displayclass = 'nextend-widget-' . $display[1] . ' ';

            $css = NextendCss::getInstance();
            $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR.'style.css');

            $data = '';
            $style = 'position: absolute;';
            $position = NextendParse::parse($params->get('autoplayimageposition', ''));

            if (count($position)) {
                if(!is_numeric($position[1])){
                    $data.= 'data-ss'.$position[0].'="'.$position[1].'" ';
                }else{
                    $style .= $position[0] . ':' . $position[1] . $position[2] . ';';
                }
                
                if(!is_numeric($position[4])){
                    $data.= 'data-ss'.$position[3].'="'.$position[4].'" ';
                }else{
                    $style .= $position[3] . ':' . $position[4] . $position[5] . ';';
                }
            }
                
            $info = pathinfo($autoplayimage);
            $class = 'nextend-autoplay-button nextend-autoplay-image nextend-autoplay-'.basename($autoplayimage, '.'.$info['extension']);
            $html.= '<div onclick="njQuery(this).hasClass(\'paused\') ? njQuery(\'#'.$id.'\').smartslider(\'startautoplay\') : njQuery(\'#'.$id.'\').smartslider(\'pauseautoplay\');" class="'.$displayclass.$class.'" style="'.$style.'" '.$data.'></div>';
        }

        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetautoplay', 'plgNextendSliderWidgetAutoplayImage');