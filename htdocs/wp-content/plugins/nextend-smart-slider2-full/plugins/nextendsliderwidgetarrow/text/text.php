<?php

nextendimport('nextend.image.color');

class plgNextendSliderWidgetArrowText extends NextendPluginBase {

    var $_name = 'text';

    function onNextendarrowList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'text' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';

        $previous = $params->get('previous', false);

        $next = $params->get('next', false);

        $enabled = $previous && $previous != -1 && $next && $next != -1;

        if ($enabled) {

            $display = NextendParse::parse($params->get('widgetarrowdisplay', '0|*|always'));

            $displayclass = 'nextend-widget-' . $display[1] . ' ';

            $color = $params->get('arrowtextbackground', '00ff00ff');
            $rgba = NextendColor::hex2rgba($color);
            $rgbacss = 'RGBA(' . $rgba[0] . ',' . $rgba[1] . ',' . $rgba[2] . ',' . round($rgba[3] / 127, 2) . ')';
            $colorhex = substr($color, 0, 6);

            $colorhover = $params->get('arrowtextbackgroundhover', '000000ff');
            $rgbahover = NextendColor::hex2rgba($colorhover);
            $rgbacsshover = 'RGBA(' . $rgbahover[0] . ',' . $rgbahover[1] . ',' . $rgbahover[2] . ',' . round($rgbahover[3] / 127, 2) . ')';
            $colorhexhover = substr($colorhover, 0, 6);

            if ($previous && $previous != -1) {

                $css = NextendCss::getInstance();
                $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'text' . DIRECTORY_SEPARATOR . 'style.css');
                
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
                
                $style .= 'font-size: '.$slider->_sliderParams->get('globalfontsize', '12').'px;';
                
                $info = pathinfo($previous);
                $class = 'nextend-arrow-previous nextend-arrow-text nextend-arrow-text-previous nextend-arrow-text-previous-' . basename($previous, '.' . $info['extension']);
                $html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'previous\');" class="' . $displayclass . $class . '" style="' . $style . '" '.$data.'>
                            <span class="' . $params->get('fontclassprev', 'sliderfont7') . '">' . $params->get('contentprev', 'Prev') . '</span>
                          </div>';
            }

            if ($next && $next != -1) {

                $css = NextendCss::getInstance();
                $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'text' . DIRECTORY_SEPARATOR . 'style.css');
                
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

                $style .= 'font-size: '.$slider->_sliderParams->get('globalfontsize', '12').'px;';
                
                $info = pathinfo($next);
                $class = 'nextend-arrow-next nextend-arrow-text nextend-arrow-text-next nextend-arrow-text-next-' . basename($next, '.' . $info['extension']);
                $html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'next\');" class="' . $displayclass . $class . '" style="' . $style . '" '.$data.'>
                            <span class="' . $params->get('fontclassnext', 'sliderfont7') . '">' . $params->get('contentnext', 'Next') . '</span>
                          </div>
                          <style>
                             .nextend-arrow-text-next,              
                            .nextend-arrow-text-previous{                
                              background:' . $rgbacss . ';
                            }
                            .nextend-arrow-text-next:HOVER,              
                            .nextend-arrow-text-previous:HOVER{
                              background:' . $rgbacsshover . ';
                            }
                          </style>';
            }
        }

        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetarrow', 'plgNextendSliderWidgetArrowText');