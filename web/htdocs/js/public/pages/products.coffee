define 'pages/products', ['app', 'jquery'], (app, $) ->
	index =

		categories_section: undefined

		init: ->
			@categories_section = $ '#categories'
			$('button', @categories_section).on 'click', (e) =>
				t = $ e.currentTarget
				parent_li = t.parent()
				unless parent_li.hasClass 'expanded'
					$('> ul > li', @categories_section).removeClass 'expanded'
					parent_li.addClass 'expanded'
