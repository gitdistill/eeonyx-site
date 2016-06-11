<?php /* Template Name: Page With Hero */ ?>
<?php
get_header(); 

$is_contact = false;
$hero_image = get_field( 'hero_image' );
$sections_post = get_post();

while ( have_posts() ){

the_post();

?>


<div id="outer" class="page-with-hero <?= $post->post_name; ?>">
  <div id="main" class="content-container">

      <div class="wipe-hero medium">
        <div class="image">
          <div style="background-image:url(<?= $hero_image['url'] ?>)" title="<?= $hero_image['alt'] ?>">
          </div>
        </div>
      </div>

      <article>

        <h2 class="dark-black sub-page-header text-center">
          <?php the_title(); ?>
        </h2>

        <?php the_content(); ?>

        <?php include('template-parts/flexible-content.php'); ?>

        <?php include('template-parts/paragraph-with-image.php'); ?>

      </article>

  </div><!-- .site-main -->
</div><!-- .content-area -->

<?php
}
get_footer(); ?>

