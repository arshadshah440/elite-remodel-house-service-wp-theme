/**
 * Contact form: live-restrict and auto-format the phone field to a US number.
 *
 * @package Elite_Remodel_Hub
 */

( function () {
	'use strict';

	function formatUsPhone( digits ) {
		digits = digits.slice( 0, 10 );

		if ( digits.length > 6 ) {
			return '(' + digits.slice( 0, 3 ) + ') ' + digits.slice( 3, 6 ) + '-' + digits.slice( 6 );
		}

		if ( digits.length > 3 ) {
			return '(' + digits.slice( 0, 3 ) + ') ' + digits.slice( 3 );
		}

		if ( digits.length > 0 ) {
			return '(' + digits;
		}

		return '';
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		var field = document.getElementById( 'erh_phone' );

		if ( ! field ) {
			return;
		}

		field.addEventListener( 'input', function () {
			var digits = field.value.replace( /\D/g, '' ).slice( 0, 10 );
			field.value = formatUsPhone( digits );
		} );

		field.addEventListener( 'keypress', function ( event ) {
			if ( event.key && ! /[0-9]/.test( event.key ) ) {
				event.preventDefault();
			}
		} );

		field.addEventListener( 'paste', function ( event ) {
			event.preventDefault();
			var pasted  = ( event.clipboardData || window.clipboardData ).getData( 'text' );
			var digits  = pasted.replace( /\D/g, '' ).slice( 0, 10 );
			field.value = formatUsPhone( digits );
		} );

		var form = field.closest( 'form' );

		if ( form ) {
			form.addEventListener( 'submit', function ( event ) {
				var digits = field.value.replace( /\D/g, '' );

				if ( digits.length && 10 !== digits.length ) {
					event.preventDefault();
					field.setCustomValidity( 'Enter a valid 10-digit US phone number.' );
					field.reportValidity();
				} else {
					field.setCustomValidity( '' );
				}
			} );
		}
	} );
}() );
