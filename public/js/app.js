var actions = {
	init: function() {
		
	},
	
	alert: function(message, type) {
		if( typeof type == 'undefined' ) {
			var type = 'success';
		} else {
			var type = type;
		}
		toastr[type](message);
	}
};
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
window.width = $(window).width();
var plugin_path = 'js/plugins';

var app = {
	
	/**
	 * On initialise l'application
	 */
	init: function() {
		$.ajaxSetup({
			cache: false,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
		});
		
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		
		this.delete();
		this.loadJson();
		this.loadDataOnClick();
		components.init();
		actions.init();
	},
	
	/**
	 * Soumission d'un formulaire en AJAX
	 * @param form
	 * @param submit
	 */
	submitForm: function(form, submit, callback) {
		$('body').on('click', submit, function(e) {
			e.preventDefault();
			
			var f = $(form);
			var formData = new FormData(f[0]);
			
			if( $('.' + f.attr('id') + '-errors').length > 0 ) {
				$('.' + f.attr('id') + '-errors').fadeOut().remove();
				$('#' + f.attr('id') + ' .form-group').removeClass('has-error');
				$('#' + f.attr('id') + ' .return-error').remove();
			}
			
			var btnText = $(submit).html();
			$(submit).html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
			
			$.ajax({
				url: f.attr('action'),
				method: f.attr('method'),
				data: formData,
				dataType: 'JSON',
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					
					console.log(response);
					
					var timer = 0;
					if( typeof response.timer != 'undefined' ) {
						timer = response.timer;
						if( typeof response.redirect != 'undefined' && timer == 0 ) {
							timer = 5000;
						}
					}
					
					console.log(timer);
					
					setTimeout(function() {
						if( typeof response.alert != 'undefined' ) {
							var alertType = '';
							if( typeof response.type != 'undefined' ) {
								alertType = response.type;
							} else {
								if( response.success ) {
									alertType = 'success';
								} else {
									alertType = 'error';
								}
							}
							toastr[alertType](response.message);
						} else if( typeof response.content != 'undefined' ) {
							$(response.element)[response.method](response.content);
						}
						
						if( typeof response.clean != 'undefined' && typeof response.to_clean != 'undefined' && response.clean ) {
							$.each(response.to_clean, function(key, value) {
								if( $('#' + value).length > 0 ) {
									$('#' + value).val('');
								}
							});
						}
						
						if( typeof response.inputs != 'undefined' ) {
							$.each(response.inputs, function(key, value) {
								if( $('#' + key).length > 0 ) {
									$('#' + key).val(value);
								}
							});
						}
						
						if( typeof response.redirect != 'undefined' ) {
							//var timer = typeof response.timer == 'undefined' ? 5000 : response.timer;
							//setTimeout(function() {
								$(location).attr('href', response.redirect);
							//}, timer);
						}
					}, timer);
					$(submit).html(btnText);
					
					if( typeof callback != 'undefined' && typeof callback == 'function' ) {
						callback();
					}
				},
				error :function(response) {
					var $errorsReturn = '';
					var $errors = $.parseJSON(response.responseText);
					
					$.each( $errors, function( key, value ) {
						$errorsReturn += '<li>' + value[0] + '</li>';
						$('#' + f.attr('id') + ' #' + key).parents('.form-group').addClass('has-error');
						$('#' + f.attr('id') + ' #' + key).after('<span class="help-block return-error">' + value[0] + '</span>');
					});
					
					f.prepend('<div class="alert alert-danger ' + f.attr('id') + '-errors"><ul>' + $errorsReturn + '</ul></di>');
					$(submit).html(btnText);
				}
			});
		});
	},
	
	/**
	 * Permet d'intéragir en JSON facilement
	 */
	loadJson: function() {
		$('body').on('click', '[data-action="json"]', function(e) {
			e.preventDefault();
			$.ajax({
				url: $(this).attr('href'),
				method: 'GET',
				dataType: 'JSON',
				success: function(response) {
					if( response.success ) {
						
						var timer = 0;
						if( typeof response.timer != 'undefined' ) {
							timer = response.timer;
							if( typeof response.redirect != 'undefined' && timer == 0 ) {
								timer = 5000;
							}
						}
						
						console.log(timer);
						
						setTimeout(function() {
							if( typeof response.alert != 'undefined' ) {
								var alertType = 'success';
								if( typeof response.type != 'undefined' ) {
									alertType = response.type;
								}
								toastr[alertType](response.message);
							} else if( typeof response.content != 'undefined' ) {
								$(response.element)[response.method](response.content);
							}
							
							if( typeof response.redirect != 'undefined' ) {
								//var timer = typeof response.timer == 'undefined' ? 5000 : response.timer;
								//setTimeout(function() {
									$(location).attr('href', response.redirect);
								//}, timer);
							}
						}, timer);
					} else {
						toastr['error'](response.message);
					}
				},
			})
		})
	},
	
	
	/**
	 * Permet de charger avec des réglages prédéfinis summernote
	 * @param form
	 * @param textarea
	 */
	loadSummerNote: function(form, textarea) {
		$(textarea).summernote({
			height: 500,
			lang: 'fr-FR',
			dialogsInBody: true,
			callbacks: {
				onImageUpload: function(image) {
					console.log(image[0]);
					uploadImage(image[0]);
				},
			}
		});
		
		/**
		 * Upload d'image en AJAX avec summernote
		 * @param image
		 */
		function uploadImage(image) {
			var data = new FormData();
			data.append('picture', image);
			//data.append('_token', $('meta[name="csrf-token"]').attr('content'));
			data.append('_method', 'POST');
			data.append('_token', $('meta[name="csrf-token"]').attr('content'));
			console.log(data);
			//console.log(data);
			$.ajax({
				//data: {picture: file, _token: $('meta[name="csrf-token"]').attr('content'), _method: 'POST'},
				data: data,
				method: 'POST',
				url: laroute.route('admin.pictures.upload'),
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					console.log(response);
					$(textarea).summernote('insertImage', response.url, function($image) {
						$image.attr('class', 'img-responsive');
						$image.attr('id', response.name);
					});
					
					$('#pictures_list').append(response.content);
					$(form).prepend('<input name=pictures[] type="hidden" id="picture_' + response.id + '" value="' + response.id + '">');
				}, error: function(response) {
					console.log(response);
					var $errors = $.parseJSON(response.responseText);
					$.each( $errors, function( key, value ) {
						toastr.error(value[0]);
					});
				}
			});
		}
	},
	
	/**
	 * Permet de supprimer une photo dans l'éditeur, en la retirant également sur summernote
	 * @param summernote
	 */
	removePicture: function(summernote) {
		$('body').on('click', '[data-action="remove-picture"]', function(e) {
			e.preventDefault();
			$.ajax({
				method: 'GET',
				url: laroute.route('admin.pictures.destroy'),
				data: {image: $(this).attr('data-name')},
				success: function(response) {
					if( response.success ) {
						$('#picture_' + response.id).remove();
						$('#picture_card_' + response.id).remove();
						$(summernote).summernote('removeMedia', $('#' + response.name));
					}
				}
			});
		});
	},
	
	/**
	 * Récupération de données en AJAX
	 */
	loadDataOnClick: function() {
		$('body').on('click', '[data-action=load]', function(e) {
			e.preventDefault();
			$.get($(this).attr('href'), function(response) {
				if( typeof response.alert != 'undefined' ) {
					toastr[response.type](response.message);
				} else {
					$(response.element)[response.method](response.content);
				}
			});
		});
	},
	
	/**
	 * Permet de charger plus d'éléments
	 */
	loadMore: function() {
		$('body').on('click', '[data-action=load-more]', function(e) {
			e.preventDefault();
			var $this = $(this);
			$.get($this.attr('href'), function(response) {
				console.log(response);
				if( response.count > 0 ) {
					$this.attr('href', response.href);
					$(response.element)[response.method](response.content);
				} else {
					$(response.element)[response.method](response.content);
					$this.addClass('disabled');
				}
			});
		});
	},
	
	/**
	 * Permet d'ordonner des liens facilement
	 */
	orderLinks: function() {
		$('body').on('click', '[data-action="order"]', function(e) {
			e.preventDefault();
			var action = $(this);
			var div = action.attr('data-div');
			$.get(action.attr('href'), function(response) {
				if( response.success ) {
					//$('#link_' + response.link.id).remove();
					//link.find('data-info=["position"]').text(response.link.position);
					if( action.attr('data-asc') == 'up' ) {
						$('#' + div + '_' + response.element.id).insertBefore('#' + div + '_' + response.move.id);
					} else {
						$('#' + div + '_' + response.element.id).insertAfter('#' + div + '_' + response.move.id);
					}
					
					$('#' + div + '_' + response.element.id).find('[data-info="position"]').text(response.position);
					$('#' + div + '_' + response.move.id).find('[data-info="position"]').text(response.move_pos);
				}
			});
		});
	},
	
	/**
	 * Box de suppression en AJAX avec confirmation
	 */
	delete: function() {
		$('body').on('click', '[data-action="delete"]', function(e) {
			e.preventDefault();
			var data = $(this);
			var dataId = $(this).attr('data-id');
			
			swal({
				title: "Êtes vous sûr ?",
				text: data.attr('data-message'),
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Oui",
				cancelButtonText: "Non",
				closeOnConfirm: true,
				closeOnCancel: true
				},
				function(isConfirm){
					if( isConfirm ) {
						$.ajax({
							url: data.attr('href'),
							method: 'POST',
							data: {_method: 'delete', _token: data.attr('data-token')},
							success: function(response) {
								console.log(response.success);
								if( typeof response.success != 'undefined' && response.success ) {
									$('#' + dataId).fadeOut().remove();
									if( typeof response.message != 'undefined' ) {
										toastr['success'](response.message);
									}
								} else {
									var message = typeof response.message == 'undefined' ? 'Une erreur est survenue durant la suppression de l\'élément' : response.message;
									toastr['error'](message);
								}
							}
						})
					}
				});
		});
	}
};

/**
 * Let's GO !
 */
app.init();
//# sourceMappingURL=app.js.map
