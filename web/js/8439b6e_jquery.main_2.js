// page init
jQuery(function(){
	jQuery('select.custom').customSelect();
	initOpenClose();
	initTabs();
	clearInputs();
	initCycleGallery();
	initScrollGallery();
	initPopups();
});
jQuery(window).load(boxSize);

// tabs init
function initTabs() {
	jQuery('ul.tabset').jqueryTabs({
		activeClass:'active',
		tabLinks:'a.tab',
		fadeSpeed:0
	})
}

// box size init
function boxSize(){
	jQuery('.highlight-list .unit').each(function(){
		var hold = jQuery(this);
		var box = hold.find('.purchase');
		box.css({minHeight: hold.height() - 82})
	})
}

// clear inputs init
function clearInputs() {
	clearFormFields({
		clearInputs: true,
		clearTextareas: true
	});
}

// cycle gallery init
function initCycleGallery() {
	jQuery('.slideshow').cycleGallery({
		slider:'.holder > ul',
		slides:'>li',
		pagerLinks: '.listing li'
	});
}

// scroll gallery init
function initScrollGallery() {
	jQuery('div.carousel-box').scrollGallery({
		sliderHolder:'.holder',
		btnNext:'.link-next',
		btnPrev:'.link-prev',
		duration : 500
	});
}

// open-close init
function initOpenClose() {
	var activeClass = 'active';
	var animSpeed = 500;
	jQuery('.open-box').each(function() {
		var hold = jQuery(this);
		var opener = hold.find('.opener');
		var slider = hold.find('.drop');
		if(slider.length) {
			opener.click(function(e) {
				if(hold.hasClass(activeClass)) {
					slider.slideUp(animSpeed, function() {hold.removeClass(activeClass);});
				}
				else {
					slider.slideDown(animSpeed, function() {hold.addClass(activeClass);});
					hold.addClass(activeClass);
				}
				e.preventDefault();
			})
		}
	})
	jQuery('body').click(function(e) {
		if(!jQuery(e.target).parents('.' + activeClass).length) {
			jQuery('.open-box').each(function() {
				if(jQuery(this).hasClass(activeClass)) {
					jQuery(this).removeClass(activeClass);
					jQuery(this).find('.drop').hide();
				}
			})
		}
	})
}

// scrolling gallery plugin
jQuery.fn.scrollGallery = function(_options){
	var _options = jQuery.extend({
		sliderHolder: '>div',
		slider:'>ul',
		slides: '>li',
		pagerLinks:'div.pager a',
		btnPrev:'a.link-prev',
		btnNext:'a.link-next',
		activeClass:'active',
		disabledClass:'disabled',
		generatePagination:'div.pg-holder',
		curNum:'em.scur-num',
		allNum:'em.sall-num',
		circleSlide:true,
		pauseClass:'gallery-paused',
		pauseButton:'none',
		pauseOnHover:true,
		autoRotation:false,
		stopAfterClick:false,
		switchTime:5000,
		duration:650,
		easing:'swing',
		event:'click',
		splitCount:false,
		afterInit:false,
		vertical:false,
		step:false
	},_options);

	return this.each(function(){
		// gallery options
		var _this = jQuery(this);
		var _sliderHolder = jQuery(_options.sliderHolder, _this);
		var _slider = jQuery(_options.slider, _sliderHolder);
		var _slides = jQuery(_options.slides, _slider);
		var _btnPrev = jQuery(_options.btnPrev, _this);
		var _btnNext = jQuery(_options.btnNext, _this);
		var _pagerLinks = jQuery(_options.pagerLinks, _this);
		var _generatePagination = jQuery(_options.generatePagination, _this);
		var _curNum = jQuery(_options.curNum, _this);
		var _allNum = jQuery(_options.allNum, _this);
		var _pauseButton = jQuery(_options.pauseButton, _this);
		var _pauseOnHover = _options.pauseOnHover;
		var _pauseClass = _options.pauseClass;
		var _autoRotation = _options.autoRotation;
		var _activeClass = _options.activeClass;
		var _disabledClass = _options.disabledClass;
		var _easing = _options.easing;
		var _duration = _options.duration;
		var _switchTime = _options.switchTime;
		var _controlEvent = _options.event;
		var _step = _options.step;
		var _vertical = _options.vertical;
		var _circleSlide = _options.circleSlide;
		var _stopAfterClick = _options.stopAfterClick;
		var _afterInit = _options.afterInit;
		var _splitCount = _options.splitCount;

		// gallery init
		if(!_slides.length) return;

		if(_splitCount) {
			var curStep = 0;
			var newSlide = $('<slide>').addClass('split-slide');
			_slides.each(function(){
				newSlide.append(this);
				curStep++;
				if(curStep > _splitCount-1) {
					curStep = 0;
					_slider.append(newSlide);
					newSlide = $('<slide>').addClass('split-slide');
				}
			});
			if(curStep) _slider.append(newSlide);
			_slides = _slider.children();
		}

		var _currentStep = 0;
		var _sumWidth = 0;
		var _sumHeight = 0;
		var _hover = false;
		var _stepWidth;
		var _stepHeight;
		var _stepCount;
		var _offset;
		var _timer;

		_slides.each(function(){
			_sumWidth+=$(this).outerWidth(true);
			_sumHeight+=$(this).outerHeight(true);
		});

		// calculate gallery offset
		function recalcOffsets() {
			if(_vertical) {
				if(_step) {
					_stepHeight = _slides.eq(_currentStep).outerHeight(true);
					_stepCount = Math.ceil((_sumHeight-_sliderHolder.height())/_stepHeight)+1;
					_offset = -_stepHeight*_currentStep;
				} else {
					_stepHeight = _sliderHolder.height();
					_stepCount = Math.ceil(_sumHeight/_stepHeight);
					_offset = -_stepHeight*_currentStep;
					if(_offset < _stepHeight-_sumHeight) _offset = _stepHeight-_sumHeight;
				}
			} else {
				if(_step) {
					_stepWidth = _slides.eq(_currentStep).outerWidth(true)*_step;
					_stepCount = Math.ceil((_sumWidth-_sliderHolder.width())/_stepWidth)+1;
					_offset = -_stepWidth*_currentStep;
					if(_offset < _sliderHolder.width()-_sumWidth) _offset = _sliderHolder.width()-_sumWidth;
				} else {
					_stepWidth = _sliderHolder.width();
					_stepCount = Math.ceil(_sumWidth/_stepWidth);
					_offset = -_stepWidth*_currentStep;
					if(_offset < _stepWidth-_sumWidth) _offset = _stepWidth-_sumWidth;
				}
			}
		}

		// gallery control
		if(_btnPrev.length) {
			_btnPrev.bind(_controlEvent,function(e){
				if(_stopAfterClick) stopAutoSlide();
				prevSlide();
				e.preventDefault();
			});
		}
		if(_btnNext.length) {
			_btnNext.bind(_controlEvent,function(e){
				if(_stopAfterClick) stopAutoSlide();
				nextSlide();
				e.preventDefault();
			});
		}
		if(_generatePagination.length) {
			_generatePagination.empty();
			recalcOffsets();
			var _list = $('<ul />');
			for(var i=0; i<_stepCount; i++) $('<li><a href="#">'+(i+1)+'</a></li>').appendTo(_list);
			_list.appendTo(_generatePagination);
			_pagerLinks = _list.children();
		}
		if(_pagerLinks.length) {
			_pagerLinks.each(function(_ind){
				jQuery(this).bind(_controlEvent,function(e){
					if(_currentStep != _ind) {
						if(_stopAfterClick) stopAutoSlide();
						_currentStep = _ind;
						switchSlide();
					}
					e.preventDefault();
				});
			});
		}

		// gallery animation
		function prevSlide() {
			recalcOffsets();
			if(_currentStep > 0) _currentStep--;
			else if(_circleSlide) _currentStep = _stepCount-1;
			switchSlide();
		}
		function nextSlide() {
			recalcOffsets();
			if(_currentStep < _stepCount-1) _currentStep++;
			else if(_circleSlide) _currentStep = 0;
			switchSlide();
		}
		function refreshStatus() {
			if(_pagerLinks.length) _pagerLinks.removeClass(_activeClass).eq(_currentStep).addClass(_activeClass);
			if(!_circleSlide) {
				_btnPrev.removeClass(_disabledClass);
				_btnNext.removeClass(_disabledClass);
				if(_currentStep == 0) _btnPrev.addClass(_disabledClass);
				if(_currentStep == _stepCount-1) _btnNext.addClass(_disabledClass);
			}
			if(_curNum.length) _curNum.text(_currentStep+1);
			if(_allNum.length) _allNum.text(_stepCount);
		}
		function switchSlide() {
			recalcOffsets();
			if(_vertical) _slider.animate({marginTop:_offset},{duration:_duration,queue:false,easing:_easing});
			else _slider.animate({marginLeft:_offset},{duration:_duration,queue:false,easing:_easing});
			refreshStatus();
			autoSlide();
		}

		// autoslide function
		function stopAutoSlide() {
			if(_timer) clearTimeout(_timer);
			_autoRotation = false;
		}
		function autoSlide() {
			if(!_autoRotation || _hover) return;
			if(_timer) clearTimeout(_timer);
			_timer = setTimeout(nextSlide,_switchTime+_duration);
		}
		if(_pauseOnHover) {
			_this.hover(function(){
				_hover = true;
				if(_timer) clearTimeout(_timer);
			},function(){
				_hover = false;
				autoSlide();
			});
		}
		recalcOffsets();
		refreshStatus();
		autoSlide();

		// pause buttton
		if(_pauseButton.length) {
			_pauseButton.click(function(e){
				if(_this.hasClass(_pauseClass)) {
					_this.removeClass(_pauseClass);
					_autoRotation = true;
					autoSlide();
				} else {
					_this.addClass(_pauseClass);
					stopAutoSlide();
				}
				e.preventDefault();
			});
		}

		if(_afterInit && typeof _afterInit === 'function') _afterInit(_this, _slides);
	});
}

// cycle gallery
jQuery.fn.cycleGallery = function(options){
	var options = jQuery.extend({
		holder: '.holder',
		slider: '.slider',
		slides: 'li',
		btnPrev: '.link-prev',
		btnNext: '.link-next',
		pagerLinks: '.pager a',
		curItem: '.cur-item',
		allItems: '.all-items',
		activeClass: 'active',
		animSpeed: 650,
		autoRotation: false
	}, options);

	return this.each(function(){
		var gal = jQuery(this);
		var holder = jQuery(options.holder, gal);
		var slider = jQuery(options.slider, gal);
		var slides = jQuery(options.slides, slider);
		var btnPrev = jQuery(options.btnPrev, gal);
		var btnNext = jQuery(options.btnNext, gal);
		var pagerLinks = jQuery(options.pagerLinks, gal);
		var curItem = jQuery(options.curItem, gal);
		var allItems = jQuery(options.allItems, gal);
		var activeClass = options.activeClass;
		var animSpeed = options.animSpeed;
		var autoRotation = options.autoRotation;
		
		var animating = false;
		var len = slides.length;
		var slideWidth = slides.eq(0).outerWidth(true);
		var index = 0;
		var prevIndex = 0;
		var direction = true, timer;
		
		slides.css({position: 'absolute', left: slideWidth}).eq(0).css({left: 0}).addClass(activeClass);
		slider.css({position: 'relative'}).height(slides.eq(0).outerHeight(true));
		
		function switchSlide() {
			animating = true;
			stopAutoSlide();
			if(direction) {
				slides.eq(prevIndex).removeClass(activeClass).stop().animate({left: -slideWidth}, {
					duration: animSpeed
				})
				slides.eq(index).addClass(activeClass).css({left: slideWidth}).stop().animate({left: 0}, {
					duration: animSpeed,
					complete: function() {
						animating = false;
					}
				})
			}
			else {
				slides.eq(prevIndex).removeClass(activeClass).stop().animate({left: slideWidth}, {
					duration: animSpeed
				})
				slides.eq(index).addClass(activeClass).css({left: -slideWidth}).stop().animate({left: 0}, {
					duration: animSpeed,
					complete: function() {
						animating = false;
					}
				})
			}
			slider.stop().animate({height: slides.eq(index).outerHeight(true)}, {
				duration: animSpeed
			})
			prevIndex = index;
			refresh();
			autoSlide();
		}
		function refresh() {
			var cur = index >= 0 ? index >= len ? 1 : index +1 : len - Math.abs(index) + 1;
			if(curItem.length) curItem.text(cur);
			if(allItems.length) allItems.text(len);
			if(pagerLinks.length) pagerLinks.removeClass(activeClass).eq(cur - 1).addClass(activeClass);
		}
		function slideNext() {
			if(!animating) {
				if(index == len - 1) index = 0;
				else index++;
				direction = true;
				switchSlide();
			}
		}
		function slidePrev() {
			if(!animating) {
				if(index == 0) index = len - 1;
				else index--;
				direction = false;
				switchSlide();
			}
		}
		btnNext.click(function(e) {
			slideNext();
			e.preventDefault();
		})
		btnPrev.click(function(e) {
			slidePrev();
			e.preventDefault();
		})
		pagerLinks.each(function(n) {
			jQuery(this).click(function(e) {
				if(!animating && index != n) {
					index = n;
					if(index > prevIndex) direction = true;
					else direction = false;
					switchSlide();
				}
				e.preventDefault();
			})
		})
		function stopAutoSlide() {
			clearTimeout(timer);
		}
		function autoSlide() {
			clearTimeout(timer);
			if(autoRotation) timer = setTimeout(slideNext, autoRotation + animSpeed);
		}
		refresh();
		autoSlide();
	});
}

// popups function
function initPopups() {
	var _zIndex = 1000;
	var _fadeSpeed = jQuery.browser.msie && jQuery.browser.version < 9 ? 0 : 350;
	var _faderOpacity = 0.65;
	var _faderBackground = '#000';
	var _faderId = 'lightbox-overlay';
	var _closeLink = 'a.btn-close, a.close, a.cancel';
	var _fader;
	var _lightbox = null;
	var _ajaxClass = 'ajax-load';
	var _openers = jQuery('a.open-popup');
	var _page = jQuery(document);
	var _minWidth = parseInt(jQuery('body').css('minWidth'));
	var _scroll = false;

	// init popup fader
	_fader = jQuery('#'+_faderId);
	if(!_fader.length) {
		_fader = jQuery('<div />');
		_fader.attr('id',_faderId);
		jQuery('body').append(_fader);
	}
	_fader.css({
		opacity:_faderOpacity,
		backgroundColor:_faderBackground,
		position:'absolute',
		overflow:'hidden',
		display:'none',
		top:0,
		left:0,
		zIndex:_zIndex
	});

	// IE6 iframe fix
	if(jQuery.browser.msie && jQuery.browser.version < 7) {
		if(!_fader.children().length) {
			var _frame = jQuery('<iframe src="javascript:false" frameborder="0" scrolling="no" />');
			_frame.css({
				opacity:0,
				width:'100%',
				height:'100%'
			});
			var _frameOverlay = jQuery('<div>');
			_frameOverlay.css({
				top:0,
				left:0,
				zIndex:1,
				opacity:0,
				background:'#000',
				position:'absolute',
				width:'100%',
				height:'100%'
			});
			_fader.empty().append(_frame).append(_frameOverlay);
		}
	}

	// lightbox positioning function
	function positionLightbox() {
		if(_lightbox) {
			var _windowHeight = jQuery(window).height();
			var _windowWidth = jQuery(window).width();
			var _lightboxWidth = _lightbox.outerWidth();
			var _lightboxHeight = _lightbox.outerHeight();
			var _pageHeight = _page.height();

			if (_windowWidth < _minWidth) _fader.css('width',_minWidth);
				else _fader.css('width','100%');
			if (_windowHeight < _pageHeight) _fader.css('height',_pageHeight);
				else _fader.css('height',_windowHeight);

			_lightbox.css({
				position:'absolute',
				zIndex:(_zIndex+1)
			});

			// vertical position
			if (_windowHeight > _lightboxHeight) {
				if (_windowWidth < _minWidth || jQuery.browser.msie && jQuery.browser.version < 7) {
					_lightbox.css({
						position:'absolute',
						top: parseInt(jQuery(window).scrollTop()) + (_windowHeight - _lightboxHeight) / 2
					});
				} else {
					_lightbox.css({
						position:'fixed',
						top: (_windowHeight - _lightboxHeight) / 2
					});
				}
			} else {
				var _faderHeight = _fader.height();
				if(_faderHeight < _lightboxHeight) _fader.css('height',_lightboxHeight);
				if (!_scroll) {
					if (_faderHeight - _lightboxHeight > parseInt(jQuery(window).scrollTop())) {
						_faderHeight = parseInt(jQuery(window).scrollTop())
						_scroll = _faderHeight;
					} else {
						_scroll = _faderHeight - _lightboxHeight;
					}
				}
				_lightbox.css({
					position:'absolute',
					top: _scroll
				});
			}

			// horizontal position
			if (_fader.width() > _lightbox.outerWidth()) _lightbox.css({left:(_fader.width() - _lightbox.outerWidth()) / 2});
			else _lightbox.css({left: 0});
		}
	}

	// show/hide lightbox
	function toggleState(_state) {
		if(!_lightbox) return;
		if(_state) {
			_fader.fadeIn(_fadeSpeed,function(){
				_lightbox.fadeIn(_fadeSpeed);
			});
			_scroll = false;
			positionLightbox();
		} else {
			_lightbox.fadeOut(_fadeSpeed,function(){
				_fader.fadeOut(_fadeSpeed);
				_scroll = false;
			});
		}
	}

	// popup actions
	function initPopupActions(_obj) {
		if(!_obj.get(0).jsInit) {
			_obj.get(0).jsInit = true;
			// close link
			_obj.find(_closeLink).click(function(){
				_lightbox = _obj;
				toggleState(false);
				return false;
			});
		}
	}

	// lightbox openers
	_openers.each(function(){
		var _opener = jQuery(this);
		var _target = _opener.attr('href');

		// popup load type - ajax or static
		if(_opener.hasClass(_ajaxClass)) {
			_opener.click(function(){
				// ajax load
				if(jQuery('div[rel*="'+_target+'"]').length == 0) {
					jQuery.ajax({
						url: _target,
						type: "POST",
						dataType: "html",
						success: function(msg){
							// append loaded popup
							_lightbox = jQuery(msg);
							_lightbox.find('img').load(positionLightbox)
							_lightbox.attr('rel',_target).hide().css({
								position:'absolute',
								zIndex:(_zIndex+1),
								top: -9999,
								left: -9999
							});
							jQuery('body').append(_lightbox);

							// init js for lightbox
							initPopupActions(_lightbox);

							// show lightbox
							toggleState(true);
						},
						error: function(msg){
							alert('AJAX error!');
							return false;
						}
					});
				} else {
					_lightbox = jQuery('div[rel*="'+_target+'"]');
					toggleState(true);
				}
				return false;
			});
		} else {
			if(jQuery(_target).length) {
				// init actions for popup
				var _popup = jQuery(_target);
				initPopupActions(_popup);
					// open popup
					_opener.click(function(){
					if(_lightbox) {
						_lightbox.fadeOut(_fadeSpeed,function(){
							_lightbox = _popup.hide();
							toggleState(true);
						})
					} else {
						_lightbox = _popup.hide();
						toggleState(true);
					}
					return false;
				});
			}
		}
	});

	// event handlers
	jQuery(window).resize(positionLightbox);
	jQuery(window).scroll(positionLightbox);
	jQuery(document).keydown(function (e) {
		if (!e) evt = window.event;
		if (e.keyCode == 27) {
			toggleState(false);
		}
	})
	_fader.click(function(){
		if(!_fader.is(':animated')) toggleState(false);
		return false;
	})
}

// tabs plugin
jQuery.fn.jqueryTabs = function(_options){
	// default options
	var _options = jQuery.extend({
		addToParent:false,
		holdHeight:false,
		activeClass:'active',
		tabLinks:'a.tab',
		fadeSpeed:300,
		event:'click'
	},_options);

	return this.each(function(){
		var _holder = jQuery(this);
		var _fadeSpeed = _options.fadeSpeed;
		var _activeClass = _options.activeClass;
		var _addToParent = _options.addToParent;
		var _holdHeight = _options.holdHeight;
		var _tabLinks = jQuery(_options.tabLinks, _holder);
		var _tabset = (_addToParent ? _tabLinks.parent() : _tabLinks);
		var _event = _options.event;
		var _animating = false;

		// tabs init
		_tabLinks.each(function(){
			var _tmpLink = jQuery(this);
			var _tmpTab = jQuery('#'+_tmpLink.attr('rel'));
			var _classItem = (_addToParent ? _tmpLink.parent() : _tmpLink);
			if(_tmpTab.length) {
				if(_classItem.hasClass(_activeClass)) _tmpTab.show();
				else _tmpTab.hide();
			}
		});

		// tab switcher
		function switchTab(_switcher) {
			if(!_animating) {
				var _link = jQuery(_switcher);
				var _newItem = (_addToParent ? _link.parent() : _link);
				var _newTab = jQuery('#'+_link.attr('rel'));
				if(_newItem.hasClass(_activeClass)) return;

				var _oldItem = jQuery(_addToParent ? _tabset : _tabLinks).filter('.'+_activeClass);
				var _oldTab = jQuery('#'+ jQuery(_addToParent ? _oldItem.children('a') : _oldItem).attr('rel'));
				if(_newTab.length) {
					_animating = true;
					if(_oldItem.length) {
						_newItem.addClass(_activeClass);
						_oldItem.removeClass(_activeClass);

						var _parent = _oldTab.parent();
						if(_holdHeight) _parent.css({height:_parent.height()});

						_oldTab.fadeOut(_fadeSpeed,function(){
							_newTab.fadeIn(_fadeSpeed,function(){
								_animating = false;
							});
							if(_holdHeight) _parent.css({height:'auto'});
						});
					} else {
						_newItem.addClass(_activeClass);
						_newTab.fadeIn(_fadeSpeed,function(){
							_animating = false;
						});
					}
				}
			}
		}
		
		function closeTab(_switcher){
			if(!_animating) {
				var _link = jQuery(_switcher);
				var _newItem = (_addToParent ? _link.parent() : _link);
				var _newTab = jQuery('#'+_link.attr('rel'));
				_newItem.removeClass(_activeClass);
				_newTab.hide();
			}
		}

		// control
		_tabLinks.each(function(){
			if(_event == 'mouseenter'){
				jQuery(this).bind({
					'mouseenter': function(){
						switchTab(this);
					},
					'mouseleave': function(){
						closeTab(this);
					}
				});
			}
			else{
				jQuery(this).bind(_event, function(e){
					switchTab(this);
					e.preventDefault();
				});
			}
		});
	});
}

// custom forms plugin
;(function($){
	// custom checkboxes module
	$.fn.customCheckbox = function(_options){
		var _options = $.extend({
			checkboxStructure: '<div></div>',
			checkboxDisabled: 'disabled',
			checkboxDefault: 'checkboxArea',
			checkboxChecked: 'checkboxAreaChecked'
		}, _options);
		return this.each(function(){
			var checkbox = $(this);
			if(!checkbox.hasClass('outtaHere') && checkbox.is(':checkbox')){
				var replaced = $(_options.checkboxStructure);
				this._replaced = replaced;
				if(checkbox.is(':disabled')) replaced.addClass(_options.checkboxDisabled);
				else if(checkbox.is(':checked')) replaced.addClass(_options.checkboxChecked);
				else replaced.addClass(_options.checkboxDefault);

				replaced.click(function(){
					if(checkbox.is(':checked')) checkbox.removeAttr('checked');
					else checkbox.attr('checked', 'checked');
					changeCheckbox(checkbox);
				});
				checkbox.click(function(){
					changeCheckbox(checkbox);
				});
				replaced.insertBefore(checkbox);
				checkbox.addClass('outtaHere');
			}
		});
		function changeCheckbox(_this){
			_this.change();
			if(_this.is(':checked')) _this.get(0)._replaced.removeClass().addClass(_options.checkboxChecked);
			else _this.get(0)._replaced.removeClass().addClass(_options.checkboxDefault);
		}
	}

	// custom radios module
	$.fn.customRadio = function(_options){
		var _options = $.extend({
			radioStructure: '<div></div>',
			radioDisabled: 'disabled',
			radioDefault: 'radioArea',
			radioChecked: 'radioAreaChecked'
		}, _options);
		return this.each(function(){
			var radio = $(this);
			if(!radio.hasClass('outtaHere') && radio.is(':radio')){
				var replaced = $(_options.radioStructure);
				this._replaced = replaced;
				if(radio.is(':disabled')) replaced.addClass(_options.radioDisabled);
				else if(radio.is(':checked')) replaced.addClass(_options.radioChecked);
				else replaced.addClass(_options.radioDefault);
				replaced.click(function(){
					if($(this).hasClass(_options.radioDefault)){
						radio.attr('checked', 'checked');
						changeRadio(radio.get(0));
					}
				});
				radio.click(function(){
					changeRadio(this);
				});
				replaced.insertBefore(radio);
				radio.addClass('outtaHere');
			}
		});
		function changeRadio(_this){
			$(_this).change();
			$('input:radio[name='+$(_this).attr("name")+']').not(_this).each(function(){
				if(this._replaced && !$(this).is(':disabled')) this._replaced.removeClass().addClass(_options.radioDefault);
			});
			_this._replaced.removeClass().addClass(_options.radioChecked);
		}
	}

	// custom selects module
	$.fn.customSelect = function(_options) {
		var _options = $.extend({
			selectStructure: '<div class="selectArea"><span class="center"></span><a href="#" class="selectButton"></a><div class="disabled"></div></div>',
			hideOnMouseOut: false,
			copyClass: true,
			selectText: '.center',
			selectBtn: '.selectButton',
			selectDisabled: '.disabled',
			optStructure: '<div class="optionsDivVisible"><ul></ul></div>',
			optList: 'ul'
		}, _options);
		return this.each(function() {
			var select = $(this);
			if(!select.hasClass('outtaHere')) {
				if(select.is(':visible')) {
					var hideOnMouseOut = _options.hideOnMouseOut;
					var copyClass = _options.copyClass;
					var replaced = $(_options.selectStructure);
					var selectText = replaced.find(_options.selectText);
					var selectBtn = replaced.find(_options.selectBtn);
					var selectDisabled = replaced.find(_options.selectDisabled).hide();
					var optHolder = $(_options.optStructure);
					var optList = optHolder.find(_options.optList);
					if(copyClass) optHolder.addClass('drop-'+select.attr('class')); replaced.addClass(select.attr('class'));

					if(select.attr('disabled')) selectDisabled.show();
					select.find('option').each(function(){
						var selOpt = $(this);
						var _opt = $('<li><a href="#">' + selOpt.html() + '</a></li>');
						if(selOpt.attr('selected')) {
							selectText.html(selOpt.html());
							_opt.addClass('selected');
						}
						_opt.children('a').click(function() {
							optList.find('li').removeClass('selected');
							select.find('option').removeAttr('selected');
							$(this).parent().addClass('selected');
							selOpt.attr('selected', 'selected');
							selectText.html(selOpt.html());
							select.change();
							optHolder.hide();
							if ( typeof Cufon === 'function' ) Cufon.refresh ( '.header-holder .select-form .center' );
							return false;
						});
						optList.append(_opt);
					});
					replaced.width(select.outerWidth());
					replaced.insertBefore(select);
					optHolder.css({
						width: select.outerWidth(),
						display: 'none',
						position: 'absolute'
					});
					$(document.body).append(optHolder);

					var optTimer;
					replaced.hover(function() {
						if(optTimer) clearTimeout(optTimer);
					}, function() {
						if(hideOnMouseOut) {
							optTimer = setTimeout(function() {
								optHolder.hide();
							}, 200);
						}
					});
					optHolder.hover(function(){
						if(optTimer) clearTimeout(optTimer);
					}, function() {
						if(hideOnMouseOut) {
							optTimer = setTimeout(function() {
								optHolder.hide();
							}, 200);
						}
					});
					selectBtn.click(function() {
						if(optHolder.is(':visible')) {
							optHolder.hide();
						}
						else{
							if(_activeDrop) _activeDrop.hide();
							optHolder.children('ul').css({height:'auto', overflow:'hidden'});
							optHolder.css({
								top: replaced.offset().top + replaced.outerHeight(),
								left: replaced.offset().left,
								display: 'block'
							});
							if(optHolder.children('ul').height() > 200) optHolder.children('ul').css({height:200, overflow:'auto'});
							_activeDrop = optHolder;
						}
						return false;
					});
					select.addClass('outtaHere');
				}
			}
		});
	}

	// event handler on DOM ready
	var _activeDrop;
	$(function(){
		$('body').click(hideOptionsClick)
		$(window).resize(hideOptions)
	});
	function hideOptions() {
		if(_activeDrop && _activeDrop.length) {
			_activeDrop.hide();
			_activeDrop = null;
		}
	}
	function hideOptionsClick(e) {
		if(_activeDrop && _activeDrop.length) {
			var f = false;
			$(e.target).parents().each(function(){
				if(this == _activeDrop) f=true;
			});
			if(!f) {
				_activeDrop.hide();
				_activeDrop = null;
			}
		}
	}
})(jQuery);

// clear form fields on focus
function clearFormFields(o) {
	if (o.clearInputs == null) o.clearInputs = true;
	if (o.clearTextareas == null) o.clearTextareas = true;
	if (o.passwordFieldText == null) o.passwordFieldText = false;
	if (o.addClassFocus == null) o.addClassFocus = false;
	if (!o.filterClass) o.filterClass = "default";
	if(o.clearInputs) {
		var inputs = document.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++ ) {
			if((inputs[i].type == "text" || inputs[i].type == "password") && inputs[i].className.indexOf(o.filterClass) == -1) {
				inputs[i].valueHtml = inputs[i].value;
				inputs[i].onfocus = function ()	{
					if(this.valueHtml == this.value) this.value = "";
					if(this.fake) {
						inputsSwap(this, this.previousSibling);
						this.previousSibling.focus();
					}
					if(o.addClassFocus && !this.fake) {
						this.className += " " + o.addClassFocus;
						this.parentNode.className += " parent-" + o.addClassFocus;
					}
				}
				inputs[i].onblur = function () {
					if(this.value == "") {
						this.value = this.valueHtml;
						if(o.passwordFieldText && this.type == "password") inputsSwap(this, this.nextSibling);
					}
					if(o.addClassFocus) {
						this.className = this.className.replace(o.addClassFocus, "");
						this.parentNode.className = this.parentNode.className.replace("parent-"+o.addClassFocus, "");
					}
				}
				if(o.passwordFieldText && inputs[i].type == "password") {
					var fakeInput = document.createElement("input");
					fakeInput.type = "text";
					fakeInput.value = inputs[i].value;
					fakeInput.className = inputs[i].className;
					fakeInput.fake = true;
					inputs[i].parentNode.insertBefore(fakeInput, inputs[i].nextSibling);
					inputsSwap(inputs[i], null);
				}
			}
		}
	}
	if(o.clearTextareas) {
		var textareas = document.getElementsByTagName("textarea");
		for(var i=0; i<textareas.length; i++) {
			if(textareas[i].className.indexOf(o.filterClass) == -1) {
				textareas[i].valueHtml = textareas[i].value;
				textareas[i].onfocus = function() {
					if(this.value == this.valueHtml) this.value = "";
					if(o.addClassFocus) {
						this.className += " " + o.addClassFocus;
						this.parentNode.className += " parent-" + o.addClassFocus;
					}
				}
				textareas[i].onblur = function() {
					if(this.value == "") this.value = this.valueHtml;
					if(o.addClassFocus) {
						this.className = this.className.replace(o.addClassFocus, "");
						this.parentNode.className = this.parentNode.className.replace("parent-"+o.addClassFocus, "");
					}
				}
			}
		}
	}
	function inputsSwap(el, el2) {
		if(el) el.style.display = "none";
		if(el2) el2.style.display = "inline";
	}
}

// mobile browsers detect
browserPlatform = {
	platforms: [
		{ uaString:['symbian','midp'], cssFile:'symbian.css' }, // Symbian phones
		{ uaString:['opera','mobi'], cssFile:'opera.css' }, // Opera Mobile
		{ uaString:['msie','ppc'], cssFile:'ieppc.css' }, // IE Mobile <6
		{ uaString:'iemobile', cssFile:'iemobile.css' }, // IE Mobile 6+
		{ uaString:'webos', cssFile:'webos.css' }, // Palm WebOS
		{ uaString:'Android', cssFile:'android.css' }, // Android
		{ uaString:['BlackBerry','/6.0','mobi'], cssFile:'blackberry6.css' },	// Blackberry 6
		{ uaString:['BlackBerry','/7.0','mobi'], cssFile:'blackberry7.css' },	// Blackberry 7+
		{ uaString:'ipad', cssFile:'ipad.css' }, // iPad
		{ uaString:['safari','mobi'], cssFile:'safari.css' } // iPhone and other webkit browsers
	],
	options: {
		cssPath:'css/',
		mobileCSS:'allmobile.css'
	},
	init:function(){
		this.checkMobile();
		this.parsePlatforms();
		return this;
	},
	checkMobile: function() {
		if(this.uaMatch('mobi') || this.uaMatch('midp') || this.uaMatch('ppc') || this.uaMatch('webos')) {
			this.attachStyles({cssFile:this.options.mobileCSS});
		}
	},
	parsePlatforms: function() {
		for(var i = 0; i < this.platforms.length; i++) {
			if(typeof this.platforms[i].uaString === 'string') {
				if(this.uaMatch(this.platforms[i].uaString)) {
					this.attachStyles(this.platforms[i]);
					break;
				}
			} else {
				for(var j = 0, allMatch = true; j < this.platforms[i].uaString.length; j++) {
					if(!this.uaMatch(this.platforms[i].uaString[j])) {
						allMatch = false;
					}
				}
				if(allMatch) {
					this.attachStyles(this.platforms[i]);
					break;
				}
			}
		}
	},
	attachStyles: function(platform) {
		var head = document.getElementsByTagName('head')[0], fragment;
		var cssText = '<link rel="stylesheet" href="' + this.options.cssPath + platform.cssFile + '" type="text/css"/>';
		var miscText = platform.miscHead;
		if(platform.cssFile) {
			if(document.body) {
				fragment = document.createElement('div');
				fragment.innerHTML = cssText;
				head.appendChild(fragment.childNodes[0]);
			} else {
				document.write(cssText);
			}
		}
		if(platform.miscHead) {
			if(document.body) {
				fragment = document.createElement('div');
				fragment.innerHTML = miscText;
				head.appendChild(fragment.childNodes[0]);
			} else {
				document.write(miscText);
			}
		}
	},
	uaMatch:function(str) {
		if(!this.ua) {
			this.ua = navigator.userAgent.toLowerCase();
		}
		return this.ua.indexOf(str.toLowerCase()) != -1;
	}
}.init();