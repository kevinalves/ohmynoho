<?php

nextendimportsmartslider2('nextend.smartslider.plugin.slideritem');

class plgNextendSliderItemCaption extends plgNextendSliderItemAbstract {

    var $_identifier = 'caption';

    var $_title = 'Caption';

    function getTemplate() {
        return "
          <div data-click='{onmouseclick}' data-enter='{onmouseenter}' data-leave='{onmouseleave}'>
            <a href='{url}'  target='{target}' style='display: block; background: none !important;'>
          		<div class='nextend-smartslider-caption {customcaptionclass}' style='width:{width}px; height:{height}px;'>
          			<img alt='{alt}' src='{image}' class='img-{captionclass}' />
          				<span class='caption nextend-smartslider-caption-{captionclass}'>
          				  <h4 class='{fontclasstitle}'>{content}</h4>
          					<p class='{fontclass}'>{description}</p>
          				</span>
          		</div>
          	</a>
    
          	<script type='text/javascript'>
          	    if(window['{{id}}-onresize'])
                    window['{{id}}-onresize'].push((function(script){
                        var node = null;
                        return function(ratio){
                            if(!node) node = njQuery(script).parent().find('> .nextend-smartslider-caption');
                            var w = njQuery.data(node, 'ss-w'),
                                h = njQuery.data(node, 'ss-h');
                            node.width((w ? w : njQuery.data(node, 'ss-w', node.width()))*ratio);
                            node.height((h ? h : njQuery.data(node, 'ss-h', node.height()))*ratio);
                        };
                    })(
                    (function(){
                        var scripts = document.getElementsByTagName( 'script' );
                        return scripts[ scripts.length - 1 ];
                    })())
                    );
    
          	</script>
            
            <style>
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption{
                	float: left;
                	position: relative;
                	overflow: hidden;   
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption img,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption{ 
                    position: absolute;
                    left: 0;
                    -webkit-transition: all 0.4s ease-out 0s;
                    -moz-transition: all 0.4s ease-out 0s;
                    -ms-transition: all 0.4s ease-out 0s;
                    -o-transition: all 0.4s ease-out 0s;
                    transition: all 0.4s ease-out 0s;
                	width: 100%;
                	height: 100%;
                }          
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption{
                	z-index: 2;
                    background: #{colorhex};
                    background: RGBA({colora});
                    margin: 0;
                }
                            
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption h4{
                    padding:  20px 20px 5px;
                    margin: 0;
                }
                
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption p{
                  padding: 0 20px;
                  margin: 0;
                }
                
                /* SIMPLE TITLE */
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-simple-bottom h4,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-simple-left h4{
                  padding:  5px 10px;
                  margin: 0;
                  text-align: center !important;
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-simple-bottom{
                  height: auto;
                  bottom: -100%;
                }
    
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-simple-bottom p{
                    display: none;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-simple-bottom,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-simple-bottom,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-simple-bottom{
                  bottom: 0;
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-simple-left{
                  left: -100%;
                  height: auto;;
                  bottom: 0px;
                }
    
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-simple-left p{
                    display: none;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-simple-left,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-simple-left,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-simple-left{
                  left: 0;
                }
                
                
                
                /* FULL CAPTION */
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-full-top{
                    top: -100%;
                }
                
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-full-top,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-full-top,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-full-top{
                    top: 0;
                }
    
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-full-bottom{
                    bottom: -100%;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-full-bottom,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-full-bottom,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-full-bottom{
                    bottom: 0;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-full-right{
                    left: 100%;
                    top: 0;
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-full-right,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-full-right,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-full-right{
                    left: 0;
                }
                            
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-full-left{
                    left: -100%;
                    top: 0;
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-full-left,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-full-left,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-full-left{
                    left: 0;
                }
                
                
                /* SLIDE */
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-slide-right{
                    left: 100%;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-slide-right,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-slide-right,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-slide-right{
                	left: 0;
                }
    
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER  .img-slide-right{
                	left: -100%;
                }
    
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-slide-left{
                    left: -100%;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-slide-left,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-slide-left,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-slide-left{
                	left: 0;
                }
                
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER  .img-slide-left{
                	left: 100%;
                }
    
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-slide-top{
                    top: -100%;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-slide-top,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-slide-top,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-slide-top{
                	top: 0;
                }
                
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER  .img-slide-top{
                	top: 100%;
                }   
    
    
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-slide-bottom{
                  bottom: -100%;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-slide-bottom,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:FOCUS .caption.nextend-smartslider-caption-slide-bottom,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:ACTIVE .caption.nextend-smartslider-caption-slide-bottom{
                	bottom: 0;
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER  .img-slide-bottom{
                	top: -100%;
                }
                
                
                /* SCALE */
                  
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale{
                  opacity: 0;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale h4,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale p{     
                	left: -100%;
                	position: relative;
                    -webkit-transition: all 0.4s ease-out 0s;
                    -moz-transition: all 0.4s ease-out 0s;
                    -ms-transition: all 0.4s ease-out 0s;
                    -o-transition: all 0.4s ease-out 0s;
                    transition: all 0.4s ease-out 0s;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale h4{
                	-webkit-transition-delay: 100ms;
                	-moz-transition-delay: 100ms;
                	-o-transition-delay: 100ms;
                	-ms-transition-delay: 100ms;	
                	transition-delay: 100ms;            
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale p{
                	-webkit-transition-delay: 300ms;
                	-moz-transition-delay: 300ms;
                	-o-transition-delay: 300ms;
                	-ms-transition-delay: 300ms;	
                	transition-delay: 300ms;
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .img-scale{
                	-moz-transform: scale(1.4);
                	-o-transform: scale(1.4);
                	-webkit-transform: scale(1.4);
                	transform: scale(1.4);
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-scale h4,
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-scale p{
                	left: 0;
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-scale{
                	opacity: 1;    
                }
                
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale-left{
                	left: -100%;
                }    
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .img-scale-left{
                	-moz-transform: scale(1.4);
                	-o-transform: scale(1.4);
                	-webkit-transform: scale(1.4);
                	transform: scale(1.4);
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-scale-left{
                	left: 0;
                }
                            
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale-right{
                	left: 100%;
                }    
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .img-scale-right{
                	-moz-transform: scale(1.4);
                	-o-transform: scale(1.4);
                	-webkit-transform: scale(1.4);
                	transform: scale(1.4);
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-scale-right{
                	left: 0;
                }
                                     
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale-bottom{
                	bottom: -100%;
                }    
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .img-scale-bottom{
                	-moz-transform: scale(1.4);
                	-o-transform: scale(1.4);
                	-webkit-transform: scale(1.4);
                	transform: scale(1.4);
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-scale-bottom{
                	bottom: 0;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-scale-top{
                	top: -100%;
                }    
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .img-scale-top{
                	-moz-transform: scale(1.4);
                	-o-transform: scale(1.4);
                	-webkit-transform: scale(1.4);
                	transform: scale(1.4);
                }            
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-scale-top{
                	top: 0;
                }
                
                
                /* FADE */
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption .caption.nextend-smartslider-caption-fade{
                  opacity: 0;
                }
                
                div#{{id}} .{customcaptionclass}.nextend-smartslider-caption:HOVER .caption.nextend-smartslider-caption-fade{
                  opacity: 1;
                }
                
    
            </style>
        </div>
        ";
    }

    function getValues() {
        return array(
            'link' => '#|*|_self',
            'url' => '',
            'target' => '_self',
            'image' => NextendSmartSliderSettings::get('placeholder'),
            'alt' => 'Image not available',
            'content' => 'Title',
            'description' => 'Here comes the description text.',
            'fontclass' => 'sliderfont11',
            'fontclasstitle' => 'sliderfont1',
            'captionclass' => 'simple-bottom',
            'width' => '130',
            'height' => '120',
            'color' => '00000080',
            'colora' => 'RGBA(0,0,0,0.6)',
            'colorhex' => '000000',
            'customcaptionclass' => 'my-caption-custom-class',
            'onmouseclick' => '',
            'onmouseenter' => '',
            'onmouseleave' => ''
        );
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . $this->_identifier . DIRECTORY_SEPARATOR;
    }
}

NextendPlugin::addPlugin('nextendslideritem', 'plgNextendSliderItemCaption');