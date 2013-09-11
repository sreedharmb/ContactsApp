/**
 * @author: Sreedhar M B
 *
 */


require.config({
	'paths' : {
		'jquery'			: 'com/ext/jquery/jquery-1.10.2',
		'underscore'		: 'com/ext/underscore/underscore',
		'backbone'			: 'com/ext/backbone/backbone',
		'bootstrap'			: 'com/ext/bootstrap/js/bootstrap'
	},

	'shim': {
		
		'underscore'		: {
			exports			: '_'
		},

		'backbone'			: {
			deps			: ['jquery', 'underscore'],
			exports			: 'Backbone'
		},

		'bootstrap'			: {
			deps			: ['jquery'],
			exports			: 'bootstrap'
		}


	}
});

require([
	'jquery',
	'underscore',
	'backbone',
	'bootstrap',
	'js/config',
	'js/router/Router'
	], function($, _, Backbone, Bootstrap, APP) {
	$(document).ready(function() {
		var router = new APP.Router();

		// router.initDefGroups();
		// router.initUserGroups();
		router.initContacts(function(){
			Backbone.history.start();
		});

		$('#newContact').tooltip({title: "Click here to create a new contact", placement: "bottom"});
		$('#newContact').on('show.bs.tooltip', function() {
			$(this).delay(1000);
			$('#newContact').tooltip('hide');
		});
		
		
	});
});