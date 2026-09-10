<?php
/**
 * Custom post types: Service, Testimonial.
 *
 * Both back the "Our Service" and "What Our Client Say" home page sections -
 * see template-parts/sections/services.php and testimonials.php. Each
 * section's "Choose ... to show" relationship field (Home Page Sections
 * panel) lets an admin hand-pick which posts appear; left empty, the
 * section shows every published post of that type in menu-order.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Service and Testimonial post types.
 *
 * @return void
 */
function erh_register_post_types() {
	register_post_type(
		'service',
		array(
			'labels'              => array(
				'name'                  => __( 'Services', 'elite-remodel-hub' ),
				'singular_name'         => __( 'Service', 'elite-remodel-hub' ),
				'add_new'               => __( 'Add New', 'elite-remodel-hub' ),
				'add_new_item'          => __( 'Add New Service', 'elite-remodel-hub' ),
				'edit_item'             => __( 'Edit Service', 'elite-remodel-hub' ),
				'new_item'              => __( 'New Service', 'elite-remodel-hub' ),
				'view_item'             => __( 'View Service', 'elite-remodel-hub' ),
				'view_items'            => __( 'View Services', 'elite-remodel-hub' ),
				'search_items'          => __( 'Search Services', 'elite-remodel-hub' ),
				'not_found'             => __( 'No services found', 'elite-remodel-hub' ),
				'not_found_in_trash'    => __( 'No services found in Trash', 'elite-remodel-hub' ),
				'all_items'             => __( 'All Services', 'elite-remodel-hub' ),
				'archives'              => __( 'Service Archives', 'elite-remodel-hub' ),
				'featured_image'        => __( 'Service Photo', 'elite-remodel-hub' ),
				'set_featured_image'    => __( 'Set service photo', 'elite-remodel-hub' ),
				'remove_featured_image' => __( 'Remove service photo', 'elite-remodel-hub' ),
			),
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-hammer',
			'menu_position'       => 21,
			'hierarchical'        => true,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'has_archive'         => false,
			'rewrite'             => array( 'slug' => 'services' ),
			'exclude_from_search' => false,
		)
	);

	register_post_type(
		'testimonial',
		array(
			'labels'              => array(
				'name'                  => __( 'Testimonials', 'elite-remodel-hub' ),
				'singular_name'         => __( 'Testimonial', 'elite-remodel-hub' ),
				'add_new'               => __( 'Add New', 'elite-remodel-hub' ),
				'add_new_item'          => __( 'Add New Testimonial', 'elite-remodel-hub' ),
				'edit_item'             => __( 'Edit Testimonial', 'elite-remodel-hub' ),
				'new_item'              => __( 'New Testimonial', 'elite-remodel-hub' ),
				'view_item'             => __( 'View Testimonial', 'elite-remodel-hub' ),
				'search_items'          => __( 'Search Testimonials', 'elite-remodel-hub' ),
				'not_found'             => __( 'No testimonials found', 'elite-remodel-hub' ),
				'not_found_in_trash'    => __( 'No testimonials found in Trash', 'elite-remodel-hub' ),
				'all_items'             => __( 'All Testimonials', 'elite-remodel-hub' ),
				'featured_image'        => __( 'Client Photo', 'elite-remodel-hub' ),
				'set_featured_image'    => __( 'Set client photo', 'elite-remodel-hub' ),
				'remove_featured_image' => __( 'Remove client photo', 'elite-remodel-hub' ),
			),
			// Client testimonials don't need a public single page of their own -
			// they're only ever displayed as cards on the home page.
			'public'              => false,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_rest'        => true,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-testimonial',
			'menu_position'       => 22,
			'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'         => false,
		)
	);
}
add_action( 'init', 'erh_register_post_types' );

// Service is hierarchical (see registration above), so WordPress's default
// permalink and request handling already nests a child under its parent's
// slug - e.g. "/services/kitchen-remodeling/kitchen-remodel-cost-guide/".
// No custom permalink/request handling is needed for that.
