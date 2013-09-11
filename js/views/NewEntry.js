define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/templates/newEntry'
	], function($, _, Backbone, APP){

	APP.Views.NewEntry = Backbone.View.extend({

		template : _.template(APP.Templates.newEntry),

		// events: {
		// 	'click #minusEmail': 'removeEmail',
		// 	'click #minusNumber': 'removeNumber'
		// },

		render: function(){
			this.$el.html( this.template(this.model.attributes));
			return this;
		}

		// removeEmail: function(){
		// 	this.remove();
		// },

		// removeNumber: function(){
		// 	this.remove();
		// }

	});
});