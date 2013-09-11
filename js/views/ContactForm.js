define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/templates/contactForm',
	'js/models/Contact',
	'js/models/NewEntry',
	'js/views/NewEntry'
	], function($, _, Backbone, APP){
		APP.Views.ContactForm = Backbone.View.extend({
			template: _.template(APP.Templates.contactForm),

			events: {
				'click #createContact': 'addContact',
				'click #updateContact': 'updateContact',
				'click #cancelEdit': 'cancelEdit',
				'click #cancelCreation': 'cancelCreation',
				'click .plusNumber': 'plusNumber',
				'click .minusNumber': 'minusNumber',
				'click .plusEmail': 'plusEmail',
				'click .minusEmail': 'minusEmail'
			},

			addContact: function(e){
				e.preventDefault();
				Backbone.history.navigate('newContact/create', {trigger: true});

			},

			updateContact: function(e){
				e.preventDefault();
				var map = {};
				for(var prop in this.model.attributes){
					var value = document.getElementById(prop) && document.getElementById(prop).value;
					if(value === '') //to handle the entities to which value is set to null while editing
					{
						if(map[prop] !== null)
						{
							map[prop] = null;
						}
					}
					else if(prop !=='id') //to handle the case not to update "id"
					{
						map[prop]= value;
					}
				}
				map['groupId'] = 2;
				
				var numberArr = [];
				var elements = document.getElementsByClassName('numbers');
				for(var i = 0 ; i<elements.length; i++){
					var num = elements[i].value;
					var defNums = this.model.get('numbers');
					if(num)
					{
						numberArr[i] = {'number': num, 'tag': 'home'};
						if(defNums[i])
						{
							numberArr[i].id = defNums[i].id;
						}
					}
				}
				map['numbers'] = numberArr;

				var emailArr = [];
				elements = document.getElementsByClassName('emails');
				for(i = 0 ; i<elements.length; i++){
					var mail = elements[i].value;
					var defMails = this.model.get('emails');
					if(mail)
					{
						// console.log(defmails[0].id);
						emailArr[i] = {'emailId': mail, 'tag': 'home'};
						if(defMails[i])
						{
							emailArr[i].id = defMails[i].id;
						}
					}
				}
				map['emails'] = emailArr;

				this.model.save(map,{error: function(model, xhr, options) {
									// var errors = JSON.parse(xhr.responseText).error.message;
									$('#contactDetailsSection').append("enter necessary feilds or make sure you are not creating duplicate entries");
								},
								success: function(model, response, options) {
									Backbone.history.navigate('contact/'+this.model.get('id'), {trigger: true});
								}.bind(this)});

			},

			cancelEdit: function(e)
			{
				e.preventDefault();
				Backbone.history.navigate('contact/'+this.model.get('id'), {trigger: true});
			},

			cancelCreation: function(e){
				e.preventDefault();
				Backbone.history.navigate('', {trigger: true});
			},

			render: function(){
				this.$el.html( this.template( this.model.attributes ) );
				return this;
			},

			plusNumber: function(e)
			{
				e.preventDefault();
				var newNum = new APP.Models.NewEntry({});
				var newNumView = new APP.Views.NewEntry({model: newNum});
				newNumView.render();
				$('#numbersSection').append(newNumView.el);

			},

			minusNumber: function(e)
			{
				e.preventDefault();
				e.target.parentNode.remove();
			},

			plusEmail: function(e)
			{
				e.preventDefault();
				var newMail = new APP.Models.NewEntry({type: 'emails', placeholder: 'email@example.com', spanClass: 'minusEmail'});
				var newMailView = new APP.Views.NewEntry({model: newMail});
				newMailView.render();
				$('#emailsSection').append(newMailView.el);
			},

			minusEmail: function(e)
			{
				e.preventDefault();
				e.target.parentNode.remove();
			}
		});
});