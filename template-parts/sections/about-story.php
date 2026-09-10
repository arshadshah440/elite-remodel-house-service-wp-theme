<?php
/**
 * About page section: Story.
 *
 * Text on the left, a three-photo collage on the right - reuses the same
 * .erh-about__* media classes as the home page's About teaser (home.css)
 * so the collage looks identical, just mirrored.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_main   = erh_image( erh_field( 'story_image_main' ), 'erh-card' );
$erh_top    = erh_image( erh_field( 'story_image_top' ), 'erh-service' );
$erh_bottom = erh_image( erh_field( 'story_image_bottom' ), 'erh-service' );
?>
<section class="erh-about-story erh-section" id="story">
	<div class="erh-container erh-about__grid erh-about-story__grid">

		<div class="erh-about__content">

			<?php erh_eyebrow( erh_field( 'story_eyebrow' ) ); ?>

			<?php
			erh_split_heading(
				erh_field( 'story_title' ),
				(int) erh_field( 'story_title_highlight' ),
				'h2'
			);
			?>

			<?php $erh_text = erh_field( 'story_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-about__copy"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>

			<?php $erh_text_2 = erh_field( 'story_text_2' ); ?>
			<?php if ( $erh_text_2 ) : ?>
				<p class="erh-about__copy"><?php echo esc_html( $erh_text_2 ); ?></p>
			<?php endif; ?>

			<?php
			$erh_button = erh_link( erh_field( 'story_button' ), __( 'Meet the Team', 'elite-remodel-hub' ) );

			if ( $erh_button ) :
				?>
				<a class="erh-btn erh-btn--navy"<?php echo erh_link_attrs( $erh_button ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
					<?php echo esc_html( $erh_button['title'] ); ?>
				</a>
			<?php endif; ?>

		</div>

		<div class="erh-about__media">
			<div class="erh-about__media-main">
				<?php if ( $erh_main['url'] ) : ?>
					<img src="<?php echo esc_url( $erh_main['url'] ); ?>" alt="<?php echo esc_attr( $erh_main['alt'] ); ?>" loading="lazy" decoding="async">
				<?php else : ?>
					<img src="<?php echo esc_url( erh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
				<?php endif; ?>
			</div>
			<div class="erh-about__media-stack">
				<div class="erh-about__media-small">
					<?php if ( $erh_top['url'] ) : ?>
						<img src="<?php echo esc_url( $erh_top['url'] ); ?>" alt="<?php echo esc_attr( $erh_top['alt'] ); ?>" loading="lazy" decoding="async">
					<?php else : ?>
						<img src="<?php echo esc_url( erh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
					<?php endif; ?>
				</div>
				<div class="erh-about__media-small">
					<?php if ( $erh_bottom['url'] ) : ?>
						<img src="<?php echo esc_url( $erh_bottom['url'] ); ?>" alt="<?php echo esc_attr( $erh_bottom['alt'] ); ?>" loading="lazy" decoding="async">
					<?php else : ?>
						<img src="<?php echo esc_url( erh_placeholder_image_url() ); ?>" alt="" loading="lazy" decoding="async">
					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>
</section>
