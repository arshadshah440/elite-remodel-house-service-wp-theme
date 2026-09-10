/**
 * Home page sliders (Owl Carousel 2, jQuery-based):
 *
 * - Hero gallery: 3 photos shown fully, next/previous photo peeking at
 *   each edge, dots below, auto-plays and pauses on hover.
 * - Testimonials: 3 cards shown fully, with glimpses of the next 2 cards
 *   peeking in on the right and the previous 2 on the left.
 *
 * Item widths and the peek amount ("stagePadding") are set per breakpoint
 * below rather than in CSS, since Owl computes and applies slide widths
 * itself. Card/photo styling lives in assets/css/home.css.
 *
 * @package Elite_Remodel_Hub
 */

jQuery( function ( $ ) {
	'use strict';

	if ( ! $.fn.owlCarousel ) {
		return;
	}

	var $hero = $( '#erh-hero-owl' );

	if ( $hero.length ) {
		$hero.owlCarousel( {
			items: 3,
			margin: 20,
			stagePadding: 100,
			loop: true,
			nav: false,
			dots: true,
			dotsContainer: '#erh-hero-gallery-dots',
			autoplay: true,
			autoplayTimeout: 4500,
			autoplayHoverPause: true,
			smartSpeed: 650,
			responsive: {
				0: {
					items: 1,
					stagePadding: 30,
					margin: 14,
				},
				600: {
					items: 2,
					stagePadding: 50,
					margin: 18,
				},
				900: {
					items: 3,
					stagePadding: 70,
					margin: 20,
				},
				1280: {
					items: 3,
					stagePadding: 100,
					margin: 24,
				},
			},
		} );
	}

	var $testimonials = $( '#erh-testimonials-owl' );

	if ( $testimonials.length ) {
		$testimonials.owlCarousel( {
			items: 3,
			margin: 20,
			stagePadding: 160,
			loop: true,
			nav: false,
			dots: true,
			dotsContainer: '#erh-testimonials-dots',
			smartSpeed: 550,
			responsive: {
				0: {
					items: 1,
					stagePadding: 40,
					margin: 14,
				},
				700: {
					items: 2,
					stagePadding: 70,
					margin: 18,
				},
				900: {
					items: 3,
					stagePadding: 110,
					margin: 20,
				},
				1280: {
					items: 3,
					stagePadding: 160,
					margin: 24,
				},
			},
		} );
	}
} );
