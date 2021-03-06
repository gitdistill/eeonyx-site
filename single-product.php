<?php
/**
 * The template for displaying all single products
 *
 */

get_header(); 

// Start the loop.
while ( have_posts() ) : the_post();

$tables = get_field('tables');
$data = get_field('data');

?>

<div id="outer" class="product <?= $post->post_name; ?>">
  <div class="content-container">


	<!-- TODO IMPLEMENT CRUMB -->
		<div class='product-crumb'>
			<div class='category-icon anti-static'></div>
			<div class='text'>
				<strong>Product</strong><br />
				<strong>Antistatic</strong>
			</div>
			<div class='clear'></div>
		</div>

		<div class='product-columns row'>

			<div class='left-column col-sm-7'>
				<div class='column-inner'>
					<h2>
						<?php the_field('name'); ?>
					</h2>
					<h3 class='light bottom-margin-1x'>
						<?php the_field('type'); ?>
					</h3>
					<h5 class='bottom-margin-2x'>
						<?php the_field('description'); ?>
					</h5>

					<?php
					/**
					 *
					 * Bullet lists
					 *
					 */
					$bulletLists = get_field('bullet_lists');
					if ( is_array($bulletLists) ){
						foreach( $bulletLists as $list ){ ?>
							<h4 class="subsection-heading">
								<?= $list['heading'] ?>
							</h4>
							<ul class='bottom-margin-1x'>
								<?php foreach( $list['items'] as $item ){ ?>
								<li><?= $item['item'] ?></li>
								<?php } ?>
							</ul>
						<?php } ?>
					<?php } ?>

				</div>
			</div>

			<div class='right-column col-sm-5'>
				<div class='column-inner'>

					<a href="/contact" class='inquire-link'>
						<div class='inquire-icon'>
						</div>
						<div class='text'>
							Inquire about<br/>this product
						</div>
						<div class='clear'>
						</div>
					</a>

					<?php
					if ( is_array( get_field('images') ) ){
						foreach( get_field('images') as $image ){ ?>
						<div class='product-image-wrapper'>
							<img src="<?= $image['image']['url']; ?>" alt="<?= $image['image']['alt']; ?>" />
						</div>
						<?php }
					} ?>

				</div>
			</div>

		</div><!-- end product columns -->

		<?php
		if( $tables ){ ?>

		<div class='specs row'>

		<?php foreach( $tables as $table ){ ?>

			<div class='specs-section col-sm-12'>
				<h4 class="subsection-heading">
					<?=$table['heading']?>
				</h4>
				<div class='specs-table <?php if ( $table["has_standards_column"] ){ ?>three-column<?php } ?>'>
					<div class='specs-table-inner'>
						<div class='table-header'>
							<div class='header-row table-row'>
								<div class='first-column header-column column'>
									Characteristic
								</div>
								<div class='second-column header-column column'>
									Measured Value
								</div>
								<?php if ( $table['has_standards_column'] ){ ?>
								<div class='third-column header-column column'>
									Standard
								</div>
								<?php } ?>
							</div>
						</div>
						<div class='table-body'>

							<?php foreach( $table['specs'] as $row ){ ?>

								<div class='table-row body-row'>
									<div class='first-column body-column column'>
										<?= $row['characteristic'] ?>
									</div>
									<div class='second-column body-column column'>
										<?= $row['measured_value'] ?>
									</div>
									<?php if ( $table['has_standards_column'] ){ ?>
									<div class='third-column body-column column'>
										<?= $row['standard'] ?>
									</div>
									<?php } ?>
								</div>

							<?php } ?>

						</div>
					</div>
				</div>
				<div class="scroll-message hidden visible-xs-block">
					Scroll right to see full table...
				</div>
			</div>

			<?php } ?>

		</div><!-- end specs row -->

		<?php } ?><!--end tables loop and if statement -->

		<?php if( $data ){ ?>

		<div class='data-section row'>
		<div class="col-sm-12">
			<h4 class="subsection-heading">
				Product Data
			</h4>
		</div>
			<?php foreach( $data as $item ){ ?>
				<div class="col-sm-6">
					<img src="<?=$item['chart']['url']?>" alt="<?=$item['chart']['alt']?>">
				</div>
			<?php } ?>

		</div>

		<?php } ?>


	</div><!-- content-container -->
</div><!--outer-->

<div class="inquire-modal">
</div>

<?php 
		// End of the loop.
		endwhile;
?>

<?php get_footer(); ?>
