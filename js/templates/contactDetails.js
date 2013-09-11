define([
	'jquery',
	'underscore',
	'backbone',
	'js/config'
	], function($, _, Backbone, APP){

		APP.Templates.contactDetails = "" +
		"FirstName: <%= firstname %> <br>" +
		"LastName: <%= lastname %> <br>" +
		"Birthday: <%= birthday %> <br>" +
		"Company: <%= company %> <br>" +
		"Address: <%= address %> <br>" +
		"Facebook: <%= fbId %> <br>" +
		"Twitter: <%= twitterHandle %>" +
		"<a href='#contact/<%= id %>/tweets'>" +
			"<button type='button' name='twitter' id='twitterButton'>see tweets</button>" +
		"</a><br>" +
		"LinkedIn: <%= linkedinId %> <br>" +
		"Skype: <%= skypeId %> <br>" +
		"Website: <%= website %> <br>" +
		"Numbers: " +
		"<% _.each( numbers, function(number){ %>" +
			"<p><%= number.number%></p>"+
		"<% }); %> <br>" +
		"Email id: <br>" +
		"<% _.each( emails, function(email){ %>" +
			"<a href='mailto:#'><%= email.emailId%></a> <br>"+
		"<% }); %> <br>" +
		"<div class='col-lg-offset-4 col-lg-5'>" +
			"<button type='submit' class='btn btn-default' id='editContact'>edit</button>" +
		"</div>" +
		"<div class='col-lg-offset-4 col-lg-5'>" +
			"<button type='submit' class='btn btn-default' id='deleteContact'>delete</button>" +
		"</div>";
});