<?php
/**
 * Home section: Hero.
 *
 * Split heading with supporting text and a "Start Project Now" button, plus
 * an Owl Carousel slider of project photos showing 3 at a time, with the
 * next/previous photo peeking at each edge, and dot navigation below.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_title   = erh_field( 'hero_title' );
$erh_text    = erh_field( 'hero_text' );
$erh_text_2  = erh_field( 'hero_text_2' );
$erh_note    = erh_field( 'hero_note' );
$erh_gallery = erh_field_rows( 'hero_gallery' );

$erh_contact_url = erh_contact_page_url();

if ( ! $erh_contact_url ) {
	$erh_contact_url = '#contact';
}

$erh_button_default = erh_default( 'hero_button' );

if ( ! is_array( $erh_button_default ) ) {
	$erh_button_default = array( 'url' => '', 'title' => '' );
}

// The estimate button points at the contact page unless a URL is set.
if ( empty( $erh_button_default['url'] ) ) {
	$erh_button_default['url'] = $erh_contact_url;
}

$erh_button = erh_resolved_link( erh_field( 'hero_button', $erh_button_default ), __( 'Start Project Now', 'elite-remodel-hub' ) );
?>
<section class="erh-hero" id="hero">

	<div class="erh-container erh-hero__inner">

		<div class="erh-hero__content">

			<?php
			erh_split_heading(
				$erh_title,
				(int) erh_field( 'hero_title_highlight' ),
				'h1'
			);
			?>

			<?php if ( $erh_text ) : ?>
				<p class="erh-hero__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>

			<?php if ( $erh_text_2 ) : ?>
				<p class="erh-hero__text"><?php echo esc_html( $erh_text_2 ); ?></p>
			<?php endif; ?>

			<?php if ( $erh_note ) : ?>
				<p class="erh-hero__note">
					<span class="erh-hero__note-icon" aria-hidden="true"><?php erh_icon( 'map-pin', array( 'size' => 18 ) ); ?></span>
					<span><?php echo esc_html( $erh_note ); ?></span>
				</p>
			<?php endif; ?>

			<?php if ( $erh_button ) : ?>
				<a class="erh-btn erh-btn--navy erh-btn--lg"<?php echo erh_link_attrs( $erh_button ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
					<?php echo esc_html( $erh_button['title'] ); ?>
				</a>
			<?php endif; ?>

		</div>

	</div>

	<?php if ( $erh_gallery ) : ?>
		<?php $erh_total = count( $erh_gallery ); ?>
		<div class="erh-hero__gallery" role="region" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Recent remodeling work', 'elite-remodel-hub' ); ?>">

			<div class="owl-carousel erh-hero-owl" id="erh-hero-owl">
				<?php foreach ( $erh_gallery as $erh_index => $erh_row ) : ?>
					<?php
					$erh_photo = isset( $erh_row['image'] ) ? erh_image( $erh_row['image'], 'erh-gallery' ) : erh_image( null );
					if ( ! $erh_photo['url'] ) {
						$erh_photo['url'] = erh_placeholder_image_url();
					}
					?>
					<div class="erh-hero__gallery-item" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( sprintf( /* translators: 1: slide number, 2: total slides. */ __( '%1$d of %2$d', 'elite-remodel-hub' ), $erh_index + 1, $erh_total ) ); ?>">
						<img src="<?php echo esc_url( $erh_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_photo['alt'] ); ?>" loading="<?php echo 0 === $erh_index ? 'eager' : 'lazy'; ?>" decoding="async">
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( $erh_total > 3 ) : ?>
				<div class="erh-hero__gallery-dots" id="erh-hero-gallery-dots" aria-label="<?php esc_attr_e( 'Gallery slides', 'elite-remodel-hub' ); ?>"></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

</section>
