/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 02.07.2023
 */

jQuery(document).ready(function ($) {

  $('.main-navigation ul.menu > li').each(function(){
    var str = $(this).text().trim().toLowerCase();
    var slug = slugify(str);
    $(this).addClass('menu-'+slug);
    if( $(this).text().trim().toLowerCase().indexOf('logo') >= 0 ) {
      $(this).html( $('.site-logo').html() );
      $(this).css('visibility','visible');
    }
  });

  function slugify(string) {
    const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìıİłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
    const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
    const p = new RegExp(a.split('').join('|'), 'g')

    return string.toString().toLowerCase()
      .replace(/\s+/g, '-') // Replace spaces with -
      .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
      .replace(/&/g, '-and-') // Replace & with 'and'
      .replace(/[^\w\-]+/g, '') // Remove all non-word characters
      .replace(/\-\-+/g, '-') // Replace multiple - with single -
      .replace(/^-+/, '') // Trim - from start of text
      .replace(/-+$/, '') // Trim - from end of text
  }


  var owl = $('#carousel').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
    responsiveClass:true,
    responsive:{
        0:{
          items:1,
          nav:true
        },
        600:{
          items:1,
          nav:false,
        },
        800:{
          items:3,
          nav:false,
        },
        1300:{
          items:4,
          nav:true,
          loop:false
        },
        1400:{
          items:5,
          nav:true,
          loop:false
        }
    }
  });


  owl.on("dragged.owl.carousel", function (event) {
    var direction = event.relatedTarget['_drag']['direction'];
    if(direction=='left') {
      LoadMoreProjects();
    }
  });

  $(document).on('click','.carousel-wrapper .customControl', function(e){
    e.preventDefault();
    var action = $(this).attr('data-action');
    if(action=="next") {
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
    carouselDiv.attr('data-page',next);
    $('.hiddenData').load( loadURL + " .hiddenData", function(){
      if( $('.hiddenData .hiddenData .thumbnail').length > 0 ) {
        var items = [];
        $('.hiddenData .hiddenData .thumbnail').each(function(e){
          $('#carousel').owlCarousel('add', this.outerHTML).owlCarousel('update');
        });
      }
    });
  }

}); 
