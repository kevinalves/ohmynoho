(function ($, scope, undefined) {
    scope.ssSimpleSlider = scope.ssTypeBase.extend({
        extraParallax: 1,
        init: function (parent, $el, options) {
            var _this = this;

            options.flux[0] = (options.flux[0] && parseInt(options.flux[0])) ? true : false;

            this._super(parent, $el, options);

            this.smartsliderborder2 = $el.find('.smart-slider-border2');

            this.$this.on('mainanimationoutend', function () {
                var $slide = this.slideList.eq(_this._lastActive);
                $slide.css('display', 'none');
            });
            $(this).on('load.firstsub', function () {
                $(this).off('load.firstsub');
            });
        },
        sizeInited: function () {
            if (this.options.flux[0]) {
                this.flux = new flux.slider('#'+this.id+' .nextend-flux', {
                    transitions: this.options.flux[1],
                    width: this.slideDimension.w,
                    height: this.slideDimension.h,
                    currentImageIndex: this._active,
                    nextImageIndex: this._active + 1
                });
            }
        },
        storeDefaults: function () {
            var _this = this,
                ss = this.$slider;

            ss.data('ss-outerwidth', ss.outerWidth(true));

            ss.data('ss-fontsize', parseInt(ss.css('fontSize')));

            this.variables.margintop = parseInt(ss.css('marginTop'));
            this.variables.marginright = parseInt(ss.css('marginRight'));
            this.variables.marginbottom = parseInt(ss.css('marginBottom'));
            this.variables.marginleft = parseInt(ss.css('marginLeft'));
            
            ss.data('ss-m-t', this.variables.margintop);
            ss.data('ss-m-r', this.variables.marginright);
            ss.data('ss-m-b', this.variables.marginbottom);
            ss.data('ss-m-l', this.variables.marginleft);
            
            this.variables.outerwidth = ss.parent().width();
            this.variables.outerheight = ss.parent().height();
                
            this.variables.width = ss.width();
            this.variables.height = ss.height();
            
            ss.data('ss-w', this.variables.width);
            ss.data('ss-h', this.variables.height);

            var smartsliderborder1 = this.smartsliderborder1 = ss.find('.smart-slider-border1');
            
            smartsliderborder1.data('ss-w', smartsliderborder1.width());
            smartsliderborder1.data('ss-h', smartsliderborder1.height());
            smartsliderborder1.data('ss-p-t', parseInt(smartsliderborder1.css('paddingTop')));
            smartsliderborder1.data('ss-p-r', parseInt(smartsliderborder1.css('paddingRight')));
            smartsliderborder1.data('ss-p-b', parseInt(smartsliderborder1.css('paddingBottom')));
            smartsliderborder1.data('ss-p-l', parseInt(smartsliderborder1.css('paddingLeft')));

            var canvases = this.smartslidercanvasinner = this.slideList.find('.smart-slider-canvas-inner');
                
            this.variables.canvaswidth = canvases.width();
            this.variables.canvasheight = canvases.height();
            
            canvases.data('ss-w', this.variables.canvaswidth);
            canvases.data('ss-h', this.variables.canvasheight);
            
            this.slideList.css({
                width: this.variables.canvaswidth,
                height: this.variables.canvasheight
            });
            
            this.imagesinited = false;
            this.$slider.waitForImages(function () {
                $.each(_this.slidebgList, function(){
                    var $img = $(this);
                    var im = $("<img/>").attr("src", $img.attr("src"));
                    $img.data('ss-w', im[0].width);
                    $img.data('ss-h', im[0].height);
                });
                _this.imagesinited = true;
                _this.$slider.trigger('imagesinited');
            });

            this.variablesRefreshed();
        },
        onResize: function () {
            var _this = this,
                ss = this.$slider;

            var ratio = 1;

            var availableWidth = ss.parent().width();

            var outerWidth = ss.data('ss-outerwidth');

            if (!this.options.responsive.upscale && availableWidth > outerWidth) availableWidth = outerWidth;

            if (availableWidth != outerWidth) {
                ratio = availableWidth / outerWidth;
            }

            if (this.lastAvailableWidth == availableWidth || !this.options.responsive.downscale && ratio < 1) {
                var _this = this;
                this.$slider.waitForImages(function () {
                    $(_this).trigger('load');
                });
                return true;
            }

            this.lastAvailableWidth = availableWidth;

            ss.css('fontSize', ss.data('ss-fontsize') * ratio + 'px');

            this.variables.margintop = parseInt(ss.data('ss-m-t') * ratio);
            this.variables.marginright = parseInt(ss.data('ss-m-r') * ratio);
            this.variables.marginbottom = parseInt(ss.data('ss-m-b') * ratio);
            this.variables.marginleft = parseInt(ss.data('ss-m-l') * ratio);

            ss.css('marginTop', this.variables.margintop);
            ss.css('marginRight', this.variables.marginright);
            ss.css('marginBottom', this.variables.marginbottom);
            ss.css('marginLeft', this.variables.marginleft);

            var smartsliderborder1 = this.smartsliderborder1;


            smartsliderborder1.css('paddingTop', parseInt(smartsliderborder1.data('ss-p-t') * ratio) + 'px');
            smartsliderborder1.css('paddingRight', parseInt(smartsliderborder1.data('ss-p-r') * ratio) + 'px');
            smartsliderborder1.css('paddingBottom', parseInt(smartsliderborder1.data('ss-p-b') * ratio) + 'px');
            smartsliderborder1.css('paddingLeft', parseInt(smartsliderborder1.data('ss-p-l') * ratio) + 'px');

            smartsliderborder1.width(parseInt(smartsliderborder1.data('ss-w') * ratio));


            this.variables.width = smartsliderborder1.outerWidth(true);
            ss.width(this.variables.width);


            var canvases = this.smartslidercanvasinner;
            var oCanvasWidth = canvasWidth = parseInt(canvases.data('ss-w') * ratio),
                oCanvasHeight = parseInt(canvases.data('ss-h') * ratio),
                margin = 0,
                maxw = this.options.responsive.maxwidth,
                ratio2 = ratio;

            if (canvasWidth > this.options.responsive.maxwidth) {
                margin = parseInt((canvasWidth - maxw) / 2);
                ratio2 = maxw / canvases.data('ss-w');
                canvasWidth = parseInt(canvases.data('ss-w') * ratio2);
            }

            this.extraParallax = ratio / ratio2;

            var canvasHeight = parseInt(canvases.data('ss-h') * ratio2);
            
            if (this.options.flux[0]) this.flux.changeSize(oCanvasWidth, canvasHeight);

            canvases.width(canvasWidth).height(canvasHeight).css({
                marginLeft: margin,
                marginRight: margin
            });

            this.slideList.css({
                width: canvases.outerWidth(true),
                height: canvases.outerHeight(true)
            });

            smartsliderborder1.css('fontSize', ss.data('ss-fontsize') * ratio2 + 'px');

            smartsliderborder1.height(canvasHeight);
            
            this.variables.height = smartsliderborder1.outerHeight(true);
            ss.height(this.variables.height);

            this.slideDimension.w = canvasWidth;
            this.slideDimension.h = canvasHeight;

            this.variables.canvaswidth = canvasWidth;
            this.variables.canvasheight = canvasHeight;
            
            
            this.variables.outerwidth = ss.parent().width();
            this.variables.outerheight = ss.parent().height();
            
            
            this.slidebgList.width(oCanvasWidth);
            var bgfn = function () {
                $.each(_this.slidebgList, function(){
                    var $img = $(this);
                    $img.height(parseInt(oCanvasWidth/$img.data('ss-w')*$img.data('ss-h')));
                });
            };
            if(_this.imagesinited){
                bgfn();
            }else{
                _this.$slider.on('imagesinited', function(){
                    bgfn();
                });
            }


            for (var i = 0; i < window[this.id + '-onresize'].length; i++) {
                window[this.id + '-onresize'][i](ratio);
            }
            $(this).trigger('resize', [ratio, canvasWidth, canvasHeight]);

            var _this = this;
            this.$slider.waitForImages(function () {
                $(_this).trigger('load');
            });
            
            this.variablesRefreshed();
        },
        animateOut: function (i, reversed) {
            var _this = this;
            this._lastActive = i;

            this.initAnimation();

            var $slide = this.slideList.eq(i);
            $slide.on('ssanimationsended.ssmainanimateout',function () {
                $slide.off('ssanimationsended.ssmainanimateout');
                _this.$this.trigger('mainanimationoutend');
                _this.mainanimationended();
            }).trigger('ssoutanimationstart');
            this.__animateOut($slide, reversed).animateOut();
        },
        animateIn: function (i, reversed) {
            this._active = i;
            var _this = this,
                $slide = this.slideList.eq(i);

            $slide.width(this.slideList.width());
            $slide.on('ssanimationsended.ssmainanimatein',function () {
                $slide.off('ssanimationsended.ssmainanimatein');
                _this.$this.trigger('mainanimationinend');
                _this.mainanimationended();
            }).trigger('ssinanimationstart');

            if (this.options.flux[0]) {
                //make them synced
                var ended = null,
                endFN = function(){
                    _this.mainanimationended();
                    $slide.trigger('decrementanimation');
                };
                ended = function(){
                    ended = endFN;
                };
                
                $slide.trigger('incrementanimation');
                this.__animateIn($slide, reversed,function () {
                    ended();
                }).animateIn();
                this.flux.element.on('fluxTransitionEnd.ss', function (event) {
                    $(this).off('fluxTransitionEnd.ss');
                    ended();
                });
                this.flux.showImage(i);
            } else {
                this.__animateIn($slide, reversed,function () {
                    _this.mainanimationended();
                }).animateIn();
            }
        },

        initAnimation: function () {
            var currentAnimation = this.options.animation[Math.floor(Math.random() * this.options.animation.length)];
            this._animationOptions = {
                next: {},
                current: {}
            };

            this._animationOptions.next = $.merge(this.options.animationSettings, this._animationOptions.next);
            this._animationOptions.current = $.merge(this.options.animationSettings, this._animationOptions.current);

            switch (currentAnimation) {
                case 'horizontal':
                    this.__animateIn = this.__animateInHorizontal;
                    this.__animateOut = this.__animateOutHorizontal;
                    break;
                case 'vertical':
                    this.__animateIn = this.__animateInVertical;
                    this.__animateOut = this.__animateOutVertical;
                    break;
                case 'fade':
                    this.__animateIn = this.__animateInFade;
                    this.__animateOut = this.__animateOutFade;
                    break;
                default:
                    this.__animateIn = this.__animateInNo;
                    this.__animateOut = this.__animateOutNo;
                    break;
            }
        },

        __animateIn: function ($slide, reversed, end) {

        },

        __animateOut: function ($slide, reversed, end) {

        },

        __animateInNo: function ($slide, reversed, end) {
            if (end) end();
            return ssAnimationManager.getAnimation('no', $slide, {});
        },

        __animateOutNo: function ($slide, reversed, end) {
            if (end) end();
            return ssAnimationManager.getAnimation('no', $slide, {});
        },

        __animateInHorizontal: function ($slide, reversed, end) {

            var option = this._animationOptions.next;
            return ssAnimationManager.getAnimation((reversed && option.parallax >= 1) ? 'slidelefttoright' : 'sliderighttoleft', $slide, {
                width: this.slideDimension.w,
                height: this.slideDimension.h,
                intervalIn: option.duration,
                easingIn: option.easing,
                delayIn: option.delay,
                parallaxIn: option.parallax * this.extraParallax,
                target: {},
                endFn: function () {
                    if (end) end();
                }
            });
        },

        __animateOutHorizontal: function ($slide, reversed, end) {

            var _this = this,
                option = this._animationOptions.current,
                target = option.parallax < 1 ? {width: this.smartsliderborder2.width() * option.parallax} : {};

            return ssAnimationManager.getAnimation((reversed && option.parallax >= 1) ? 'slidelefttoright' : 'sliderighttoleft', $slide, {
                width: this.slideDimension.w,
                height: this.slideDimension.h,
                intervalOut: option.duration,
                easingOut: option.easing,
                delayOut: option.delay,
                parallaxOut: option.parallax * this.extraParallax,
                target: target,
                endFn: function () {
                    $slide.width(_this.smartsliderborder2.width());
                    if (end) end();
                }
            });
        },

        __animateInVertical: function ($slide, reversed, end) {

            var option = this._animationOptions.next;
            return ssAnimationManager.getAnimation((reversed && option.parallax >= 1) ? 'slidetoptobottom' : 'slidebottomtotop', $slide, {
                width: this.slideDimension.w,
                height: this.slideDimension.h,
                intervalIn: option.duration,
                easingIn: option.easing,
                delayIn: option.delay,
                parallaxIn: option.parallax * this.extraParallax,
                target: {},
                endFn: function () {
                    if (end) end();
                }
            });
        },

        __animateOutVertical: function ($slide, reversed, end) {

            var _this = this,
                option = this._animationOptions.current,
                target = option.parallax < 1 ? {height: this.smartsliderborder2.height() * option.parallax} : {};

            return ssAnimationManager.getAnimation((reversed && option.parallax >= 1) ? 'slidetoptobottom' : 'slidebottomtotop', $slide, {
                width: this.slideDimension.w,
                height: this.slideDimension.h,
                intervalOut: option.duration,
                easingOut: option.easing,
                delayOut: option.delay,
                parallaxOut: option.parallax * this.extraParallax,
                target: target,
                endFn: function () {
                    $slide.height(_this.smartsliderborder2.height());
                    if (end) end();
                }
            });
        },

        __animateInFade: function ($slide, reversed, end) {

            var option = this._animationOptions.next;
            return ssAnimationManager.getAnimation('fade', $slide, {
                width: this.slideDimension.w,
                height: this.slideDimension.h,
                intervalIn: option.duration,
                easingIn: option.easing,
                delayIn: option.delay,
                parallaxIn: option.parallax * this.extraParallax,
                endFn: function () {
                    if (end) end();
                }
            });
        },

        __animateOutFade: function ($slide, reversed, end) {

            var option = this._animationOptions.current;

            return ssAnimationManager.getAnimation('fade', $slide, {
                width: this.slideDimension.w,
                height: this.slideDimension.h,
                intervalOut: option.duration,
                easingOut: option.easing,
                delayOut: option.delay,
                parallaxOut: option.parallax * this.extraParallax,
                endFn: function () {
                    if (end) end();
                }
            });
        }
    });

})(njQuery, window);