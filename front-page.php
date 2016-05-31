<?php
/**
 * The template for displaying all single products
 *
 */

get_header(); 

// Start the loop.
while ( have_posts() ) : the_post();

$wipe_image = get_field('hero_image');

?>

<div id="outer" class="home loading">

  <div id="fullpage">

      <!--======== TOP SECTION =========-->

      <div class="section fp-section" id="section0">

        <div class="wipe-panel" data-url="<?= $wipe_image['url'] ?>">
          <div class="image">
            <div style="background-image:url(<?= $wipe_image['url'] ?>)" title="<?= $wipe_image['alt'] ?>">
            </div>
          </div>
        </div>
        <div id="panel-outer">
          <div id="panel">
            <div class="content">
              <div class="inner">
                <h1 class="dark-black">
                  SMART FABRICS FOR THE INTERNET OF THINGS
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--======== EXPLORE PRODUCTS (COMBS) =========-->

      <div class="section fp-section" id="section1">

        <div class='section-top-header'>
          <div class='text white'>Explore Our Products</div>
        </div>

        <div class='section-text'>
          <h4 class='explore-intro text-center'>
            Eeonyx makes an assortment of products that fall into the following categories
          </h4>

          <div class='combs-container'>

            <div class='comb'>
              <div>
                <div class='icon icon-smart-fabrics'></div>
                <div class='title'>Smart Fabrics</div>
                <div class='body'>
                  Thin, light and less costly. Fashionable enough for dress yet rugged and reliable enough for mission critical environments.
                </div>
              </div>
            </div><!--
         --><div class='comb'>
              <div>
                <div class='icon icon-pressure-sensors'></div>
                <div class='title'>Pressure Sensors</div>
                <div class='body'>
                  Thin, light and less costly. Fashionable enough for dress yet rugged and reliable enough for mission critical environments.
                </div>
              </div>
            </div><!--
         --><div class='comb'>
              <div>
                <div class='icon icon-warming-fabrics'></div>
                <div class='title'>Warming Fabrics</div>
                <div class='body'>
                  Thin, light and less costly. Fashionable enough for dress yet rugged and reliable enough for mission critical environments.
                </div>
              </div>
            </div><!--
         --><div class='comb'>
              <div>
                <div class='icon icon-stealth'></div>
                <div class='title'>EMI &amp; Stealth</div>
                <div class='body'>
                  Thin, light and less costly. Fashionable enough for dress yet rugged and reliable enough for mission critical environments.
                </div>
              </div>
            </div><!--
         --><div class='comb'>
              <div>
                <div class='icon icon-anti-static'></div>
                <div class='title'>Anti-Static</div>
                <div class='body'>
                  Thin, light and less costly. Fashionable enough for dress yet rugged and reliable enough for mission critical environments.
                </div>
              </div>
            </div><!--
         --><div class='comb'>
              <div>
                <div class='icon icon-custom'></div>
                <div class='title'>Custom Solutions</div>
                <div class='body'>
                  Thin, light and less costly. Fashionable enough for dress yet rugged and reliable enough for mission critical environments.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

      <!--======== PRODUCTS IN ACTION =========-->

      <div class="section fp-section fp-completely" id="section2">

        <div class='section-top-header'>
          <div class='text'>Eeonyx Products In Action</div>
        </div>

        <a class='top-right-link hidden-mobile'>
          <div class='arrow'></div>
          <div class='text'>View More of Our Products In Action</div>
        </a>

        <?php
        $args = array(
            'post_type' => 'application',
        );
        $query = new WP_Query( $args );
        if ($query->have_posts()) {
          $count = 0;
          while ( $query->have_posts() ){
            $query->the_post();
            $primary_category = get_field('primary_category');
            $image = get_field('home_page_slide_image');
        ?>

        <div class="slide" id="slide<?=$count?>" style="background-image:url(<?= $image['url']; ?>)">
          <div class='section-text'>
            <div class='green-product-box'>
              <div class='product-category'>
                <div class="category-icon <?= $primary_category->slug; ?> white" ></div>
                <div class='text'>
                  <?= $primary_category->name; ?>
                </div>
                <div class='clear'></div>
              </div>
              <div class='product-title'>
                <?= get_the_title(); ?>
              </div>
              <div class='product-description'>
                <?= get_field('summary_heading'); ?>
              </div>
            </div>
          </div>
        </div>

        <?php
            $count++;
          }
        } ?>

      </div>


      <!--======== FINAL SECTION =========-->

      <div class="section fp-section" id="section3">

        <div class='section-top-header'>
          <div class='text'>What Eeonyx Can Provide You</div>
        </div>

        <div class='section-text'>
          <h4 class='bottom-home-text'>
            Manufacturer of electron conductive cloth, textiles, and fabrics for the aerospace, commercial, electronics, marine, military, and medical industries. Features tunable conductive coating applied to the product. Specific electrical resistances can be applied in gradients and patterns. Other products offered are conductive coatings, felt, foams, yarns, and polymers. Suitable for ESD applications, bomb suits, cleanroom garments, resistive heaters, and piezoresistive fabric sensors.
          </h4>

          <div class='links-bar'>
            <div class='link-wrapper'>
              <a href='#'>
                Our Full Product List
              </a>
            </div>
            <div class='link-wrapper'>
              <a href='#'>
                About Our Technology
              </a>
            </div>
            <div class='link-wrapper'>
              <a href='#'>
                More About Who We Are
              </a>
            </div>
            <div class='link-wrapper'>
              <a href='#'>
                Our Products In Actions
              </a>
            </div>
            <div class='clear'></div>
          </div>
        </div>

        <div class="footer">
          <div class="logo"></div>
        </div>
      </div>

    </div><!--end fullpage -->
  </div><!--end outer -->
</div><!--end #page -->

<div class="down-arrow">
  <span class="icon-EeonyxIconSet-71"></span>
</div>
<div class="up-arrow">
  <span class="icon-EeonyxIconSet-65"></span>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>
