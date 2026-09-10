/**
 * Mobile navigation drawer and submenu toggles.
 *
 * @package Elite_Remodel_Hub
 */

( function () {
	'use strict';

	var toggle = document.querySelector( '.erh-menu-toggle' );
	var nav = document.getElementById( 'erh-primary-nav' );

	if ( ! toggle || ! nav ) {
		return;
	}

	var backdrop = document.createElement( 'div' );
	backdrop.className = 'erh-nav-backdrop';
	document.body.appendChild( backdrop );

	var labels = window.erhNav || { openLabel: 'Open menu', closeLabel: 'Close menu' };

	function openNav() {
		nav.classList.add( 'is-open' );
		backdrop.classList.add( 'is-open' );
		document.body.classList.add( 'erh-menu-open' );
		toggle.setAttribute( 'aria-expanded', 'true' );
		toggle.setAttribute( 'aria-label', labels.closeLabel );
	}

	function closeNav() {
		nav.classList.remove( 'is-open' );
		backdrop.classList.remove( 'is-open' );
		document.body.classList.remove( 'erh-menu-open' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		toggle.setAttribute( 'aria-label', labels.openLabel );

		var openItems = nav.querySelectorAll( '.menu-item-has-children.is-open' );
		for ( var i = 0; i < openItems.length; i++ ) {
			openItems[ i ].classList.remove( 'is-open' );
		}
	}

	toggle.addEventListener( 'click', function () {
		if ( nav.classList.contains( 'is-open' ) ) {
			closeNav();
		} else {
			openNav();
		}
	} );

	backdrop.addEventListener( 'click', closeNav );

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key && nav.classList.contains( 'is-open' ) ) {
			closeNav();
			toggle.focus();
		}
	} );

	// On small screens, the first tap on a parent link opens its submenu
	// instead of navigating away; desktop keeps the hover dropdown.
	var parents = nav.querySelectorAll( '.menu-item-has-children > a' );

	for ( var p = 0; p < parents.length; p++ ) {
		parents[ p ].addEventListener( 'click', function ( event ) {
			if ( window.innerWidth > 1024 ) {
				return;
			}

			var item = this.parentElement;

			if ( ! item.classList.contains( 'is-open' ) ) {
				event.preventDefault();
				item.classList.add( 'is-open' );
			}
		} );
	}
}() );
