<?php
/**
 * FAQ page section: Banner.
 *
 * Compact navy intro band with a breadcrumb, page title and short intro
 * text - uses the same shared .erh-page-banner styles (assets/css/pages.css)
 * as the About and Contact pages.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_text = erh_field( 'faq_banner_text' );
?>
<section class="erh-page-banner">
	<div class="erh-container">

		<nav class="erh-page-banner__crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'elite-remodel-hub' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'elite-remodel-hub' ); ?></a>
			<span aria-hidden="true">/</span>
			<span aria-current="page"><?php the_title(); ?></span>
		</nav>

		<?php erh_eyebrow( erh_field( 'faq_banner_eyebrow' ) ); ?>

		<?php
		erh_split_heading(
			erh_field( 'faq_banner_title' ),
			(int) erh_field( 'faq_banner_title_highlight' ),
			'h1'
		);
		?>

		<?php if ( $erh_text ) : ?>
			<p class="erh-page-banner__text"><?php echo esc_html( $erh_text ); ?></p>
		<?php endif; ?>

	</div>
</section>
