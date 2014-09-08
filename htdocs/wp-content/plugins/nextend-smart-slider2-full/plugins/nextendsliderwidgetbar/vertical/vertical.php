<?php

nextendimport('nextend.image.color');

class plgNextendSliderWidgetBarVertical extends NextendPluginBase {

    var $_name = 'vertical';

    function onNextendBarList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vertical' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';   
        
        $color = $params->get('barbackground', '00000080');
        $rgba = NextendColor::hex2rgba($color);
        $rgbacss = 'RGBA('.$rgba[0].','.$rgba[1].','.$rgba[2].','.round($rgba[3]/127, 2).')';
        $colorhex = substr($color, 0,6);
        
        $barvertical = $params->get('barvertical', false);
        if($barvertical && $barvertical != -1){

            $display = NextendParse::parse($params->get('widgetbardisplay', '0|*|always'));

            $displayclass = 'nextend-widget-' . $display[1] . ' ';

            $css = NextendCss::getInstance();
            $css->enableLess();
            $cssfile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vertical' . DIRECTORY_SEPARATOR . 'style.less';
            $css->addCssFile(array(
                $cssfile,
                $cssfile,
                array('id' => '~"#' . $id . '"')
            ));

            $style = 'position: absolute;';
            $style.= 'background-color:'.$rgbacss.';';
            
            $data = '';
            $position = NextendParse::parse($params->get('barverticalposition', ''));
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
            
            $width = NextendParse::parse($params->get('barverticalwidth', '30'));
            if(is_numeric($width)){
                $style.= 'width:'.$width.'%;';
            }else{
                $data.= 'data-sswidth="'.$width.'" ';
            }
            
            $height = NextendParse::parse($params->get('barverticalheight', '100'));
            if(is_numeric($height)){
                $style.= 'height:'.$height.'%;';
            }else{
                $data.= 'data-ssheight="'.$height.'" ';
            }
            
            $style .= 'font-size: '.$slider->_sliderParams->get('globalfontsize', '12').'px;';

            $info = pathinfo($barvertical);
            $class = 'nextend-bar nextend-bar-v nextend-bar-v-'.basename($barvertical, '.'.$info['extension']);
            $html.= '<div class="'.$displayclass.$class.'" style="'.$style.'" '.$data.'>';

            for ($i = 0; $i < count($slider->_slides); $i++) {
                $html.= '<div class="nextend-bar-slide '.($slider->_slides[$i]['first'] ? ' active' : '').'">';
                $html.= '<h6 class="'.$params->get('barverticaltitlefont','').'">'.$slider->_slides[$i]['title'].'</h6>';
                if($slider->_slides[$i]['description']){
                  $html.= '<p class="'.$params->get('barverticaldescriptionfont','').'">'.$slider->_slides[$i]['description'].'</p>';
                }
                $html.= '<div style="clear: both;"></div></div>';
            }

            $html.= '</div>';
        }

        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetbar', 'plgNextendSliderWidgetBarVertical');