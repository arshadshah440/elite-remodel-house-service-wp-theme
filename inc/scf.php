<?php
/**
 * Secure Custom Fields (SCF) / Advanced Custom Fields integration.
 *
 * Registers the "Theme Settings" options page with Header, Footer and Brand
 * sub-pages, and points SCF at the theme's /acf-json folder so every field
 * group lives in version control.
 *
 * SCF is the WordPress.org maintained fork of ACF and exposes the same
 * `acf_*` function names, so this file works with either plugin.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

/**
 * Is a compatible fields plugin active?
 *
 * @return bool
 */
function erh_has_scf() {
	return function_exists( 'acf_add_options_page' ) && function_exists( 'get_field' );
}

/**
 * Register the Theme Settings options pages.
 *
 * @return void
 */
function erh_register_options_pages() {
	if ( ! erh_has_scf() ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title'      => __( 'Theme Settings', 'elite-remodel-hub' ),
			'menu_title'      => __( 'Theme Settings', 'elite-remodel-hub' ),
			'menu_slug'       => 'erh-theme-settings',
			'capability'      => 'edit_theme_options',
			'icon_url'        => 'dashicons-admin-customizer',
			'position'        => 59,
			'redirect'        => true,
			'update_button'   => __( 'Save Settings', 'elite-remodel-hub' ),
			'updated_message' => __( 'Theme settings saved.', 'elite-remodel-hub' ),
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Header Settings', 'elite-remodel-hub' ),
			'menu_title'  => __( 'Header', 'elite-remodel-hub' ),
			'menu_slug'   => 'erh-header-settings',
			'parent_slug' => 'erh-theme-settings',
			'capability'  => 'edit_theme_options',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Footer Settings', 'elite-remodel-hub' ),
			'menu_title'  => __( 'Footer', 'elite-remodel-hub' ),
			'menu_slug'   => 'erh-footer-settings',
			'parent_slug' => 'erh-theme-settings',
			'capability'  => 'edit_theme_options',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => __( 'Brand &amp; Contact', 'elite-remodel-hub' ),
			'menu_title'  => __( 'Brand &amp; Contact', 'elite-remodel-hub' ),
			'menu_slug'   => 'erh-brand-settings',
			'parent_slug' => 'erh-theme-settings',
			'capability'  => 'edit_theme_options',
		)
	);
}
add_action( 'acf/init', 'erh_register_options_pages' );

/**
 * Save new/updated field groups into the theme's acf-json folder.
 *
 * @param string $path Default save path.
 * @return string
 */
function erh_acf_json_save_point( $path ) {
	return ERH_DIR . 'acf-json';
}
add_filter( 'acf/settings/save_json', 'erh_acf_json_save_point' );

/**
 * Load field groups from the theme's acf-json folder.
 *
 * @param array $paths Existing load paths.
 * @return array
 */
function erh_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = ERH_DIR . 'acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'erh_acf_json_load_point' );

/**
 * Warn administrators when the fields plugin is missing, since the header,
 * footer and home page fall back to placeholder content without it.
 *
 * @return void
 */
function erh_scf_missing_notice() {
	if ( erh_has_scf() || ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	$screen = get_current_screen();

	if ( $screen && ! in_array( $screen->id, array( 'dashboard', 'themes', 'plugins' ), true ) ) {
		return;
	}

	$install_url = wp_nonce_url(
		self_admin_url( 'plugin-install.php?tab=search&s=secure+custom+fields' ),
		'install-plugin'
	);

	printf(
		'<div class="notice notice-warning"><p><strong>%1$s</strong> %2$s <a href="%3$s">%4$s</a></p></div>',
		esc_html__( 'Elite Remodel Hub:', 'elite-remodel-hub' ),
		esc_html__( 'the header, footer and home page are edited through Secure Custom Fields (or ACF). Install and activate one of them to unlock Theme Settings &rarr; Header / Footer / Brand &amp; Contact and the Home Page Sections panel. Until then the theme shows placeholder content.', 'elite-remodel-hub' ),
		esc_url( $install_url ),
		esc_html__( 'Install Secure Custom Fields', 'elite-remodel-hub' )
	);
}
add_action( 'admin_notices', 'erh_scf_missing_notice' );

/**
 * Read a value from the Theme Settings options pages.
 *
 * Falls back to erh_default() so templates always render something sensible,
 * including on a fresh install with no fields plugin present.
 *
 * @param string $selector Field name.
 * @param mixed  $fallback Optional explicit fallback. When null the value from
 *                         erh_default() is used.
 * @return mixed
 */
function erh_option( $selector, $fallback = null ) {
	$value = null;

	if ( erh_has_scf() ) {
		$value = get_field( $selector, 'option' );
	}

	$is_empty = ( null === $value || '' === $value || array() === $value || false === $value );

	if ( $is_empty ) {
		return ( null === $fallback ) ? erh_default( $selector ) : $fallback;
	}

	return $value;
}

/**
 * Read a sub value from a repeater row while inside have_rows().
 *
 * @param string $selector Sub field name.
 * @param mixed  $fallback Fallback value.
 * @return mixed
 */
function erh_sub( $selector, $fallback = '' ) {
	if ( ! function_exists( 'get_sub_field' ) ) {
		return $fallback;
	}

	$value = get_sub_field( $selector );

	return ( null === $value || '' === $value ) ? $fallback : $value;
}
