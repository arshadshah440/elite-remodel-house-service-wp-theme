<?php
/**
 * Elite Remodel Hub - Theme bootstrap.
 *
 * This file only defines constants and loads the modules in /inc.
 * Keep feature code in its own module rather than adding it here.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

define( 'ERH_VERSION', '1.0.0' );
define( 'ERH_DIR', trailingslashit( get_template_directory() ) );
define( 'ERH_URI', trailingslashit( get_template_directory_uri() ) );

function erh_load_modules() {
	$modules = array(
		'setup',           // Theme supports, menus, image sizes.
		'cpt',             // Service and Testimonial custom post types.
		'enqueue',         // Styles and scripts.
		'icons',           // Inline SVG icon library.
		'template-tags',   // Reusable template helpers.
		'links',           // Destination page URL resolver.
		'scf',             // Secure Custom Fields options pages + JSON sync.
		'defaults',        // Fallback content used before fields are filled in.
		'seed',            // One-time starter Service/Testimonial posts.
		'seed-pages',      // One-time creation of the pages the home page links to.
		'seo',             // Home page SEO title and meta description.
		'contact-form',    // Contact page form submission handler.
	);

	foreach ( $modules as $module ) {
		$file = ERH_DIR . 'inc/' . $module . '.php';
		if ( is_readable( $file ) ) {
			require_once $file;
		}
	}
}
erh_load_modules();
