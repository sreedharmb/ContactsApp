define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/models/Group',
	'js/collections/Groups',
	'js/views/Group'
	], function($, _, Backbone, APP){
		APP.Views.GroupList = Backbone.View.extend({
			tagName: 'ul',
			className: 'nav nav-pills nav-stacked pre-scrollable',
			
			initialize: function(){
				this.collection.on('add', this.addOne, this);
			},

			render: function(){
				this.collection.each(this.addOne, this);
				return this;
			},

			addOne: function(group) {
				var groupView = new APP.Views.Group({model: group});
				this.$el.append(groupView.render().el);
			}
		});
});