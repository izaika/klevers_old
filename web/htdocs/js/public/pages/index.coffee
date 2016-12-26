define 'pages/index', ['app', 'jquery', 'mousewheel', 'imagesLoaded', 'jqueryMobile'], (app, $, mousewheel, imagesLoaded) ->
	index =


		parallax_blocks: undefined
		

		init: ->

			imagesLoaded app.module[0], ->
				$('#busy_overlay').fadeOut	300

			unless Modernizr.touchevents	
				@parallax_blocks = $ '.parallax'

				app.window.on 'mousemove', (e) =>
					window_w	= app.window.width()
					window_h	= app.window.height()
					coef_x		= ((((e.pageX / window_w) * 100) - 50) * 2) / 100
					coef_y		= ((((e.pageY / window_h) * 100) - 50) * 2) / 100
					@parallax_blocks.each (i, e) ->
						t = $ e
						translate_x = coef_x * t.data('parallax-range') / 15
						translate_y = coef_y * t.data('parallax-range') / 15
						if t.data('parallax-invert')
							translate_x *= -1
							translate_y *= -1

						translate_x += '%'
						translate_y += '%'

						t.css
							'-ms-transform': 'translate(' + translate_x + ', ' + translate_y + ')'
							'-webkit-transform': 'translate(' + translate_x + ', ' + translate_y + ')'
							'transform': 'translate(' + translate_x + ', ' + translate_y + ')'

				app.scrollable_element.mousewheel (e) ->
					unless app.module.hasClass 'busy'
						app.module.addClass 'busy'
						$('#busy_overlay').fadeIn 300, ->
							window.location.href = $('#main_link').attr 'href'

			if Modernizr.touchevents
				event_type = 'vmousedown'
			else
				event_type = 'click'

			$('#main_link').on event_type, (e) ->
				console.log 1
				e.preventDefault();
				unless app.module.hasClass 'busy'
					app.module.addClass 'busy'
					$('#busy_overlay').fadeIn 300, ->
						window.location.href = $('#main_link').attr 'href'





				
				
	
	
