<?php
/**
 * The template for displaying all single products
 *
 */

get_header(); 

// Start the loop.
while ( have_posts() ) : the_post();
$primary_category = get_field('primary_category');
$hero_image = get_field( 'hero_image' );
$background_image = get_field( 'background_image' );

?>

<div id="outer" class="application <?= $post->post_name; ?>">
	<div id="main" class="content-container">

	<!--get outside of the container-->
	</div>
	<!--============================-->

<div class="background-image">
  <div class="image">
  	<img src="<?= $background_image['url'] ?>" alt="<?= $background_image['alt'] ?>">
  </div>
</div>

	<!--get back inside the container-->
	<div class="content-container">
	<!--============================-->

		<div class="wipe-hero large">
		  <div class="image">
		  	<img src="<?= $hero_image['url'] ?>" alt="<?= $hero_image['alt'] ?>">
		  </div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class='application-crumb'>
					<div class="category-icon <?=$primary_category->slug?>"></div>
					<div class='text'>
						<strong>Eeonyx in Action</strong><br />
						<strong><?=$primary_category->name?></strong>
					</div>
					<div class='clear'></div>
				</div>

				<h2 class="dark-black sub-page-header">
				  <?php the_title(); ?>
				</h2>
				<div class="summary">
					<div class="heading">
						Imagine a piano key that could be played like a string or a horn!
					</div>
					<div class="information">
						PRODUCT: PRODUCT TYPE: MADE BY:
						INDUSTRY: EEONYX PRODUCT:
						PURCHASE HERE:
						QUNEO
						MIDI TOUCH CONTROL KEITH MCMILLEN
						ENTERTAINMENT THERMIONYXTM TWILL 36 KEITHMCMILLEN.COM
						￼￼￼For our piezo-resistive pressure sensing technology inquiries, please contact Robin Nijoor (V.P. Business Development at Bebop Sensors) at info@bebopsensors.com or +1 831.234.4369
					</div>
				</div>
			</div>
		</div>

		<div class="description">

				<div class="drop-quote">
				“QuNexus is the most important evolution in keyboards since the Erard Escapement was introduced to pianos in 1821”
				<p class="attribution">- Keith McMillen</p>
				</div>

				<div class="full-text">
				The QuNexus Smart Sensor
				Keyboard Controller gives unprecedented expressive control because Eeonyx’s pressure sensor technology transmits pressure, tilt, polyphonic aftertouch, and velocity. QuNexus’ revolutionary keys can be played faster and more accurately than those of a traditional keyboard. Individual key pressure and tilt sensitivity enable fresh nuance.

				“QuNexus is the most important evolution in keyboards since the Erard Escapement was introduced to pianos in 1821,” said KMI founder, Keith McMillen. “QuNexus gives keyboardists forms of expression that were only available to string and horn players. Although playful in appearance, it performs and feels like a serious instrument.”

				Instead of sliders, dials and toggles, QuNexus uses 25 vividly illuminated Smart Sensor keys that are uniquely interactive and fun to play.
				“We are very excited about the arrival of QuNexus,” said John Grabowski, Senior Director of Merchandising at Sweetwater Sound. “Its innovative design and unique capabilities have already translated into strong pre-order demand.”
				Pros love the expressive power of polyphonic aftertouch, channel rotation, poly pitch bend, and the ability to incorporate analog synthesizers with Control Voltage (CV).
				“Apart from being a slick, portable USB controller with the unique key tilt feature, QuNexus is a convenient MIDI to CV and CV to MIDI converter, and is extremely useful for integrating my analog gear into the digital world,” said electronic musician, DJ and remixer, Jonah Sharp aka Spacetime Continuum.
				“QuNexus is a dope piece of equipment for playing chords and lead lines, and I really like how I can express with the tilt pitch bend and get creative like a guitar or horn player, and do things pianos can’t do,” said pianist, MC and producer, Kev Choice.
				“QuNexus is solving a big problem for a lot of laptop musicians who want a really portable, but powerful, keyboard controller,” said recording artist and sound designer, Richard Devine.
				</div>

		</div>


	</main><!-- .site-main -->
</div>

<?php 
		// End of the loop.
		endwhile;
?>

<?php get_footer(); ?>
