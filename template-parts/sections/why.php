<?php

/**
 * Home section: Why Choose Us.
 *
 * Full-bleed dark navy panel with a dimmed background photo, the section
 * heading on the left and a grid of feature cards on the right. One card can
 * be marked "highlighted" to render with a solid navy fill.
 *
 * @package Elite_Remodel_Hub
 */

defined('ABSPATH') || exit;

$erh_bg    = erh_image(erh_field('why_bg_image'), 'erh-wide');
$erh_items = erh_field_rows('why_items');
?>
<section class="erh-why" id="why-choose-us">

	<?php if ($erh_bg['url']) : ?>
		<div class="erh-why__bg" style="background-image:url('<?php echo esc_url($erh_bg['url']); ?>');" aria-hidden="true"></div>
	<?php endif; ?>
	<div class="erh-why__overlay" aria-hidden="true"></div>

	<div class="erh-container erh-why__inner">

		<div class="erh-why__grid"<?php echo erh_grid_style( 'why_columns', 3 ); ?>>

			<div class="erh-why__head">
				<?php
				erh_split_heading(
					erh_field('why_title'),
					(int) erh_field('why_title_highlight'),
					'h2'
				);
				?>

				<?php $erh_text = erh_field('why_text'); ?>
				<?php if ($erh_text) : ?>
					<p class="erh-why__text"><?php echo esc_html($erh_text); ?></p>
				<?php endif; ?>
			</div>

			<?php if ($erh_items) : ?>
				<?php foreach ($erh_items as $erh_item) : ?>
					<?php
					$erh_icon_slug = isset($erh_item['icon']) && $erh_item['icon'] ? $erh_item['icon'] : 'tool';
					$erh_title     = isset($erh_item['title']) ? $erh_item['title'] : '';
					$erh_desc      = isset($erh_item['text']) ? $erh_item['text'] : '';
					$erh_highlight = ! empty($erh_item['highlight']);

					if (! $erh_title) {
						continue;
					}
					?>
					<div class="erh-why-card<?php echo $erh_highlight ? ' erh-why-card--highlight' : ''; ?>">
						<span class="erh-why-card__icon"><?php erh_icon($erh_icon_slug, array('size' => 24)); ?></span>
						<h3 class="erh-why-card__title"><?php echo esc_html($erh_title); ?></h3>
						<?php if ($erh_desc) : ?>
							<p class="erh-why-card__text"><?php echo esc_html($erh_desc); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>

			<?php endif; ?>
		</div>
	</div>
</section>