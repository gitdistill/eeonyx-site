
var MOBILE_MAX_WIDTH = 767;

function EeonyxSlideout( $nav ){
  var _self = this;
  var menuColumnWidth = 130;
  var visibility = false;
  var $toggleIcon = $('#nav-link');
  var $allColumns = $nav.find('.menu-items');
  var $allLinks = $nav.find('.menu-item');
  var $stateElement = $('#page');
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
      $stateElement.attr( 'column-visible', $slugColumn.data('column') );
      $linkColumn.addClass('open');
      $link.siblings().removeClass('selected');
      $link.addClass('selected');
    });
  };
  this.toggle = function( state ){
    if ( typeof state === 'undefined' ){
      state = !visibility;
    } else {
      if( state === visibility ){
        return; //no need to do anything if state and visibility are the same
      }
    }
    if( state ){
      $toggleIcon.addClass('open');
      $nav.show();
      setTimeout(function(){
        $nav.addClass('visible');
      },10);
      $stateElement.addClass('menu-open');
      $stateElement.attr( 'column-visible', 1 );
    }else{
      $toggleIcon.removeClass('open');
      $allColumns.removeClass('visible');
      $nav.one('transitionend webkitTransitionEnd oTransitionEnd', function () {
        if( !visibility ) {
          $nav.hide();
        }
      });
      $nav.removeClass('visible');
      $allLinks.removeClass('selected');
      $allColumns.removeClass('visible open');
      $stateElement.removeClass('menu-open');
      $stateElement.attr( 'column-visible', '' );
    }
    visibility = !visibility;
  };
  init();
}

var slideout = new EeonyxSlideout( $('nav') );

$(".nav-toggle").on('click', function() {
  slideout.toggle();
});

var mobile = function(){
  return parseInt($(window).width()) <= MOBILE_MAX_WIDTH;
};

$(document).on('ready', function() {

  $('#menu').removeClass('hidden');
  $('.wipe-hero .image').addClass('visible');

  //open _all_ external links in a new tab
  //must be done in js because client can add links in content
  $('a[href*="://"]').each(function() {
     var a = new RegExp('/' + window.location.host + '/');
     if(!a.test(this.href)) {
         $(this).click(function(event) {
             event.preventDefault();
             event.stopPropagation();
             window.open(this.href, '_blank');
         });
     }
  });

  //set up fullpage
  if ( $('#fullpage').length ){

    if( !mobile() ){
      $('#nav-link').addClass('big');
    }

    $('body').addClass('content-hidden');

    //Prepare for wipe animation
    var WIPE_DELAY = 1000;
    var startWipe = function(){
      setTimeout( function(){
        $('.home').removeClass('loading');
        $('.home .wipe-panel .image').addClass('visible');
        if( !mobile() && !window.location.hash ) {
          slideout.toggle(true);
        }
      }, WIPE_DELAY);
    };
    $wipeImage = $('<img/>');
    $wipeImage[0].src = $('.home .wipe-panel').data('url');
    if ( $wipeImage[0].complete ){
      startWipe();
    } else {
      $wipeImage.on('load', function(){
        startWipe();
      });
    }

    var enterIntroSlide = function(){
      if( !mobile() ){
        $('#nav-link.small').removeClass('small').addClass('big');
        slideout.toggle(true);
      }
    };
    var leaveIntroSlide = function(){
      if( !mobile() ){
        $('#nav-link.big').removeClass('big').addClass('small');
        slideout.toggle( false );
      }
    };

    $('#fullpage').fullpage({
      anchors: ['intro', 'explore-products', 'products-in-action', 'about-eeonyx'],
      sectionsColor: ['#E6E7E8', '#ffffff', '#E6E7E8', 'transparent'],
      css3: true,
      // responsiveWidth: 768,
      slidesNavigation: true,
      slidesNavPosition: 'top',
      afterLoad: function(anchorLink, index){
          // var loadedSection = $(this);
          if ( anchorLink === 'intro' ){
            $('body').removeClass('content-hidden');
          }
      },
      onLeave: function(index, nextIndex, direction){
        //after leaving section 1
        if(index == 1 && direction =='down'){
          leaveIntroSlide();
        }
        //entering section 1
        else if(index == 2 && direction == 'up'){
          enterIntroSlide();
        }
      }
    });
    //adding the action to the arrows
    $('.down-arrow').click( function(){
      $.fn.fullpage.moveSectionDown();
    });
    $('.up-arrow').click( function(){
      $.fn.fullpage.moveTo('intro');
      enterIntroSlide();
    });
  }


  //prevent scrolling in the menu from triggering a section change. from s/o
  $('.menu-items').on('DOMMouseScroll mousewheel', function(ev) {

      var $this = $(this),
          scrollTop = this.scrollTop,
          scrollHeight = this.scrollHeight,
          height = $this.innerHeight(),
          delta = (ev.type == 'DOMMouseScroll' ?
              ev.originalEvent.detail * -40 :
              ev.originalEvent.wheelDelta),
          up = delta > 0;

      var prevent = function() {
          ev.stopPropagation();
          ev.preventDefault();
          ev.returnValue = false;
          return false;
      };

      if (!up && -delta > scrollHeight - height - scrollTop) {
          // Scrolling down, but this will take us past the bottom.
          $this.scrollTop(scrollHeight);
          return prevent();
      } else if (up && delta > scrollTop) {
          // Scrolling up, but this will take us past the top.
          $this.scrollTop(0);
          return prevent();
      }
  });

});

if ($(".combs-container .comb").length) {
  $(".combs-container").on('click', '.comb', function(e) {

    //dont run on tablets
    if ( true ){ return } //e.originalEvent.sourceCapabilities.firesTouchEvents

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