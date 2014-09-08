<?php

class plgNextendSliderWidgetIndicatorStripe extends NextendPluginBase {

    var $_name = 'stripe';

    function onNextendIndicatorList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'stripe' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';

        $indicatorstripe = $params->get('indicatorstripe', false);

        if ($indicatorstripe && $indicatorstripe != -1) {

            $display = NextendParse::parse($params->get('widgetindicatordisplay', '0|*|always'));

            $displayclass = 'nextend-indicator nextend-widget-' . $display[1] . ' ';

            nextendimport('nextend.image.color');

            $js = NextendJavascript::getInstance();

            $css = NextendCss::getInstance();
            $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'stripe' . DIRECTORY_SEPARATOR . 'style.css');
            
            $data = '';
            $style = 'position: absolute; z-index:10;';
            $position = NextendParse::parse($params->get('indicatorposition', ''));

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
            
            $width = NextendParse::parse($params->get('indicatorwidth', '100%'));
            if(is_numeric($width) || $width == 'auto' || substr($width, -1) == '%'){
                $style.= 'width:'.$width.';';
            }else{
                $data.= 'data-sswidth="'.$width.'" ';
            }

            $size = intval($params->get('indicatorsize', 50));

            $color = $params->get('indicatorstripecolor', '000000cc');
            $rgba = NextendColor::hex2rgba($color);
            $rgbacss = 'RGBA('.$rgba[0].','.$rgba[1].','.$rgba[2].','.round($rgba[3]/127, 2).')';
            $colorhex = '#'.substr($color, 0,6);
            
            $colorbg = $params->get('backgroundstripecolor', '7670c7ff');
            $rgbabg = NextendColor::hex2rgba($colorbg);
            $rgbacssbg = 'RGBA('.$rgbabg[0].','.$rgbabg[1].','.$rgbabg[2].','.round($rgbabg[3]/127, 2).')';
            $colorhexbg = '#'.substr($colorbg, 0,6);
            
            $height = $params->get('indicatorstripeheight', '6');

            $info = pathinfo($indicatorstripe);
            $class = 'nextend-indicator nextend-indicator-stripe nextend-indicator-stripe-' . basename($indicatorstripe, '.' . $info['extension']);

            $html = '<div class="'.$displayclass.'nextend-indicator-stripe-container" style="' . $style . 'background-color:'.$colorhexbg.'; background-color:'.$rgbacssbg.'; height: '.$height.'px;" '.$data.'><div class="'.$class.'" style="width: 0%; background-color:'.$colorhex.'; background-color:'.$rgbacss.'; height: '.$height.'px;"></div></div>';



            $html .="
              <script type='text/javascript'>
                  njQuery(document).ready(function () {
                      var stripe = window.njQuery('#" . $id . " .nextend-indicator-stripe');
                       window['" . $id . "-indicator'] = {
                          hide: function(){
                              stripe.hide();
                          },
                          show: function(){
                              stripe.show();
                          },
                          refresh: function(val){
                              stripe.css('width', val+'%');
                          }
                       };
                  });
              </script>
            ";
            
        }

        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetindicator', 'plgNextendSliderWidgetIndicatorStripe');