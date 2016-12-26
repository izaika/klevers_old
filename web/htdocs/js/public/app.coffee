define 'app', ['jquery'], ($) ->
	$.fn.scrollable_element = ->
		@.map ->
			elem = @
			isWin = !elem.nodeName || $.inArray( elem.nodeName.toLowerCase(), ['iframe','#document','html','body'] ) != -1
			return elem unless isWin

			doc = (elem.contentWindow || elem).document || elem.ownerDocument || elem

			if /webkit/i.test(navigator.userAgent) || doc.compatMode == 'BackCompat'
				doc.body
			else
				doc.documentElement


	app =
		url: (rel_url) ->
			return @base_url + rel_url.replace /^\/+/, ""


		jsonURL: (url) ->
			result = url
			unless result then result = document.location.href
			if result.indexOf('?') == -1 then result += '?'
			if result.substr(-1) != '?' then result += '&'
			result += '___xhr'
			result


		measureScrollbar: ->
			$body = $ 'body'
			scrollDiv = document.createElement 'div'
			scrollDiv.className = 'modal-scrollbar-measure'
			$(scrollDiv).css 'overflow', 'scroll'
			$body.append scrollDiv
			scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth
			$body[0].removeChild scrollDiv
			scrollbarWidth


		base_url:			undefined
		window:				undefined
		html:				undefined
		body:				undefined
		module:				undefined
		scrollable_element:	undefined
		menu_btn:			undefined
		menu_overlay:		undefined
		to_top_link:		undefined
		document:			undefined
		footer:				undefined
		facebook_link:		undefined
		instagram_link:		undefined
		linkedin_link:		undefined
		pdf:				undefined


		init: ->
			@base_url				= $ 'body'
				.data 'base-url'
				.replace(/\/+$/, "") + "/"
			@window 				= $ window
			@html					= $ 'html'
			@body					= $ 'body'
			@module					= $ 'main'
			@scrollable_element		= $(window).scrollable_element()
			@menu_btn				= $ '#menu_btn'
			@menu_overlay			= $ '#menu_overlay'
			@to_top_link			= $ '#to_top'
			@document 				= $ document
			@footer 				= $ 'footer'
			@facebook_link			= $ '#facebook_link'
			@instagram_link			= $ '#instagram_link'
			@linkedin_link			= $ '#linkedin_link'
			@pdf_link				= $ '#pdf_link'

			@menu_btn.on 'click', (e) =>
				e.preventDefault()
				if @html.hasClass 'menu-is-shown'
					@html.removeClass 'menu-is-shown'
					@menu_overlay.stop(true, true).fadeOut '300'
				else
					@html.addClass 'menu-is-shown'
					@menu_overlay.stop(true, true).fadeIn '300'

			unless Modernizr.touchevents
				@html.attr 'data-scrollbar-width', app.measureScrollbar()



			$('.initially-hidden')
				.removeClass "initially-hidden"
				.hide()

			@initTransitionLinks()

			switch @module.attr 'id'
				when 'index'
					require ['cs!pages/index'], (index) ->
						index.init()
				when 'home'
					require ['cs!pages/home'], (home) ->
						home.init()
				when 'projects'
					require ['cs!pages/projects'], (projects) ->
						projects.init()
				when 'project_article'
					require ['cs!pages/project_article'], (project_article) ->
						project_article.init()
				when 'blog'
					require ['cs!pages/blog'], (blog) ->
						blog.init()
				when 'about'
					require ['cs!pages/about'], (about) ->
						about.init()
				when 'contact'
					require ['cs!pages/contact'], (contact) ->
						contact.init()
				when 'search'
					require ['cs!pages/search'], (search) ->
						search.init()
				when 'exception404'
					require ['cs!pages/exception404'], (exception404) ->
						exception404.init()

			if @to_top_link.length
				@to_top_link.on 'click', (e) =>
					e.preventDefault()
					@scrollable_element.animate
						scrollTop: 0
					, 800

			@window.on 'scroll', =>
				window_height	= @window.height()
				footer_height	= @footer.height()
				scroll_top 		= @scrollable_element.scrollTop()
				document_height	= @document.height()

				if scroll_top > window_height * 0.2
					@to_top_link.addClass 'visible'
				else
					@to_top_link.removeClass 'visible'

				if scroll_top >= document_height - window_height - footer_height
					margin_bottom = footer_height - (document_height - (scroll_top + window_height))
					@facebook_link.css 	'margin-bottom', margin_bottom if @facebook_link.length
					@instagram_link.css 'margin-bottom', margin_bottom if @instagram_link.length
					@linkedin_link.css 'margin-bottom', margin_bottom if @linkedin_link.length
					@pdf_link.css 		'margin-bottom', margin_bottom if @pdf_link.length
					@to_top_link.css 	'margin-bottom', margin_bottom if @to_top_link.length
				else
					@facebook_link.removeAttr 	'style' if @facebook_link.length
					@instagram_link.removeAttr 	'style' if @instagram_link.length
					@linkedin_link.removeAttr 	'style' if @linkedin_link.length
					@pdf_link.removeAttr 		'style' if @pdf_link.length
					@to_top_link.removeAttr 	'style' if @to_top_link.length


			@window.trigger 'scroll'


		initTransitionLinks: ->
			if Modernizr.touchevents
				$('.touchlink').off('click').on 'click', (e) =>
					e.preventDefault()
					t = $ e.currentTarget
					if t.hasClass 'vhover'
						location.href = t.attr 'href'
					else
						$('.touchlink').removeClass 'vhover'
						t.addClass 'vhover'

				$('a.transition:not(.touchlink)').off('click').on 'click', (e) ->
					e.preventDefault()
					t = $ e.currentTarget
					busy_overlay = $ '#busy_overlay'
					if t.hasClass 'to-blog'
						busy_overlay.addClass 'blue'
					else if app.html.hasClass 'blue-bg'
						busy_overlay.addClass 'gray'
					busy_overlay.fadeIn 300, ->
						window.location.href = t.attr 'href'
			else
				$('a.transition').off('click').on 'click', (e) ->
					e.preventDefault()
					t = $ e.currentTarget
					busy_overlay = $ '#busy_overlay'
					if t.hasClass 'to-blog'
						busy_overlay.addClass 'blue'
					else if app.html.hasClass 'blue-bg'
						busy_overlay.addClass 'gray'
					busy_overlay.fadeIn 300, ->
						window.location.href = t.attr 'href'
