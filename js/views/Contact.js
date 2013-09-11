define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/templates/contact',
	'js/models/Contact'
	], function($, _, Backbone, APP){

		APP.Views.Contact = Backbone.View.extend({
			tagName: 'a',
			className: 'list-group-item',
			
			initialize: function(){
				// this.template =  _.template($('#contact-template').html());
				this.template = _.template(APP.Templates.contact);
				this.model.on('change:firstname', this.render, this);
				this.model.on('change:lastname', this.render, this);
				this.model.on('change:numbers', this.render, this);
				this.model.on('destroy', this.removeContact, this);
			},

			events: {
				"click" : "makeActive",
				"click #removeContact" : "deleteContact"
			},
			
			render: function() {
				this.$el.attr('href', '#contact/'+this.model.get('id'));
				// this.$el.html(this.model.get('firstname') + ' ' + this.model.get('lastname') + ':' + outNum);
				this.$el.html( this.template( this.model.attributes ) );
				return this;
			},

			makeActive: function(){
				$('#contactListSection').find('.active').removeClass('active');
				this.$el.addClass('active');
				Backbone.history.navigate('contact/'+this.model.get('id'), {trigger: true});
			},

			deleteContact: function() {
						
				this.model.destroy({wait: true,
						success: function(model, xhr, options) {
							$('#contactDetailsSection').html("contact successfully deleted");
						},
						error: function(model, response, options){
							$('#contactListSection').find('.active').removeClass('active');
							this.$el.addClass('active');
							$('#contactDetailsSection').empty();
							$('#contactDetailsSection').html("unable to delete contact");
						}
				});
			},

			removeContact: function() {
				this.remove();
			}


		});
});
