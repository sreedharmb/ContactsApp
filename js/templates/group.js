define([
	'jquery',
	'underscore',
	'backbone',
	'js/config'
	], function($, _, Backbone, APP){

		APP.Templates.group = '<a href="#group/<%= id %>"><%= name %>';
});