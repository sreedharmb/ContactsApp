({
	appDir: '.',
	baseUrl: '.',
	dir: '../ContactsApplication',
	paths: {
		'jquery'					: 'com/ext/jquery/jquery-1.10.2',
		'underscore'				: 'com/ext/underscore/underscore',
		'backbone'					: 'com/ext/backbone/backbone',
		'bootstrap'					: 'com/ext/bootstrap/js/bootstrap'
		// 'text'						: 'com/ext/require/text',
		// 'jquery.qtip'				: 'com/ext/jquery/qtip/jquery.qtip.min'
		// 'jqueryui'					: 'com/ext/jquery/jqueryui/jquery-ui.min'
	},
	'shim': {
		
		'underscore'		: {
			exports			: '_'
		},

		'backbone'			: {
			deps			: ['jquery', 'underscore'],
			exports			: 'Backbone'
		},

		'bootstrap'			: {
			deps			: ['jquery'],
			exports			: 'bootstrap'
		}


	},
	modules: [
		{
			name: 'main'
		}
	],
	preserveLicenseComments: false,
	optimizeAllPluginResources: true,
	findNestedDependencies: true,
	removeCombined: true
	/*
	cssIn: "assets/css/main.css",
    out: "./assets/css/main-min.css"
	*/
})