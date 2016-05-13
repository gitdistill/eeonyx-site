<?php
/**
 * The template for displaying all single products
 *
 */

get_header(); 

// Start the loop.
while ( have_posts() ) : the_post();

?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<div class="content">
			<div class="inner">

				<div class='product-crumb'>
					<div class='product-icon anti-static'></div>
					<div class='text'>
						<strong>Product</strong><br />
						<strong>Antistatic</strong>
					</div>
					<div class='clear'></div>
				</div>

				<div class='product-columns'>
					<div class='left-column'>
						<div class='column-inner'>
							<h2>
								<?php the_field('name'); ?>
							</h2>
							<h3 class='light bottom-margin-1x'>
								<?php the_field('type'); ?>
							</h3>
							<h5 class='bottom-margin-2x'>
								<?php the_field('description'); ?><br/>
							</h5>

							<?php
							/**
							 *
							 * Bullet lists
							 *
							 */
							foreach( get_field('bullet_lists') as $list ){ ?>
								<h4>
									<?= $list['heading'] ?>
								</h4>
								<ul class='bottom-margin-1x'>
									<?php foreach( $list['items'] as $item ){ ?>
									<li><?= $item['item'] ?></li>
									<?php } ?>
								</ul>
							<?php } ?>

						</div>
					</div>

					<div class='right-column'>
						<div class='column-inner'>
							<div class='inquire-link'>
								<div class='inquire-icon'></div>
								<div class='text'>
									Inquire about this product
								</div>
								<div class='clear'></div>
							</div>

							<?php foreach( get_field('images') as $image ){ ?>
							<div class='product-image-wrapper'>
								<img src="<?= $image['image']['url'] ?>"" />
							</div>
							<?php } ?>
						</div>
					</div>
					<div class='clear'></div>

					<div class='specs-section'>
						<h4>
							Specs
						</h4>
						<div class='specs-table'>
							<div class='specs-table-inner'>
								<div class='table-header'>
									<div class='header-row table-row'>
										<div class='first-column header-column column'>
											Characteristic
										</div>
										<div class='second-column header-column column'>
											Measured Value
										</div>
										<?php if ( get_field('has_standards') ){ ?>
										<div class='third-column header-column column'>
											Standard
										</div>
										<?php } ?>
									</div>
								</div>
								<div class='table-body'>

									<?php foreach( get_field('specs') as $row ){ ?>

									<div class='table-row body-row'>
										<div class='first-column body-column column'>
											<?= $row['characteristic'] ?>
										</div>
										<div class='second-column body-column column'>
											<?= $row['measured_value'] ?>
										</div>
										<?php if ( get_field('has_standards') ){ ?>
										<div class='third-column body-column column'>
											<?= $row['standard'] ?>
										</div>
										<?php } ?>
									</div>

									<?php } ?>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
						
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php 
		// End of the loop.
		endwhile;
?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
