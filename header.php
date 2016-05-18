<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php if (wp_is_mobile()) { ?>mobile <?php } else { ?>desktop <?php } ?><?php if (is_home() && ! wp_is_mobile()) { ?>slideout-open<?php } ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php if (is_home()) { ?>class='home'<?php } ?>>
<div id="page" class="site">
	<nav id="menu" <?php if (is_home() && ! wp_is_mobile()) { ?>class='slideout-menu'<?php } else { ?>class='hidden'<?php } ?>>
	  	<header>
	    	<div class="left-menu">

				<div class="menu-items column-1">
					<?php
					if (!is_home()) { ?>
					<a class="menu-item black" href="/">
						Home
					</a>
					<?php } ?>
					<a class="menu-item" href="/smart-fabrics" data-slug="has-menu">
						Has<br/>
						Menu
					</a>
					<a class="menu-item" href="/custom-solutions" data-slug="custom-solutions">
						Custom Solutions
					</a>
					<a class="menu-item active" href="/about-eeonyx" data-slug="about-eeonyx">
						About 
						Eeonyx
					</a>
					<a class="menu-item" href="/contact" data-slug="contact">
						Contact
					</a>
				</div>

				<div class="menu-items column-2" data-slug="has-menu">
					<a class="menu-item" href="/smart-fabrics" data-slug="has-menu-2">
						Has<br/>
						Menu
					</a>
					<a class="menu-item" href="/custom-solutions">
						Smart
						Fabrics 2
					</a>
					<a class="menu-item active" href="/about-eeonyx">
						Smart
						Fabrics 2
					</a>
					<a class="menu-item" href="/contact">
						Smart
						Fabrics 2
					</a>
				</div>

				<div class="menu-items column-3" data-slug="has-menu-2">
					<a class="menu-item" href="/smart-fabrics">
						Smart
						Fabrics 3
					</a>
					<a class="menu-item" href="/custom-solutions">
						Smart
						Fabrics 3
					</a>
					<a class="menu-item active" href="/about-eeonyx">
						Smart
						Fabrics 3
					</a>
					<a class="menu-item" href="/contact">
						Smart
						Fabrics 3
					</a>
				</div>

			</div>
	  	</header>
	</nav>
	<?php
	if (!is_home()) { 
		?>
		<div id="nav-link">
			<div class='nav-toggle'><div class='nav-icon'><span></span><span></span><span></span></div></div>
			<div class='logo small'></div>
		</div>
		<?php
	} else {
		?>
		<div id="nav-link" class='hidden-desktop'>
			<div class='nav-toggle'><div class='nav-icon'><span></span><span></span><span></span></div></div>
			<div class='logo small'></div>
		</div>
		<?php
	}; 
	?>
	<div id="outer">
		<main id="panel" <?php if (is_home() && ! wp_is_mobile()) { ?>class="slideout-panel" style="left: 220px;padding-right: 220px;"<?php } ?>>
			<?php if (is_home()) { ?>
				<div class="content">
					<div class="inner">
						<div class="logo big hidden-mobile"></div>
						<h1 class="dark-black">
							SMART FABRICS FOR THE INTERNET OF THINGS
						</h1>
						<h4>
							Look smart. Be smart. Discover electronics you can wash and wear. Conductive textiles by Eeonyx warm you up, sense your environment, and protect you and your devices from unwanted energy.    
						</h4>
					</div>
				</div>
			<?php } ?>

		<!--
			<div class="site-header-main">
				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
				</div>

				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>

					<div id="site-header-menu" class="site-header-menu">
						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu_class'     => 'primary-menu',
									 ) );
								?>
							</nav>
						<?php endif; ?>

						<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'twentysixteen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>',
									) );
								?>
							</nav>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div><
			-->