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
          <div class="heading col-sm-12">
            <?php the_sub_field('heading'); ?>
          </div>
          <?php } ?>
          <div class="content col-sm-12">
            <?php the_sub_field('content'); ?>
          </div>
        </div>

<?php
      elseif( get_row_layout() == 'image' ): 
        /**
         *
         * Image section
         *
         */
      ?>

        <div class="flexible-content image row">
          <div class="image-container col-sm-12">
            <?php $image = get_sub_field('image'); if( $image ) { ?>
            <!--<div style="background-image:url(<?= $image['url'] ?>);" title="<?= $image['alt'] ?>" ></div>-->
            <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" >
            <?php } ?>
          </div>
          <?php if ( get_sub_field('caption') ) { ?>
          <div class="caption col-sm-12">
            <?php the_sub_field('caption'); ?>
          </div>
          <?php } ?>
        </div>


<?php
      elseif( get_row_layout() == 'bullet_list' ): 
        /**
         *
         * Bullet List section
         *
         */
        $items = get_sub_field('items');
      ?>
        <div class="flexible-content bullet-list row">
          <?php if ( get_sub_field('heading') ) { ?>
          <div class="heading col-sm-12">
            <?php the_sub_field('heading'); ?>
          </div>
          <?php } ?>
          <div class="content col-sm-12">
            <ul class='bottom-margin-1x'>
              <?php foreach( $items as $item ){ ?>
              <li><?= $item['item'] ?></li>
              <?php } ?>
            </ul>
          </div>
        </div>

<?php
      elseif( get_row_layout() == 'table' ): 
        /**
         *
         * Table section
         *
         */
      ?>
        <div class='flexible-content specs table row'>

          <?php if ( get_sub_field('heading') ) { ?>
          <div class="heading col-sm-12">
            <?php the_sub_field('heading'); ?>
          </div>
          <?php } ?>

          <div class='content col-sm-12'>
            <div class='specs-table'>
              <div class='specs-table-inner'>
                <div class='table-header'>
                  <div class='header-row table-row'>
                    <div class='first-column header-column column'>
                      <?=get_sub_field('column_1_heading')?>
                    </div>
                    <div class='second-column header-column column'>
                      <?=get_sub_field('column_2_heading')?>
                    </div>
                    <?php if ( get_sub_field('columns') > 2 ){ ?>
                    <div class='third-column header-column column'>
                      <?=get_sub_field('column_3_heading')?>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class='table-body'>

                  <?php foreach( get_sub_field('rows') as $row ){ ?>

                    <div class='table-row body-row'>
                      <div class='first-column body-column column'>
                        <?= $row['cell_1'] ?>
                      </div>
                      <div class='second-column body-column column'>
                        <?= $row['cell_2'] ?>
                      </div>
                      <?php if ( get_sub_field('columns') > 2 ){ ?>
                      <div class='third-column body-column column'>
                        <?= $row['cell_3'] ?>
                      </div>
                      <?php } ?>
                    </div>

                  <?php } ?>

                </div>
              </div>
            </div>
            <div class="scroll-message hidden visible-xs-block">
              Scroll right to see full table...
            </div>
          </div>
        </div><!-- end specs row -->
<?php
      endif;

    endwhile;

} ?>