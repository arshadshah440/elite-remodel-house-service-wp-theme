<?php
/**
 * Reusable template helpers.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Normalise an SCF/ACF image value into a URL + alt pair.
 *
 * Accepts the array, ID and URL return formats.
 *
 * @param mixed  $image Field value.
 * @param string $size  Image size for ID/array values.
 * @return array{url:string,alt:string,width:int,height:int}
 */
function erh_image( $image, $size = 'full' ) {
	$result = array(
		'url'    => '',
		'alt'    => '',
		'width'  => 0,
		'height' => 0,
	);

	if ( empty( $image ) ) {
		return $result;
	}

	if ( is_array( $image ) ) {
		$id = isset( $image['ID'] ) ? (int) $image['ID'] : ( isset( $image['id'] ) ? (int) $image['id'] : 0 );

		if ( $id ) {
			return erh_image( $id, $size );
		}

		$result['url'] = isset( $image['url'] ) ? $image['url'] : '';
		$result['alt'] = isset( $image['alt'] ) ? $image['alt'] : '';

		return $result;
	}

	if ( is_numeric( $image ) ) {
		$src = wp_get_attachment_image_src( (int) $image, $size );

		if ( $src ) {
			$result['url']    = $src[0];
			$result['width']  = (int) $src[1];
			$result['height'] = (int) $src[2];
			$result['alt']    = (string) get_post_meta( (int) $image, '_wp_attachment_image_alt', true );
		}

		return $result;
	}

	$result['url'] = (string) $image;

	return $result;
}

/**
 * URL of the theme's bundled "no photo yet" placeholder graphic.
 *
 * @return string
 */
function erh_placeholder_image_url() {
	return ERH_URI . 'assets/images/placeholder.svg';
}

/**
 * Normalise an SCF/ACF link value.
 *
 * @param mixed  $link          Field value (array, URL string or empty).
 * @param string $default_title Fallback label.
 * @return array{url:string,title:string,target:string}|null Null when there is no URL.
 */
function erh_link( $link, $default_title = '' ) {
	if ( empty( $link ) ) {
		return null;
	}

	if ( is_string( $link ) ) {
		$link = array( 'url' => $link );
	}

	if ( ! is_array( $link ) || empty( $link['url'] ) ) {
		return null;
	}

	$title = isset( $link['title'] ) && '' !== $link['title'] ? $link['title'] : $default_title;

	return array(
		'url'    => $link['url'],
		'title'  => $title,
		'target' => ! empty( $link['target'] ) ? $link['target'] : '',
	);
}

/**
 * Build safe href/target/rel attributes for a normalised link.
 *
 * @param array $link Result of erh_link().
 * @return string
 */
function erh_link_attrs( $link ) {
	if ( ! $link ) {
		return '';
	}

	$attrs = ' href="' . esc_url( $link['url'] ) . '"';

	if ( '_blank' === $link['target'] ) {
		$attrs .= ' target="_blank" rel="noopener noreferrer"';
	}

	return $attrs;
}

/**
 * Resolve the header logo, falling back to the WordPress custom logo and then
 * to the logo shipped with the theme.
 *
 * @return array{url:string,alt:string}
 */
function erh_header_logo_src() {
	$image = erh_image( erh_option( 'header_logo' ), 'full' );

	if ( $image['url'] ) {
		return $image;
	}

	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id ) {
		$image = erh_image( $custom_logo_id, 'full' );

		if ( $image['url'] ) {
			return $image;
		}
	}

	$bundled = ERH_DIR . 'assets/images/logo.png';

	if ( file_exists( $bundled ) ) {
		return array(
			'url' => ERH_URI . 'assets/images/logo.png',
			'alt' => get_bloginfo( 'name' ),
		);
	}

	return array(
		'url' => '',
		'alt' => '',
	);
}

/**
 * Resolve the footer logo.
 *
 * @return array{url:string,alt:string}
 */
function erh_footer_logo_src() {
	$image = erh_image( erh_option( 'footer_logo' ), 'full' );

	if ( $image['url'] ) {
		return $image;
	}

	$header_logo = erh_header_logo_src();

	if ( $header_logo['url'] ) {
		return $header_logo;
	}

	$bundled = ERH_DIR . 'assets/images/logo-white.png';

	if ( file_exists( $bundled ) ) {
		return array(
			'url' => ERH_URI . 'assets/images/logo-white.png',
			'alt' => get_bloginfo( 'name' ),
		);
	}

	return array(
		'url' => '',
		'alt' => '',
	);
}

/**
 * Get the repeater rows for an options-page field, using defaults when empty.
 *
 * @param string $field Field name.
 * @return array<int, array>
 */
function erh_rows( $field ) {
	$rows = erh_option( $field );

	return is_array( $rows ) ? $rows : array();
}

/**
 * Render the copyright line, expanding {year} and {sitename}.
 *
 * @return string
 */
function erh_copyright_text() {
	$text = (string) erh_option( 'footer_copyright' );

	return strtr(
		$text,
		array(
			'{year}'     => date_i18n( 'Y' ),
			'{sitename}' => get_bloginfo( 'name' ),
		)
	);
}

/**
 * Fallback header menu shown before a menu is assigned to the Primary location.
 *
 * @return void
 */
function erh_fallback_menu() {
	echo '<ul id="erh-primary-menu" class="erh-nav__list">';

	wp_list_pages(
		array(
			'title_li'    => '',
			'depth'       => 1,
			'number'      => 5,
			'sort_column' => 'menu_order, post_title',
		)
	);

	echo '</ul>';
}

/**
 * Output brand colour overrides as CSS custom properties.
 *
 * Only prints declarations that differ from the design defaults.
 *
 * @return void
 */
function erh_brand_inline_css() {
	$map = array(
		'--erh-navy' => array( 'brand_primary_color', '#153A68' ),
		'--erh-gold' => array( 'brand_accent_color', '#F1B73E' ),
		'--erh-ink'  => array( 'brand_ink_color', '#25262D' ),
		'--erh-grey-500' => array( 'brand_body_color', '#666A73' ),
	);

	$declarations = array();

	foreach ( $map as $property => $config ) {
		list( $field, $default ) = $config;

		$value = erh_option( $field );

		if ( ! is_string( $value ) || '' === $value ) {
			continue;
		}

		if ( 0 === strcasecmp( $value, $default ) ) {
			continue;
		}

		if ( ! preg_match( '/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value ) ) {
			continue;
		}

		$declarations[] = $property . ':' . $value . ';';

		if ( '--erh-navy' === $property ) {
			$declarations[] = sprintf( '--erh-navy-dark:%s;', erh_shade( $value, -0.16 ) );
		}

		if ( '--erh-gold' === $property ) {
			list( $r, $g, $b ) = sscanf( erh_hex_expand( $value ), '#%02x%02x%02x' );

			$declarations[] = sprintf( '--erh-gold-10:rgba(%d,%d,%d,0.1);', $r, $g, $b );
			$declarations[] = sprintf( '--erh-gold-dark:%s;', erh_shade( $value, -0.14 ) );
		}
	}

	if ( ! $declarations ) {
		return;
	}

	wp_add_inline_style( 'erh-tokens', ':root{' . implode( '', $declarations ) . '}' );
}
add_action( 'wp_enqueue_scripts', 'erh_brand_inline_css', 20 );

/**
 * Expand a 3-digit hex colour to 6 digits.
 *
 * @param string $hex Hex colour.
 * @return string
 */
function erh_hex_expand( $hex ) {
	$hex = ltrim( $hex, '#' );

	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	return '#' . $hex;
}

/**
 * Lighten or darken a hex colour.
 *
 * @param string $hex    Hex colour.
 * @param float  $amount Between -1 (black) and 1 (white).
 * @return string
 */
function erh_shade( $hex, $amount ) {
	list( $r, $g, $b ) = sscanf( erh_hex_expand( $hex ), '#%02x%02x%02x' );

	$adjust = function ( $channel ) use ( $amount ) {
		$target = $amount < 0 ? 0 : 255;

		return (int) round( $channel + ( $target - $channel ) * abs( $amount ) );
	};

	return sprintf( '#%02x%02x%02x', $adjust( $r ), $adjust( $g ), $adjust( $b ) );
}

/**
 * Read a field from the current post (used by the home page template).
 *
 * Falls back to erh_default() so the page renders sensibly before anything has
 * been filled in, and works even with no fields plugin installed.
 *
 * @param string   $selector Field name.
 * @param mixed    $fallback Optional explicit fallback. Null uses erh_default().
 * @param int|null $post_id  Optional post ID. Defaults to the current post.
 * @return mixed
 */
function erh_field( $selector, $fallback = null, $post_id = null ) {
	$value = null;

	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $selector, $post_id );
	}

	$is_empty = ( null === $value || '' === $value || array() === $value || false === $value );

	if ( $is_empty ) {
		return ( null === $fallback ) ? erh_default( $selector ) : $fallback;
	}

	return $value;
}

/**
 * Repeater rows from the current post, falling back to the defaults.
 *
 * @param string   $selector Field name.
 * @param int|null $post_id  Optional post ID.
 * @return array<int, array>
 */
function erh_field_rows( $selector, $post_id = null ) {
	$rows = erh_field( $selector, null, $post_id );

	return is_array( $rows ) ? $rows : array();
}

/**
 * Is a page-template or single-service section switched on?
 *
 * Every custom page template and the Service detail page gate their section
 * loop through this - each section has a matching "{slug}_enable" true/false
 * field (e.g. "hero_enable", "about-story_enable") in that template's ACF
 * panel. When no value has been saved yet the matching "{slug}_enable" entry
 * in erh_defaults() decides, and sections with no entry there default to
 * visible - so a brand new page shows the intended design before any toggle
 * has been touched.
 *
 * @param string   $section Section slug, e.g. "hero" or "about-story".
 * @param int|null $post_id Optional post ID. Defaults to the current post -
 *                          pass this explicitly on the Blog listing template
 *                          (home.php), since its main Loop iterates posts,
 *                          not the "Posts page" the toggle fields live on.
 * @return bool
 */
function erh_section_enabled( $section, $post_id = null ) {
	$default = erh_default( $section . '_enable' );
	$default = ( null === $default ) ? true : (bool) $default;

	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $section . '_enable', $post_id );

	return ( null === $value ) ? $default : (bool) $value;
}

/**
 * Read a "cards per row" field and clamp it to something sane.
 *
 * @param string $field   Field name, e.g. "kservices_columns".
 * @param int    $default Columns to use when the field is empty.
 * @param int    $max     Highest allowed value.
 * @return int
 */
function erh_grid_columns( $field, $default = 3, $max = 6 ) {
	$value = erh_field( $field );

	if ( null === $value || '' === $value ) {
		$value = $default;
	}

	return max( 1, min( (int) $max, (int) $value ) );
}

/**
 * Inline style declaring how many cards a grid shows per row.
 *
 * The value is written to --erh-cols-desktop rather than --erh-cols, because
 * an inline custom property outranks any stylesheet rule. The stylesheet
 * reads it into --erh-cols and is then free to override that variable at
 * tablet and phone widths, so a four-across choice still steps down to two
 * and then one instead of squashing the cards.
 *
 * @param string $field   Field name.
 * @param int    $default Columns to use when the field is empty.
 * @param int    $max     Highest allowed value.
 * @return string Attribute string, ready to echo.
 */
function erh_grid_style( $field, $default = 3, $max = 6 ) {
	return sprintf(
		' style="--erh-cols-desktop:%d"',
		erh_grid_columns( $field, $default, $max )
	);
}

/**
 * Render the small gold eyebrow label used above every section title.
 *
 * @param string $text Label text.
 * @return void
 */
function erh_eyebrow( $text ) {
	if ( ! $text ) {
		return;
	}

	printf(
		'<p class="erh-eyebrow">%s</p>',
		esc_html( $text )
	);
}

/**
 * Render a pill button with a trailing circular arrow.
 *
 * @param mixed  $link          SCF link value or URL string.
 * @param string $default_title Fallback label.
 * @param string $variant       "", "navy", "white" or "gold".
 * @return void
 */
function erh_btn_arrow( $link, $default_title = '', $variant = '' ) {
	$link = erh_link( $link, $default_title );

	if ( ! $link ) {
		return;
	}

	$class = 'erh-btn-arrow';

	if ( $variant ) {
		$class .= ' erh-btn-arrow--' . sanitize_html_class( $variant );
	}

	printf(
		'<a class="%1$s"%2$s><span class="erh-btn-arrow__label">%3$s</span><span class="erh-btn-arrow__icon">%4$s</span></a>',
		esc_attr( $class ),
		erh_link_attrs( $link ), // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs().
		esc_html( $link['title'] ),
		erh_get_icon( 'arrow-right', array( 'size' => 18 ) ) // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- built and escaped in erh_get_icon().
	);
}

/**
 * Render a heading where the last N words are highlighted in gold.
 *
 * @param string $text      Full heading text.
 * @param int    $highlight Number of trailing words to accent. 0 disables.
 * @param string $tag       HTML tag. Default h2.
 * @param string $class     Extra CSS class.
 * @return void
 */
function erh_split_heading( $text, $highlight = 1, $tag = 'h2', $class = '' ) {
	$text = trim( (string) $text );

	if ( '' === $text ) {
		return;
	}

	$tag       = preg_match( '/^h[1-6]$/', $tag ) ? $tag : 'h2';
	$classes   = trim( 'erh-heading ' . $class );
	$highlight = max( 0, (int) $highlight );
	$words     = preg_split( '/\s+/', $text );

	if ( $highlight > 0 && count( $words ) > $highlight ) {
		$accent = array_splice( $words, -$highlight );

		$inner = esc_html( implode( ' ', $words ) ) . ' <span class="erh-heading__accent">'
			. esc_html( implode( ' ', $accent ) ) . '</span>';
	} else {
		$inner = esc_html( $text );
	}

	printf(
		'<%1$s class="%2$s">%3$s</%1$s>',
		esc_attr( $tag ),
		esc_attr( $classes ),
		$inner // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- each part escaped above.
	);
}

/**
 * Render a five-star rating row.
 *
 * @param float $rating Rating out of 5.
 * @return void
 */
function erh_stars( $rating = 5 ) {
	$rating = max( 0, min( 5, (float) $rating ) );
	$full   = (int) round( $rating );

	echo '<span class="erh-stars" role="img" aria-label="'
		/* translators: %s: rating out of five. */
		. esc_attr( sprintf( __( '%s out of 5 stars', 'elite-remodel-hub' ), number_format_i18n( $rating, 1 ) ) )
		. '">';

	for ( $i = 1; $i <= 5; $i++ ) {
		$class = $i <= $full ? 'erh-stars__star is-on' : 'erh-stars__star';
		echo '<span class="' . esc_attr( $class ) . '">';
		erh_icon( 'star', array( 'size' => 16 ) );
		echo '</span>';
	}

	echo '</span>';
}

/**
 * Stop WordPress redirecting paginated URLs on the Service Listing template
 * back to page 1.
 *
 * The services grid paginates a secondary query using the "page/N/" rewrite,
 * which normally exists for splitting post content with <!--nextpage-->.
 * Since this page has no such split, redirect_canonical() treats any page
 * number beyond 1 as invalid and redirects it away - this restores it.
 *
 * @param string $redirect_url Canonical redirect target.
 * @return string|false
 */
function erh_keep_service_listing_pagination( $redirect_url ) {
	if ( is_page_template( 'page-service-listing.php' ) && ( get_query_var( 'paged' ) || get_query_var( 'page' ) ) ) {
		return false;
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'erh_keep_service_listing_pagination' );

/**
 * URL of the page using the Service Listing template, if one has been
 * published, used for the "Services" breadcrumb link on single-service.php.
 *
 * @return string Empty string when no such page exists.
 */
function erh_service_listing_url() {
	static $url = null;

	if ( null !== $url ) {
		return $url;
	}

	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- one-off lookup, cached via the static above.
			'meta_value'     => 'page-service-listing.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
		)
	);

	$url = $pages ? get_permalink( $pages[0] ) : '';

	return $url;
}

/**
 * URL of the page using the Contact Us template, if one has been published,
 * used for the "Get a Free Quote" buttons on single-service.php.
 *
 * @return string Empty string when no such page exists.
 */
function erh_contact_page_url() {
	static $url = null;

	if ( null !== $url ) {
		return $url;
	}

	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- one-off lookup, cached via the static above.
			'meta_value'     => 'page-contact.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
		)
	);

	$url = $pages ? get_permalink( $pages[0] ) : '';

	return $url;
}

/**
 * URL of the page using the About Us template, if one has been published,
 * used for the footer's "About Us" quick link.
 *
 * @return string Empty string when no such page exists.
 */
function erh_about_page_url() {
	static $url = null;

	if ( null !== $url ) {
		return $url;
	}

	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'meta_key'       => '_wp_page_template', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- one-off lookup, cached via the static above.
			'meta_value'     => 'page-about.php', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			'fields'         => 'ids',
		)
	);

	$url = $pages ? get_permalink( $pages[0] ) : '';

	return $url;
}

/**
 * Print the post date and author for the blog card.
 *
 * @return void
 */
function erh_posted_on() {
	printf(
		'<span class="erh-entry__meta-item"><time datetime="%1$s">%2$s</time></span><span class="erh-entry__meta-item">%3$s</span>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_html( get_the_author() )
	);
}

/**
 * Estimate reading time for the current post, at ~200 words per minute.
 *
 * @param int|null $post_id Optional post ID. Defaults to the current post.
 * @return string e.g. "4 min read".
 */
function erh_reading_time( $post_id = null ) {
	$content    = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes    = max( 1, (int) round( $word_count / 200 ) );

	/* translators: %d: number of minutes. */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'elite-remodel-hub' ), $minutes );
}
