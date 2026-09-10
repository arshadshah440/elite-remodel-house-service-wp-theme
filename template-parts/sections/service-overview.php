<?php
/**
 * Service detail section: Overview.
 *
 * The service's main written content on the left (whatever was typed into
 * the editor), a "Quick Facts" card and a mini contact CTA in a sticky
 * sidebar on the right.
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_facts       = erh_field_rows( 'service_facts' );
$erh_phone       = erh_option( 'brand_phone' );
$erh_email       = erh_option( 'brand_email' );
$erh_contact_url = erh_contact_page_url();

if ( ! $erh_contact_url ) {
	$erh_contact_url = '#contact';
}
?>
<section class="erh-service-overview erh-section" id="overview">
	<div class="erh-container erh-service-overview__grid">

		<div class="erh-service-overview__content erh-entry-content">
			<?php the_content(); ?>
		</div>

		<aside class="erh-service-sidebar">

			<?php if ( $erh_facts ) : ?>
				<div class="erh-service-facts">
					<h2 class="erh-service-facts__title"><?php esc_html_e( 'Quick Facts', 'elite-remodel-hub' ); ?></h2>
					<ul class="erh-service-facts__list">
						<?php foreach ( $erh_facts as $erh_fact ) : ?>
							<?php
							$erh_icon_slug = isset( $erh_fact['icon'] ) && $erh_fact['icon'] ? $erh_fact['icon'] : 'clock';
							$erh_label     = isset( $erh_fact['label'] ) ? $erh_fact['label'] : '';
							$erh_value     = isset( $erh_fact['value'] ) ? $erh_fact['value'] : '';

							if ( ! $erh_label && ! $erh_value ) {
								continue;
							}
							?>
							<li class="erh-service-facts__item">
								<span class="erh-service-facts__icon"><?php erh_icon( $erh_icon_slug, array( 'size' => 18 ) ); ?></span>
								<span>
									<?php if ( $erh_label ) : ?>
										<span class="erh-service-facts__label"><?php echo esc_html( $erh_label ); ?></span>
									<?php endif; ?>
									<?php if ( $erh_value ) : ?>
										<span class="erh-service-facts__value"><?php echo esc_html( $erh_value ); ?></span>
									<?php endif; ?>
								</span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<div class="erh-service-sidebar-cta">
				<h2 class="erh-service-sidebar-cta__title"><?php esc_html_e( 'Ready to Talk?', 'elite-remodel-hub' ); ?></h2>
				<p class="erh-service-sidebar-cta__text"><?php esc_html_e( 'Get a free, no-obligation quote for your project.', 'elite-remodel-hub' ); ?></p>
				<a class="erh-btn erh-btn--navy erh-btn--block" href="<?php echo esc_url( $erh_contact_url ); ?>"><?php esc_html_e( 'Get a Free Quote', 'elite-remodel-hub' ); ?></a>
				<?php if ( $erh_phone ) : ?>
					<a class="erh-service-sidebar-cta__link" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $erh_phone ) ); ?>">
						<?php erh_icon( 'phone', array( 'size' => 16 ) ); ?> <?php echo esc_html( $erh_phone ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $erh_email ) : ?>
					<a class="erh-service-sidebar-cta__link" href="mailto:<?php echo esc_attr( sanitize_email( $erh_email ) ); ?>">
						<?php erh_icon( 'mail', array( 'size' => 16 ) ); ?> <?php echo esc_html( $erh_email ); ?>
					</a>
				<?php endif; ?>
			</div>

		</aside>

	</div>
</section>
