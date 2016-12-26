define 'pages/exception404', ['app', 'jquery', 'imagesLoaded'], (app, $, imagesLoaded) ->
	exception404 =
		init: ->

			imagesLoaded app.module[0], ->
				$('#busy_overlay').fadeOut	300
