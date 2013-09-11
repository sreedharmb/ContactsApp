define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/templates/group',
	'js/models/Group'
	], function($, _, Backbone, APP){
		
		APP.Views.Group = Backbone.View.extend({
			tagName : 'li',
			template: _.template(APP.Templates.group),

			events: {
				"click" : "makeActive"

			},

			render : function() {
				if(this.model.get('id') === 0) {
					this.$el.addClass('active');
				}
				this.$el.html( this.template( this.model.attributes ) );
				return this;
			},

			makeActive: function(){
				$('#groupSection').find('.active').removeClass('active');
				this.$el.addClass('active') ;
			}
		});
});