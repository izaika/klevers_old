(function() {
	
	array_unique_noempty = function( array ) {
		var out = [];

		$.each( array, function( key, val ) {
			val = $.trim( val );

			if ( val && $.inArray( val, out ) === -1 ) {
				out.push( val );
			}
		} );

		return out;
	};
	
	clean_tags = function(tags) {
		tags = tags.replace(/\s*,\s*/g, ',').replace(/,+/g, ',').replace(/[,\s]+$/, '').replace(/^[,\s]+/, '');
		return tags;
	};
	
	render_tags =  function( ) {
		var thetags = $( "input[name=the_tags]" ),
			tagchecklist = $('.tagchecklist'),
			//id = $(el).attr('id'),
			current_tags, disabled;
		if ( ! thetags.length )
			return;

		disabled = thetags.prop('disabled');

		current_tags = thetags.val().split( ',' );
		tagchecklist.empty();

		$.each( current_tags, function( key, val ) {
			var span, xbutton;

			val = $.trim( val );

			if ( ! val )
				return;

			// Create a new span, and ensure the text is properly escaped.
			span = $('<span />').text( val );

			xbutton = $( '<a id="' + '1' + '-check-num-' + key + '" class="ntdelbutton" tabindex="0">X</a>' );

			xbutton.on( 'click keypress', function( e ) {
				// Trigger function if pressed Enter - keyboard navigation
				if ( e.type === 'click' || e.keyCode === 13 ) {
					// When using keyboard, move focus back to the new tag field.
					if ( e.keyCode === 13 ) {
						$( this ).closest( '.tagsdiv' ).find( 'input.newtag' ).focus();
					}

					parseTags( this );
				}
			});

			span.prepend( '&nbsp;' ).prepend( xbutton );


			// Append the span to the tag list.
			tagchecklist.append( span );
		});
	};
	
	parseTags = function(el) {
		var id = el.id,
			num = id.split('-check-num-')[1],
			thetags = $( "input[name=the_tags]" ),
			comma = ",",
			current_tags = thetags.val().split( comma ),
			new_tags = [];

		delete current_tags[num];

		$.each( current_tags, function( key, val ) {
			val = $.trim( val );
			if ( val ) {
				new_tags.push( val );
			}
		});

		thetags.val( clean_tags( new_tags.join( comma ) ) );

		render_tags();
		return false;
	};

}).call(this);
