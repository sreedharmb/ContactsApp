define([
	'jquery',
	'underscore',
	'backbone',
	'js/config'
	], function($, _, Backbone, APP){

		APP.Templates.contact = "" +
		"<span class='glyphicon glyphicon-remove pull-right' id='removeContact'></span>" +
		"<h4 class='list-group-item-heading'><%= firstname %> <%= lastname %></h4>" +
		"<% _.each( numbers, function(number){ %>" +
			"<p><%= number.number%></p>"+
		"<% }); %>";
});

