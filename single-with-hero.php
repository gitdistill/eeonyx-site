<?php /* Template Name: Page With Hero */ ?>
<?php
/**
 * The template for displaying product categories
 *
 */

get_header(); 

$is_contact = false;
$pos = strpos(get_permalink(), 'contact');
if ($pos !== false) { $is_contact = true; }
$hero_image = get_field( 'hero_image' );
$sections_post = get_post();


?>


<div id="outer" class="page-with-hero <?= $post->post_name; ?>">
	<div id="main" class="content-container">
		<article>

	    <div class="wipe-hero medium">
	      <div class="image">
	        <div style="background-image:url(<?= $hero_image['url'] ?>)" title="<?= $hero_image['alt'] ?>">
	        </div>
	      </div>
	    </div>

	    <h2 class="dark-black sub-page-header text-center">
	      <?php the_title(); ?>
	    </h2>

	    <?php the_content(); ?>

	    <?php
	    	if ( get_field( 'sections' ) ){
	    		include('template-parts/flexible-content.php');
				} ?><!-- end if -->

    </article>
  </div><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>

