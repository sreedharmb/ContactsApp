define([
	'jquery',
	'underscore',
	'backbone',
	'js/config',
	'js/models/Tweet'
	], function($, _, Backbone, APP){

		APP.Collections.Tweets = Backbone.Collection.extend({
			url: 'https://api.twitter.com/1.1/statuses/user_timeline.json'
			// headers: {
			// 	Authorization: 'OAuth oauth_consumer_key="DC0sePOBbQ8bYdC8r4Smg",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1376244579",oauth_nonce="2069772441",oauth_version="1.0",oauth_token="134057446-nXdD8CQZ1x2i2yBRGekmIlgYBhDW3dUAOx6YUpVJ",oauth_signature="e0oRBHKDhjVG3h1kjJUx144hjn8%3D"',
			// 	'Access-Control-Allow-Origin': 'http://www.sreedharmb.blogspot.in'
			// }
		});
		
});