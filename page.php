<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="nav-link">
	<div class='nav-toggle'><div class='nav-icon'><span></span><span></span><span></span></div></div>
	<div class='logo small'></div>
</div>
<?php
$show_topbar = false;
$is_smart_fabrics = false;
$pos = strpos(get_permalink(), 'smart-fabrics');
if ($pos !== false) { $is_smart_fabrics = true; }

if ($is_smart_fabrics) {
	?>
	<div id='top-bar'></div>
	<?php
}
?>
<div class="content">
	<div class="inner pad2x">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
