<?php

class plgNextendSliderWidgetBarGradient extends NextendPluginBase {

    var $_name = 'gradient';

    function onNextendBarList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'gradient' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';

        $bargradient = $params->get('bargradient', false);
        if ($bargradient && $bargradient != -1) {

            $display = NextendParse::parse($params->get('widgetbardisplay', '0|*|always'));

            $displayclass = 'nextend-widget-' . $display[1] . ' ';

            $css = NextendCss::getInstance();
            $css->enableLess();
            $cssfile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'gradient' . DIRECTORY_SEPARATOR . 'style.less';
            $css->addCssFile(array(
                $cssfile,
                $cssfile,
                array('id' => '~"#' . $id . '"')
            ));
            
            $data = '';
            $style = 'position: absolute;';
            $position = NextendParse::parse($params->get('bargradientposition', ''));

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
            
            $width = NextendParse::parse($params->get('bargradientwidth', '100%'));
            if(is_numeric($width) || $width == 'auto' || substr($width, -1) == '%'){
                $style.= 'width:'.$width.';';
            }else{
                $data.= 'data-sswidth="'.$width.'" ';
            }

            $height = $params->get('bargradientheight', '30');
            $style .= 'height: ' . $height . 'px;';
            $style .= 'font-size: '.$slider->_sliderParams->get('globalfontsize', '12').'px;';

            $info = pathinfo($bargradient);
            $class = 'nextend-bar nextend-bar-g nextend-bar-g-' . basename($bargradient, '.' . $info['extension']);
            $html .= '<div class="' . $displayclass . $class . '" style="' . $style . '" '.$data.'>';
            $html .= '<div class="inner" style="height:' . ($height - 2) . 'px;">';

            for ($i = 0; $i < count($slider->_slides); $i++) {
                $html .= '<div class="nextend-bar-slide ' . ($slider->_slides[$i]['first'] ? ' active' : '') . '">';
                $html .= '<h6 class="' . $params->get('bargradienttitlefont', '') . '" style="line-height: ' . $height . 'px;">' . $slider->_slides[$i]['title'] . '</h6>';
                if ($slider->_slides[$i]['description']) {
                    $html .= '<p class="' . $params->get('bargradientdescriptionfont', '') . '" style="line-height: ' . $height . 'px;"> - ' . $slider->_slides[$i]['description'] . '</p>';
                }
                $html .= '</div>';
            }

            $html .= '</div></div>';
        }

        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetbar', 'plgNextendSliderWidgetBarGradient');