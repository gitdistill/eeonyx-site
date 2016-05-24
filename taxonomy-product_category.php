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

?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="content">
      <div class="inner">

      <div class="wipe-hero">
        <div class="image"><img src="<?= $hero_image['url'] ?>"></div>
      </div>

        <h2 class="dark-black sub-page-header text-center">
          <?php echo $term->name; ?>
        </h2>


        <?php if ($query->have_posts()) { ?>

          <div class='product-category-grid row'>

            <div class='col-sm-12'><div class='row'>

          <?php
          $count = 0;
          while ( $query->have_posts() ){
            $query->the_post();
            if( $count > 0 && $count%2 == 0 ) { ?>
            </div></div>

            <div class='col-sm-12 hidden-sm hidden-xs'><div class='row'>
              <div class='lower-line col-md-6'></div>
              <div class='lower-line col-md-6'></div>
            </div></div>

            <div class='col-sm-12'><div class='row'>
            <?php } ?>

              <div class='product-grid-item col-md-6'><div class='product-grid-item-inner row'>
                <div class='product-image col-sm-5'>
                  <a href="<?= get_permalink(); ?>">
                    <img src='<?php $images = get_field('images'); echo $images[0]['image']['url']; ?>' />
                  </a>
                </div>
                <div class='product-text col-sm-7'>
                  <a href="<?= get_permalink(); ?>">
                    <div class='product-title'>
                      <?= get_field('name'); ?>
                    </div>
                    <div class='product-sub-title'>
                      <?= get_field('type'); ?>
                    </div>
                  </a>
                  <div class='product-description'>
                    <?= wp_trim_words( get_field('short_description'), $num_words = 10, $more = '... <a href="'.get_permalink().'">more</a>' ); ?>
                  </div>
                </div>
              </div></div>
              <div class='lower-line col-md-6 hidden-md hidden-lg'></div>

          <?php
          $count++;
          } ?><!-- end while -->
          </div></div>

          <div class='col-sm-12 hidden-sm hidden-xs'><div class='row'>
            <div class='lower-line col-md-6'></div>
            <?php if ( $count%2 == 0 ) { ?>
            <div class='lower-line col-md-6'></div>
            <?php } ?>
          </div></div>

        </div>

        <?php } ?><!-- end if -->


        <div class='text-center'>
        <h6 class="text-center black section-title sub-page-subtitle line thick uppercase">About <?php echo $term->name; ?></h6>
        </div>

        <div class="about-category">
        <?= the_field( 'about', $term ); ?>
        </div>

        <div class='text-center'>
        <h6 class="black section-title sub-page-subtitle line thick uppercase">Some of our smart fabrics in action</h6>
        </div>

    <?php
    $args = array(
        'post_type' => 'application',
        'product_category' => $term->slug
    );
    $query = new WP_Query( $args );
    if ($query->have_posts()) { 

      include get_template_directory() . '/template-parts/application-product-grid.php';

    } ?><!-- end if -->

      </div>
    </div>

  </main><!-- .site-main -->

  <?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
