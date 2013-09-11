define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/models/Contact',
	'js/collections/contacts',
	'js/views/Contact'
	], function($, _, Backbone, APP){
		APP.Views.ContactList = Backbone.View.extend({
			className: 'list-group',
			initialize: function(){
				this.collection.on('add', this.addOne, this);
			},

			render: function(){
				this.collection.forEach(this.addOne, this);
				return this;
			},

			addOne: function(contact){
				var contactView = new APP.Views.Contact({model: contact});
				this.$el.append(contactView.render().el);
			}

		});
});