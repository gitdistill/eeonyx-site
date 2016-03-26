<?php
/**
 * The template for displaying 404 pages (not found)
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

<div class="content">
	<div class="inner pad2x">
			<br /><br />
			<section class="error-404 not-found" style='min-height: 1000px;'>
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

	</div><!-- .content-area -->
</div>
<?php get_footer(); ?>
