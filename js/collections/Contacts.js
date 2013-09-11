define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/models/Contact'
	], function($, _, Backbone, APP){
		
		APP.Collections.Contacts = Backbone.Collection.extend({
			model: APP.Models.Contact,
			comparator: 'firstname',
			// comparator: function(model1, model2){
			// return model1.get('firstname') < model2.get('firstname');
			// },
			url: '/ContactsApp/php/laravel/public/contact',
			parse: function(response) {
				return response.contacts;
			}
		});
});