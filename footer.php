<?php
/**
 *
 * Site footer
 *
 */
 if ( ! defined( 'INCLUDE_EEONYX_FOOTER_ELEMENT' ) ){
 	define( 'INCLUDE_EEONYX_FOOTER_ELEMENT', true );
 }

 ?>

 			<?php include 'template-parts/nav.php'; ?>

		</div><!--end page -->
		<?php  if ( INCLUDE_EEONYX_FOOTER_ELEMENT ){ ?>
		<div class="footer">
			<div class="info phone">
				<span class="icon"></span>
				<p>+1 510.741.3632</p>
			</div>
			<div class="logo"></div>
			<div class="info address">
				<span class="icon"></span>
				<p>750 BELMONT WAY,<br/>
				PINOLE, CA 94564</p>
			</div>
		</div>
		<?php } ?>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/eeonyx-wp-theme/vendor/jquery.slimscroll.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/eeonyx-wp-theme/vendor/jquery.fullPage.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/eeonyx-wp-theme/vendor/autosize.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/eeonyx-wp-theme/main.js"></script>
		<script type='text/javascript'>
		/* <![CDATA[ */
		var _wpcf7 = {"loaderUrl":"http:\/\/eeonyx.com\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","recaptchaEmpty":"Please verify that you are not a robot.","sending":"Sending ..."};
		/* ]]> */
		</script>
		<script type='text/javascript'>
		/* <![CDATA[ */
		var screenReaderText = {"expand":"expand child menu","collapse":"collapse child menu"};
		/* ]]> */
		</script>

		<!-- WP footer -->
		<?php wp_footer(); ?>

	</body>
</html>