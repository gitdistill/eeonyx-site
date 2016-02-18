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