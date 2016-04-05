var slideout = new Slideout({
  'panel': document.getElementById('panel'),
  'menu': document.getElementById('menu'),
  'padding': 220,
  'tolerance': 70,
  'duration': 220,
  'toggleElement': document.getElementById('nav-link')
});


$(".nav-toggle").on('click', function() {
	$(this).find('.nav-icon').toggleClass('open');
	slideout.toggle();
});

$(document).on('ready', function() {
	$("#menu").removeClass('hidden');
});

if ($(".contact-form").length) { 
	$(".contact-form").on('click', "span.wpcf7-not-valid-tip", function() {
		$($(this).parent().find('input')[0]).focus();
	});

	autosize($('.contact-form input[name="message"]'));

	$(".contact-form input[type='text']").each(function() { 
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