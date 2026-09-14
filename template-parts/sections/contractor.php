<?php
/**
 * Home section: Choosing the Right Kitchen Remodeling Contractor.
 *
 * Guidance on vetting a contractor, with the items a written proposal
 * should identify pulled out as a checklist panel.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_intro = array(
	erh_field( 'contractor_text' ),
	erh_field( 'contractor_text_2' ),
);

$erh_outro = array(
	erh_field( 'contractor_text_3' ),
	erh_field( 'contractor_text_4' ),
);

$erh_checklist = erh_field_rows( 'contractor_checklist' );

// No proposal checklist - center the copy in one column instead of splitting
// the grid against an empty panel.
$erh_has_checklist = ! empty( $erh_checklist );
?>
<section class="erh-contractor erh-section" id="choosing-a-contractor">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'contractor_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'contractor_title' ),
				(int) erh_field( 'contractor_title_highlight' ),
				'h2'
			);
			?>
		</div>

		<div class="erh-contractor__grid<?php echo $erh_has_checklist ? '' : ' erh-contractor__grid--centered'; ?>">

			<div class="erh-contractor__copy">
				<?php
				foreach ( $erh_intro as $erh_paragraph ) :
					if ( ! $erh_paragraph ) {
						continue;
					}
					?>
					<p><?php echo esc_html( $erh_paragraph ); ?></p>
					<?php
				endforeach;
				?>
			</div>

			<?php if ( $erh_checklist ) : ?>
				<div class="erh-contractor__panel">
					<h3 class="erh-contractor__panel-title"><?php echo esc_html( erh_field( 'contractor_checklist_title' ) ); ?></h3>
					<ul class="erh-contractor__checklist">
						<?php foreach ( $erh_checklist as $erh_row ) : ?>
							<?php
							$erh_label = isset( $erh_row['text'] ) ? trim( $erh_row['text'] ) : '';

							if ( ! $erh_label ) {
								continue;
							}
							?>
							<li>
								<span class="erh-contractor__tick" aria-hidden="true"><?php erh_icon( 'check', array( 'size' => 14 ) ); ?></span>
								<span><?php echo esc_html( $erh_label ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

		</div>

		<?php if ( array_filter( $erh_outro ) ) : ?>
			<div class="erh-contractor__outro<?php echo $erh_has_checklist ? '' : ' erh-contractor__outro--centered'; ?>">
				<?php
				foreach ( $erh_outro as $erh_paragraph ) :
					if ( ! $erh_paragraph ) {
						continue;
					}
					?>
					<p><?php echo esc_html( $erh_paragraph ); ?></p>
					<?php
				endforeach;
				?>
			</div>
		<?php endif; ?>

	</div>
</section>
