/**
 * Kitchen remodel cost calculator.
 *
 * The headline estimate comes from kitchen size alone ($75-$250 per sq.
 * ft.) - the one figure that applies without extra assumptions. Every
 * other field shows its own reference range for planning context; those
 * ranges are informational and are not added into the headline number.
 *
 * @package Elite_Remodel_Hub
 */
( function () {
	'use strict';

	var LOW_RATE  = 75;
	var HIGH_RATE = 250;

	function formatCurrency( value ) {
		return '$' + Math.round( value ).toLocaleString( 'en-US' );
	}

	function init( panel ) {
		var sizeInput  = panel.querySelector( '[data-erh-calc-size]' );
		var resultEl   = panel.querySelector( '[data-erh-calc-result]' );
		var selects    = panel.querySelectorAll( '[data-erh-calc-select]' );

		if ( ! sizeInput || ! resultEl ) {
			return;
		}

		var emptyText = resultEl.textContent;

		function updateResult() {
			var size = parseFloat( sizeInput.value );

			if ( ! size || size <= 0 ) {
				resultEl.textContent = emptyText;
				return;
			}

			resultEl.textContent = formatCurrency( size * LOW_RATE ) + ' to ' + formatCurrency( size * HIGH_RATE );
		}

		function updateNote( select ) {
			var note = select.parentElement.querySelector( '[data-erh-calc-note]' );

			if ( ! note ) {
				return;
			}

			var notes = {};

			try {
				notes = JSON.parse( select.getAttribute( 'data-erh-calc-notes' ) || '{}' );
			} catch ( e ) {
				notes = {};
			}

			note.textContent = notes[ select.value ] || '';
		}

		sizeInput.addEventListener( 'input', updateResult );

		selects.forEach( function ( select ) {
			select.addEventListener( 'change', function () {
				updateNote( select );
			} );
		} );
	}

	document.querySelectorAll( '[data-erh-calculator]' ).forEach( init );
} )();
