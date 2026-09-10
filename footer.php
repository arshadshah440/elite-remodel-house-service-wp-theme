<?php
/**
 * The site footer.
 *
 * Every string, image, link and toggle below is editable in the admin under
 * Theme Settings → Footer (Secure Custom Fields options page).
 *
 * @package Elite_Remodel_Hub
 */

defined( 'ABSPATH' ) || exit;

$erh_footer_logo   = erh_footer_logo_src();
$erh_footer_height = absint( erh_option( 'footer_logo_height' ) );
$erh_footer_height = $erh_footer_height ? $erh_footer_height : 40;

$erh_socials = erh_rows( 'footer_socials' );

$erh_links_source = erh_option( 'footer_links_source' );
$erh_links        = erh_option( 'footer_links', array() );
$erh_links        = is_array( $erh_links ) ? $erh_links : array();

// The theme's built-in default for "manual" links is same-page anchors
// (#services, #about, ...) that only resolve on the home page itself. When
// the admin hasn't entered real links, build the fallback from actual
// published page URLs instead, so the footer works correctly no matter
// which page it's shown on. Passing array() above (instead of using
// erh_rows(), which falls back to that same built-in default) is what lets
// us detect "nothing configured" here and take over with real URLs.
if ( ! $erh_links ) {
	$erh_footer_blog_id  = (int) get_option( 'page_for_posts' );
	$erh_footer_blog_url = $erh_footer_blog_id ? get_permalink( $erh_footer_blog_id ) : '';

	$erh_links = array_values(
		array_filter(
			array(
				erh_service_listing_url() ? array( 'link' => array( 'url' => erh_service_listing_url(), 'title' => __( 'Our Service', 'elite-remodel-hub' ), 'target' => '' ) ) : null,
				erh_about_page_url() ? array( 'link' => array( 'url' => erh_about_page_url(), 'title' => __( 'About Us', 'elite-remodel-hub' ), 'target' => '' ) ) : null,
				$erh_footer_blog_url ? array( 'link' => array( 'url' => $erh_footer_blog_url, 'title' => __( 'Our Blog', 'elite-remodel-hub' ), 'target' => '' ) ) : null,
				array( 'link' => array( 'url' => home_url( '/#testimonials' ), 'title' => __( 'Testimonial', 'elite-remodel-hub' ), 'target' => '' ) ),
			)
		)
	);
}

$erh_phone   = erh_option( 'footer_show_phone' ) ? erh_option( 'brand_phone' ) : '';
$erh_email   = erh_option( 'footer_show_email' ) ? erh_option( 'brand_email' ) : '';
$erh_address = erh_option( 'footer_show_address' ) ? erh_option( 'brand_address' ) : '';
$erh_map_url = erh_option( 'brand_map_url' );

$erh_legal = erh_rows( 'footer_legal_links' );
?>

	</div><!-- #erh-content -->

	<?php // ------------------------------------------------------------- Footer ?>
	<footer id="colophon" class="erh-footer">

		<div class="erh-container erh-footer__top">

			<?php // ------------------------------------------------- Brand column ?>
			<div class="erh-footer__brand">
				<a class="erh-footer__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php if ( $erh_footer_logo['url'] ) : ?>
						<img
							class="erh-footer__logo"
							src="<?php echo esc_url( $erh_footer_logo['url'] ); ?>"
							alt="<?php echo esc_attr( $erh_footer_logo['alt'] ? $erh_footer_logo['alt'] : get_bloginfo( 'name' ) ); ?>"
							style="height:<?php echo esc_attr( $erh_footer_height ); ?>px"
							loading="lazy"
							decoding="async"
						>
					<?php else : ?>
						<span class="erh-footer__logo--fallback"><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
				</a>

				<?php $erh_about = erh_option( 'footer_about' ); ?>
				<?php if ( $erh_about ) : ?>
					<p class="erh-footer__about"><?php echo nl2br( esc_html( $erh_about ) ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?></p>
				<?php endif; ?>

				<?php if ( $erh_socials ) : ?>
					<ul class="erh-socials">
						<?php foreach ( $erh_socials as $erh_social ) : ?>
							<?php
							$erh_social_url = isset( $erh_social['social_url'] ) ? $erh_social['social_url'] : '';

							if ( ! $erh_social_url ) {
								continue;
							}

							$erh_social_icon = isset( $erh_social['social_icon'] ) ? $erh_social['social_icon'] : 'auto';

							if ( ! $erh_social_icon || 'auto' === $erh_social_icon ) {
								$erh_social_icon = erh_icon_from_url( $erh_social_url );
							}

							$erh_social_label = isset( $erh_social['social_label'] ) && $erh_social['social_label']
								? $erh_social['social_label']
								: ucfirst( str_replace( '-', ' ', $erh_social_icon ) );
							?>
							<li>
								<a href="<?php echo esc_url( $erh_social_url ); ?>" target="_blank" rel="noopener noreferrer">
									<?php erh_icon( $erh_social_icon, array( 'size' => 16 ) ); ?>
									<span class="screen-reader-text"><?php echo esc_html( $erh_social_label ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<?php // --------------------------------------------- Quick links ?>
			<div class="erh-footer__col erh-footer__col--links">
				<?php $erh_links_title = erh_option( 'footer_links_title' ); ?>
				<?php if ( $erh_links_title ) : ?>
					<h2 class="erh-footer__heading"><?php echo esc_html( $erh_links_title ); ?></h2>
				<?php endif; ?>

				<?php if ( 'menu' === $erh_links_source && has_nav_menu( 'footer_links' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_links',
							'container'      => false,
							'menu_class'     => 'erh-footer__menu',
							'depth'          => 1,
						)
					);
					?>
				<?php elseif ( $erh_links ) : ?>
					<ul class="erh-footer__menu">
						<?php foreach ( $erh_links as $erh_row ) : ?>
							<?php $erh_item = erh_link( isset( $erh_row['link'] ) ? $erh_row['link'] : null ); ?>
							<?php if ( ! $erh_item ) { continue; } ?>
							<li>
								<a<?php echo erh_link_attrs( $erh_item ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
									<?php echo esc_html( $erh_item['title'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

			<?php // --------------------------------------------- Contact ?>
			<?php if ( $erh_phone || $erh_email || $erh_address ) : ?>
				<div class="erh-footer__col erh-footer__col--contact">
					<?php $erh_contact_title = erh_option( 'footer_contact_title' ); ?>
					<?php if ( $erh_contact_title ) : ?>
						<h2 class="erh-footer__heading"><?php echo esc_html( $erh_contact_title ); ?></h2>
					<?php endif; ?>

					<div class="erh-footer__contact">

						<?php if ( $erh_email ) : ?>
							<p class="erh-footer__contact-item">
								<span class="erh-footer__contact-icon"><?php erh_icon( 'mail', array( 'size' => 16 ) ); ?></span>
								<a href="mailto:<?php echo esc_attr( sanitize_email( $erh_email ) ); ?>">
									<?php echo esc_html( $erh_email ); ?>
								</a>
							</p>
						<?php endif; ?>

						<?php if ( $erh_phone ) : ?>
							<p class="erh-footer__contact-item">
								<span class="erh-footer__contact-icon"><?php erh_icon( 'phone', array( 'size' => 16 ) ); ?></span>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $erh_phone ) ); ?>">
									<?php echo esc_html( $erh_phone ); ?>
								</a>
							</p>
						<?php endif; ?>

						<?php if ( $erh_address ) : ?>
							<p class="erh-footer__contact-item">
								<span class="erh-footer__contact-icon"><?php erh_icon( 'map-pin', array( 'size' => 16 ) ); ?></span>
								<?php if ( $erh_map_url ) : ?>
									<a href="<?php echo esc_url( $erh_map_url ); ?>" target="_blank" rel="noopener noreferrer">
										<?php echo nl2br( esc_html( $erh_address ) ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?>
									</a>
								<?php else : ?>
									<span><?php echo nl2br( esc_html( $erh_address ) ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped above. ?></span>
								<?php endif; ?>
							</p>
						<?php endif; ?>

					</div>
				</div>
			<?php endif; ?>

			<?php // --------------------------------------------- Newsletter ?>
			<div class="erh-footer__col erh-footer__col--newsletter">
				<?php $erh_newsletter_title = erh_option( 'footer_newsletter_title' ); ?>
				<?php if ( $erh_newsletter_title ) : ?>
					<h2 class="erh-footer__heading"><?php echo esc_html( $erh_newsletter_title ); ?></h2>
				<?php endif; ?>

				<form
					class="erh-newsletter"
					action="<?php echo esc_url( erh_option( 'footer_newsletter_action' ) ? erh_option( 'footer_newsletter_action' ) : home_url( '/' ) ); ?>"
					method="post"
					<?php echo erh_option( 'footer_newsletter_action' ) ? 'target="_blank"' : ''; ?>
				>
					<label class="screen-reader-text" for="erh-newsletter-email">
						<?php esc_html_e( 'Email address', 'elite-remodel-hub' ); ?>
					</label>
					<div class="erh-newsletter__field">
						<input
							id="erh-newsletter-email"
							type="email"
							name="EMAIL"
							required
							placeholder="<?php echo esc_attr( erh_option( 'footer_newsletter_placeholder' ) ); ?>"
						>
						<?php $erh_newsletter_button = erh_option( 'footer_newsletter_button' ); ?>
						<button class="erh-newsletter__submit" type="submit">
							<?php echo esc_html( $erh_newsletter_button ? $erh_newsletter_button : __( 'Subscribe', 'elite-remodel-hub' ) ); ?>
						</button>
					</div>
				</form>
			</div>

		</div><!-- .erh-footer__top -->

		<?php // ------------------------------------------------- Bottom bar ?>
		<div class="erh-footer__bottom">
			<div class="erh-container erh-footer__bottom-inner">
				<p class="erh-footer__copyright"><?php echo esc_html( erh_copyright_text() ); ?></p>

				<?php if ( has_nav_menu( 'footer_legal' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_legal',
							'container'      => false,
							'menu_class'     => 'erh-footer__legal',
							'depth'          => 1,
						)
					);
					?>
				<?php elseif ( $erh_legal ) : ?>
					<ul class="erh-footer__legal">
						<?php foreach ( $erh_legal as $erh_row ) : ?>
							<?php $erh_item = erh_link( isset( $erh_row['link'] ) ? $erh_row['link'] : null ); ?>
							<?php if ( ! $erh_item ) { continue; } ?>
							<li>
								<a<?php echo erh_link_attrs( $erh_item ); // phpcs:ignore WordPress.Security.EscapingOutput.OutputNotEscaped -- escaped in erh_link_attrs(). ?>>
									<?php echo esc_html( $erh_item['title'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
