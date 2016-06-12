<?php
/**
 * The template for displaying the header
 *
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */



?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js <?php if (wp_is_mobile()) { ?>mobile <?php } else { ?>desktop <?php } ?><?php if (is_front_page() && ! wp_is_mobile()) { ?>slideout-open<?php } ?>">
<head>
<!-- 	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
 -->	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel='stylesheet' id=''  href='/wp-content/themes/eeonyx-wp-theme/vendor/jquery.fullPage.css' type='text/css' media='all' />
<!-- 	<link rel='stylesheet' id=''  href='/wp-content/themes/eeonyx-wp-theme/fonts/icomoon/style.css' type='text/css' media='all' />
 -->	<?php wp_head(); ?>
</head>

<body <?php if (is_front_page()) { ?>class='home'<?php } ?>>

<div id="page" class="site">


