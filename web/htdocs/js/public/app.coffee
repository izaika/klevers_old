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


			$('.initially-hidden')
				.removeClass "initially-hidden"
				.hide()

			switch @module.attr 'id'
				when 'index'
					require ['cs!pages/index'], (index) ->
						index.init()
				when 'products'
					require ['cs!pages/products'], (products) ->
						products.init()
				when 'exception404'
					require ['cs!pages/exception404'], (exception404) ->
						exception404.init()
