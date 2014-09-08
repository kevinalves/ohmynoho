<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemVimeo extends plgNextendSliderItemAbstract {
    
    var $_identifier = 'vimeo';
    
    var $_title = 'Vimeo';
    
    function getTemplate(){
        $html = '
        <img id="vimeo-{code}_{{uuid}}" src="" alt="Thumbnail image for video is loading..." style="width: 100%; height: 100%;" />
        <div id="{{uuid}}{code}"></div>
        <script type="text/javascript">
            if(window.ssadmin){
                function vimeoLoadingThumb{code}(id){
                    var url = "http://vimeo.com/api/v2/video/" + id + ".json?callback=showThumb{code}";
                
                    var id_img = "#vimeo-{code}_{{uuid}}";
                    var script = document.createElement( "script" );
                    script.type = "text/javascript";
                    script.src = url;
                    njQuery(document.getElementsByTagName("script")[0]).before(script);
                }
                function showThumb{code}(data){
                    var id_img = "#vimeo-{code}_{{uuid}}";
                    try{
                        njQuery(id_img).attr("src",data[0].thumbnail_medium);
                    }catch(e){};
                }
                try{
                    vimeoLoadingThumb{code}({code});
                }catch(e){}
            }else{
                var script = document.createElement( "script" );
                script.type = "text/javascript";
                script.src = "http://a.vimeocdn.com/js/froogaloop2.min.js";
                var firstScriptTag = document.getElementsByTagName("script")[0];
                firstScriptTag.parentNode.insertBefore(script, firstScriptTag);
            
                njQuery(window).load(function(){
                    njQuery("#vimeo-{code}_{{uuid}}").remove();
                    var vimeo = njQuery(\'<iframe id="{{uuid}}{code}" src="http://player.vimeo.com/video/{code}?api=1&player_id={{uuid}}{code}&autoplay={autoplay}&title={title}&byline={byline}&portrait={portrait}&color={color}&loop={loop}" width="400" height="225" style="position: absolute; top:0; left: 0; width: 100%; height: 100%;" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>\');
                    njQuery("#{{uuid}}{code}").replaceWith(vimeo);
                    var player = $f(vimeo[0]);
                    player.addEvent("ready", function() {
                        if(parseInt("{autoplay}")){
                            var p = vimeo.closest(".smart-slider-canvas");
                            if(p.hasClass("smart-slider-slide-active")){
                                player.api("play");
                            }else{
                                player.api("play");
                                setTimeout(function(){
                                    player.api("pause");
                                }, 200);
                                
                                
                                player.addEvent("play", function(){
                                    njQuery("#{{id}}").trigger("ssplaystarted");
                                });
                                p.on("ssanimatelayersin", function(){
                                    njQuery("#{{id}}").trigger("ssplaystarted");
                                    player.api("play");
                                });
                            }
                        };
                        player.addEvent("finish", function(){
                            njQuery("#{{id}}").trigger("ssplayended");
                        });
                    });
                });
            }
        </script>
        ';

        return $html;
    }
    
    function getValues(){
        return array(
            'code' => '75251217',
            'autoplay' => 0,
            'title' => 1,
            'byline' => 1,
            'portrait' => 0,
            'color' => '00adef',
            'loop' => 0
        );
    }
    
    function getPath(){
        return dirname(__FILE__).DIRECTORY_SEPARATOR.$this->_identifier.DIRECTORY_SEPARATOR;
    } 
}

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemVimeo');