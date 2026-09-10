<?php
/**
 * One-time creation of the destination pages the home page links to.
 *
 * The kitchen remodeling home page links out to a fixed set of service,
 * guide and state pages. This module creates each of them as an empty
 * published page - with the right slug, title and page template - the first
 * time the theme runs, so every link on the home page resolves instead of
 * 404ing while the content is still being written.
 *
 * Nothing is overwritten: a page that already exists at the same path is
 * left exactly as it is, and the whole routine bails out once the
 * `erh_seeded_pages_v1` option is set.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * The pages the home page links to.
 *
 * Each entry: slug, title, optional parent slug, optional page template and
 * optional intro paragraph used as the page's starting content.
 *
 * @return array<int, array<string, string>>
 */
function erh_linked_pages() {
	return array(
		array(
			'slug'     => 'kitchen-remodeling',
			'title'    => __( 'Kitchen Remodeling', 'elite-remodel-hub' ),
			'intro'    => __( 'Full kitchen remodeling can transform an outdated or inefficient kitchen through coordinated design and construction.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'cost',
			'title'    => __( 'Kitchen Remodel Cost Guide', 'elite-remodel-hub' ),
			'parent'   => 'kitchen-remodeling',
			'intro'    => __( 'Kitchen remodeling does not have one standard price. This guide breaks down what affects the cost of a kitchen remodel.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'kitchen-cabinet-refacing',
			'title'    => __( 'Kitchen Cabinet Refacing', 'elite-remodel-hub' ),
			'intro'    => __( 'Kitchen cabinet refacing updates existing cabinets without automatically replacing the entire cabinet system.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'countertop-installation',
			'title'    => __( 'Countertop Installation', 'elite-remodel-hub' ),
			'intro'    => __( 'Countertops affect preparation space, maintenance requirements, and the overall kitchen design.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'kitchen-island-installation',
			'title'    => __( 'Kitchen Island Installation', 'elite-remodel-hub' ),
			'intro'    => __( 'A kitchen island can add preparation space, cabinets, drawers, seating, electrical access, or appliance space.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'small-kitchen-remodeling',
			'title'    => __( 'Small Kitchen Remodeling', 'elite-remodel-hub' ),
			'intro'    => __( 'Limited square footage makes every design decision more important.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'kitchen-design',
			'title'    => __( 'Kitchen Design', 'elite-remodel-hub' ),
			'intro'    => __( 'A functional kitchen design connects cabinets, countertops, appliances, storage, lighting, seating, and work areas.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'kitchen-remodel-before-after',
			'title'    => __( 'Kitchen Remodel Before and After', 'elite-remodel-hub' ),
			'intro'    => __( 'Before-and-after examples showing how changing cabinet placement, counter space, lighting, storage, or room configuration affects both appearance and function.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'california',
			'title'    => __( 'California', 'elite-remodel-hub' ),
			'template' => 'page-location.php',
			'intro'    => __( 'Kitchen remodeling services in California cover full renovations, cabinet refacing, countertops, kitchen islands, and small kitchen remodeling projects.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'oregon',
			'title'    => __( 'Oregon', 'elite-remodel-hub' ),
			'template' => 'page-location.php',
			'intro'    => __( 'Kitchen remodeling services in Oregon support projects ranging from focused cabinet and countertop improvements to complete kitchen renovations.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'florida',
			'title'    => __( 'Florida', 'elite-remodel-hub' ),
			'template' => 'page-location.php',
			'intro'    => __( 'Kitchen remodeling services in Florida include full kitchen renovations, cabinet updates, countertops, kitchen islands, and small kitchen transformations.', 'elite-remodel-hub' ),
		),
		array(
			'slug'     => 'washington',
			'title'    => __( 'Washington', 'elite-remodel-hub' ),
			'template' => 'page-location.php',
			'intro'    => __( 'Kitchen remodeling services in Washington help homeowners plan projects around existing kitchen conditions, available space, project requirements, and remodeling goals.', 'elite-remodel-hub' ),
		),
	);
}

/**
 * Create any linked page that does not already exist.
 *
 * Safe to run repeatedly: existing pages are matched by path and skipped.
 *
 * @return void
 */
function erh_seed_linked_pages() {
	if ( get_option( 'erh_seeded_pages_v1' ) ) {
		return;
	}

	if ( ! is_admin() && ! wp_doing_cron() ) {
		return;
	}

	$created = array();

	foreach ( erh_linked_pages() as $page ) {
		$parent_id = 0;

		if ( ! empty( $page['parent'] ) ) {
			$parent = get_page_by_path( $page['parent'], OBJECT, 'page' );

			if ( ! $parent instanceof WP_Post ) {
				// The parent has not been created yet this run - skip the child
				// so it is not orphaned at the site root.
				continue;
			}

			$parent_id = (int) $parent->ID;
		}

		$path     = $parent_id ? $page['parent'] . '/' . $page['slug'] : $page['slug'];
		$existing = get_page_by_path( $path, OBJECT, 'page' );

		if ( $existing instanceof WP_Post ) {
			continue;
		}

		$post_id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_title'   => $page['title'],
				'post_name'    => $page['slug'],
				'post_parent'  => $parent_id,
				'post_status'  => 'publish',
				'post_content' => ! empty( $page['intro'] ) ? wpautop( $page['intro'] ) : '',
			)
		);

		if ( ! $post_id || is_wp_error( $post_id ) ) {
			continue;
		}

		if ( ! empty( $page['template'] ) ) {
			update_post_meta( $post_id, '_wp_page_template', $page['template'] );
		}

		if ( 'page-location.php' === ( isset( $page['template'] ) ? $page['template'] : '' ) ) {
			erh_seed_field( $post_id, 'location_name', $page['title'] );
		}

		$created[] = $path;
	}

	update_option( 'erh_seeded_pages_v1', 1 );

	if ( $created ) {
		update_option( 'erh_seeded_pages_created', $created );
	}
}
add_action( 'admin_init', 'erh_seed_linked_pages' );

/**
 * Tell the administrator which pages were created, once.
 *
 * @return void
 */
function erh_seeded_pages_notice() {
	$created = get_option( 'erh_seeded_pages_created' );

	if ( ! $created || ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	delete_option( 'erh_seeded_pages_created' );

	printf(
		'<div class="notice notice-success is-dismissible"><p><strong>%1$s</strong> %2$s</p><p><code>%3$s</code></p></div>',
		esc_html__( 'Elite Remodel Hub:', 'elite-remodel-hub' ),
		esc_html__( 'created the pages the home page links to. They are published and empty - add content to each when you are ready.', 'elite-remodel-hub' ),
		esc_html( implode( '  /  ', array_map( 'sanitize_text_field', (array) $created ) ) )
	);
}
add_action( 'admin_notices', 'erh_seeded_pages_notice' );
