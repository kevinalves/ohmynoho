<?php

nextendimport('nextend.image.color');
nextendimport('nextend.image.image');

class plgNextendSliderWidgetThumbnailHorizontal extends NextendPluginBase {

    var $_name = 'horizontal';

    function onNextendthumbnailList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'horizontal' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {
        
        $html = '';
        $thumbnail = $params->get('thumbnail', false);
        if ($thumbnail && $thumbnail != '-1') {

            $display = NextendParse::parse($params->get('widgetthumbnaildisplay', '0|*|always'));

            $displayclass = 'nextend-widget-' . $display[1] . ' ';

            $css = NextendCss::getInstance();
            $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'horizontal' . DIRECTORY_SEPARATOR . 'style.css');

            $js = NextendJavascript::getInstance();
            $js->addLibraryJsFile('jquery', dirname(__FILE__) . '/horizontal/script.js');

            $thumbnailactivebackground = $params->get('thumbnailactivebackground', '00000080');
            $rgbathumbnailactivebackground = NextendColor::hex2rgba($thumbnailactivebackground);
            $rgbacssthumbnailactivebackground = 'RGBA('.$rgbathumbnailactivebackground[0].','.$rgbathumbnailactivebackground[1].','.$rgbathumbnailactivebackground[2].','.round($rgbathumbnailactivebackground[3]/127, 2).')';
            $colorhexthumbnailactivebackground = substr($thumbnailactivebackground, 0,6);

            $info = pathinfo($thumbnail);
            $class = 'nextend-thumbnail nextend-thumbnail-horizontal nextend-thumbnail-horizontal-' . basename($thumbnail, '.' . $info['extension']);

            $style = '';
            $thumbnailsize = NextendParse::parse($params->get('thumbnailsize', '100|*|54'));
            $thumbnailperpage = $params->get('thumbnailperpage', 2);

            $style .= 'width:' . $thumbnailsize[0] . 'px; height:' . $thumbnailsize[1] . 'px;';

            $positionstyle = 'position: absolute; z-index:10; width: 100%;';
            
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

            $html .= '<div id="'.$id.'-thumbnail" class="'.$displayclass.'" style="'.$positionstyle.'" '.$data.'>';

            $html .= '<div class="nextend-thumbnail-container ' . $class . ' clearfix">
            <div class="nextend-arrow-left" style="height:' . $thumbnailsize[1] . 'px"></div>';

            $html .= '<div class="nextend-thumbnail-strip-hider"><div class="nextend-thumbnail-strip">';

            for ($i = 0; $i < count($slider->_slides); $i++) {
                if(!$slider->_slides[$i]['thumbnail'] && $slider->_slides[$i]['bg']){
                    $im = new NextendImage();
                    $slider->_slides[$i]['thumbnail'] = $im->resizeImage($slider->_slides[$i]['bg'], $thumbnailsize[0], $thumbnailsize[1]);
                }
                $html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'goto\',' . $i . ',false);" class="' . $class . ($slider->_slides[$i]['first'] ? ' active' : '') . '" style="' . $style . 'background-image: url(' . $slider->_slides[$i]['thumbnail'] . ')"></div>';
            }

            $html .= '</div></div>';

            $html .= '<div class="nextend-arrow-right" style="height:' . $thumbnailsize[1] . 'px"></div>

            </div>
            <style>
            .nextend-thumbnail-container.nextend-thumbnail-horizontal-horizontal1 .nextend-thumbnail:HOVER,            
            .nextend-thumbnail-container.nextend-thumbnail-horizontal-horizontal1 .nextend-thumbnail.active{            
                box-shadow: inset 0 0 0 6px '.$rgbacssthumbnailactivebackground.';
            }
            .nextend-thumbnail-container.nextend-thumbnail-horizontal-horizontal-dark .nextend-thumbnail:HOVER,            
            .nextend-thumbnail-container.nextend-thumbnail-horizontal-horizontal-dark .nextend-thumbnail.active{
                box-shadow: 0 0 3px 1px RGBA(0,0,0,0.6), 0 0 0 6px '.$rgbacssthumbnailactivebackground.' inset;
            }
            </style>
            ';

            $html .= '</div>';

            $html .="
              <script type='text/javascript'>
                  njQuery(document).ready(function () {
                      window['".$id."-thumbnail'] = new smartSliderHorizontal({
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
NextendPlugin::addPlugin('nextendsliderwidgetthumbnail', 'plgNextendSliderWidgetThumbnailHorizontal');