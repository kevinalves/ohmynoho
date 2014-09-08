<?php

nextendimport('nextend.image.color');
nextendimport('nextend.image.image');

class plgNextendSliderWidgetThumbnailGallery extends NextendPluginBase {

    var $_name = 'gallery';

    function onNextendthumbnailList(&$list) {
        $list[$this->_name] = $this->getPath();
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR;
    }

    static function render($slider, $id, $params) {
        
        $html = '';
        $thumbnail = $params->get('thumbnail', false);
        if ($thumbnail && $thumbnail != '-1') {

            $display = NextendParse::parse($params->get('widgetthumbnaildisplay', '0|*|always'));

            $displayclass = 'nextend-widget-' . $display[1] . ' ';

            $css = NextendCss::getInstance();
            $css->addCssFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . 'style.css');
            
            $js = NextendJavascript::getInstance();
            $js->addLibraryJsFile('jquery', dirname(__FILE__) . '/gallery/script.js');

            $info = pathinfo($thumbnail);
            $class = 'nextend-thumbnail nextend-thumbnail-gallery nextend-thumbnail-gallery-' . basename($thumbnail, '.' . $info['extension']);

            $style = '';
            $thumbnailsize = NextendParse::parse($params->get('thumbnailgallerysize', '100|*|54'));
            $thumbnailperpage = $params->get('thumbnailperpage', 2);

            $style .= 'width:' . $thumbnailsize[0] . 'px; height:' . $thumbnailsize[1] . 'px;';

            $positionstyle = 'position: absolute; z-index:10;';
            
            $data = '';
            
            $thumbnailgalleryoutersize = NextendParse::parse($params->get('thumbnailgalleryoutersize', '100%|*|auto'));
            
            if(is_numeric($thumbnailgalleryoutersize[0]) || $thumbnailgalleryoutersize[0] == 'auto' || substr($thumbnailgalleryoutersize[0], -1) == '%'){
                $positionstyle.= 'width:'.$thumbnailgalleryoutersize[0].';';
            }else{
                $data.= 'data-sswidth="'.$thumbnailgalleryoutersize[0].'" ';
            }
            
            if(is_numeric($thumbnailgalleryoutersize[1]) || $thumbnailgalleryoutersize[1] == 'auto' || substr($thumbnailgalleryoutersize[1], -1) == '%'){
                $positionstyle.= 'height:'.$thumbnailgalleryoutersize[1].';';
            }else{
                $data.= 'data-ssheight="'.$thumbnailgalleryoutersize[1].'" ';
            }
            
            $thumbnailgallerybackground = $params->get('thumbnailgallerybackground', 'eeeeeefff');
            $rgbathumbnailgallerybackground = NextendColor::hex2rgba($thumbnailgallerybackground);
            $rgbacssthumbnailgallerybackground = 'RGBA('.$rgbathumbnailgallerybackground[0].','.$rgbathumbnailgallerybackground[1].','.$rgbathumbnailgallerybackground[2].','.round($rgbathumbnailgallerybackground[3]/127, 2).')';
            $colorhexthumbnailgallerybackground = substr($thumbnailgallerybackground, 0,6);
            $positionstyle.='background: #'.$colorhexthumbnailgallerybackground.'; background: '.$rgbacssthumbnailgallerybackground.';';
            
            $br = NextendParse::parse($params->get('thumbnailgalleryborderradius', '0|*|0|*|0|*|0'));
            
            $positionstyle.= 'border-radius: '.$br[0].'px '.$br[1].'px '.$br[2].'px '.$br[3].'px; overflow: auto;';
            
            $position = NextendParse::parse($params->get('thumbnailgalleryposition', ''));
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

            $html .= '<div id="'.$id.'-thumbnail" class="'.$displayclass.'" style="opacity: 0.9999; '.$positionstyle.'" '.$data.'>';
            
            $p = NextendParse::parse($params->get('thumbnailgallerypadding', '5|*|5|*|5|*|5'));

            $html .= '<div class="nextend-thumbnail-container ' . $class . '" style="padding: '.$p[0].'px '.$p[1].'px '.$p[2].'px '.$p[3].'px;">';

            $m = NextendParse::parse($params->get('thumbnailgallerymargin', '0|*|1|*|1|*|0'));
            
            for ($i = 0; $i < count($slider->_slides); $i++) {
                if(!$slider->_slides[$i]['thumbnail'] && $slider->_slides[$i]['bg']){
                    $im = new NextendImage();
                    $slider->_slides[$i]['thumbnail'] = $im->resizeImage($slider->_slides[$i]['bg'], $thumbnailsize[0], $thumbnailsize[1]);
                }
                $html .= '<div onclick="njQuery(\'#' . $id . '\').smartslider(\'goto\',' . $i . ',false);" class="' . $class . ($slider->_slides[$i]['first'] ? ' active' : '') . '" style="' . $style . 'background-image: url(\'' . $slider->_slides[$i]['thumbnail'] . '\'); margin: '.$m[0].'px '.$m[1].'px '.$m[2].'px '.$m[3].'px;"></div>';
            }

            $html .= '</div></div>';

            $html .="
              <script type='text/javascript'>
                  njQuery(document).ready(function () {
                      window['".$id."-thumbnail'] = new smartSliderGallery({
                          id: '".$id."',
                          node: window.njQuery('#".$id."-thumbnail')
                      });
                  });
              </script>
            ";

        }
        return $html;
    }

}
NextendPlugin::addPlugin('nextendsliderwidgetthumbnail', 'plgNextendSliderWidgetThumbnailGallery');