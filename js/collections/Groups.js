define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/models/Group'
	], function($, _, Backbone, APP){
		
		APP.Collections.Groups = Backbone.Collection.extend({
			model: APP.Models.Group,
			comparator: 'name',
			url: '/ContactsApp/php/laravel/public/group'
		});
});