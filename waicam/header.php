<?php
/**
 * Header du thème WAI-CAM
 * Navbar : fond bleu nuit, items blancs uppercase, dropdowns sur tous les items
 *
 * @package WAICAM
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Aller au contenu', 'waicam' ); ?></a>

<!-- ========== NAVBAR ========== -->
<nav class="navbar" id="navbar" role="navigation" aria-label="<?php esc_attr_e( 'Navigation principale', 'waicam' ); ?>">

	<!-- Logo -->
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo" aria-label="<?php bloginfo( 'name' ); ?> — <?php esc_attr_e( 'Accueil', 'waicam' ); ?>">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( waicam_img( 'logo-waicam.png' ) ); ?>"
				 alt="<?php bloginfo( 'name' ); ?>"
				 width="auto" height="52" />
		<?php endif; ?>
	</a>

	<!-- Menu principal (desktop) -->
	<div class="nav-links" id="nav-links" role="menubar">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'walker'         => new WAICAM_Nav_Walker(),
				'fallback_cb'    => 'waicam_default_menu',
			) );
		} else {
			waicam_default_menu();
		}
		?>
	</div>

	<!-- CTA Rejoindre + Hamburger (colonne droite) -->
	<div class="nav-right">
		<?php
		$rejoindre = get_page_by_path( 'rejoindre' );
		$href_rejoindre = $rejoindre ? get_permalink( $rejoindre ) : home_url( '/rejoindre' );
		?>
		<a href="<?php echo esc_url( $href_rejoindre ); ?>" class="btn-nav nav-cta">
			<?php esc_html_e( 'Rejoindre', 'waicam' ); ?>
		</a>

		<button class="hamburger"
				id="hamburger"
				aria-label="<?php esc_attr_e( 'Ouvrir le menu', 'waicam' ); ?>"
				aria-expanded="false"
				aria-controls="nav-links">
			<span></span>
			<span></span>
			<span></span>
		</button>
	</div>
</nav>
<!-- /.navbar -->

<div id="content" class="site-content">
