<?php
/**
 * Home section: Frequently Asked Questions.
 *
 * Native details elements so every answer stays keyboard accessible and
 * usable without JavaScript, plus FAQPage structured data so the same
 * questions are eligible for rich results.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_items = erh_field_rows( 'home_faq_items' );
$erh_pairs = array();

foreach ( $erh_items as $erh_item ) {
	$erh_question = isset( $erh_item['question'] ) ? trim( $erh_item['question'] ) : '';
	$erh_answer   = isset( $erh_item['answer'] ) ? trim( $erh_item['answer'] ) : '';

	if ( $erh_question && $erh_answer ) {
		$erh_pairs[] = array(
			'question' => $erh_question,
			'answer'   => $erh_answer,
		);
	}
}
?>
<section class="erh-home-faq erh-section" id="faq">
	<div class="erh-container erh-home-faq__grid">

		<div class="erh-section-head erh-home-faq__intro">
			<?php erh_eyebrow( erh_field( 'home_faq_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'home_faq_title' ),
				(int) erh_field( 'home_faq_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'home_faq_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_pairs ) : ?>
			<div class="erh-faq-list">
				<?php foreach ( $erh_pairs as $erh_index => $erh_pair ) : ?>
					<details class="erh-faq-item"<?php echo 0 === $erh_index ? ' open' : ''; ?>>
						<summary class="erh-faq-item__question">
							<span><?php echo esc_html( $erh_pair['question'] ); ?></span>
							<span class="erh-faq-item__icon" aria-hidden="true">+</span>
						</summary>
						<div class="erh-faq-item__answer">
							<?php echo wp_kses_post( wpautop( $erh_pair['answer'] ) ); ?>
						</div>
					</details>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>

	<?php
	if ( $erh_pairs ) {
		$erh_schema = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => array(),
		);

		foreach ( $erh_pairs as $erh_pair ) {
			$erh_schema['mainEntity'][] = array(
				'@type'          => 'Question',
				'name'           => wp_strip_all_tags( $erh_pair['question'] ),
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => wp_strip_all_tags( $erh_pair['answer'] ),
				),
			);
		}

		printf(
			'<script type="application/ld+json">%s</script>',
			wp_json_encode( $erh_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- JSON-LD, encoded above.
		);
	}
	?>
</section>
