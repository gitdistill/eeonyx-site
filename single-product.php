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
								<?php the_field('description'); ?><br/>
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
							<div class='inquire-link'>
								<div class='inquire-icon'></div>
								<div class='text'>
									Inquire about this product
								</div>
								<div class='clear'></div>
							</div>

							<?php
							if ( is_array( get_field('images') ) ){
								foreach( get_field('images') as $image ){ ?>
								<div class='product-image-wrapper'>
									<img src="<?= $image['image']['url'] ?>"" />
								</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<div class='clear'></div>

					<?php foreach( get_field('tables') as $table ){ ?>

						<div class='specs-section col-sm-12'>
							<h4 class="subsection-heading">
								<?=$table['heading']?>
							</h4>
							<div class="scroll-message hidden visible-xs-block">
								Scroll right to see full table...
							</div>
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
						</div>

					<?php } ?><!--end tables loop -->

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
