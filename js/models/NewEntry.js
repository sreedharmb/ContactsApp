define([
	'jquery',
	'underscore',
	'backbone',
	'js/config'
	], function($, _, Backbone, APP){

		APP.Models.NewEntry = Backbone.Model.extend({
			defaults: {
				type: 'number',
				placeholder: 'ph no',
				spanClass: 'minusNumber'
			}
		});
		
});