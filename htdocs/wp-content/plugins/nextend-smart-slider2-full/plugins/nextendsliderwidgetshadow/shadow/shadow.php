<?php


class plgNextendSliderWidgetShadowShadow extends NextendPluginBase {

    var $_name = 'shadow';

    function onNextendshadowList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'shadow' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';

        $shadowcss = $params->get('shadowcss', false);        

        if($shadowcss && $shadowcss != -1){        
        
            $style = 'position: absolute;';
            
            $data = '';
            $position = NextendParse::parse($params->get('shadowposition', ''));
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
            
            $width = NextendParse::parse($params->get('shadowwidth', 'width'));
            if(is_numeric($width) || $width == 'auto' || substr($width, -1) == '%'){
                $style.= 'width:'.$width.';';
            }else{
                $data.= 'data-sswidth="'.$width.'" ';
            }

            $css = NextendCss::getInstance();
            $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'shadow' . DIRECTORY_SEPARATOR.'style.css');

            $info = pathinfo($shadowcss);
            $class = 'nextend-shadow nextend-shadow-'.basename($shadowcss, '.'.$info['extension']);
            $html.= '<div class="'.$class.'" style="line-height:0;'.$style.'" '.$data.'><img src="'.(nextendIsWordpress() ? plugins_url('shadow/shadow/'.$info['basename'], __FILE__) : NextendUri::pathToUri(NextendFilesystem::getBasePath().$shadowcss)).'"/></div>';
        }

        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetshadow', 'plgNextendSliderWidgetShadowShadow');