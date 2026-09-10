<?php
/**
 * Home section: Kitchen Design Ideas and Real Transformations.
 *
 * Copy on the left, an optional photo collage on the right, and a link to
 * the before-and-after gallery.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_paragraphs = array(
	erh_field( 'ideas_text' ),
	erh_field( 'ideas_text_2' ),
	erh_field( 'ideas_text_3' ),
);

$erh_gallery = erh_field_rows( 'ideas_gallery' );
$erh_link    = erh_resolved_link( erh_field( 'ideas_link' ), __( 'View before and after projects', 'elite-remodel-hub' ) );
?>
<section class="erh-ideas erh-section" id="design-ideas">
	<div class="erh-container erh-ideas__grid">

		<div class="erh-ideas__content">
			<?php erh_eyebrow( erh_field( 'ideas_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'ideas_title' ),
				(int) erh_field( 'ideas_title_highlight' ),
				'h2'
			);
			?>

			<?php
			foreach ( $erh_paragraphs as $erh_paragraph ) :
				if ( ! $erh_paragraph ) {
					continue;
				}
				?>
				<p class="erh-ideas__copy"><?php echo esc_html( $erh_paragraph ); ?></p>
				<?php
			endforeach;
			?>

			<?php if ( $erh_link ) : ?>
				<a class="erh-btn erh-btn--gold"<?php echo erh_link_attrs( $erh_link ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
					<?php echo esc_html( $erh_link['title'] ); ?>
				</a>
			<?php endif; ?>
		</div>

		<?php if ( $erh_gallery ) : ?>
			<div class="erh-ideas__gallery"<?php echo erh_grid_style( 'ideas_columns', 2, 4 ); ?>>
				<?php foreach ( $erh_gallery as $erh_row ) : ?>
					<?php
					$erh_photo = erh_image( isset( $erh_row['image'] ) ? $erh_row['image'] : null, 'erh-service' );

					if ( ! $erh_photo['url'] ) {
						$erh_photo['url'] = erh_placeholder_image_url();
					}
					?>
					<figure class="erh-ideas__shot">
						<img src="<?php echo esc_url( $erh_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_photo['alt'] ); ?>" loading="lazy" decoding="async">
					</figure>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
