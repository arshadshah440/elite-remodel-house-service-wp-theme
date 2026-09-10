<?php
/**
 * FAQ page section: Questions and answers.
 *
 * Uses native details elements so every answer remains keyboard accessible
 * and usable without JavaScript.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'faq_items' );
?>
<section class="erh-faq-content erh-section" id="faq-list">
	<div class="erh-container erh-faq-content__grid">
		<div class="erh-section-head erh-faq-content__intro">
			<?php erh_eyebrow( erh_field( 'faq_content_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'faq_content_title' ),
				(int) erh_field( 'faq_content_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'faq_content_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_items ) : ?>
			<div class="erh-faq-list">
				<?php foreach ( $erh_items as $erh_index => $erh_item ) : ?>
					<?php
					$erh_question = isset( $erh_item['question'] ) ? trim( $erh_item['question'] ) : '';
					$erh_answer   = isset( $erh_item['answer'] ) ? trim( $erh_item['answer'] ) : '';

					if ( ! $erh_question || ! $erh_answer ) {
						continue;
					}

					$erh_id = 'erh-faq-' . ( (int) $erh_index + 1 );
					?>
					<details class="erh-faq-item"<?php echo 0 === $erh_index ? ' open' : ''; ?>>
						<summary class="erh-faq-item__question">
							<span><?php echo esc_html( $erh_question ); ?></span>
							<span class="erh-faq-item__icon" aria-hidden="true">+</span>
						</summary>
						<div class="erh-faq-item__answer" id="<?php echo esc_attr( $erh_id ); ?>">
							<?php echo wp_kses_post( wpautop( $erh_answer ) ); ?>
						</div>
					</details>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>