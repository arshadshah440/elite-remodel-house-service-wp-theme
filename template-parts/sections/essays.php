<?php
/**
 * Kitchen Gallery page section: More Topics.
 *
 * Longer-form asides that do not fit a card or before/after shape. Each row
 * has a shared intro paragraph, then one of a few layouts chosen per row:
 * plain text, a two-column note with a callout, a tag grid, a checklist
 * grid, or a numbered steps list.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'essays_items' );

if ( ! $erh_items ) {
	return;
}

/**
 * Render a field's text as HTML when it contains markup, plain escaped text otherwise.
 *
 * @param string $erh_text Raw field value.
 * @return string Safe markup ready to echo.
 */
function erh_essay_richtext( $erh_text ) {
	if ( $erh_text !== wp_strip_all_tags( $erh_text ) ) {
		return wp_kses_post( $erh_text );
	}

	return esc_html( $erh_text );
}
?>
<section class="erh-essays erh-section" id="more-topics">
	<div class="erh-container erh-container--narrow">

		<?php $erh_title = erh_field( 'essays_title' ); ?>
		<?php if ( $erh_title ) : ?>
			<div class="erh-section-head">
				<?php erh_eyebrow( erh_field( 'essays_eyebrow' ) ); ?>
				<?php
				erh_split_heading(
					$erh_title,
					(int) erh_field( 'essays_title_highlight' ),
					'h2'
				);
				?>
				<?php $erh_text = erh_field( 'essays_text' ); ?>
				<?php if ( $erh_text ) : ?>
					<p class="erh-section-head__text"><?php echo erh_essay_richtext( $erh_text ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="erh-essays__list">
			<?php foreach ( $erh_items as $erh_item ) : ?>
				<?php
				$erh_item_title = isset( $erh_item['title'] ) ? trim( $erh_item['title'] ) : '';
				$erh_intro      = isset( $erh_item['text'] ) ? trim( $erh_item['text'] ) : '';

				if ( ! $erh_item_title ) {
					continue;
				}

				$erh_layout = isset( $erh_item['layout'] ) && $erh_item['layout'] ? $erh_item['layout'] : 'plain';
				?>
				<div class="erh-essay">
					<h3 class="erh-essay__title"><?php echo esc_html( $erh_item_title ); ?></h3>

					<?php if ( $erh_intro ) : ?>
						<?php if ( 'plain' === $erh_layout ) : ?>
							<div class="erh-essay__body"><?php echo wp_kses_post( wpautop( $erh_intro ) ); ?></div>
						<?php else : ?>
							<p class="erh-essay__intro"><?php echo erh_essay_richtext( $erh_intro ); ?></p>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( 'two_column' === $erh_layout ) : ?>
						<?php
						$erh_col_label      = isset( $erh_item['col_label'] ) ? trim( $erh_item['col_label'] ) : '';
						$erh_col_text       = isset( $erh_item['col_text'] ) ? $erh_item['col_text'] : '';
						$erh_callout_label  = isset( $erh_item['callout_label'] ) ? trim( $erh_item['callout_label'] ) : '';
						$erh_callout_text   = isset( $erh_item['callout_text'] ) ? $erh_item['callout_text'] : '';
						$erh_outro          = isset( $erh_item['outro_text'] ) ? trim( $erh_item['outro_text'] ) : '';
						?>
						<?php if ( $erh_col_text || $erh_callout_text ) : ?>
							<div class="erh-essay__cols">
								<?php if ( $erh_col_text ) : ?>
									<div class="erh-essay__col">
										<?php if ( $erh_col_label ) : ?>
											<strong><?php echo esc_html( $erh_col_label ); ?>:</strong>
										<?php endif; ?>
										<?php echo esc_html( $erh_col_text ); ?>
									</div>
								<?php endif; ?>
								<?php if ( $erh_callout_text ) : ?>
									<div class="erh-essay__callout">
										<?php if ( $erh_callout_label ) : ?>
											<strong><?php echo esc_html( $erh_callout_label ); ?>:</strong>
										<?php endif; ?>
										<?php echo esc_html( $erh_callout_text ); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( $erh_outro ) : ?>
							<p class="erh-essay__outro"><em><?php echo erh_essay_richtext( $erh_outro ); ?></em></p>
						<?php endif; ?>

					<?php elseif ( 'tags' === $erh_layout ) : ?>
						<?php
						$erh_tags     = isset( $erh_item['tags'] ) && is_array( $erh_item['tags'] ) ? $erh_item['tags'] : array();
						$erh_body     = isset( $erh_item['body_text'] ) ? $erh_item['body_text'] : '';
						$erh_tag_link = erh_resolved_link( isset( $erh_item['link'] ) ? $erh_item['link'] : '', $erh_item_title );
						?>
						<?php if ( $erh_tags ) : ?>
							<div class="erh-essay__tags">
								<?php foreach ( $erh_tags as $erh_tag ) : ?>
									<?php $erh_tag_label = isset( $erh_tag['label'] ) ? trim( $erh_tag['label'] ) : ''; ?>
									<?php if ( $erh_tag_label ) : ?>
										<span class="erh-essay__tag"><?php echo esc_html( $erh_tag_label ); ?></span>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<?php if ( $erh_body ) : ?>
							<p class="erh-essay__body-text"><?php echo erh_essay_richtext( $erh_body ); ?></p>
						<?php endif; ?>
						<?php if ( $erh_tag_link ) : ?>
							<a class="erh-essay__link"<?php echo erh_link_attrs( $erh_tag_link ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
								<?php echo esc_html( $erh_tag_link['title'] ); ?>
								<?php erh_icon( 'arrow-right', array( 'size' => 16 ) ); ?>
							</a>
						<?php endif; ?>

					<?php elseif ( 'checklist' === $erh_layout ) : ?>
						<?php
						$erh_check_items = isset( $erh_item['items'] ) && is_array( $erh_item['items'] ) ? $erh_item['items'] : array();
						$erh_outro       = isset( $erh_item['outro_text'] ) ? trim( $erh_item['outro_text'] ) : '';
						?>
						<?php if ( $erh_check_items ) : ?>
							<div class="erh-essay__checklist">
								<?php foreach ( $erh_check_items as $erh_check ) : ?>
									<?php
									$erh_check_title = isset( $erh_check['title'] ) ? trim( $erh_check['title'] ) : '';
									$erh_check_text  = isset( $erh_check['text'] ) ? $erh_check['text'] : '';

									if ( ! $erh_check_title ) {
										continue;
									}
									?>
									<div class="erh-essay__check">
										<h4><?php echo esc_html( $erh_check_title ); ?></h4>
										<?php if ( $erh_check_text ) : ?>
											<p><?php echo erh_essay_richtext( $erh_check_text ); ?></p>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<?php if ( $erh_outro ) : ?>
							<p class="erh-essay__note"><strong><?php esc_html_e( 'Note:', 'elite-remodel-hub' ); ?></strong> <?php echo erh_essay_richtext( $erh_outro ); ?></p>
						<?php endif; ?>

					<?php elseif ( 'steps' === $erh_layout ) : ?>
						<?php $erh_steps = isset( $erh_item['items'] ) && is_array( $erh_item['items'] ) ? $erh_item['items'] : array(); ?>
						<?php if ( $erh_steps ) : ?>
							<ol class="erh-essay__steps">
								<?php
								$erh_number = 0;

								foreach ( $erh_steps as $erh_step ) :
									$erh_step_title = isset( $erh_step['title'] ) ? trim( $erh_step['title'] ) : '';

									if ( ! $erh_step_title ) {
										continue;
									}

									++$erh_number;
									$erh_step_text = isset( $erh_step['text'] ) ? $erh_step['text'] : '';
									?>
									<li class="erh-essay__step">
										<span class="erh-essay__step-number"><?php echo esc_html( $erh_number ); ?></span>
										<div>
											<h4><?php echo esc_html( $erh_step_title ); ?></h4>
											<?php if ( $erh_step_text ) : ?>
												<p><?php echo erh_essay_richtext( $erh_step_text ); ?></p>
											<?php endif; ?>
										</div>
									</li>
								<?php endforeach; ?>
							</ol>
						<?php endif; ?>


					<?php elseif ( 'table' === $erh_layout ) : ?>
						<?php
						$erh_rows  = isset( $erh_item['items'] ) && is_array( $erh_item['items'] ) ? $erh_item['items'] : array();
						$erh_outro = isset( $erh_item['outro_text'] ) ? trim( $erh_item['outro_text'] ) : '';
						?>
						<?php if ( $erh_rows ) : ?>
							<dl class="erh-essay__table">
								<?php foreach ( $erh_rows as $erh_row ) : ?>
									<?php
									$erh_row_label = isset( $erh_row['title'] ) ? trim( $erh_row['title'] ) : '';
									$erh_row_value = isset( $erh_row['text'] ) ? trim( $erh_row['text'] ) : '';

									if ( ! $erh_row_label ) {
										continue;
									}
									?>
									<div class="erh-essay__table-row">
										<dt><?php echo esc_html( $erh_row_label ); ?></dt>
										<dd><?php echo esc_html( $erh_row_value ); ?></dd>
									</div>
								<?php endforeach; ?>
							</dl>
						<?php endif; ?>
						<?php if ( $erh_outro ) : ?>
							<p class="erh-essay__outro"><?php echo erh_essay_richtext( $erh_outro ); ?></p>
						<?php endif; ?>

					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
