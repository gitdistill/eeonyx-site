<?php

/**
 *
 * Renders flexible content sections
 *
 */

if( !isset( $sections_post ) ){
  $sections_post = get_the_ID();
}

if( get_field('sections', $sections_post) ){

  // loop through the rows of data
    while ( has_sub_field('sections', $sections_post) ) :

      if( get_row_layout() == 'text' ):
        /**
         *
         * Text section
         *
         */
      ?>

        <div class="flexible-content text row">
          <?php if ( get_sub_field('heading') ) { ?>
          <div class="heading col-xs-12">
            <?php the_sub_field('heading'); ?>
          </div>
          <?php } ?>
          <div class="content col-xs-12">
            <?php the_sub_field('content'); ?>
          </div>
        </div>


<?php
      elseif( get_row_layout() == 'image' ): 
        /**
         *
         * Text section
         *
         */
      ?>

        <div class="flexible-content image row">
          <div class="image-container col-xs-12">
            <?php $image = get_sub_field('image'); if( $image ) { ?>
            <!--<div style="background-image:url(<?= $image['url'] ?>);" title="<?= $image['alt'] ?>" ></div>-->
            <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" >
            <?php } ?>
          </div>
          <div class="caption col-xs-12">
            <?php the_sub_field('caption'); ?>
          </div>
        </div>

<?php
      endif;

    endwhile;

} ?>