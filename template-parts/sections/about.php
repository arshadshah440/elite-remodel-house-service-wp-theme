<?php
/**
 * Home section: About.
 *
 * A three-photo collage on the left, the section copy, eyebrow and a
 * "Read More" button on the right.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_main   = erh_image( erh_field( 'about_image_main' ), 'erh-card' );
$erh_top    = erh_image( erh_field( 'about_image_top' ), 'erh-service' );
$erh_bottom = erh_image( erh_field( 'about_image_bottom' ), 'erh-service' );
?>
<section class="erh-about erh-section" id="about">
	<div class="erh-container erh-about__grid">

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

		<div class="erh-about__content">

			<?php erh_eyebrow( erh_field( 'about_eyebrow' ) ); ?>

			<?php
			erh_split_heading(
				erh_field( 'about_title' ),
				(int) erh_field( 'about_title_highlight' ),
				'h2'
			);
			?>

			<?php
			$erh_paragraphs = array(
				erh_field( 'about_text' ),
				erh_field( 'about_text_2' ),
				erh_field( 'about_text_3' ),
				erh_field( 'about_text_4' ),
			);

			foreach ( $erh_paragraphs as $erh_paragraph ) :
				if ( ! $erh_paragraph ) {
					continue;
				}
				?>
				<p class="erh-about__copy"><?php echo esc_html( $erh_paragraph ); ?></p>
				<?php
			endforeach;
			?>

			<?php
			$erh_button = erh_resolved_link( erh_field( 'about_button' ), __( 'Read More', 'elite-remodel-hub' ) );

			if ( $erh_button ) :
				?>
				<a class="erh-btn erh-btn--navy"<?php echo erh_link_attrs( $erh_button ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
					<?php echo esc_html( $erh_button['title'] ); ?>
				</a>
			<?php endif; ?>

		</div>

	</div>
</section>
