$( document ).ready(function() {

  $('.content-section').hide();
  $('.feature').fadeIn(1500);

  $('#showAll').click(function() {
    $('.content-section').fadeIn(1500);
    $('#viewAll').hide();
  });

  $('#web').click(function() {
    $('.content-section').hide();
    $('.web').fadeIn(1500);
    $('#viewAll').show();
  });

  $('#mobile').click(function() {
    $('.content-section').hide();
    $('.mobile').fadeIn(1500);
    $('.viewAll').show();
  });

  $('#feature').click(function() {
    $('.content-section').hide();
    $('.feature').fadeIn(1500);
    $('.viewAll').show();
  });

  $('#graphics').click(function() {
    $('.content-section').hide();
    $('.graphics').fadeIn(1500);
    $('#viewAll').show();
  });
});


(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 48)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 48
  });

  // Collapse the navbar when page is scrolled
  $(window).scroll(function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
      $("#bannerImg").attr('src', "welcome/img/bannerDark.png");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
      $("#bannerImg").attr('src', "welcome/img/banner.png");
    }
  });

  // Scroll reveal calls
  window.sr = ScrollReveal();
  sr.reveal('.sr-icons', {
    duration: 600,
    scale: 0.3,
    distance: '0px'
  }, 200);
  sr.reveal('.sr-button', {
    duration: 1000,
    delay: 200
  });
  sr.reveal('.sr-contact', {
    duration: 600,
    scale: 0.3,
    distance: '0px'
  }, 300);

  // Magnific popup calls
  $('.popup-gallery').magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-img-mobile',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1]
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
    }
  });

})(jQuery); // End of use strict
