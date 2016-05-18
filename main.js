
// var slideout = new Slideout({
//   'panel': document.getElementById('panel'),
//   'menu': document.getElementById('menu'),
//   'padding': menuColumnWidth,
//   'tolerance': 70,
//   'duration': 220,
//   'toggleElement': document.getElementById('nav-link')
// });


// $(".nav-toggle").on('click', function() {
// 	$(this).find('.nav-icon').toggleClass('open');
// 	slideout.toggle();
// });

var EeonyxSlideout = function( $nav ){
	var menuColumnWidth = 130;
	var visible = false;
	var $allColumns = $nav.find('.menu-items');
	var $allLinks = $nav.find('.menu-item');
	function init(){
		$nav.addClass('slideout-menu');
		var $slugLinks = $nav.find('a[data-slug]');
		$slugLinks.click( function( e ){
			e.preventDefault();
			$link = $( this );
			var slug = $link.data('slug');
			var $slugColumn = $allColumns.filter('[data-slug=' + slug + ']');
			$slugColumn.addClass('visible');
			$link.siblings().removeClass('selected');
			$link.siblings('.active').addClass('was-active');
			$link.siblings('.active').removeClass('active');
			$link.addClass('selected');
		});
	}
	this.toggle = function(){
		if( !visible ){
			$nav.addClass('visible');
		}else{
			$allColumns.removeClass('visible');
			$nav.removeClass('visible');
			$allLinks.filter('.was-active').addClass('active');
			$allLinks.removeClass('selected');
		}
		visible = !visible;
	};
	init();
};

var slideout = new EeonyxSlideout( $('nav') );

$(".nav-toggle").on('click', function() {
	$(this).find('.nav-icon').toggleClass('open');
	slideout.toggle();
});



$(document).on('ready', function() {
	$("#menu").removeClass('hidden');
});

if ($(".combs-container .comb").length) {
	$(".combs-container").on('click', '.comb', function() {
		var el = $(this);
		var bodyEl = $(el.find('.body')[0]);
		var iconEl = $(el.find('.icon')[0]);
		var titleEl = $(el.find('.title')[0]);

		if (! el.hasClass('active')) {
			iconEl.animate({
				"top": "10px",
	  			"width": "19px",
	  			"height": "19px"
			}, 200);

			titleEl.animate({
				"font-size": "14px",
	  			"padding": "0 60px",
	  			"top": "5px"
			}, 200);

			bodyEl.animate({
				"opacity": 1
			}, 200, function() {
				el.addClass('active');
			});
		} else {
			iconEl.animate({
				"top": "65px",
	  			"width": "38px",
	  			"height": "38px"
			}, 200);

			titleEl.animate({
				"font-size": "18px",
	  			"padding": "0 0",
	  			"top": "65px"
			}, 200);

			bodyEl.animate({
				"opacity": 0
			}, 200, function() { 
				el.removeClass('active');
			});
		}
	});
}


if ($(".contact-form").length) { 
	$(".contact-form").on('click', "span.wpcf7-not-valid-tip", function() {
		$($(this).parent().find('input, textarea')[0]).focus();
	});

	autosize($('.contact-form textarea'));

	$(".contact-form input[type='text'], .contact-form input[type='email'], .contact-form textarea").each(function() { 
		$(this).on('focus', function() { 
			$(this).parent().parent().addClass('active-input');
			var errorMessages = $(this).parent().find("span.wpcf7-not-valid-tip");
			if (errorMessages.length) {
				$(errorMessages[0]).fadeOut(225);
			}
		});

		$(this).on('blur', function() { 
			$(this).parent().parent().removeClass('active-input');
			var errorMessages = $(this).parent().find("span.wpcf7-not-valid-tip");
			if (errorMessages.length && ! $(this).val().length) {
				$(errorMessages[0]).fadeIn(225);
			}
		});
	});
}