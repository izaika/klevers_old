requirejs.config
	paths:
		modernizr: 'lib/modernizr'
		jquery: 'lib/jquery/jquery-3.1.1.min'
		swiper: 'lib/swiper/swiper.jquery.min'
	shim:
		swiper: ['jquery']

require ['app', 'jquery'], (app, $) ->
	$(document).ready app.init.bind app
