<?php


class plgNextendSliderWidgetArrowImage extends NextendPluginBase {

    var $_name = 'image';

    function onNextendarrowList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {
        $html = '';

        $previous = $params->get('previous', false);
        $next = $params->get('next', false);
        $enabled = $previous && $previous != -1 && $next && $next != -1;

        if ($enabled) {

            $display = NextendParse::parse($params->get('widgetarrowdisplay', '0|*|always'));

            $displayclass = 'nextend-widget-' . $display[1] . ' ';

            $css = NextendCss::getInstance();
            $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . 'style.css');

            if ($previous && $previous != -1) {
            
                $data = '';
                $style = 'position: absolute;';
                $position = NextendParse::parse($params->get('previousposition', ''));
    
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

                $info = pathinfo($previous);
                $class = 'nextend-arrow-previous nextend-image nextend-image-previous nextend-image-previous-' . basename($previous, '.' . $info['extension']);
                $html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'previous\');" class="' . $displayclass . $class . '" style="' . $style . '" '.$data.'></div>';
            }

            if ($next && $next != -1) {
            
                $data = '';
                $style = 'position: absolute;';
                $position = NextendParse::parse($params->get('nextposition', ''));
    
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
                
                $info = pathinfo($next);
                $class = 'nextend-arrow-next nextend-image nextend-image-next nextend-image-next-' . basename($next, '.' . $info['extension']);
                $html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'next\');" class="' . $displayclass . $class . '" style="' . $style . '" '.$data.'></div>';
            }
        }

        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetarrow', 'plgNextendSliderWidgetArrowImage');