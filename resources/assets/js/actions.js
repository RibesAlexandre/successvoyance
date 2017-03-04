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