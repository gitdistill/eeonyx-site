
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

function EeonyxSlideout( $nav ){
	var _self = this;
	var menuColumnWidth = 130;
	var visible = false;
	var $allColumns = $nav.find('.menu-items');
	var $allLinks = $nav.find('.menu-item');
	var $allSiblingsByNumber = {
		1: $allColumns.filter( '[data-column=1]' ),
		2: $allColumns.filter( '[data-column=2]' ),
		3: $allColumns.filter( '[data-column=3]' )
	};
	var $allChildrenByNumber = {
		1: $allSiblingsByNumber[2].add( $allSiblingsByNumber[3] ),
		2: $allSiblingsByNumber[3]
	};
	var headerElement = $nav.find('header')[0];
	var menuElement = $nav.find('.left-menu')[0];

	var init = function(){
		$nav.addClass('slideout-menu');
		$nav.hide();
		$nav.click( function(e){
			if( $(e.toElement)[0] == headerElement || $(e.toElement)[0] == menuElement ){
				_self.toggle();
			}
		});
		var $slugLinks = $nav.find('a[data-slug]');
		$slugLinks.click( function( e ){
			e.preventDefault();
			var $link = $( this );
			var $linkColumn = $link.parents('.menu-items');
			var $slugColumn = $allColumns.filter('[data-slug=' + $link.data('slug') + ']');
			$allChildrenByNumber[ $linkColumn.data('column') ].removeClass('visible open');
			$allChildrenByNumber[ $linkColumn.data('column') ].find('.menu-item.selected').removeClass('selected');
			$slugColumn.addClass('visible');
			$linkColumn.addClass('open');
			$link.siblings().removeClass('selected');
			$link.addClass('selected');
		});
	};
	this.toggle = function(){
		if( !visible ){
			$nav.show();
			setTimeout(function(){
				$nav.addClass('visible');
			},10);
			$('#outer').addClass('menu-open');
		}else{
			$allColumns.removeClass('visible');
			$nav.one('transitionend webkitTransitionEnd oTransitionEnd', function () {
				if( !visible ) {
					$nav.hide();
				}
			});
			$nav.removeClass('visible');
			$allLinks.removeClass('selected');
			$allColumns.removeClass('visible open');
			$('#outer').removeClass('menu-open');
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

	$('.wipe-hero .image').addClass('visible');

	if ( $('#fullpage').length ){
		$('#fullpage').fullpage({
      anchors: ['intro', 'explore-products', 'products-in-action', 'about-eeonyx'],
      sectionsColor: ['#E6E7E8', '#ffffff', '#E6E7E8', '#ffffff'],
      css3: true,
      responsiveWidth: 768
  	});
	}

});

if ($(".combs-container .comb").length) {
	$(".combs-container").on('click', '.comb', function(e) {

		//dont run on tablets
		if ( true ){ return }

		console.log(e);
		var el = $(this);
		var bodyEl = $(el.find('.body')[0]);
		var iconEl = $(el.find('.icon')[0]);
		var titleEl = $(el.find('.title')[0]);

		if (! el.hasClass('active')) {

			iconEl.addClass('hover');

			titleEl.addClass('hover');

			var addActiveClass = function() {
				el.addClass('active');
				bodyEl.off('transitionend oTransitionEnd webkitTransitionEnd', addActiveClass);
			};
			bodyEl.one('transitionend oTransitionEnd webkitTransitionEnd', addActiveClass );
			bodyEl.addClass('hover');

		} else {

			iconEl.removeClass('hover');

			titleEl.removeClass('hover');

			var removeActiveClass = function() {
				el.removeClass('active');
				bodyEl.off('transitionend oTransitionEnd webkitTransitionEnd',removeActiveClass);
			};
			bodyEl.one('transitionend oTransitionEnd webkitTransitionEnd', removeActiveClass );
			bodyEl.removeClass('hover');

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