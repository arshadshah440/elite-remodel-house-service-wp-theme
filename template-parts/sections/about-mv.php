<?php
/**
 * About page section: Mission & Vision.
 *
 * Two side-by-side cards - Mission (solid navy) and Vision (light wash) -
 * mirroring each other with a matching icon treatment.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_mission_text = erh_field( 'mission_text' );
$erh_vision_text  = erh_field( 'vision_text' );
?>
<section class="erh-about-mv erh-section">
	<div class="erh-container erh-mv__grid">

		<div class="erh-mv-card erh-mv-card--mission">
			<span class="erh-mv-card__icon"><?php erh_icon( 'target', array( 'size' => 24 ) ); ?></span>
			<h2 class="erh-mv-card__title"><?php echo esc_html( erh_field( 'mission_title' ) ); ?></h2>
			<?php if ( $erh_mission_text ) : ?>
				<p class="erh-mv-card__text"><?php echo esc_html( $erh_mission_text ); ?></p>
			<?php endif; ?>
		</div>

		<div class="erh-mv-card erh-mv-card--vision">
			<span class="erh-mv-card__icon"><?php erh_icon( 'sparkles', array( 'size' => 24 ) ); ?></span>
			<h2 class="erh-mv-card__title"><?php echo esc_html( erh_field( 'vision_title' ) ); ?></h2>
			<?php if ( $erh_vision_text ) : ?>
				<p class="erh-mv-card__text"><?php echo esc_html( $erh_vision_text ); ?></p>
			<?php endif; ?>
		</div>

	</div>
</section>
