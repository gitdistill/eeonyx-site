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


$taxonomies = get_object_taxonomies('product');
$product_taxonomy = $taxonomies[0];
$product_catgories = get_terms( $product_taxonomy, array(
    'hide_empty' => false,
) );

// if(count($customPostTaxonomies) > 0)
// {
//      foreach($customPostTaxonomies as $tax)
//      {
// 	     $args = array(
//          	  'orderby' => 'name',
// 	          'show_count' => 0,
//         	  'pad_counts' => 0,
// 	          'hierarchical' => 1,
//         	  'taxonomy' => $tax,
//         	  'title_li' => ''
//         	);

// 	     wp_list_categories( $args );
//      }
// }

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

				<div class="menu-items column-1" data-column="1">
					<div>
						<?php
						if (!is_home()) { ?>
						<a class="menu-item black" href="/">
							<div>Home</div>
						</a>
						<?php } ?>
						<a class="menu-item" href="/conductive-fabrics" data-slug="conductive-fabrics">
							<div>Conductive Fabrics</div>
						</a>
						<a class="menu-item" href="#">
							<div>Eeonyx in Action</div>
						</a>
						<a class="menu-item" href="#">
							<div>The Tech</div>
						</a>
						<a class="menu-item active" href="/about-eeonyx">
							<div>About Eeonyx</div>
						</a>
						<a class="menu-item" href="/contact">
							<div>Contact</div>
						</a>
					</div>
				</div>

				<div class="menu-items column-2" data-column="2" data-slug="conductive-fabrics">
					<div>

						<?php foreach ($product_catgories as $index => $cat) { ?>
						<a class="menu-item has-icon" href="#" data-slug="<?=$cat->slug?>">
							<div><?=$cat->name?></div>
						</a>

						<?php } ?>
					</div>
				</div>

				<?php foreach ($product_catgories as $index => $cat) { 

					$args = array(
					  'post_type' => 'product',
					  'numberposts' => -1,
					  'tax_query' => array(
					    array(
					      'taxonomy' => $product_taxonomy,
					      'field' => 'name',
					      'terms' => $cat->name // Where term_id of Term 1 is "1".
					    )
					  )
					);

					$products = get_posts( $args );
					
					if( count( $products ) > 0 ) { ?>

						<div class="menu-items column-3"  data-column="3" data-slug="<?=$cat->slug?>">
							<div>
							
							<?php

						foreach ($products as $index => $product) {
							$type = get_field( 'type_shown_in_nav', $product->ID );
							$type = $type=='' ? get_field( 'type', $product->ID ) : $type;
							?>

							<a class="menu-item" href="<?= get_permalink( $product->ID ) ?>" >
								<div>
									<?= get_field( 'name', $product->ID ); ?><br/>
									<span class="type"><?=$type?></span>
								</div>
							</a>

						<?php } ?>

						</div>
					</div>

					<?php } ?>
				<?php } ?>

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