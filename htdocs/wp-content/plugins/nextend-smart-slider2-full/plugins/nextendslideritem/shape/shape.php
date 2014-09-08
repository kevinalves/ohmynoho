<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemShape extends plgNextendSliderItemAbstract {

    var $_identifier = 'shape';

    var $_title = 'Shape';

    function getTemplate() {
        return "
          <div>
          		<div class='{uuuid} nextend-smartslider-shape nextend-smartslider-shape-{shapeclass}' data-click='{onmouseclick}' data-enter='{onmouseenter}' data-leave='{onmouseleave}'>

          		</div>
            <style>   
               div#{{id}} .{uuuid}.nextend-smartslider-shape-square{
                width: {width}px;
                height: {height}px;
                background: #{colorhex};
                background: RGBA({colora});
               }   
               
               div#{{id}} .{uuuid}.nextend-smartslider-shape-rounded-square{
                width: {width}px;
                height: {height}px;
                background: #{colorhex};
                background: RGBA({colora});                
                -webkit-border-radius: 2%;
                -moz-border-radius: 2%;
                border-radius: 2%;
               }
               
              div#{{id}} .{uuuid}.nextend-smartslider-shape-circle{
                width: {width}px;
                height: {height}px;
                background: #{colorhex};
                background: RGBA({colora});
                -webkit-border-radius: 100%;
                -moz-border-radius: 100%;
                border-radius: 100%;
               }
               
              div#{{id}} .{uuuid}.nextend-smartslider-shape-triangle-up{
                width: 0; 
                height: 0; 
                border-left: {width}px solid transparent; 
                border-right: {width}px solid transparent; 
                border-bottom: {height}px solid #{colorhex};
                border-bottom: {height}px solid RGBA({colora});
               }
               
              div#{{id}} .{uuuid}.nextend-smartslider-shape-triangle-down{
                width: 0; 
                height: 0; 
                border-left: {width}px solid transparent; 
                border-right: {width}px solid transparent; 
                border-top: {height}px solid #{colorhex};
                border-top: {height}px solid RGBA({colora});
               }
               
              div#{{id}} .{uuuid}.nextend-smartslider-shape-triangle-left{
                width: 0; 
                height: 0; 
                border-top: {height}px solid transparent; 
                border-right: {width}px solid #{colorhex};
                border-right: {width}px solid RGBA({colora}); 
                border-bottom: {height}px solid transparent;
               }
               
              div#{{id}} .{uuuid}.nextend-smartslider-shape-triangle-right{
                width: 0; 
                height: 0; 
                border-top: {height}px solid transparent; 
                border-left: {width}px solid #{colorhex};
                border-left: {width}px solid RGBA({colora}); 
                border-bottom: {height}px solid transparent;
               }               
                              
              div#{{id}} .{uuuid}.nextend-smartslider-shape-triangle-top-left{
                width: 0; 
                height: 0;                 
                border-top: {height}px solid #{colorhex};
                border-top: {height}px solid RGBA({colora}); 
                border-right: {width}px solid transparent;
               }  
                            
              div#{{id}} .{uuuid}.nextend-smartslider-shape-triangle-top-right{
                width: 0; 
                height: 0;                 
                border-top: {height}px solid #{colorhex};
                border-top: {height}px solid RGBA({colora}); 
                border-left: {width}px solid transparent;
               }              
               
               div#{{id}} .{uuuid}.nextend-smartslider-shape-triangle-bottom-left{
                width: 0; 
                height: 0;                 
                border-bottom: {height}px solid #{colorhex};
                border-bottom: {height}px solid RGBA({colora}); 
                border-right: {width}px solid transparent;
               }  
                            
              div#{{id}} .{uuuid}.nextend-smartslider-shape-triangle-bottom-right{
                width: 0; 
                height: 0;                 
                border-bottom: {height}px solid #{colorhex};
                border-bottom: {height}px solid RGBA({colora}); 
                border-left: {width}px solid transparent;
               }          
            </style>
          	<script type='text/javascript'>
          	    if(window['{{id}}-onresize'])
                    window['{{id}}-onresize'].push((function(script){
                        var node = null,
                          w = {width},
                          h = {height};
                        return function(ratio){
                            if(!node) node = njQuery(script).parent().find('> .nextend-smartslider-shape');
                            var nw = w*ratio,
                                nh = h*ratio;
                            switch('{shapeclass}'){
                              case 'triangle-up':
                                node.css({
                                    'borderLeftWidth': nw,
                                    'borderRightWidth': nw,
                                    'borderBottomWidth': nh
                                });
                                break;
                              case 'triangle-down':
                                node.css({
                                    'borderLeftWidth': nw,
                                    'borderRightWidth': nw,
                                    'borderTopWidth': nh
                                });
                                break;
                              case 'triangle-left':
                                node.css({
                                    'borderTopWidth': nh,
                                    'borderRightWidth': nw,
                                    'borderBottomWidth': nh
                                });
                                break;
                              case 'triangle-right':
                                node.css({
                                    'borderTopWidth': nh,
                                    'borderLeftWidth': nw,
                                    'borderBottomWidth': nh
                                });
                                break;
                              case 'triangle-top-left':
                                node.css({
                                    'borderTopWidth': nh,
                                    'borderRightWidth': nw
                                });
                                break;
                              case 'triangle-top-right':
                                node.css({
                                    'borderLeftWidth': nw,
                                    'borderTopWidth': nh
                                });
                                break;
                              case 'triangle-bottom-left':
                                node.css({
                                    'borderBottomWidth': nh,
                                    'borderRightWidth': nw
                                });
                                break;
                              case 'triangle-bottom-right':
                                node.css({
                                    'borderLeftWidth': nw,
                                    'borderBottomWidth': nh
                                });
                                break;
                              default:
                                node.width(nw);
                                node.height(nh);
                            }
                        };
                    })(
                    (function(){
                        var scripts = document.getElementsByTagName( 'script' );
                        return scripts[ scripts.length - 1 ];
                    })())
                    );
    
          	</script>
        </div>
        ";
    }

    function getValues() {
        return array(
            'width' => '100',
            'height' => '100',
            'color' => '00000080',
            'colora' => 'RGBA(0,0,0,0.6)',
            'colorhex' => '000000',
            'onmouseclick' => '',
            'onmouseenter' => '',
            'onmouseleave' => ''
        );
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->_identifier . DIRECTORY_SEPARATOR;
    }
}

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemShape');