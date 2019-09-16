// JavaScript Document

$(document).ready(function () {

  $( window ).resize(function() {
   

  });


  /***** PAGE PRELOADER *******/

  $('body').jpreLoader({

    showSplash: true,
    autoClose: true,
    splashID:"#preloader",
    showPercentage:false,
    splashFunction:function(){

      var min=0;
      var max = $("#preloader .intro").length;

      var randonQuote = Math.floor(Math.random() * (max - min)) + min;
      $("#preloader .intro:eq("+randonQuote+")").show();
    
    }

  }, function () {

    initializePage();

  });

  /***** END PAGE PRELOADER *******/

  /***** INTIIALIZE FUNCTION *******/
  // createHeaderSlider - Creates Main site slider
 

  function initializePage() {

    createHeaderSlider();

    
  }

  /***** END INTIIALIZE FUNCTION *******/

  /***** CREATE HEADER SLIDER *******/

  function createHeaderSlider() {


    $('#mainSlider').sliderPro({
      autoHeight: true,
      width: '100%',
      fade: false,
      fadeOutPreviousSlide: false,
      autoplayDelay: 10000,
      buttons: false,
      arrows: false,
      fadeArrows: false,
      autoScaleLayers: false,
      slideDistance: 0,
      waitForLayers: true,
      fadeCaption: true,
      thumbnailsPosition:'bottom',
      endVideoAction: 'nextSlide',
      init: function () {

      },
      gotoSlide: function (index) {

      }, gotoSlideComplete: function (index) {

      }
    });
   
  }

  /***** END CREATE HEADER SLIDER *******/

  

});