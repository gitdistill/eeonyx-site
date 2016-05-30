<?php
/**
 * The template for displaying all single products
 *
 */

get_header(); 

// Start the loop.
while ( have_posts() ) : the_post();
$primary_category = get_field('primary_category');
$hero_image = get_field( 'hero_image' );
$background_image = get_field( 'background_image' );

?>

<div id="outer" class="application <?= $post->post_name; ?>">
  <div id="main" class="content-container">

    <div class="wipe-hero large">
      <div class="image">
        <div style="background-image:url(<?= $hero_image['url'] ?>)" title="<?= $hero_image['alt'] ?>">
        </div>
      </div>
    </div>

    <!--get outside of the container-->
    </div>
    <!--============================-->

  <div class="background-image">
    <div class="image">
      <img src="<?= $background_image['url'] ?>" alt="<?= $background_image['alt'] ?>">
    </div>
  </div>

    <!--get back inside the container-->
    <div class="content-container">
    <!--============================-->


    <div class="row">
      <div class="col-sm-6">
      
        <div class='application-crumb'>
          <div class="category-icon <?=$primary_category->slug?>"></div>
          <div class='text'>
            <strong>Eeonyx in Action</strong><br />
            <strong><?=$primary_category->name?></strong>
          </div>
          <div class='clear'></div>
        </div>

        <h2 class="dark-black sub-page-header">
          <?php the_title(); ?>
        </h2>
        <div class="summary">
          <div class="heading">
            <?=get_field('summary_heading')?>
          </div>
          <div class="information">

            <?php $summary_list = get_field('summary_list');
            if ( $summary_list ) { ?>
            <div class="summary-list">
              <div class="list-column">
              <?php foreach ($summary_list as $key => $row) { ?>
                <span class="name"><?=$row['property_name']?>:</span>
              <?php } ?>
              </div>
              <div class="list-column">
              <?php foreach ($summary_list as $key => $row) {
                $has_link = $row['has_link'];
                $url = '';
                if ( is_string( $has_link ) ) {
                  if ( $has_link == 'Links to an internal Eeonyx page' ) {
                    $url = $row['property_eeonyx_page_link'];
                  }
                  if ( $has_link == 'Links to another website' ) {
                    $url = $row['property_link'];
                  }
                }
                ?>
                <span class="value">
                  <?php if ( $url ){ ?><a href="<?=$url?>"><?php } ?>
                  <?=$row['property_value']?>
                  <?php if ( $url ){ ?></a><?php } ?>
                </span>
              <?php } ?>
              </div>
              <?php } ?>
            </div>
            <?=the_field('summary_blurb')?>

          </div>
        </div>
      </div>
    </div>

    <div class="description">

        <div class="drop-quote">
        <?=the_field('drop_quote')?>
        <p class="attribution">- <?=the_field('drop_quote_attribution')?></p>
        </div>

        <div class="full-text">
        <?=the_field('description')?>
        </div>

    </div>


  </div><!-- content-container -->
</div><!-- outer -->

<?php 
    // End of the loop.
    endwhile;
?>

<?php get_footer(); ?>
