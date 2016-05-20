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

$page = get_post();
global $active_slug;
$active_slug = $page->post_name;

function active( $slug ){
	global $active_slug;
	if( $active_slug==$slug ){
		echo 'active';
	}
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php if (wp_is_mobile()) { ?>mobile <?php } else { ?>desktop <?php } ?><?php if (is_home() && ! wp_is_mobile()) { ?>slideout-open<?php } ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
						<a class="menu-item <?php active('conductive-fabrics') ?>" href="/conductive-fabrics" data-slug="conductive-fabrics">
							<div>Conductive Fabrics</div>
						</a>
						<a class="menu-item <?php active('eeonyx-in-action') ?>" href="#">
							<div>Eeonyx in Action</div>
						</a>
						<a class="menu-item <?php active('the-tech') ?>" href="#">
							<div>The Tech</div>
						</a>
						<a class="menu-item <?php active('about-eeonyx') ?>" href="/about-eeonyx">
							<div>About Eeonyx</div>
						</a>
						<a class="menu-item <?php active('contact') ?>" href="/contact">
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
