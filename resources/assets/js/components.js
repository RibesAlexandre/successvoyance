var components = {
	
	arguments: {},
	subMenuClass: false,
	
	init: function() {
		this.header();
		this.footer();
		this.flipBox();
		this.searchBox();
		this.escapeKey();
		this.slideToTop();
		this.mobileSubMenu();
		this.mobilePageMenu();
		
		/*
		if($("html").hasClass("chrome") && $("body").hasClass("smoothscroll")) {
			this.loadScript(plugin_path + 'smoothscroll.js', function() {
				$.smoothScroll();
			});
		}
		*/
	},
	
	/**
	 * Actions de la SearchBox
	 */
	searchBox: function() {
		$('li.search i.fa').click(function () {
			if($('#header .search-box').is(":visible")) {
				$('#header .search-box').fadeOut(300);
			} else {
				$('.search-box').fadeIn(300);
				$('#header .search-box form input').focus();
				
				// hide quick cart if visible
				if ($('#header li.quick-cart div.quick-cart-box').is(":visible")) {
					$('#header li.quick-cart div.quick-cart-box').fadeOut(300);
				}
			}
		});
		
		if($('#header li.search i.fa').size != 0) {
			$('#header .search-box, #header li.search i.fa').on('click', function(e){
				e.stopPropagation();
			});
			
			$('body').on('click', function() {
				if($('#header li.search .search-box').is(":visible")) {
					$('#header .search-box').fadeOut(300);
				}
			});
		}
		
		$(document).bind("click", function() {
			if($('#header li.search .search-box').is(":visible")) {
				$('#header .search-box').fadeOut(300);
			}
		});
		
		$("#closeSearch").bind("click", function(e) {
			e.preventDefault();
			$('#header .search-box').fadeOut(300);
		});
	},
	
	/**
	 * Header
	 */
	header: function() {
		var header = $('#header');
		var _headerHeight = 0;
		
		if(header.hasClass('transparent') || header.hasClass('translucent')) {
			_headerHeight = 0;
		} else {
			_headerHeight = header.outerHeight();
			if($("#topBar").length > 0) {
				_headerHeight = _headerHeight + $("#topBar").outerHeight();
			}
		}
		
		var _screenHeight = $(window).height() - _headerHeight;
		$("#slider.fullheight").height(_screenHeight);
		
		if(header.hasClass('bottom')) {
			
			// Add dropup class
			header.addClass('dropup');
			window.homeHeight 	= $(window).outerHeight() - 55;
			
			
			// sticky header
			if(header.hasClass('sticky')) {
				window.isOnTop 		= true;
				
				
				// if scroll is > 60%, remove class dropup
				$(window).scroll(function() {
					if($(document).scrollTop() > window.homeHeight / 2) {
						header.removeClass('dropup');
					} else {
						header.addClass('dropup');
					}
				});
				
				
				// Add fixed|not fixed & dropup|no dropup
				$(window).scroll(function() {
					if($(document).scrollTop() > window.homeHeight) {
						if(window.isOnTop === true) {
							$('#header').addClass('fixed');
							header.removeClass('dropup');
							window.isOnTop = false;
						}
					} else {
						if(window.isOnTop === false) {
							$('#header').removeClass('fixed');
							header.addClass('dropup');
							window.isOnTop = true;
						}
					}
				});
				
				// get window height on resize
				$(window).resize(function() {
					window.homeHeight = $(window).outerHeight();
				});
				
			}
			
		} else
		
		// STICKY
		if(header.hasClass('sticky')) {
			
			$(window).scroll(function() {
				if(window.width > 768) {
					
					var _scrollTop 	= $(document).scrollTop();
					var	_topBar_H 	= $("#topBar").outerHeight() || 0;
					
					if(_scrollTop > _topBar_H) {
						header.addClass('fixed');
						
						var _header_H = header.outerHeight() || 0;
						
						if(!header.hasClass('transparent') && !header.hasClass('translucent')) {
							$('body').css({"padding-top":_header_H+"px"});
						}
						
					} else {
						if(!header.hasClass('transparent') && !header.hasClass('translucent')) {
							$('body').css({"padding-top":"0px"});
						}
						
						header.removeClass('fixed');
					}
					
				}
			});
			
		} else
		
		if(header.hasClass('static')) {
			// _header_H = header.outerHeight() + "px";
			// $('body').css({"padding-top":_header_H});
		}
	},
	
	footer: function() {
		if($("#footer").hasClass('sticky')) {
			
			var footerHeight = 0,
				footerTop 	= 0,
				_footer 		= $("#footer.sticky");
			
			positionFooter();
			function positionFooter() {
				footerHeight = _footer.height();
				footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";
				
				if(($(document.body).height()+footerHeight) > $(window).height()) {
					_footer.css({
						position: "absolute"
					}).stop().animate({
						top: footerTop
					},0);
				} else {
					_footer.css({position: "static"});
				}
			}
			
			$(window).scroll(positionFooter).resize(positionFooter);
		}
	},
	
	slideToTop: function() {
		$("#slidetop a.slidetop-toggle").bind("click", function() {
			$("#slidetop .container").slideToggle(150, function() {
				
				if($("#slidetop .container").is(":hidden")) {
					$("#slidetop").removeClass('active');
				} else {
					$("#slidetop").addClass('active');
				}
				
			});
		});
	},
	
	escapeKey: function() {
		$(document).keyup(function(e) {
			if(e.keyCode == 27) {
				if($("#slidetop").hasClass("active")) {
					$("#slidetop .container").slideToggle(150, function() {
						$("#slidetop").removeClass('active');
					});
				}
			}
		});
	},
	
	/**
	 * Classes du sous Menu sous mobile
	 */
	mobileSubMenu: function() {
		$("#topMain a.dropdown-toggle").bind("click", function(e) {
			if($(this).attr('href') == "#") {
				e.preventDefault();
			}
			
			this.subMenuClass = $(this).parent().hasClass("resp-active");
			$("#topMain").find(".resp-active").removeClass("resp-active");
			
			if(!this.subMenuClass) {
				$(this).parents("li").addClass("resp-active");
			}
			
			return;
		});
	},
	
	/**
	 * Menu déroulant sous mobile
	 */
	mobilePageMenu: function() {
		$("button#page-menu-mobile").bind("click", function() {
			$(this).next('ul').slideToggle(150);
		});
	},
	
	flipBox: function() {
		if($('.box-flip').length > 0) {
			
			$('.box-flip').each(function() {
				var _height1 = $('.box1',this).outerHeight();
				var _height2 = $('.box2',this).outerHeight();
				
				if(_height1 >= _height2) {
					var _height = _height1;
				} else {
					var _height = _height2;
				}
				
				$(this).css({"min-height":_height+"px"});
				$('.box1',this).css({"min-height":_height+"px"});
				$('.box2',this).css({"min-height":_height+"px"});
			});
			
			$('.box-flip').hover(function() {
				$(this).addClass('flip');
			},function(){
				$(this).removeClass('flip');
			});
		}
	},
	
	loadScript: function(scriptName, callback) {
		
		if (!this.argumebts[scriptName]) {
			this.arguments[scriptName] = true;
			
			var body = document.getElementsByTagName('body')[0];
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = scriptName;
			
			// then bind the event to the callback function
			// there are several events for cross browser compatibility
			// script.onreadystatechange = callback;
			script.onload = callback;
			
			// fire the loading
			body.appendChild(script);
			
		} else if (callback) {
			callback();
		}
	},
};