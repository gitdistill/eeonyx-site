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
      <div style="background-image:url(<?= $hero_image['url'] ?>)" title="<?= $hero_image['alt'] ?>" data-src="<?= $hero_image['url'] ?>">
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

    include('flexible-content.php');


  if ($is_contact) { ?>
    </div>
  <?php } ?>

  <?php include get_template_directory() . '/template-parts/paragraph-with-image.php'; ?>

</article><!-- #post-## -->
