<?php
/**
 * The template for displaying the header
 *
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
$active_slug = $page? $page->post_name: '';

function active( $slug ){
	global $active_slug;
	if( $active_slug==$slug ){
		echo 'active';
	}
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php if (wp_is_mobile()) { ?>mobile <?php } else { ?>desktop <?php } ?><?php if (is_front_page() && ! wp_is_mobile()) { ?>slideout-open<?php } ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel='stylesheet' id=''  href='/wp-content/themes/eeonyx-wp-theme/vendor/jquery.fullPage.css' type='text/css' media='all' />
	<?php wp_head(); ?>
</head>

<body <?php if (is_front_page()) { ?>class='home'<?php } ?>>
<div id="page" class="site">
	<nav id="menu" <?php if (is_front_page() && ! wp_is_mobile()) { ?>class='slideout-menu'<?php } else { ?>class='hidden'<?php } ?>>
	  	<header>

	  		<div class="margin-filler"></div>
	    
	    	<div class="left-menu">

				<div class="menu-items column-1" data-column="1">
					<div>
						<?php
						if (!is_front_page()) { ?>
						<a class="menu-item black" href="/">
							<div>Home</div>
						</a>
						<?php } ?>
						<a class="menu-item <?php active('conductive-products') ?>" href="/conductive-products" data-slug="conductive-products">
							<div>Conductive Products</div>
						</a>
						<a class="menu-item <?php active('eeonyx-in-action') ?>" href="/eeonyx-in-action">
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

				<div class="menu-items column-2" data-column="2" data-slug="conductive-products">
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
							
								<a class="menu-item" href="/product_category/<?=$cat->slug?>" >
									<div>
										View all <?=$cat->name?>
									</div>
								</a>

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

	<div class="content-container">
		<div id="nav-link">
			<div class='nav-toggle'>
				<div class='nav-icon'>
					<span></span><span></span><span></span></div></div>
				<div class='logo small'>
			</div>
		</div>
	</div>