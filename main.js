
var MOBILE_MAX_WIDTH = 767;
var FULLPAGE_RESPONSIVE_WIDTH = 667;
var WIPE_DELAY = 1000;

/**
 *
 * Slideout
 *
 */

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
      if( $(e.target)[0] == headerElement || $(e.target)[0] == menuElement ){
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


/**
 *
 * Detect mobile
 *
 */

var screenWidthBelow = function( width ) {
  return parseInt($(window).width()) <= width;
};
var mobile = function() {
  return screenWidthBelow( MOBILE_MAX_WIDTH );
};

/**
 *
 * Convert external links to open in a new tab
 *
 */
var convertExternalLinks = function(){
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
};

/**
 *
 * Load wipe image and fire wipe
 *
 */

 var initWipe = function( src, callback, delay ){
   $wipeImage = $('<img/>');
   $wipeImage[0].src = src;
   if ( $wipeImage[0].complete ){
     callback( delay );
   } else {
     $wipeImage.on('load', function(){
       callback( delay );
     });
   }
 };
 var startHomeWipe = function( delay ){
   setTimeout( function(){
     $('.home').removeClass('loading');
     $('.home .wipe-panel .image').addClass('visible');
     if( !mobile() && ( !window.location.hash || window.location.hash=='#intro' ) ) {
       slideout.toggle(true);
     }
   }, delay);
 };
 var startHeroWipe = function( delay ){
   setTimeout( function(){
     $('.wipe-hero .image').addClass('transition-armed');
     $('.wipe-hero .image').addClass('visible');
   }, delay);
 };


/**
 *
 * Init full-page effect on home
 *
 */

var initFullPage = function() {

  var $fullpage = $('#fullpage');

  if ( $fullpage.length ) {

    var enterIntroSlide = function(){
      if( !mobile() ){
        $('#nav-link.small').removeClass('small').addClass('big');
        $('.home .wipe-panel .image').addClass('visible');
        slideout.toggle(true);
      }
    };
    var leaveIntroSlide = function(){
      if( !mobile() ){
        $('#nav-link.big').removeClass('big').addClass('small');
        $('.home .wipe-panel .image').removeClass('visible');
        slideout.toggle( false );
      }
    };

    var resizeSections = function( newWindowWidth, newWindowHeight ) {
      //go through sections in reverse order and open them up
      //this is less choppy because it is changing less of the page at a time
      var sections = $('.fp-section');
      var transitioningSection = null;
      var transitionEvents = 'transitionend oTransitionEnd webkitTransitionEnd';
      var transitioningIndex = null;
      var changeHeight = function( i ){
        $transitioningSection = $( sections[i] );
        transitioningIndex = i;
        $transitioningSection.height( newWindowHeight );
        $transitioningSection.find('.fp-tableCell').height( newWindowHeight );
        $(".mobile-background").height( newWindowHeight );
        $transitioningSection.on( transitionEvents, transitionCallback );
      };
      var transitionCallback = function() {
        $transitioningSection.off( transitionEvents );
        if ( transitioningIndex > 0 ){
          changeHeight( transitioningIndex-1 );
        }
      };
      changeHeight( sections.length - 1 );
    };

    if( !mobile() ){
      $('#nav-link').addClass('big');
    }

    $('body').addClass('content-hidden');

    var src = $('.home .wipe-panel').data('url');
    $('body.home').css('background-image', 'url(' + src + ')');


    //Prepare for wipe animation
    initWipe( src, startHomeWipe, WIPE_DELAY );

    $fullpage.fullpage({
      anchors: ['intro', 'explore-products', 'products-in-action', 'about-eeonyx'],
      sectionsColor: ['transparent', 'transparent', '#E6E7E8', '#E6E7E8'],
      css3: true,
      responsiveWidth: FULLPAGE_RESPONSIVE_WIDTH,
      slidesNavigation: true,
      slidesNavPosition: 'top',
      loopHorizontal: false,
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
      },
      afterRender: function(){
        //resize to the actual outer dims, minus the chrome, immediately
        // console.log( $(window).height() );
        // console.log( $(window) );
        var height = mobile() && window.screen.availHeight? window.screen.availHeight: window.innerHeight;
        resizeSections( window.innerWidth, height );
      }
    });

    //adding the scroll action to the arrows
    $('.down-arrow span').click( function(){
      $.fn.fullpage.moveSectionDown();
    });
    $('.up-arrow span').click( function(){
      $.fn.fullpage.moveTo('intro');
      enterIntroSlide();
    });

    if ( screenWidthBelow( FULLPAGE_RESPONSIVE_WIDTH ) ) {

      //keep track of dims and resize when they actually change
      var windowHeight = window.innerHeight;
      var windowWidth = window.innerWidth;

      // //resize on scroll event
      // $(window).on('scroll', function(){
      //   if ( window.innerHeight != windowHeight ){
      //     console.log('scroll');
      //     var newWindowHeight = window.innerHeight;
      //     var newWindowWidth = window.innerWidth;
      //     if ( windowHeight !== newWindowHeight || newWindowWidth !== windowWidth ){
      //       resizeSections( newWindowWidth, newWindowHeight );
      //     }
      //     windowHeight = window.innerHeight;
      //     windowWidth = window.innerWidth;
      //   }
      // });

      // //resize on resize event
      // $(window).resize( function(){
      //   console.log('resize');
      //   var newWindowHeight = window.innerHeight;
      //   var newWindowWidth = window.innerWidth;
      //   if ( windowHeight !== newWindowHeight || newWindowWidth !== windowWidth ){
      //     resizeSections( newWindowWidth, newWindowHeight );
      //   }
      //   windowHeight = window.innerHeight;
      //   windowWidth = window.innerWidth;
      // });

    }

  }

};

/**
 *
 * Fix menu Scroll - keep scrolling on menu from triggering fullpage transitions
 *
 * (from s/o)
 *
 */
var fixMenuScroll = function() {
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
};

/**
 *
 * Set up hexagons (combs)
 *
 */
var initCombs = function(){
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
};

/**
 *
 * Init contact form
 *
 */
var initContactForm = function(){
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
};


/**
 *
 * Init product hovers
 *
 */
var initProductHovers = function(){
  var toggleLine = function( $target, state ){
    var slug = $target.data('product-grid-slug');
    $('.lower-line[data-product-grid-slug=' + slug + ']').toggleClass( 'active', state );
  };
  $('.product-grid-item[data-product-grid-slug]').on('mouseover', function(){
    toggleLine( $(this), true );
  }).on('mouseout', function(){
    toggleLine( $(this), false );
  }).click( function() {
    window.location = $(this).data('href');
  });
};

/**
 *
 * Document load
 *
 */

$(document).on('ready', function() {

  //Prepare for wipe animation in heros
  if( $('.home').length === 0 ){
    var src = $('.wipe-hero .image div').data('src');
    initWipe( src, startHeroWipe, WIPE_DELAY );
  }

  //prevent ie from floating the nav link around on load
  $('#nav-link').addClass('transition-armed');

  //open _all_ external links in a new tab
  //must be done in js because client can add links in content
  convertExternalLinks();

  //set up fullpage
  initFullPage();
  initCombs();

  //prevent scrolling in the menu from triggering a section change
  fixMenuScroll();

  initContactForm();

  initProductHovers();

});


