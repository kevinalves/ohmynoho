(function ($, scope, undefined) {
    scope.ssHorizontalAccordionSlider = scope.ssTypeBase.extend({
        init: function (parent, $el, options) {
            var _this = this;

            options.mainlayer = false;

            this.titles = $el.find('.accordion-horizontal-title');
            this.slides = $el.find('.accordion-horizontal-slide');

            this._super(parent, $el, options);

            for (var i = 0; i < this.slideList.length; i++) {
                this.titles.eq(i).data('ssi', i).on('click', function () {
                    _this.changeTo($(this).data('ssi'), false);
                });
            }
            this.titles.eq(this._active).addClass('active');
            this.slides.eq(this._active).addClass('active').width(this.slideDimension.w);
        },
        storeDefaults: function () {
            var ss = this.$slider;

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

            smartsliderborder1.data('ss-p-t', parseInt(smartsliderborder1.css('paddingTop')));
            smartsliderborder1.data('ss-p-r', parseInt(smartsliderborder1.css('paddingRight')));
            smartsliderborder1.data('ss-p-b', parseInt(smartsliderborder1.css('paddingBottom')));
            smartsliderborder1.data('ss-p-l', parseInt(smartsliderborder1.css('paddingLeft')));
            smartsliderborder1.data('ss-w', smartsliderborder1.width());
            smartsliderborder1.data('ss-h', smartsliderborder1.height());

            var smartsliderborder2 = this.smartsliderborder2 = ss.find('.smart-slider-border2');

            smartsliderborder2.data('ss-p-t', parseInt(smartsliderborder2.css('paddingTop')));
            smartsliderborder2.data('ss-p-r', parseInt(smartsliderborder2.css('paddingRight')));
            smartsliderborder2.data('ss-p-b', parseInt(smartsliderborder2.css('paddingBottom')));
            smartsliderborder2.data('ss-p-l', parseInt(smartsliderborder2.css('paddingLeft')));
            smartsliderborder2.data('ss-w', smartsliderborder2.width());
            smartsliderborder2.data('ss-h', smartsliderborder2.height());

            var titles = this.titles = ss.find('.accordion-horizontal-title');
            titles.data('ss-w', titles.width());
            titles.data('ss-h', titles.height());

            var titles90 = this.titles90 = ss.find('.accordion-horizontal-title-rotate-90');
            titles90.data('ss-w', titles90.width());
            titles90.data('ss-h', titles90.height());
            titles90.data('ss-lineheight', parseInt(titles90.css('lineHeight')));

            var slides = this.slides;
            slides.data('ss-w', slides.width());
            slides.data('ss-h', slides.height());

            var canvases = this.slideList;
            
            this.variables.canvaswidth = canvases.width();
            this.variables.canvasheight = canvases.height();
            
            canvases.data('ss-w', this.variables.canvaswidth);
            canvases.data('ss-h', this.variables.canvasheight);

            this.margin = parseInt(titles.css('marginLeft')) + parseInt(slides.css('marginRight'));

            this.variablesRefreshed();
        },
        onResize: function () {
            var ss = this.$slider;

            var ratio = 1;

            var availableWidth = ss.parent().width();

            var outerWidth = ss.data('ss-outerwidth');
            
            if(!this.options.responsive.upscale && availableWidth > outerWidth) availableWidth = outerWidth;
            
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

            smartsliderborder1.width(parseInt(smartsliderborder1.data('ss-w') * ratio));
            smartsliderborder1.height(parseInt(smartsliderborder1.data('ss-h') * ratio));

            smartsliderborder1.css('paddingTop', parseInt(smartsliderborder1.data('ss-p-t') * ratio) + 'px');
            smartsliderborder1.css('paddingRight', parseInt(smartsliderborder1.data('ss-p-r') * ratio) + 'px');
            smartsliderborder1.css('paddingBottom', parseInt(smartsliderborder1.data('ss-p-b') * ratio) + 'px');
            smartsliderborder1.css('paddingLeft', parseInt(smartsliderborder1.data('ss-p-l') * ratio) + 'px');

            this.variables.width = smartsliderborder1.outerWidth(true);
            ss.width(this.variables.width);
            
            this.variables.height = smartsliderborder1.outerHeight(true);
            ss.height(this.variables.height);

            var smartsliderborder2 = this.smartsliderborder2;

            var smartsliderborder2Width = parseInt(smartsliderborder2.data('ss-w') * ratio);

            smartsliderborder2.width(smartsliderborder2Width);
            smartsliderborder2.height(parseInt(smartsliderborder2.data('ss-h') * ratio));
            smartsliderborder2.css('paddingTop', parseInt(smartsliderborder2.data('ss-p-t') * ratio + 'px'));
            smartsliderborder2.css('paddingRight', parseInt(smartsliderborder2.data('ss-p-r') * ratio + 'px'));
            smartsliderborder2.css('paddingBottom', parseInt(smartsliderborder2.data('ss-p-b') * ratio + 'px'));
            smartsliderborder2.css('paddingLeft', parseInt(smartsliderborder2.data('ss-p-l') * ratio + 'px'));

            var titles = this.titles;

            var canvasHeight = parseInt(titles.data('ss-h') * ratio);

            var titleWidth = parseInt(titles.data('ss-w') * ratio);

            titles.width(titleWidth);
            titles.height(canvasHeight);

            var titles90 = this.titles90;

            titles90.width(parseInt(titles90.data('ss-w') * ratio));
            titles90.height(parseInt(titles90.data('ss-h') * ratio));
            titles90.css('lineHeight', parseInt(titleWidth - 6) + 'px');

            var slides = this.slides;
            //slides.width(slides.data('ss-w') * ratio);
            slides.height(canvasHeight);

            var canvases = this.slideList;


            var canvasWidth = parseInt(smartsliderborder2Width - (this.margin + titleWidth) * canvases.length);

            canvases.width(canvasWidth);
            canvases.height(canvasHeight);

            this.variables.canvaswidth = canvasWidth;
            this.variables.canvasheight = canvasHeight;

            this.slideDimension.w = canvasWidth;
            this.slideDimension.h = canvasHeight;

            this.slidebgList.width(this.slideDimension.w);

            this.slides.eq(this._active).width(this.slideDimension.w);
            
            this.variables.outerwidth = ss.parent().width();
            this.variables.outerheight = ss.parent().height();

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
        changeTo: function (i, reversed) {
            if (window.ssadmin || i === this._active || this._animating)
                return false;

            if (!this.options.syncAnimations) {
                if (this._lastActive != i) this.slideList.eq(this._lastActive).trigger('ssanimatestop');
                this.slideList.eq(this._active).trigger('ssanimatestop');
            }

            var _this = this;

            this.pauseAutoPlay();

            this._animating = true;
            if (this.options.syncAnimations) _this._runningAnimations++; // Connected to this.changeTab() last animation to prevent earlier finish!

            this.changeBullet(i);

            $(this).trigger('mainanimationstart');

            this.titles.eq(i).addClass('active');
            this.titles.eq(this._active).removeClass('active');
            this.slides.eq(this._active).removeClass('active');

            var $currentactiveslide = this.slideList.eq(this._active),
                $nextactiveslide = this.slideList.eq(i),
                playin = function () {

                    if (_this.options.inaftermain) {

                        $nextactiveslide.trigger('ssanimatelayerssetinstart');

                        _this.$this.on('mainanimationinend.inaftermain', function () {
                            _this.$this.off('mainanimationinend.inaftermain');
                            $nextactiveslide.trigger('ssanimatelayersin');
                        });
                    } else {
                        $nextactiveslide.trigger('ssanimatelayersin');
                    }
                };


            if (this.options.mainafterout) {
                $currentactiveslide.on('ssanimationsended.ssinaftermain', function () {
                    $currentactiveslide.off('ssanimationsended.ssinaftermain');
                    _this.changeTab(_this._active, i, reversed);
                    _this._runningAnimations++;
                    _this.animateOut(_this._active, reversed);
                    playin();
                });

                if (this.options.syncAnimations) {
                    $currentactiveslide.trigger('ssanimatelayersout');
                }
            } else {
                this.changeTab(this._active, i, reversed);
                this._runningAnimations++;
                this.animateOut(this._active, reversed);

                if (this.options.syncAnimations) {
                    $currentactiveslide.trigger('ssanimatelayersout');
                }

                playin();
            }
        },
        changeTab: function (previous, current, reversed) {
            var _this = this,
                $nextSlide = this.slideList.eq(current);

            _this._runningAnimations++;
            this.slides.eq(previous).animate({
                width: 0
            }, {
                duration: this.options.duration,
                easing: this.options.easing,
                complete: function () {
                    _this.mainanimationended();
                }
            });

            this.slides.eq(current).animate({
                width: this.slideDimension.w
            }, {
                duration: this.options.duration,
                easing: this.options.easing,
                complete: function () {
                    /*$nextSlide.on('ssanimateinend.startlayers', function () {
                     $nextSlide.off('ssanimateinend.startlayers').trigger('ssanimatelayersin');
                     });*/
                    _this.animateIn(current, reversed);
                }
            });
        },
        mainanimationinend: function () {
            this.slideList.eq(this._lastActive).trigger('ssanimatelayerssetoutstart');
            //this.slideList.eq(this._lastActive).trigger('ssanimatelayerssetinstart');
            this.slides.eq(this._active).addClass('active');
        }
    });

})(njQuery, window);