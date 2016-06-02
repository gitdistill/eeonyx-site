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
          <!--data-url is the image to load before wiping-->
          <div class="image">
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

          <?php
          $product_catgories = get_terms( 'product_category', array(
              'hide_empty' => false,
          ) );
          foreach ($product_catgories as $index => $cat) {
          ?><div class='comb'>
              <div>
                <div class='icon icon-<?=$cat->slug?>'></div>
                <div class='title'><?=$cat->name?></div>
                <div class='body'>
                  <?=$cat->description?>
                </div>
              </div>
            </div><!--
       --><?php } ?>

          </div>

        </div>
      </div>

      <!--======== PRODUCTS IN ACTION =========-->

      <div class="section fp-section fp-completely" id="section2">

        <div class='section-top-header'>
          <div class='text'>Eeonyx Products In Action</div>
        </div>

        <a class='top-right-link hidden-mobile' href="/eeonyx-in-action">
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
            <a class='green-product-box' href="<?= get_the_permalink(); ?>">

              <div class='product-category'>
                <div class="category-icon <?= $primary_category->slug; ?> white" >
                </div>
                <div class='text'>
                  <?= $primary_category->name; ?>
                </div>
                <div class='clear'>
                </div>
              </div>

              <div class='product-title'>
                <?= get_the_title(); ?>
              </div>

              <div class='product-description'>
                <?= get_field('summary_heading'); ?>
              </div>

            </a>
          </div>

        </div>
      <?php
          $count++;
        }
      } ?>

      <div class="heading-background">
      </div>

      </div>


      <!--======== FINAL SECTION =========-->

      <div class="section fp-section" id="section3">

        <div class='section-top-header'>
          <div class='text'>What Eeonyx Can Provide You</div>
        </div>

        <div class='section-text'>

          <h4 class='bottom-home-text'>
          Look smart. Be smart. Discover electronics you can wash and wear. Conductive textiles by Eeonyx warm you up, sense your environment, and protect you and your devices from unwanted energy.
            <!-- Manufacturer of electron conductive cloth, textiles, and fabrics for the aerospace, commercial, electronics, marine, military, and medical industries. Features tunable conductive coating applied to the product. Specific electrical resistances can be applied in gradients and patterns. Other products offered are conductive coatings, felt, foams, yarns, and polymers. Suitable for ESD applications, bomb suits, cleanroom garments, resistive heaters, and piezoresistive fabric sensors. -->
          </h4>

          <div class='links-bar row'>
            
            <div class='col-xs-12 col-sm-6'>
              <div class="row">

                <div class='col-xs-6'>
                  <a href='#'>
                    Our Full Product List
                  </a>
                </div>

                <div class='col-xs-6'>
                  <a href='#'>
                    About Our Technology
                  </a>
                </div>

              </div>
            </div>

            <div class='col-xs-12 col-sm-6'>
              <div class="row">

                <div class='col-xs-6'>
                  <a href='#'>
                    More About Who We Are
                  </a>
                </div>

                <div class='col-xs-6'>
                  <a href='/eeonyx-in-action'>
                    Our Products In Action
                  </a>
                </div>

              </div>
            </div>

          </div>
        
        </div>

        <div class="footer">
          <div class="logo"></div>
        </div>

      </div>

    </div><!--end fullpage -->
  </div><!--end outer -->

<div class="down-arrow">
  <span class="icon-EeonyxIconSet-71"></span>
</div>
<div class="up-arrow">
  <span class="icon-EeonyxIconSet-65"></span>
</div>

<?php endwhile; ?>

<?php define( 'INCLUDE_EEONYX_FOOTER_ELEMENT', false ); ?>
<?php get_footer(); ?>

