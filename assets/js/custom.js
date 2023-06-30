"use strict";

/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 02.07.2023
 */
jQuery(document).ready(function ($) {
  $('#menu-toggle').on('click', function () {
    $(this).toggleClass('active');
    $('#site-navigation').toggleClass('active');
    $('.mobileOverlay').toggleClass('active');
  });
  $('#closeMenu').on('click', function () {
    $('#menu-toggle').trigger('click');
  });
  $('.main-navigation ul.menu > li').each(function () {
    var str = $(this).text().trim().toLowerCase();
    var slug = slugify(str);
    $(this).addClass('menu-' + slug);

    if ($(this).text().trim().toLowerCase().indexOf('logo') >= 0) {
      $(this).html($('.site-logo').html());
      $(this).css('visibility', 'visible');
    }
  });

  function slugify(string) {
    var a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìıİłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;';
    var b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------';
    var p = new RegExp(a.split('').join('|'), 'g');
    return string.toString().toLowerCase().replace(/\s+/g, '-') // Replace spaces with -
    .replace(p, function (c) {
      return b.charAt(a.indexOf(c));
    }) // Replace special characters
    .replace(/&/g, '-and-') // Replace & with 'and'
    .replace(/[^\w\-]+/g, '') // Remove all non-word characters
    .replace(/\-\-+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, ''); // Trim - from end of text
  }

  var owl = $('#carousel').owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    items: 1,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true
      },
      600: {
        items: 1,
        nav: false
      },
      800: {
        items: 2,
        nav: false
      },
      1300: {
        items: 3,
        nav: true,
        loop: false
      },
      1400: {
        items: 5,
        nav: true,
        loop: false
      }
    },
    onChanged: function onChanged() {// var countItems = $('#carousel div.frame').length;
      // console.log( countItems );
    }
  });
  adjustBottomCarousel();
  $(window).on('resize orientationchange', function () {
    adjustBottomCarousel();
  });
  /* Adjust Bottom Carousel. If window is higher than content, then make carousel fixed */

  function adjustBottomCarousel() {
    if ($('.carousel-wrapper').length) {
      var headerHeight = $('.site-header').height();
      var contentHeight = $('#main').height();
      var carouselHeight = $('.carousel-wrapper').height();
      var contentAndCarousel = headerHeight + contentHeight + carouselHeight;

      if ($(window).height() > contentAndCarousel) {
        $('.carousel-wrapper').css('position', 'fixed');
      } else {
        $('.carousel-wrapper').css('position', '');
      }
    }
  }

  owl.on("dragged.owl.carousel", function (event) {
    var direction = event.relatedTarget['_drag']['direction'];

    if (direction == 'left') {
      LoadMoreProjects();
    }
  });
  $(document).on('click', '.carousel-wrapper .customControl', function (e) {
    e.preventDefault();
    var action = $(this).attr('data-action');

    if (action == "next") {
      $('#carousel .owl-next').trigger('click');
      LoadMoreProjects();
    } else {
      $('#carousel .owl-prev').trigger('click');
    }
  });

  function LoadMoreProjects() {
    var carouselDiv = $('#carouselData');
    var baseUrl = carouselDiv.attr('data-baseUrl');
    var page = carouselDiv.attr('data-page');
    var next = parseInt(page) + 1;
    var loadURL = baseUrl + '?spg=' + next;
    carouselDiv.attr('data-page', next);
    $('.hiddenDataContainer').load(loadURL + " .hiddenData", function () {
      if ($('.hiddenDataContainer .thumbnail').length) {
        $('.hiddenDataContainer .thumbnail').each(function (e) {
          $('#carousel').owlCarousel('add', this.outerHTML).owlCarousel('update');
        });
      } // if( $('.hiddenData .hiddenData .thumbnail').length > 0 ) {
      //   var items = [];
      //   $('.hiddenData .hiddenData .thumbnail').each(function(e){
      //     $('#carousel').owlCarousel('add', this.outerHTML).owlCarousel('update');
      //   });
      // }

    });
  } // adjustContentHeight();
  // $(window).on('resize orientationchange', function(){
  //   adjustContentHeight();
  // });


  function adjustContentHeight() {
    if ($('body.subpage #primary.generic-layout').length) {
      var titleHeight = $('.titlediv').height();
      var carouselHeight = $('#carouselData').outerHeight();
      var extra = titleHeight + carouselHeight;
      var mainHeight = $('#main').height();
      var minusHeight = carouselHeight + titleHeight; //var contentHeight = (mainHeight - extra) + 40;

      var contentHeight = mainHeight - minusHeight; //$('body.subpage #primary.generic-layout #main').css('height', contentHeight+'px');

      $('.contentDiv').css('height', contentHeight + 'px');
    }
  }
});