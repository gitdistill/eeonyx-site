<?php

/**
 *
 * Navigation
 *
 */


$taxonomies = get_object_taxonomies('product');
$product_taxonomy = $taxonomies[0];
$product_catgories = get_terms( $product_taxonomy, array(
    'hide_empty' => false,
) );

$page = get_post();

global $active_slug;
$active_slug = $page? $page->post_name: '';

if ( !defined('EEONYX_NAV_INITIALIZED') ) {

  function active( $slug ){
    global $active_slug;
    if( $active_slug==$slug ){
      echo 'active';
    }
  }

  define( 'EEONYX_NAV_INITIALIZED', true );

}

?>


<nav id="menu" <?php if (is_front_page() && ! wp_is_mobile()) { ?>class='slideout-menu'<?php } else { ?>class='hidden'<?php } ?>>
  <header>

    <div class="margin-filler"></div>
  
    <div class="left-menu">

    <div class="menu-items column-1" data-column="1">
      <div>
        <?php
        if (!is_front_page()) { ?>
        <a class="menu-item black" href="/">
          <div>Home</div>
        </a>
        <?php } ?>
        <a class="menu-item <?php active('conductive-products') ?>" href="/conductive-products" data-slug="conductive-products">
          <div>Conductive Products</div>
        </a>
        <a class="menu-item <?php active('eeonyx-in-action') ?>" href="/eeonyx-in-action">
          <div>Eeonyx in Action</div>
        </a>
        <a class="menu-item <?php active('the-tech') ?>" href="#">
          <div>The Tech</div>
        </a>
        <a class="menu-item <?php active('about-eeonyx') ?>" href="/about-eeonyx">
          <div>About Eeonyx</div>
        </a>
        <a class="menu-item <?php active('contact') ?>" href="/contact">
          <div>Contact</div>
        </a>
      </div>
    </div>

    <div class="menu-items column-2" data-column="2" data-slug="conductive-products">
      <div>

        <?php foreach ($product_catgories as $index => $cat) { ?>
        <a class="menu-item has-icon" href="#" data-slug="<?=$cat->slug?>">
          <div><?=$cat->name?></div>
        </a>

        <?php } ?>
      </div>
    </div>

    <?php foreach ($product_catgories as $index => $cat) { 

      $args = array(
        'post_type' => 'product',
        'numberposts' => -1,
        'tax_query' => array(
          array(
            'taxonomy' => $product_taxonomy,
            'field' => 'name',
            'terms' => $cat->name // Where term_id of Term 1 is "1".
          )
        )
      );

      $products = get_posts( $args );
      
      if( count( $products ) > 0 ) { ?>

        <div class="menu-items column-3"  data-column="3" data-slug="<?=$cat->slug?>">
          <div>
          
            <a class="menu-item" href="/product_category/<?=$cat->slug?>" >
              <div>
                View all <?=$cat->name?>
              </div>
            </a>

          <?php

        foreach ($products as $index => $product) {
          $type = get_field( 'type_shown_in_nav', $product->ID );
          $type = $type=='' ? get_field( 'type', $product->ID ) : $type;
          ?>

          <a class="menu-item" href="<?= get_permalink( $product->ID ) ?>" >
            <div>
              <?= get_field( 'name', $product->ID ); ?><br/>
              <span class="type"><?=$type?></span>
            </div>
          </a>

        <?php } ?>

        </div>
      </div>

      <?php } ?>
    <?php } ?>

    </div>
  </header>
</nav>

<div class="content-container">
  <div id="nav-link">
    <div class='nav-toggle'>
      <div class='nav-icon'>
        <span></span><span></span><span></span></div></div>
      <a href="/" class='logo'>
      </a>
  </div>
</div>
