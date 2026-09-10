<?php
/**
 * Home section: Kitchen Remodeling That Starts With Better Planning.
 *
 * A lead statement and two closing paragraphs on the left; on the right,
 * either an icon list of short points or a single photo - editable per page
 * via the "Right side content" field.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_right_type = erh_field( 'planning_right_type' );
$erh_right_type = $erh_right_type ? $erh_right_type : 'icons';

$erh_items = 'icons' === $erh_right_type ? erh_field_rows( 'planning_items' ) : array();
$erh_image = 'image' === $erh_right_type ? erh_image( erh_field( 'planning_image' ) ) : array( 'url' => '' );

// No icons and no photo set - center the intro instead of leaving a bare column.
$erh_has_right = $erh_image['url'] || $erh_items;
?>
<section class="erh-planning erh-section" id="planning">
	<div class="erh-container erh-planning__grid<?php echo $erh_has_right ? '' : ' erh-planning__grid--centered'; ?>">

		<div class="erh-planning__intro">
			<?php erh_eyebrow( erh_field( 'planning_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'planning_title' ),
				(int) erh_field( 'planning_title_highlight' ),
				'h2'
			);
			?>

			<?php $erh_lead = erh_field( 'planning_lead' ); ?>
			<?php if ( $erh_lead ) : ?>
				<p class="erh-planning__lead"><?php echo esc_html( $erh_lead ); ?></p>
			<?php endif; ?>

			<?php
			foreach ( array( erh_field( 'planning_text_2' ), erh_field( 'planning_text_3' ) ) as $erh_paragraph ) :
				if ( ! $erh_paragraph ) {
					continue;
				}
				?>
				<p class="erh-planning__copy"><?php echo esc_html( $erh_paragraph ); ?></p>
				<?php
			endforeach;
			?>
		</div>

		<?php if ( 'image' === $erh_right_type ) : ?>
			<?php if ( $erh_image['url'] ) : ?>
				<div class="erh-planning__image">
					<img src="<?php echo esc_url( $erh_image['url'] ); ?>" alt="<?php echo esc_attr( $erh_image['alt'] ); ?>" loading="lazy" decoding="async">
				</div>
			<?php endif; ?>
		<?php elseif ( $erh_items ) : ?>
			<ul class="erh-planning__list"<?php echo erh_grid_style( 'planning_columns', 1, 4 ); ?>>
				<?php foreach ( $erh_items as $erh_item ) : ?>
					<?php
					$erh_text = isset( $erh_item['text'] ) ? trim( $erh_item['text'] ) : '';

					if ( ! $erh_text ) {
						continue;
					}

					$erh_icon = ! empty( $erh_item['icon'] ) ? $erh_item['icon'] : 'ruler';
					?>
					<li class="erh-planning-card">
						<span class="erh-planning-card__icon"><?php erh_icon( $erh_icon, array( 'size' => 20 ) ); ?></span>
						<span class="erh-planning-card__text"><?php echo esc_html( $erh_text ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

	</div>
</section>
