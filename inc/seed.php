<?php
/**
 * One-time starter content for the Service and Testimonial post types,
 * seeded from the theme's original default copy so the homepage has real
 * posts to show (and an admin has something to edit) before anyone has
 * added their own.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Write an ACF/SCF field when the plugin is active, otherwise fall back to
 * a plain post meta write under the same key so the value is picked up if
 * a fields plugin is installed later.
 *
 * @param int    $post_id Post ID.
 * @param string $name    Field/meta name.
 * @param mixed  $value   Value to store.
 * @return void
 */
function erh_seed_field( $post_id, $name, $value ) {
	if ( function_exists( 'update_field' ) ) {
		update_field( $name, $value, $post_id );
	} else {
		update_post_meta( $post_id, $name, $value );
	}
}

/**
 * Find a post by exact title within a post type, without the deprecated
 * get_page_by_title().
 *
 * @param string $title     Exact post title.
 * @param string $post_type Post type slug.
 * @return int Post ID, or 0 when not found.
 */
function erh_find_post_by_title( $title, $post_type ) {
	$query = new WP_Query(
		array(
			'post_type'              => $post_type,
			'title'                  => $title,
			'post_status'            => 'any',
			'posts_per_page'         => 1,
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);

	return ! empty( $query->posts ) ? (int) $query->posts[0] : 0;
}

/**
 * Seed the Service and Testimonial post types with starter content, once.
 *
 * Safe to run on every request: it bails immediately once the
 * `erh_seeded_content_v1` option is set, and additionally skips any
 * individual post that already exists (matched by title) so re-running it
 * manually never creates duplicates.
 *
 * @return void
 */
function erh_seed_starter_content() {
	if ( get_option( 'erh_seeded_content_v1' ) ) {
		return;
	}

	if ( ! post_type_exists( 'service' ) || ! post_type_exists( 'testimonial' ) ) {
		return;
	}

	$services = array(
		array(
			'title'   => __( 'Kitchen Remodeling', 'elite-remodel-hub' ),
			'excerpt' => __( 'From contemporary designs to classic elegance, we create kitchens that are both functional and visually stunning.', 'elite-remodel-hub' ),
		),
		array(
			'title'   => __( 'Bathroom Renovation', 'elite-remodel-hub' ),
			'excerpt' => __( 'Transform your bathroom into a spa-like retreat with our expert renovation services.', 'elite-remodel-hub' ),
		),
		array(
			'title'   => __( 'Living Room Makeovers', 'elite-remodel-hub' ),
			'excerpt' => __( 'Enhance the heart of your home with our creative living room designs and layout solutions.', 'elite-remodel-hub' ),
		),
		array(
			'title'   => __( 'Custom Carpentry', 'elite-remodel-hub' ),
			'excerpt' => __( 'Our skilled carpenters craft custom furniture, cabinets, and fixtures tailored to your space.', 'elite-remodel-hub' ),
		),
	);

	foreach ( $services as $order => $service ) {
		if ( erh_find_post_by_title( $service['title'], 'service' ) ) {
			continue;
		}

		wp_insert_post(
			array(
				'post_type'    => 'service',
				'post_title'   => $service['title'],
				'post_excerpt' => $service['excerpt'],
				'post_content' => wpautop( $service['excerpt'] ),
				'post_status'  => 'publish',
				'menu_order'   => $order,
			)
		);
	}

	$testimonials = array(
		array(
			'name'      => 'Neng Jamila',
			'role'      => __( 'Homeowner', 'elite-remodel-hub' ),
			'quote'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis lorem sit amet neque tempor fermentum.', 'elite-remodel-hub' ),
			'rating'    => 5,
			'highlight' => false,
		),
		array(
			'name'      => 'Mpok Ida',
			'role'      => __( 'Homeowner', 'elite-remodel-hub' ),
			'quote'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis lorem sit amet neque tempor fermentum.', 'elite-remodel-hub' ),
			'rating'    => 5,
			'highlight' => true,
		),
		array(
			'name'      => 'Dedek Gemezz',
			'role'      => __( 'Homeowner', 'elite-remodel-hub' ),
			'quote'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis lorem sit amet neque tempor fermentum.', 'elite-remodel-hub' ),
			'rating'    => 5,
			'highlight' => false,
		),
	);

	foreach ( $testimonials as $order => $testimonial ) {
		if ( erh_find_post_by_title( $testimonial['name'], 'testimonial' ) ) {
			continue;
		}

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'testimonial',
				'post_title'  => $testimonial['name'],
				'post_status' => 'publish',
				'menu_order'  => $order,
			)
		);

		if ( ! $post_id || is_wp_error( $post_id ) ) {
			continue;
		}

		erh_seed_field( $post_id, 'role', $testimonial['role'] );
		erh_seed_field( $post_id, 'quote', $testimonial['quote'] );
		erh_seed_field( $post_id, 'rating', $testimonial['rating'] );
		erh_seed_field( $post_id, 'highlight', $testimonial['highlight'] );
	}

	update_option( 'erh_seeded_content_v1', 1 );
}
add_action( 'init', 'erh_seed_starter_content', 20 );
