<?php


class plgNextendSliderWidgetHTMLHTML extends NextendPluginBase {

    var $_name = 'html';

    function onNextendhtmlList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';

        $display = NextendParse::parse($params->get('widgethtmldisplay', '0|*|always'));

        if($display[0]){
        
            $displayclass = 'nextend-widget-' . $display[1];  
        
            $data = '';
            $style = 'position: absolute;';
            
            $position = NextendParse::parse($params->get('htmlposition', ''));
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

            $html.= '<div class="nextend-widget-html nextend-widget-' . $display[1].'" style="'.$style.'" '.$data.'>'.$params->get('widgethtmlcontent', '').'</div>';
        }

        return $html;
    }
}

NextendPlugin::addPlugin('nextendsliderwidgethtml', 'plgNextendSliderWidgetHTMLHTML');