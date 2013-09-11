define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/templates/contactDetails',
	'js/models/Contact'
	], function($, _, Backbone, APP){
		APP.Views.ContactDetails = Backbone.View.extend({
			template: _.template(APP.Templates.contactDetails),
			events: {
				'click #editContact': 'editContact'
			},

			render: function()
			{
				this.$el.html( this.template( this.model.attributes ) ) ;
				return this;
			},

			editContact: function()
			{
				Backbone.history.navigate('contact/'+this.model.get('id')+'/edit', {trigger: true});
			}
		});
});