<?php
/**
 * About page section: Team.
 *
 * A grid of team member cards - photo, name, role.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_members = erh_field_rows( 'team_members' );
?>
<section class="erh-about-team erh-section" id="team">
	<div class="erh-container">

		<div class="erh-section-head">
			<?php erh_eyebrow( erh_field( 'team_eyebrow' ) ); ?>
			<?php
			erh_split_heading(
				erh_field( 'team_title' ),
				(int) erh_field( 'team_title_highlight' ),
				'h2'
			);
			?>
			<?php $erh_text = erh_field( 'team_text' ); ?>
			<?php if ( $erh_text ) : ?>
				<p class="erh-section-head__text"><?php echo esc_html( $erh_text ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $erh_members ) : ?>
			<div class="erh-team__grid">
				<?php foreach ( $erh_members as $erh_member ) : ?>
					<?php
					$erh_photo = isset( $erh_member['photo'] ) ? erh_image( $erh_member['photo'], 'erh-service' ) : erh_image( null );
					$erh_name  = isset( $erh_member['name'] ) ? $erh_member['name'] : '';
					$erh_role  = isset( $erh_member['role'] ) ? $erh_member['role'] : '';

					if ( ! $erh_name ) {
						continue;
					}

					if ( ! $erh_photo['url'] ) {
						$erh_photo['url'] = erh_placeholder_image_url();
					}
					?>
					<div class="erh-team-card">
						<div class="erh-team-card__photo">
							<img src="<?php echo esc_url( $erh_photo['url'] ); ?>" alt="<?php echo esc_attr( $erh_photo['alt'] ? $erh_photo['alt'] : $erh_name ); ?>" loading="lazy" decoding="async">
						</div>
						<div class="erh-team-card__name"><?php echo esc_html( $erh_name ); ?></div>
						<?php if ( $erh_role ) : ?>
							<div class="erh-team-card__role"><?php echo esc_html( $erh_role ); ?></div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
