var actions = {
	init: function() {
		this.toogle();
	},
	
	alert: function(message, type) {
		if( typeof type == 'undefined' ) {
			var type = 'success';
		} else {
			var type = type;
		}
		toastr[type](message);
	},
	
	toogle: function() {
		$('body').on('click', '[data-action="toogle"]', function(e) {
			e.preventDefault();
			$.each('[data-view="toogle"]', function() {
				$(this).fadeOut();
			})
			$('#' + $(this).attr('href')).fadeIn();
		});
	}
};