<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$is_contact = false;
	$pos = strpos(get_permalink(), 'contact');
	if ($pos !== false) { $is_contact = true; }

	if ($is_contact) { ?>
		<div class='narrow-column'>
	<?php } ?>
		<?php
		the_content();


	if ($is_contact) { ?>
		</div>
	<?php } ?>

</article><!-- #post-## -->
