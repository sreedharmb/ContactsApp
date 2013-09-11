define([
	'jquery',
	'underscore',
	'backbone',
	'js/config'
	], function($, _, Backbone, APP){

APP.Templates.contactForm = "" +
"<form class='form-horizontal'>" +
	"<div class='form-group'>" +
		"<label for='firstname' class='col-lg-3'>FirstName</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='firstname' placeholder='firstname' value=<%= firstname %> >" +
		"</div>" +
	"</div>" +
	"<div class='form-group'>" +
		"<label for='lastname' class='col-lg-3'>Lastname</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='lastname' placeholder='lastname' value=<%= lastname %>>" +
		"</div>" +
	"</div>" +
	"<div class='form-group'>" +
		"<label for='birthday' class='col-lg-3'>Birthday</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='birthday' placeholder='yyyy/mm/dd' value=<%= birthday %>>" +
		"</div>" +
	"</div>" +
	"<div class='form-group'>" +
		"<label for='company' class='col-lg-3'>Company</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='company' placeholder='company' value=<%= company %>>" +
		"</div>" +
	"</div>" +
	"<div class='form-group'>" +
		"<label for='address' class='col-lg-3'>Address</label>" +
		"<div class='col-lg-8'>" +
			"<textarea class='form-control' id='address' rows=3><%= address %></textarea>" +
		"</div>" +
	"</div>" +
	"<div class='form-group'>" +
		"<label for='fbId' class='col-lg-3'>Facebook Id</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='fbId' placeholder='name' value=<%= fbId %>>" +
		"</div>" +
	"</div>" +
	"<div class='form-group'>" +
		"<label for='twitterHandle' class='col-lg-3'>Twitter handle</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='twitterHandle' placeholder='@example' value=<%= twitterHandle %>>" +
		"</div>" +
	"</div>" +"<div class='form-group'>" +
		"<label for='linkedinId' class='col-lg-3'>LinkedIn Id</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='linkedinId' placeholder='linkedIn id' value=<%= linkedinId %>>" +
		"</div>" +
	"</div>" +
	"</div>" +"<div class='form-group'>" +
		"<label for='skypeId' class='col-lg-3'>Skype Id</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='skypeId' placeholder='skype id' value=<%= skypeId %>>" +
		"</div>" +
	"</div>" +
	"<div class='form-group'>" +
		"<label for='website' class='col-lg-3'>Website</label>" +
		"<div class='col-lg-8'>" +
			"<input type='text' class='form-control' id='website' placeholder='http://example.com' value=<%= website %>>" +
		"</div>" +
	"</div>" +
	"<div id='numbersSection'>" +
	"<% var flag = 0;%>" +
	"<% _.each( numbers, function(number){ %>" +
		"<div class='form-group'>" +
			"<% if(flag === 0 ) {%>" +
				"<label for='numbers' class='col-lg-3'>Ph no</label>" +
				"<span class='glyphicon glyphicon-plus-sign plusNumber'></span>" +
			"<%}else { %>" +
				"<label for='numbers' class='col-lg-3'></label>" +
				"<span class='glyphicon glyphicon-minus-sign minusNumber'></span>" +
			"<%}%>" +
			"<div class='col-lg-8'>" +
				"<input type='text' class='form-control numbers' placeholder='ph no' value= <%= number.number%>></input>" +
			"</div>" +
		"</div>" +
		"<%flag = 1;%>" +
	"<% }); %>" +
	"<% if(flag !== 1 ) {%>" +
		"<div class='form-group'>" +
			"<label for='numbers' class='col-lg-3'>Ph no</label>" +
			"<span class='glyphicon glyphicon-plus-sign plusNumber'></span>" +
			"<div class='col-lg-8'>" +
				"<input type='text' class='form-control numbers' placeholder='ph no'></input>" +
			"</div>" +
		"</div>" +
	"<%} else {%>" +
		"<div class='form-group'>" +
			"<label for='numbers' class='col-lg-3'></label>" +
			"<span class='glyphicon glyphicon-minus-sign minusNumber'></span>" +
			"<div class='col-lg-8'>" +
				"<input type='text' class='form-control numbers' placeholder='ph no'></input>" +
			"</div>" +
		"</div>" +
	"<%}%>" +
	"</div>" +
	"<div id='emailsSection'>" +
	"<% flag = 0;%>" +
	"<% _.each( emails, function(email){ %>" +
		"<div class='form-group'>" +
			"<% if(flag === 0 ) {%>" +
				"<label for='emails' class='col-lg-3'>Email</label>" +
				"<span class='glyphicon glyphicon-plus-sign plusEmail'></span>" +
			"<%}else { %>" +
				"<label for='emails' class='col-lg-3'></label>" +
				"<span class='glyphicon glyphicon-minus-sign minusEmail'></span>" +
			"<%}%>" +
			"<div class='col-lg-8'>" +
				"<input type='text' class='form-control emails' placeholder='email@example.com' value= <%= email.emailId%>></input>" +
			"</div>" +
		"</div>" +
		"<%flag = 1;%>" +
	"<% }); %>" +
	"<% if(flag !== 1 ) {%>" +
		"<div class='form-group'>" +
			"<label for='emails' class='col-lg-3'>Email</label>" +
			"<span class='glyphicon glyphicon-plus-sign plusEmail'></span>" +
			"<div class='col-lg-8'>" +
				"<input type='text' class='form-control emails' placeholder='email@example.com'></input>" +
			"</div>" +
		"</div>" +
	"<%} else {%>" +
		"<div class='form-group'>" +
			"<label for='emails' class='col-lg-3'></label>" +
			"<span class='glyphicon glyphicon-minus-sign minusEmail'></span>" +
			"<div class='col-lg-8'>" +
				"<input type='text' class='form-control emails' placeholder='email@example.com'></input>" +
			"</div>" +
		"</div>" +
	"<%}%>" +
	"</div>" +
	"<div class='form-group button'>" +
		"<div class='col-lg-offset-8 col-lg-5'>" +
			"<button type='submit' class='btn btn-default' id='createContact'>Create</button>" +
		"</div>" +
		"<div class='col-lg-5'>" +
			"<button type='reset' class='btn btn-default' id='cancelCreation'>Cancel</button>" +
		"</div>" +
	"</div>" +
"</form>";

});
