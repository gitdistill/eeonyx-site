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


?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="content">
      <div class="inner">

        <h2 class="dark-black sub-page-header bottom-margin-half text-center">
          <?php echo $term->name; ?>
        </h2>


        <?php if ($query->have_posts()) { ?>

          <div class='product-category-grid'>

          <?php while ( $query->have_posts() ){ $query->the_post(); ?>

          <div class='product-grid-item'><div class='product-grid-item-inner'>
            <div class='product-image'>
              <img src='<?php $images = get_field('images'); echo $images[0]['image']['url']; ?>' />
            </div>
            <div class='product-text'>
              <a href="'.get_permalink().'">
                <div class='product-title'>
                  <?= get_field('name'); ?>
                </div>
                <div class='product-sub-title'>
                  <?= get_field('type'); ?>
                </div>
              </a>
              <div class='product-description'>
                <?= wp_trim_words( get_field('description'), $num_words = 20, $more = '... <a href="'.get_permalink().'">more</a>' ); ?>
              </div>
            </div>
          </div></div>

          <?php } ?><!-- end while -->

        </div>

        <?php } ?><!-- end if -->


        <div class='text-center' style='margin-bottom: -30px; margin-top: 70px;'>
        <h6 class="text-center black section-title sub-page-subtitle line thick uppercase">About our smart fabrics</h6>
        </div>

        <h4 class="bottom-margin-1x">Eeonyx’s smart fabrics are fashionable enough for touchscreen compatible dress gloves yet rugged and reliable enough for mission critical environments, including hospitals and warfighting platforms. Eeonyx can tune the conductivity of its textiles to deliver different electromagnetic and electroactive functions including:</h4>

        <ul>
        <li>Piezo-resistive sensors for measuring and mapping pressure, bend and stretch</li>
        <li>EMI absorbers for protecting electronics and lowering radar cross section</li>
        <li>Capacitive fabrics for touchscreen compatible apparel</li>
        <li>Resistive fabrics for radiant heating</li>
        <li>Conductive textiles for filters</li>
        <li>Anti-static fibers for needle punch carpets</li>
        </ul>

        <h4 class="bottom-margin-1x">Eeonyx’s products are free of odors and VOCs. Coatings are made with organic polymers. They are recyclable and RoHS compliant. The coating process does not require post-process onsite waste treatment.</h4>

        <div class='text-center' style='margin-bottom: -65px; margin-top: 50px;'>
        <h6 class="black section-title sub-page-subtitle line thick uppercase">Some of our smart fabrics in action</h6>
        </div>

        <div class='product-grid'>
          <div class='item'><div class='item-inner'>
            <div class='image-wrapper'>
              <img src='./images/product-grid-image-1.png' />
            </div>
            <div class='item-text'>
              <div class='category-icon warming'></div>
              <h3>
                <a href='#' class='item-link'>
                  QUNEXUS SMART SENSOR KEYBOARD CONTROLLER
                </a>
              </h3>
            </div>
          </div></div>
          <div class='item'><div class='item-inner'>
            <div class='image-wrapper'>
              <img src='./images/product-grid-image-1.png' />
            </div>
            <div class='item-text'>
              <div class='category-icon warming'></div>
              <h3>
                <a href='#' class='item-link'>
                  QUNEXUS SMART SENSOR KEYBOARD CONTROLLER
                </a>
              </h3>
            </div>
          </div></div>
          <div class='clear'></div>
          <div class='item'><div class='item-inner'>
            <div class='image-wrapper'>
              <img src='./images/product-grid-image-1.png' />
            </div>
            <div class='item-text'>
              <div class='category-icon warming'></div>
              <h3>
                <a href='#' class='item-link'>
                  QUNEXUS SMART SENSOR KEYBOARD CONTROLLER
                </a>
              </h3>
            </div>
          </div></div>

          <div class='item'><div class='item-inner'>
            <div class='image-wrapper'>
              <img src='./images/product-grid-image-1.png' />
            </div>
            <div class='item-text'>
              <div class='category-icon warming'></div>
              <h3>
                <a href='#' class='item-link'>
                  QUNEXUS SMART SENSOR KEYBOARD CONTROLLER
                </a>
              </h3>
            </div>
          </div></div>
          <div class='clear'></div>
          <div class='item'><div class='item-inner'>
            <div class='image-wrapper'>
              <img src='./images/product-grid-image-1.png' />
            </div>
            <div class='item-text'>
              <div class='category-icon warming'></div>
              <h3>
                <a href='#' class='item-link'>
                  QUNEXUS SMART SENSOR KEYBOARD CONTROLLER
                </a>
              </h3>
            </div>
          </div></div>
        </div>
      </div>
    </div>

  </main><!-- .site-main -->

  <?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
