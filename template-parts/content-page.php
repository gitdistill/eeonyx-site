<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
  $is_contact = false;
  $pos = strpos(get_permalink(), 'contact');
  if ($pos !== false) { $is_contact = true; }
  $hero_image = get_field( 'hero_image' );
?>

<?php if ($hero_image) { ?>
  <div class="wipe-hero short">
    <div class="image">
      <div style="background-image:url(<?= $hero_image['url'] ?>)" title="<?= $hero_image['alt'] ?>">
      </div>
    </div>
  </div>
<?php } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ($is_contact) { ?>
    <div class='narrow-column'>
  <?php } ?>

    <h2><?php the_title() ?></h2>

    <?php
    the_content();


  if ($is_contact) { ?>
    </div>
  <?php } ?>

  <?php
  $paragraph_with_image_rows = get_field('paragraph_with_image');
  //var_dump( $paragraph_with_image_rows );
  if( $paragraph_with_image_rows ){
    foreach ($paragraph_with_image_rows as $key => $row) {
      $swap_columns = $row['image_alignment'] == 'right';
      $hide_image_on_mobile = $row['hide_image_on_mobile']
      ?>

      <div class="paragraph-with-image row row-<?=$key?>">
        <div class="col-sm-4 image <?=$swap_columns?'col-sm-push-8':'';?>">
          <?php if( $row['image'] ) { ?>
            <img src="<?=$row['image']['url']?>" class="<?=$hide_image_on_mobile?'hidden-xs':'';?>" alt="<?=$row['image']['alt']?>">
          <?php } ?>
        </div>
        <div class="col-sm-7 text <?=$swap_columns?'col-sm-pull-3':'';?>">
          <?=$row['text']?>
        </div>
      </div>

    <?php } ?>
  <?php } ?>

</article><!-- #post-## -->
