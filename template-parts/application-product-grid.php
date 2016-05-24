<div class='application-product-grid row'>

  <div class='col-sm-12'><div class='row'>
  <?php
  $count = 0;
  while ( $query->have_posts() ){
    $query->the_post();
    $primary_category = get_field('primary_category');
    $image = get_field('grid_image');
    if( $count > 0 && $count%2 == 0 ) { ?>
  </div></div>

  <div class='col-sm-12'>
    <div class='row'>
  <?php } ?>

      <div class='item col-sm-6'>

        <div class='image-wrapper'>
          <a href="<?= get_permalink(); ?>">
            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
          </a>
        </div>

        <div class='item-text'>
          <div class="category-icon <?= $primary_category->slug ?>" >
          </div>
          <h3>
            <a href="<?= get_permalink(); ?>" class='item-link'>
              <?= get_the_title(); ?>
            </a>
          </h3>
        </div>

      </div>
  <?php $count++;
  } ?><!-- end while -->
    </div>
  </div>

</div>