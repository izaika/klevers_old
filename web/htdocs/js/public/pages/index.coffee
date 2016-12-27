define 'pages/index', ['app', 'jquery', 'swiper'], (app, $) ->
	index =
		slideshow: undefined

		init: ->
			@slideshow = new Swiper '#slideshow',
				loop: true
				autoplay: 5000
				speed: 1000
				effect: 'fade'
