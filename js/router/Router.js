define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/models/Contact',
	'js/models/Group',
	'js/models/Tweet',
	'js/collections/Contacts',
	'js/collections/Groups',
	'js/collections/Tweets',
	'js/views/Contact',
	'js/views/Group',
	'js/views/ContactDetails',
	'js/views/ContactForm',
	'js/views/ContactList',
	'js/views/GroupList'
	], function($, _, Backbone, APP){
		APP.Router = Backbone.Router.extend({
			defGroups: {},
			userGroups: {},
			contacts: {},

			routes: {
				'': 'index',
				'group/:id': 'group',
				'contact/:id': 'contact',
				'newContact': 'newContact',
				'newContact/create': 'addContact',
				'contact/:id/edit': 'editContact',
				'contact/:id/tweets': 'displayTweets',
				'search': 'searchFunction'
			},

			index: function(){
				$('#contactDetailsSection').empty();
				this.initContacts(function(){
					document.getElementById('searchInput').value = '';
				});
			},

			group: function(id){
				console.log("group:" + id);
			},

			contact: function(id){
				var contact = this.contacts.get(id);
				// console.log($('a[href="#contact/'+ id +'"]'));
				// $('a[href="#contact/'+ id +'"]').addClass('active');
				var contactView = new APP.Views.ContactDetails({model: contact});
				contactView.render();
				$('#contactDetailsSection').html(contactView.el);
			},

			contactForm: function(contact){
				
				var contactForm = new APP.Views.ContactForm({model: contact});
				contactForm.render();
				$('#contactDetailsSection').html(contactForm.el);
			},

			newContact: function(){
				var contact = new APP.Models.Contact({});
				this.contactForm(contact);
			},

			addContact: function(){
				var contact = new APP.Models.Contact({});
				var map = {};
				for(var prop in contact.attributes){
					var value = document.getElementById(prop).value;
					if(value !== '')
					{
						map[prop]= value;
					}
				}
				map['groupId'] = 2;
				map['numbers'] = [];
				map['emails'] = [];

				this.contacts.create(map, {wait: true,
									error: function(model, xhr, options){
										$('#contactDetailsSection').append("make sure you enter neccessary feilds");
									},
									success: function(model, response, options){
										// $('#contactDetailsSection').html("contact successfully created");
										// VENT.trigger('contactSelection', model.id);
										Backbone.history.navigate('contact/'+model.id, {trigger: true});
									}
								});
			
			},

			editContact: function(id)
			{
				var contact = this.contacts.get(id);
				var contactView = new APP.Views.ContactForm({model: contact});
				contactView.render();
				$('#contactDetailsSection').html(contactView.el);
				document.getElementById('createContact').id = 'updateContact';
				$('#updateContact').text('update');
				document.getElementById('cancelCreation').id = 'cancelEdit';
			},

			groupCreation: function(groupsList){
				var groupListView = new APP.Views.GroupList({
					collection: groupsList
				});
				groupListView.render();
				return groupListView.el;
			},

			displayTweets: function(id){
				var contact = this.contacts.get(id);
				var twitterHandle = contact.get('twitterHandle');
				var tweets = new APP.Collections.Tweets({});
				console.log(twitterHandle);
				// var sendAuth = function(xhr) {
				// 	xhr.setRequestHeader('Authorization', 'OAuth oauth_consumer_key="DC0sePOBbQ8bYdC8r4Smg",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1376244579",oauth_nonce="2069772441",oauth_version="1.0",oauth_token="134057446-nXdD8CQZ1x2i2yBRGekmIlgYBhDW3dUAOx6YUpVJ",oauth_signature="e0oRBHKDhjVG3h1kjJUx144hjn8%3D"');
				// };
				tweets.fetch({data: $.param({user_id: twitterHandle,
					screen_name: twitterHandle}),
				headers: { 'Authorization': 'OAuth oauth_consumer_key="DC0sePOBbQ8bYdC8r4Smg",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1376987251",oauth_nonce="2441583515",oauth_version="1.0",oauth_token="134057446-nXdD8CQZ1x2i2yBRGekmIlgYBhDW3dUAOx6YUpVJ",oauth_signature="v5JfL%2BcDyONDvfPSIx4F9oHyu9w%3D"',
				// 'Access-Control-Allow-Origin': 'www.sreedharmb.blogspot.in'
				// 'Origin': '127.0.0.1:8888'
				}
				}).done({
					error: function(collection, xhr, options){
						var errors = JSON.parse(xhr.responseText).error;
						console.log(errors);
					},
					success: function(collection, response, options){}
				});
				
			},

			contactCreation :  function(contacts){
				var contactListView = new APP.Views.ContactList({
					collection: contacts
				});
				contactListView.render();
				return contactListView.el;
			},

			searchFunction: function(){
				var searchText = document.getElementById('searchInput').value;
				var filteredContacts = new APP.Collections.Contacts();
				filteredContacts.add( this.contacts.filter(function(contact) {
					var firstname = contact.get('firstname');
					var lastname = contact.get('lastname');
					if(firstname.indexOf(searchText) !== -1)
					{
						return true;
					}
					else if(lastname !== null && lastname.indexOf(searchText) !== -1){
						return true;
					}
					else{
						return false;
					}
					
				}));
				
				var html = this.contactCreation(filteredContacts);
				$('#contactListSection').html(html);

			},

			initDefGroups: function(){

				//group for default tags
				this.defGroups = new APP.Collections.Groups();
				var html = this.groupCreation(this.defGroups);

				//adding default tags allcontacts, favourites and trashed to the groups collection
				var newGroup = new APP.Models.Group({name: 'AllContacts', id: 0});
				this.defGroups.add(newGroup);
				newGroup = new APP.Models.Group({name: 'Favourites', id: -1});
				this.defGroups.add(newGroup);
				newGroup = new APP.Models.Group({name: 'Trashed', id: -2});
				this.defGroups.add(newGroup);
				
				//add the rendered html to the DOM.
				//"html" will be updated (html is js object)
				$('#groupSection').append(html);

			},

			initUserGroups: function()
			{
				//create collection user created groups
				this.userGroups = new APP.Collections.Groups();

				//fetch the list of user groups from server, render it and append it to the DOM
				this.userGroups.fetch().then(function()
								{
									var html = this.groupCreation(this.userGroups);
									$('#groupSection').append(html); //add the rendered html to the DOM
								}.bind(this));

			},

			

			initContacts: function(callback){
				
				//function to create a contacts collection view and render it for first time.
				

				//collection for the user contacts
				this.contacts = new APP.Collections.Contacts();
				
				//fetch the contacts from the server and render it and append it to the DOM
				this.contacts.fetch().done(function()
								{
									callback.call();
									var html = this.contactCreation(this.contacts);
									$('#contactListSection').html(html);
								}.bind(this));
				// this.contacts.sortBy('firsname').sortBy('lastname');
			}

		});
});