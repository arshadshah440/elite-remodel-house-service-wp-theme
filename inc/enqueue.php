<?php
/**
 * Front-end and editor assets.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * File modification time, used for cache busting during development.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function erh_asset_version( $relative_path ) {
	$file = ERH_DIR . ltrim( $relative_path, '/' );

	return file_exists( $file ) ? (string) filemtime( $file ) : ERH_VERSION;
}

/**
 * Enqueue front-end styles and scripts.
 *
 * @return void
 */
function erh_enqueue_assets() {
	wp_enqueue_style(
		'erh-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;1,500&display=swap',
		array(),
		null // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion -- external font.
	);

	$stylesheets = array(
		'erh-tokens' => 'assets/css/tokens.css',
		'erh-base'   => 'assets/css/base.css',
		'erh-header' => 'assets/css/header.css',
		'erh-footer' => 'assets/css/footer.css',
		'erh-home'   => 'assets/css/home.css',
	);

	$deps = array( 'erh-fonts' );

	foreach ( $stylesheets as $handle => $path ) {
		wp_enqueue_style( $handle, ERH_URI . $path, $deps, erh_asset_version( $path ) );
		$deps[] = $handle;
	}

	// style.css last so child themes and users can override everything above.
	wp_enqueue_style( 'erh-style', get_stylesheet_uri(), $deps, erh_asset_version( 'style.css' ) );

	wp_enqueue_script(
		'erh-navigation',
		ERH_URI . 'assets/js/navigation.js',
		array(),
		erh_asset_version( 'assets/js/navigation.js' ),
		true
	);

	wp_localize_script(
		'erh-navigation',
		'erhNav',
		array(
			'openLabel'  => __( 'Open menu', 'elite-remodel-hub' ),
			'closeLabel' => __( 'Close menu', 'elite-remodel-hub' ),
		)
	);

	if ( is_page_template( 'page-home.php' ) || is_front_page() || is_page_template( 'page-service-listing.php' ) || is_page_template( 'page-location.php' ) ) {
		wp_enqueue_style(
			'erh-owlcarousel',
			ERH_URI . 'assets/vendor/owlcarousel/owl.carousel.min.css',
			array(),
			'2.3.4'
		);

		wp_enqueue_script(
			'erh-owlcarousel',
			ERH_URI . 'assets/vendor/owlcarousel/owl.carousel.min.js',
			array( 'jquery' ),
			'2.3.4',
			true
		);

		wp_enqueue_script(
			'erh-home',
			ERH_URI . 'assets/js/home.js',
			array( 'erh-owlcarousel' ),
			erh_asset_version( 'assets/js/home.js' ),
			true
		);
	}

	if ( is_page_template( 'page-about.php' ) || is_page_template( 'page-contact.php' ) || is_page_template( 'page-faq.php' ) || is_page_template( 'page-privacy-policy.php' ) || is_page_template( 'page-service-listing.php' ) || is_page_template( 'page-kitchen-gallery.php' ) || is_home() ) {
		wp_enqueue_style(
			'erh-pages',
			ERH_URI . 'assets/css/pages.css',
			array( 'erh-home' ),
			erh_asset_version( 'assets/css/pages.css' )
		);
	}

	if ( is_page_template( 'page-about.php' ) ) {
		wp_enqueue_style(
			'erh-about',
			ERH_URI . 'assets/css/about.css',
			array( 'erh-pages' ),
			erh_asset_version( 'assets/css/about.css' )
		);
	}

	if ( is_page_template( 'page-contact.php' ) ) {
		wp_enqueue_style(
			'erh-contact',
			ERH_URI . 'assets/css/contact.css',
			array( 'erh-pages' ),
			erh_asset_version( 'assets/css/contact.css' )
		);
	}

	// The home page carries an FAQ section of its own, so it needs the same
	// accordion styles as the dedicated FAQ page template.
	if ( is_page_template( 'page-faq.php' ) || is_page_template( 'page-home.php' ) || is_page_template( 'page-kitchen-gallery.php' ) || is_front_page() ) {
		wp_enqueue_style(
			'erh-faq',
			ERH_URI . 'assets/css/faq.css',
			array( 'erh-home' ),
			erh_asset_version( 'assets/css/faq.css' )
		);
	}

	if ( is_page_template( 'page-privacy-policy.php' ) ) {
		wp_enqueue_style(
			'erh-privacy',
			ERH_URI . 'assets/css/privacy.css',
			array( 'erh-pages' ),
			erh_asset_version( 'assets/css/privacy.css' )
		);
	}

	if ( is_page_template( 'page-service-listing.php' ) ) {
		wp_enqueue_style(
			'erh-service-listing',
			ERH_URI . 'assets/css/service-listing.css',
			array( 'erh-pages' ),
			erh_asset_version( 'assets/css/service-listing.css' )
		);
	}

	if ( is_page_template( 'page-kitchen-gallery.php' ) ) {
		wp_enqueue_style(
			'erh-kitchen-gallery',
			ERH_URI . 'assets/css/kitchen-gallery.css',
			array( 'erh-pages' ),
			erh_asset_version( 'assets/css/kitchen-gallery.css' )
		);

		wp_enqueue_script(
			'erh-compare-slider',
			ERH_URI . 'assets/js/compare-slider.js',
			array(),
			erh_asset_version( 'assets/js/compare-slider.js' ),
			true
		);
	}

	if ( is_singular( 'service' ) ) {
		wp_enqueue_style(
			'erh-faq',
			ERH_URI . 'assets/css/faq.css',
			array( 'erh-home' ),
			erh_asset_version( 'assets/css/faq.css' )
		);

		wp_enqueue_style(
			'erh-service-detail',
			ERH_URI . 'assets/css/service.css',
			array( 'erh-faq' ),
			erh_asset_version( 'assets/css/service.css' )
		);

		wp_enqueue_script(
			'erh-cost-calculator',
			ERH_URI . 'assets/js/cost-calculator.js',
			array(),
			erh_asset_version( 'assets/js/cost-calculator.js' ),
			true
		);
	}

	if ( is_page_template( 'page-location.php' ) ) {
		wp_enqueue_style(
			'erh-contact',
			ERH_URI . 'assets/css/contact.css',
			array( 'erh-home' ),
			erh_asset_version( 'assets/css/contact.css' )
		);

		wp_enqueue_style(
			'erh-location',
			ERH_URI . 'assets/css/location.css',
			array( 'erh-contact' ),
			erh_asset_version( 'assets/css/location.css' )
		);
	}

	if ( is_home() || is_singular( 'post' ) ) {
		wp_enqueue_style(
			'erh-blog',
			ERH_URI . 'assets/css/blog.css',
			array( 'erh-home' ),
			erh_asset_version( 'assets/css/blog.css' )
		);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'erh_enqueue_assets' );

/**
 * Load the design tokens inside the block editor so colors match the front end.
 *
 * @return void
 */
function erh_editor_assets() {
	add_editor_style(
		array(
			'assets/css/tokens.css',
			'assets/css/base.css',
			'assets/css/home.css',
			'assets/css/pages.css',
			'assets/css/about.css',
			'assets/css/contact.css',
					'assets/css/faq.css',
					'assets/css/privacy.css',
					'assets/css/service-listing.css',
					'assets/css/service.css',
					'assets/css/location.css',
					'assets/css/blog.css',
					'assets/css/kitchen-gallery.css',
		)
	);
}
add_action( 'after_setup_theme', 'erh_editor_assets' );

/**
 * Preconnect to the Google Fonts hosts.
 *
 * @param array  $urls          URLs to print.
 * @param string $relation_type Relation type.
 * @return array
 */
function erh_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type && wp_style_is( 'erh-fonts', 'queue' ) ) {
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'erh_resource_hints', 10, 2 );
