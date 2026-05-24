<?php
/**
 * Footer du thème WAI-CAM
 *
 * @package WAICAM
 */
?>

</div><!-- /#content -->

<!-- ========== FOOTER ========== -->
<footer>
	<div class="footer-grid" style="max-width:1200px;margin:0 auto;">
		<div class="footer-brand">
			<div class="nav-logo">
				<img src="<?php echo esc_url( waicam_img( 'logo-waicam.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height:52px;width:auto;filter:brightness(0) invert(1);" />
			</div>
			<p><?php echo esc_html( get_theme_mod( 'waicam_footer_about', __( "Un mouvement citoyen pour que chaque femme comprenne, décide et innove grâce à l'intelligence artificielle.", 'waicam' ) ) ); ?></p>
			<div class="footer-socials">
				<?php
				$socials = array(
					'facebook'  => array( 'url' => get_theme_mod( 'waicam_social_facebook', '#' ),  'label' => 'Facebook',  'img' => 'logo-facebook.webp' ),
					'twitter'   => array( 'url' => get_theme_mod( 'waicam_social_twitter', '#' ),   'label' => 'Twitter/X', 'img' => 'logo-twitter.webp'  ),
					'linkedin'  => array( 'url' => get_theme_mod( 'waicam_social_linkedin', '#' ),  'label' => 'LinkedIn',  'img' => 'logo-linkedin.webp' ),
					'instagram' => array( 'url' => get_theme_mod( 'waicam_social_instagram', '#' ), 'label' => 'Instagram', 'img' => ''                   ),
					'email'     => array( 'url' => 'mailto:' . get_theme_mod( 'waicam_email', 'womeninaicameroon@gmail.com' ), 'label' => 'Email', 'img' => '' ),
				);
				foreach ( $socials as $key => $s ) :
					if ( $s['img'] ) :
				?>
					<a href="<?php echo esc_url( $s['url'] ); ?>" class="social-btn" title="<?php echo esc_attr( $s['label'] ); ?>">
						<img src="<?php echo esc_url( waicam_img( $s['img'] ) ); ?>" alt="<?php echo esc_attr( $s['label'] ); ?>" width="18" height="18" />
					</a>
				<?php
					else :
						// Instagram et Email : icône Font Awesome
						$icon = $key === 'instagram' ? '<i class="fa-brands fa-instagram"></i>' : '<i class="fa-solid fa-envelope"></i>';
				?>
					<a href="<?php echo esc_url( $s['url'] ); ?>" class="social-btn" title="<?php echo esc_attr( $s['label'] ); ?>"><?php echo wp_kses_post( $icon ); ?></a>
				<?php
					endif;
				endforeach;
				?>
			</div>
		</div>

		<div>
			<h4><?php esc_html_e( 'Navigation', 'waicam' ); ?></h4>
			<?php
			if ( has_nav_menu( 'footer-1' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer-1',
					'container'      => false,
				) );
			} else {
				?>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'waicam' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'À propos', 'waicam' ); ?></a></li>
					<li><a href="<?php echo esc_url( waicam_events_archive_url() ); ?>"><?php esc_html_e( 'Évènements', 'waicam' ); ?></a></li>
					<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ) ); ?>"><?php esc_html_e( 'Blog', 'waicam' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</div>

		<div>
			<h4><?php esc_html_e( 'Programmes', 'waicam' ); ?></h4>
			<?php
			if ( has_nav_menu( 'footer-2' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer-2',
					'container'      => false,
				) );
			} else {
				$programmes_url = home_url( '/programmes' );
				?>
				<ul>
					<li><a href="<?php echo esc_url( $programmes_url . '#youth' ); ?>">Youth &amp; AI</a></li>
					<li><a href="<?php echo esc_url( $programmes_url . '#public' ); ?>">IA &amp; Service Public</a></li>
					<li><a href="<?php echo esc_url( $programmes_url . '#leaders' ); ?>">Women Leaders for AI</a></li>
					<li><a href="<?php echo esc_url( $programmes_url . '#communities' ); ?>">AI for Communities</a></li>
				</ul>
				<?php
			}
			?>
		</div>

		<div>
			<h4><?php esc_html_e( 'Contact', 'waicam' ); ?></h4>
			<?php
			if ( has_nav_menu( 'footer-3' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer-3',
					'container'      => false,
				) );
			} else {
				$email = get_theme_mod( 'waicam_email', 'womeninaicameroon@gmail.com' );
				$phone = get_theme_mod( 'waicam_phone', '+237682573699' );
				?>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/partenaires' ) ); ?>"><?php esc_html_e( 'Partenariats', 'waicam' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'waicam' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/faire-un-don' ) ); ?>"><?php esc_html_e( 'Faire un don', 'waicam' ); ?></a></li>
					<li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</div>
	</div>

	<div class="footer-bottom" style="max-width:1200px;margin:0 auto;">
		<span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Tous droits réservés.', 'waicam' ); ?></span>
		<span><?php echo esc_html( get_theme_mod( 'waicam_address', '919 Boulevard de Rey-Bouba, Mballa2, Yaoundé' ) ); ?></span>
		<span><?php esc_html_e( 'Fait avec', 'waicam' ); ?> <i class="fa-solid fa-heart" style="color:#ef4444"></i> <?php esc_html_e( "pour l'autonomisation des femmes", 'waicam' ); ?></span>
	</div>
</footer>

<button class="back-top" title="<?php esc_attr_e( 'Retour en haut', 'waicam' ); ?>" aria-label="<?php esc_attr_e( 'Retour en haut', 'waicam' ); ?>">↑</button>
<div class="toast" aria-live="polite"></div>

<?php wp_footer(); ?>
</body>
</html>
