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


<nav id="menu" class='slideout-menu'>
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
<!--         <a class="menu-item <?php active('the-tech') ?>" href="/the-tech">
          <div>The Tech</div>
        </a>
 -->        <a class="menu-item <?php active('about-eeonyx') ?>" href="/about-eeonyx">
          <div>About Eeonyx</div>
        </a>
        <a class="menu-item <?php active('contact') ?>" href="/contact">
          <div>Contact</div>
        </a>

        <!--additional items-->
         <script language='javascript'>
         console.log(<?= json_encode(wp_get_nav_menu_items('Additional Left Nav')) ?>);
         </script>

        <?php

        $menu_items = wp_get_nav_menu_items('Additional Left Nav');
 
        if ( count($menu_items) ){
         
            foreach ( (array) $menu_items as $key => $menu_item ) {
                $title = $menu_item->title;
                // $name = $menu_item->post_name;
                $url = $menu_item->url;
            ?>

                <a class="menu-item" href="<?=$url?>">
                  <div><?=$title?></div>
                </a>

            <?php
            }
        }

        ?>
      </div>
    </div>

    <div class="menu-items column-2" data-column="2" data-slug="conductive-products">
      <div>

        <a class="menu-item has-icon smart-fabrics" href="/about-our-products">
          <div>About our Products</div>
        </a>

        <?php foreach ($product_catgories as $index => $cat) { ?>
        <a class="menu-item has-icon" href="#" data-slug="<?=$cat->slug?>">
          <div><?=$cat->name?></div>
        </a>

        <?php } ?>

        <a class="menu-item has-icon custom-solutions" href="/custom-solutions">
          <div>Custom Solutions</div>
        </a>

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
  <div id="nav-link" <?php if (is_front_page() && ! wp_is_mobile()) { ?>class="big"<?php } ?> >
    <div class='nav-toggle'>
      <div class='nav-icon'>
        <span></span><span></span><span></span></div></div>
      <a href="/" class='logo'>
      </a>
  </div>
</div>
