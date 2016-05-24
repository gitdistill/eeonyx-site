<?php
/**
 * The template for displaying the eeonyx in action page
 */

get_header(); ?>

<div id="outer">
	<main id="main" class="<?= $post->post_name; ?>">
		
		<?php
		// Start the loop.
		while ( have_posts() ){
		the_post();
		?>

		<div class='top-gray-wrapper'>
			<div class="inner">
				<h2 class='dark-black text-center grid-header bottom-margin-half'>Eeonyx In Action</h2>
				<h4 class='grid-subtitle'>
					<?=get_the_content()?>
				</h4>
			</div>
		</div>

		<?php
		$args = array(
		    'post_type' => 'application'
		);
		$query = new WP_Query( $args );
		if ($query->have_posts()) { 

			include get_template_directory() . '/template-parts/application-product-grid.php';

		 } ?>

<?php } ?><!-- end post loop -->

	</main>
</div><!-- end outer -->

<?php get_footer(); ?>

