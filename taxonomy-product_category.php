<?php
/**
 * The template for displaying product categories
 *
 */

get_header(); 

// get the currently queried taxonomy term, for use later in the template file
$term = get_queried_object();
$args = array(
    'post_type' => 'product',
    'product_category' => $term->slug
);
$query = new WP_Query( $args );
$hero_image = get_field( 'hero_image', $term );
$sections_post = $term;


?>


<div id="outer" class="product-category <?= $post->post_name; ?>">
  <div class="content-container">

    <div class="wipe-hero">
      <div class="image">
        <div style="background-image:url(<?= $hero_image['url'] ?>)" title="<?= $hero_image['alt'] ?>">
        </div>
      </div>
    </div>

    <h2 class="dark-black sub-page-header text-center">
      <?php echo $term->name; ?>
    </h2>


    <?php if ($query->have_posts()) { ?>

      <div class='product-category-grid row'>
        <div class='col-sm-12'>
          <div class='row'>

      <?php
      $count = 0;
      $slugs = [];
      while ( $query->have_posts() ){
        $query->the_post();
        $images = get_field('images');
        $slugs[$count] = $post->post_name;
        if( $count > 0 && $count%2 == 0 ) { //close and re-open for next row?>

          </div>
        </div>

        <div class='col-sm-12 hidden-sm hidden-xs'>
          <div class='row'>
            <div class='lower-line col-md-6' data-product-grid-slug="<?=$slugs[$count-2]?>"></div>
            <div class='lower-line col-md-6' data-product-grid-slug="<?=$slugs[$count-1]?>"></div>
          </div>
        </div>

        <div class='col-sm-12'>
          <div class='row'>

        <?php } //continue adding products?>

            <div class='product-grid-item col-md-6'
                 data-href="<?= get_permalink(); ?>"
                 data-product-grid-slug="<?=$slugs[$count]?>">

                <div class='product-grid-item-inner row'>

                  <div class='product-image col-sm-5'>
                      <img src="<?= $images[0]['image']['url']; ?>" alt="<?= $images[0]['image']['alt']; ?>">
                  </div>

                  <div class='product-text col-sm-7'>
                      <div class='product-title'>
                        <?= get_field('name'); ?>
                      </div>
                      <div class='product-sub-title'>
                        <?= get_field('type'); ?>
                      </div>
                    <div class='product-description'>
                      <?php $description = get_field('short_description')? get_field('short_description'): get_field('description'); ?>
                      <?= wp_trim_words( $description, $num_words = 10, $more = '... <a href="'.get_permalink().'">more</a>' ); ?>
                    </div>
                  </div>

                </div>

            </div><!-- end product grid item -->

            <div class='lower-line col-md-6 hidden-md hidden-lg' data-product-grid-slug="<?=$slugs[$count]?>"></div>

      <?php
      $count++;
      } ?><!-- end while -->

          </div>
        </div>

        <div class='col-sm-12 hidden-sm hidden-xs'>
          <div class='row'>
            <?php if ( $count%2 == 0 ) { ?>
            <div class='lower-line col-md-6' data-product-grid-slug="<?=$slugs[$count-2]?>"></div>
            <?php } ?>
            <div class='lower-line col-md-6' data-product-grid-slug="<?=$slugs[$count-1]?>"></div>
          </div>
        </div>

      </div>

    <?php } ?><!-- end if -->


    <?php wp_reset_query();

    if ( get_field('sections', $term ) ){
    ?>
    <div class='text-center'>
      <h6 class="text-center black section-title sub-page-subtitle line thick uppercase">About <?php echo $term->name; ?></h6>
    </div>


    <?php include('template-parts/flexible-content.php'); ?>

    <br/>
    <?php } ?><!-- end if -->

    <?php
    $args = array(
        'post_type' => 'application',
        'product_category' => $term->slug
    );
    $query = new WP_Query( $args );
    if ($query->have_posts()) { ?>

    <div class='text-center'>
      <h6 class="black section-title sub-page-subtitle line thick uppercase">Some of our <?php echo $term->name; ?> in action</h6>
    </div>

    <?php  include get_template_directory() . '/template-parts/application-product-grid.php';

    } ?><!-- end if -->

  </div><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
