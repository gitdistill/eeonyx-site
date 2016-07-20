<?php /* Template Name: Full Width Flexible */ ?>
<?php
get_header(); 

$is_contact = false;
$sections_post = get_post();

while ( have_posts() ){

the_post();

?>


<div id="outer" class="full-width-flexible <?= $post->post_name; ?>">
  <div id="main" class="content-container">


      <article>

        <h2 class="dark-black sub-page-header text-center">
          <?php the_title(); ?>
        </h2>

        <?php the_content(); ?>

        <?php include('template-parts/flexible-content.php'); ?>


      </article>

  </div><!-- .site-main -->
</div><!-- .content-area -->

<?php
}
get_footer(); ?>

