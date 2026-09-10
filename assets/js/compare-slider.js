/**
 * Before/after drag slider for the Kitchen Gallery comparison cards.
 *
 * Each ".erh-compare" wraps a full after-photo, a clipped before-photo, and
 * a native range input sized to cover the whole card. The range input does
 * all the real work - dragging, touch, and left/right arrow keys - and this
 * script just mirrors its value onto the clip-path and divider position.
 *
 * @package Elite_Remodel_Hub
 */
( function () {
	'use strict';

	function init( compare ) {
		var range   = compare.querySelector( '.erh-compare__range' );
		var clip    = compare.querySelector( '.erh-compare__clip' );
		var divider = compare.querySelector( '.erh-compare__divider' );

		if ( ! range || ! clip ) {
			return;
		}

		function update() {
			var value  = Number( range.value );
			var inset  = 'inset(0 ' + ( 100 - value ) + '% 0 0)';

			clip.style.clipPath = inset;
			clip.style.webkitClipPath = inset;

			if ( divider ) {
				divider.style.left = value + '%';
			}
		}

		range.addEventListener( 'input', update );
		update();
	}

	document.querySelectorAll( '.erh-compare' ).forEach( init );
} )();
