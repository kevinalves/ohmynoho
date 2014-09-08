<?php

nextendimport('nextend.image.color');

class plgNextendSliderWidgetThumbnailVertical extends NextendPluginBase {

    var $_name = 'vertical';

    function onNextendthumbnailList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vertical' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {

        $html = '';
        $thumbnail = $params->get('thumbnail', false);
        if ($thumbnail && $thumbnail != '-1') {

            $display = NextendParse::parse($params->get('widgetthumbnaildisplay', '0|*|always'));

            $displayclass = 'nextend-widget-' . $display[1] . ' ';

            $css = NextendCss::getInstance();
            $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vertical' . DIRECTORY_SEPARATOR . 'style.css');

            $js = NextendJavascript::getInstance();
            $js->addLibraryJsLibraryFile('jquery', 'jquery.mousewheel.js');
            $js->addLibraryJsFile('jquery', dirname(__FILE__) . '/vertical/script.js');

            $thumbnailactivebackground = $params->get('thumbnailactivebackground', '00000080');
            $rgbathumbnailactivebackground = NextendColor::hex2rgba($thumbnailactivebackground);
            $rgbacssthumbnailactivebackground = 'RGBA('.$rgbathumbnailactivebackground[0].','.$rgbathumbnailactivebackground[1].','.$rgbathumbnailactivebackground[2].','.round($rgbathumbnailactivebackground[3]/127, 2).')';
            $colorhexthumbnailactivebackground = substr($thumbnailactivebackground, 0,6);

            $info = pathinfo($thumbnail);
            $class = 'nextend-thumbnail nextend-thumbnail-vertical nextend-thumbnail-vertical-' . basename($thumbnail, '.' . $info['extension']);

            $style = '';
            $thumbnailsize = array(NextendParse::parse($params->get('thumbnailsize', '300')));
            $thumbnailcolumn = $params->get('thumbnailcolumn', '30');
            $thumbnailperpage = $params->get('thumbnailperpage', 2);

            $positionstyle = 'position: absolute; z-index:10;';
            
            $data = '';
            $position = NextendParse::parse($params->get('thumbnailposition', ''));
            if (count($position)) {
                if(!is_numeric($position[1])){
                    $data.= 'data-ss'.$position[0].'="'.$position[1].'" ';
                }else{
                    $positionstyle .= $position[0] . ':' . $position[1] . $position[2] . ';';
                }
                
                if(!is_numeric($position[4])){
                    $data.= 'data-ss'.$position[3].'="'.$position[4].'" ';
                }else{
                    $positionstyle .= $position[3] . ':' . $position[4] . $position[5] . ';';
                }
            }

            $id = $slider->getId();
            
            $style .= 'font-size: '.$slider->_sliderParams->get('globalfontsize', '12').'px;';

            $html .= '<div id="'.$id.'-thumbnail" class="'.$displayclass.'" style="width: '.$thumbnailsize[0].'px;height: 100%;'.$positionstyle.$style.'" '.$data.'>';

            $html .= '<div class="nextend-thumbnail-container ' . $class . ' clearfix">
            <div class="nextend-arrow-top"></div>';

            $html .= '<td><div class="nextend-thumbnail-strip-hider"><div class="nextend-thumbnail-strip">';

            for ($i = 0; $i < count($slider->_slides); $i++) {
                $html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'goto\',' . $i . ',false);" class="' . $class . ($slider->_slides[$i]['first'] ? ' active' : '') . '">';
                if($thumbnailcolumn != 0){
                    if(!$slider->_slides[$i]['thumbnail'] && $slider->_slides[$i]['bg']){
                        $slider->_slides[$i]['thumbnail'] = $slider->_slides[$i]['bg'];
                    }
                    $html .= '<div class="nextend-thumbnail-vertical-image" style="float:left;width:'.$thumbnailcolumn.'%; background-image:url(\''.$slider->_slides[$i]['thumbnail'].'\');"></div>';
                }
                $html .= '<div class="nextend-thumbnail-vertical-content" style="width:'.(100-$thumbnailcolumn).'%;">
                        <h4 class="'.$params->get('thumbnailfontclasstitle').'">'.$slider->_slides[$i]['title'].'</h4>
                        <p class="'.$params->get('thumbnailfontclassdescription').'">'.$slider->_slides[$i]['description'].'</p>
                    </div></div>';
            }

            $html .= '</div></div></td>';

            $html .= '<div class="nextend-arrow-bottom"></div>
            <style>
            .nextend-thumbnail-container .nextend-thumbnail-vertical-vertical1:HOVER,            
            .nextend-thumbnail-container .nextend-thumbnail-vertical-vertical1.active,                      
            .nextend-thumbnail-container.nextend-thumbnail-vertical-vertical1 .nextend-arrow-top:HOVER,
            .nextend-thumbnail-container.nextend-thumbnail-vertical-vertical1 .nextend-arrow-bottom:HOVER,
            .nextend-thumbnail-container .nextend-thumbnail-vertical-vertical-light:HOVER,            
            .nextend-thumbnail-container .nextend-thumbnail-vertical-vertical-light.active,                      
            .nextend-thumbnail-container.nextend-thumbnail-vertical-vertical-light .nextend-arrow-top:HOVER,
            .nextend-thumbnail-container.nextend-thumbnail-vertical-vertical-light .nextend-arrow-bottom:HOVER{            
                background-color:'.$rgbacssthumbnailactivebackground.';
            }
            </style>
            </div>';

            $html .= '</div>';

            $html .="
              <script type='text/javascript'>
                  njQuery(document).ready(function () {
                      window['".$id."-thumbnail'] = new smartSliderVertical({
                          id: '".$id."',
                          node: window.njQuery('#".$id."-thumbnail'),
                          thumbnailperpage: '".$thumbnailperpage."',
                          thumbnailanimation: '".$params->get('thumbnailanimation', 700)."'
                      });
                  });
              </script>
            ";
        }
        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetthumbnail', 'plgNextendSliderWidgetThumbnailVertical');