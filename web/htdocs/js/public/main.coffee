requirejs.config
	paths:
		modernizr: 'lib/modernizr'
		jquery: 'lib/jquery/jquery-2.2.4.min'
		jqueryMobile: 'lib/jquery/jquery.mobile.custom'
		googleMaps: 'https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAJhLGgTNcmI3VA5zTSdPDYQIUSnTPigyo&language=no'
		mousewheel: 'lib/mousewheel'
		swiper: 'lib/swiper.jquery'
		isotope: 'lib/isotope'
		imagesLoaded: 'lib/imagesLoaded'
	shim:
		mousewheel: ['jquery']
		swiper: ['jquery']
		isotope: ['jquery']
		jqueryMobile: ['jquery']

require ['app', 'jquery'], (app, $) ->
	$(document).ready app.init.bind app