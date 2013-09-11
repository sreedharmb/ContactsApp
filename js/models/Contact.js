define([
	'jquery',
	'underscore',
	'backbone',
	'js/config'
	], function($, _, Backbone, APP){
		APP.Models.Contact = Backbone.Model.extend({
			// urlRoot: '/ContactsApp/php/laravel/public/contact',
			defaults: {
				firstname: null,
				lastname: null,
				birthday: null,
				address: null,
				company: null,
				fbId: null,
				twitterHandle: null,
				linkedinId: null,
				skypeId: null,
				website: null,
				numbers: [],
				emails: []
			}
		});
});