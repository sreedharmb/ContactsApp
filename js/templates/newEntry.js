define([
	'jquery',
	'underscore',
	'backbone',
	'js/config'
	], function($, _, Backbone, APP){

		APP.Templates.newEntry = "" +
		"<div class='form-group'>" +
			"<label for=<%= type%> class='col-lg-3'></label>" +
			"<span class='glyphicon glyphicon-minus-sign <%= spanClass%>'></span>" +
			"<div class='col-lg-8'>" +
				"<input type='text' class='form-control <%= type%>' placeholder='<%= placeholder%>'></input>" +
			"</div>" +
		"</div>";
		
});