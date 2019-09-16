// JavaScript Document

$(document).ready(function () {

  $( window ).resize(function() {

    if($(window).width() > 1160){

      $.sidr('close', 'sidr');

    }

    updateIframeHeight();
    

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
 
  var date = new Date()
  var currentYear = date.getFullYear();

  function initializePage() {

    createHeaderSlider();

    
  }

  /***** END INTIIALIZE FUNCTION *******/

  /***** CREATE HEADER SLIDER *******/

  var iframeHeight = 0;
  function createHeaderSlider() {

    $('.bannerContainer .icon').animate({
      'top': '50%',
      },
      1000, function() {
        
        $(this).delay(1000).fadeOut(1000,function(){
          $('.bannerContainer form').show().animate({
            'top': '40%'},
            1000, function() {
            /* stuff to do after animation is complete */
          });
        })

    });

    updateIframeHeight();

    $('#mainSlider').sliderPro({
      autoHeight: true,
      width: '100%',
      fade: false,
      fadeOutPreviousSlide: false,
      autoplayDelay: 10000,
      buttons: true,
      arrows: true,
      fadeArrows: false,
      autoScaleLayers: false,
      slideDistance: 0,
      waitForLayers: true,
      fadeCaption: true,
      endVideoAction: 'nextSlide',
      init: function () {

      },
      gotoSlide: function (index) {

      }, gotoSlideComplete: function (index) {

      }
    });
   
  }

  function updateIframeHeight(){

    iframeHeight = $(window).width() * (1080/1920);

    if($(window).width()>1000){
      $(".bannerContainer iframe").height(iframeHeight);
    }
    

  }

  /***** END CREATE HEADER SLIDER *******/


  /***** MOBILE MENU FUNCTIONALITY *******/


  $('.menuOpener').sidr({

    side: 'right',
    speed: 500,
    onOpen: function () {

      $(".menuOpener").toggleClass('closer');


    }, onClose: function () {

      $(".menuOpener").toggleClass('closer');

    }

  });

  $("#sidr #mobileNav").navgoco({accordion: true});

  $("#sidr li").has("ul").addClass('accordionParent');

  //add smooth scrolling 
  $(".mainNav ul li a").on('click', function(event){

    //prevent default anchor click behavoir
    event.preventDefault();

    $(".mainNav ul li a").removeClass('current');
    $(this).addClass('current');
    
    //ensure that this.hash has a value
    if(this.hash !== ""){

      //store hash
      var hash = this.hash;

      //console.log($(hash).offset().top - 152);

      //smooth scroll effect
      $('html, body').animate({
        scrollTop: $(hash).offset().top - 20
      },500, function(){
        
      });
      
    }

    if($(this).hasClass('contact')){
      
      showContact();

    }
  });

  $('.bookTour').click(showContact);
  

  function showContact(){

    if($(window).width()>768){

      $('.globalForm').animate({
        'left': '70%',
        'right':'0%'
      },
        500, function() {
        /* stuff to do after animation is complete */
      });

      $('.bookTour').animate({
        'right':'30%'
      },500);

    }else{

      $('.globalForm').animate({
        'left': '0%',
        'right':'0%'
      },
        500, function() {
        /* stuff to do after animation is complete */
      });

      
    }

    

  }

  $('.globalForm .closer').click(closeContact);

  function closeContact(){

    

    $('.globalForm').animate({
      'left': '100%',
      'right':'-30%'},
      500, function() {
      /* stuff to do after animation is complete */
    });

    $('.bookTour').animate({
      'right':'0%'
    },500);


    

  }

  /***** END MOBILE MENU FUNCTIONALITY *******/

  $('.productDetails').waypoint(function() {

    $('.mainNav a').removeClass('current');
    $('.mainNav a.products').addClass('current');

    console.log('Product waypoint');
    

  });

  $('.centresWaypoint').waypoint(function() {

    $('.mainNav a').removeClass('current');
    $('.mainNav a.centres').addClass('current');

    console.log('Centres waypoint');

  });


  /***** PARALLAX FUNCTIONALITY *******/
  var controller = $.superscrollorama();

  //controller.addTween(.25, TweenMax.to($('.leaf1'), 6, {css:{top: 40}, ease:Quad.easeOut}));

  var scrollDuration = 400; 

  if($(window).width() > 1000){

    
  }

  /***** END PARALLAX FUNCTIONALITY *******/

  function escapeXml(string) {
    return string.replace(/[<>]/g, function (c) {
      switch (c) {
        case '<':
          return '\u003c';
        case '>':
          return '\u003e';
      }
    });
  }

  var pinsIcons = {
    za: escapeXml('<img class="logo" src="http://cre8ivedge.net/dev/kofisi/img/locations/pin_selected.png" /><div class="map-pin gain"><figure></figure></div>'),
    ug: escapeXml('<img class="logo" src="http://cre8ivedge.net/dev/kofisi/img/locations/pin_selected.png" /><div class="map-pin loss"><figure></figure></div>'),
    ke: escapeXml('<img class="logo" src="http://cre8ivedge.net/dev/kofisi/img/locations/pin_selected.png" /><div class="map-pin gain"></figure></div>'),
    tz: escapeXml('<img class="logo" src="http://cre8ivedge.net/dev/kofisi/img/locations/pin_selected.png" /><div class="map-pin gain"><figure></figure></div>')
  };

  /***** VECTOR MAP *******/
  var centres= locationJSON;

  var countries =locationJSON;

  /*var centres = [ {name: 'Wilson Business Park', coords: [-1.31618,
  36.814960], status: 'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/maps/centre1.jpg',description:
  'Description',location: '<h3Wilson Airport',url: 'singlelocation.php'},
  {name: 'Heritage Place Lagos', coords: [6.456065, 3.430564], status:
  'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/maps/centre2.jpg',description:
  'Description',location: 'Lagos, Nigeria',url: 'singlelocation.php'}, {name:
  '95 Riverside Drive', coords: [-1.269219, 36.791588], status: 'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg',description:
  'Description',location: 'Riverside Drive, Nairobi',url:
  'singlelocation.php'}, {name: '45 Karen Reit', coords: [-1.328843,
  36.717086], status: 'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/maps/centre1.jpg',description:
  'Description',location: 'Karen, Reit',url: 'singlelocation.php'}, {name:
  'Eden Square', coords: [-1.268346, 36.806394], status: 'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/maps/centre2.jpg',description:
  'Description',location: 'Eden Square, Westlands Road',url:
  'singlelocation.php'}, {name: 'Landmark Plaza', coords: [-1.294752,
  36.805398], status: 'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg',description:
  'Description',location: 'Location,Address',url: 'singlelocation.php'},
  {name: 'Oysterbay', coords: [-6.769620, 39.281515], status: 'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg',description:
  'Description',location: 'Location,Address',url: 'singlelocation.php'},
  {name: 'Rwenzori Towers', coords: [0.317256, 32.579876], status:
  'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/products/product2.jpg',description:
  'Description',location: 'Location,Address',url: 'singlelocation.php'},
  {name: 'Hyde Park', coords: [-26.121052, 28.039032], status: 'open',image:
  'http://cre8ivedge.net/dev/kofisi/img/products/product1.jpg',description:
  'Description',location: 'South Africa',url: 'singlelocation.php'} ];

  var countries = [
  
    {name: 'Kenya', 
    coords: [0.0236, 37.9062], 
    status: 'open',
    image: 'http://cre8ivedge.net/dev/kofisi/img/maps/centre1.jpg',
    description: 'Description',
    location: '<h3 style="">Eden Square</h3><article class="accordion"><p>Description</p><a  href="singlelocation.php">Explore this centre</a><img  src="http://cre8ivedge.net/dev/kofisi/img/maps/centre1.jpg"></article><h3>Wilson Airport</h3><article class="accordion"><p>Description</p><a  href="singlelocation.php">Explore this centre</a><img  src="http://cre8ivedge.net/dev/kofisi/img/maps/centre2.jpg"></article><h3>Karen</h3><article class="accordion"><p>Description</p><a  href="singlelocation.php">Explore this centre</a><img  src="http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg"></article>',
    url: 'singlelocation.php'},
    {name: 'Nigeria', 
    coords: [9.0820, 8.6753], 
    status: 'open',
    image: 'http://cre8ivedge.net/dev/kofisi/img/maps/centre2.jpg',
    description: 'Description',
    location: '<h3>Heritage Place</h3><article class="accordion"><p>Description</p><a  href="singlelocation.php">Explore this centre</a><img  src="http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg"></article>',
    url: 'singlelocation.php'},
    {name: 'Uganda', 
    coords: [1.3733, 32.2903], 
    status: 'open',
    image: 'http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg',
    description: 'Description',
    location: '<h3>Rwenzori Towers</h3><article class="accordion"><p>Description</p><a  href="singlelocation.php">Explore this centre</a><img  src="http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg"></article>',
    url: 'singlelocation.php'},
    {name: 'South Africa', 
    coords: [-26.195246, 28.034088], 
    status: 'open',
    image: 'http://cre8ivedge.net/dev/kofisi/img/maps/centre1.jpg',
    description: 'Description',
    location: '<h3>Hyde Park</h3><article class="accordion"><p>Description</p><a  href="singlelocation.php">Explore this centre</a><img src="http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg"></article>',
    url: 'singlelocation.php'},
    {name: 'Tanzania', 
    coords: [-6.270353, 34.823454], 
    status: 'open',
    image: 'http://cre8ivedge.net/dev/kofisi/img/maps/centre2.jpg',
    description: 'Description',
    location: '<h3>Oysterbay</h3><article class="accordion"><p>Description</p><a  href="singlelocation.php">Explore this centre</a><img src="http://cre8ivedge.net/dev/kofisi/img/maps/centre3.jpg"></article>',
    url: 'singlelocation.php'},
  
  ];

*/

  // V.1.5.1 

  // $('.map').vectorMap({
  //   map: 'africa_en',
  //   backgroundColor: '#232a3b',
  //   borderColor: '#fff',
  //   color: '#232a3b',
  //   borderWidth: 0.5,
  //   borderOpacity: 1,
  //   enableZoom: true,
  //   zoomButtons: true,
  //   multiSelectRegion: true,
  //   hoverColor:'#fff',
  //   selectedColor: '#fff',
  //   selectedRegions: ['za', 'ug', 'ke', 'tz'],
  //   pins: pinsIcons,
  //   pinMode: 'content',
  //   onLoad: function (event, map) {


  //   }

  // });

  // v 2.0.3

  var currentMarkerId;

  if ($('.map').length) {

    $('.map').vectorMap({
      map: 'africa_mill',
      backgroundColor:'232a3b',
      selectedColor: '#fff',
      enableZoom: true,
      zoomOnScroll:true,
      multiSelectRegion: true,
      selectedRegions: ['ZA', 'UG', 'KE', 'TZ','NG'],
      markers: countries.map(function(h){ return {name: h.name, latLng: h.coords} }),
      markersSelectable: true,
      hoverColor:true,
      markerStyle:{
        initial: {
          fill: 'http://cre8ivedge.net/dev/kofisi/img/locations/pin.png',
          "fill-opacity": 1,
        },
        hover: {
          fill: 'http://cre8ivedge.net/dev/kofisi/img/locations/pin_selected.png',
          "fill-opacity": 1,
          cursor: 'pointer'
        },selected:{
          fill: 'http://cre8ivedge.net/dev/kofisi/img/locations/pin_selected.png',
          "fill-opacity": 1,
        }
      },
      markerLabelStyle:{
        initial: {
          'font-family': 'Nobel Book',
          'font-size': '12',
          'font-weight': 'bold',
          cursor: 'default',
          fill: 'white'
        },
        hover: {
          cursor: 'pointer'
        }
      },
      regionStyle:{
        initial: {
          fill: '#232a3b',
          "fill-opacity": 1,
          stroke: 'white',
          "stroke-width": 1,
          "stroke-opacity": 1
        },
        hover: {
          fill:'#232a3b',
          "fill-opacity": 1,
          cursor: 'pointer'
        },
        selected: {
          attribute: 'image',
          "fill-opacity": 1,
          fill:'http://cre8ivedge.net/dev/kofisi/img/maps/map_texture2.png'
          
        },
        selectedHover: {
          attribute: 'image',
          "fill-opacity": 1,
          fill:'http://cre8ivedge.net/dev/kofisi/img/maps/map_texture2.png'
        }
      },
      series: {
        markers: [{
          attribute: 'image',
          scale: {
            'open': 'http://cre8ivedge.net/dev/kofisi/img/locations/pin.png',
            'selected': 'http://cre8ivedge.net/dev/kofisi/img/locations/pin_selected.png',
            'activeUntil2022': 'http://cre8ivedge.net/dev/kofisi/img/locations/pin.png'
          },
          values: countries.reduce(function(p, c, i){ p[i] = c.status; return p }, {})
        }]
      },
      onLoad: function (event, map) {


      },onMarkerTipShow: function(event, label, index){

        //console.log(index);
        label.html(
          '<h3 style="color: #232a3b;font-family:\'Nobel\';padding-left:30px;padding-right:30px;margin-bottom:15px;margin-top:25px;">'+countries[index].name+'</h3>'+'<p style="color: #232a3b;padding-left:30px;padding-right:30px;margin-bottom:15px;">Location '+countries[index].location+'</p>'+'<a style="padding-left:30px;color: #232a3b;font-size:16px;padding-right: 35px;margin-bottom:15px;height: 25px;background: url(img/locations/button_bg.png) right center no-repeat;color: #232a3b;display: inline-block;line-height: 25px;">Explore this centre</a>'+'<img style="max-width:220px;" src="'+countries[index].image+'">'
        ).css({'background-color':'#fff','width':'220px','display':'none !important'});

        label.html('').css();

      },onMarkerClick:function(event,code){

        currentMarkerId = code; 

        //map.series.setValues( centres.reduce(function(p, c, i){ p[i] = c.status; return p }, {}) );


      },onRegionTipShow: function(event, label, code){
        label.html('').css();
      }

    });

  }

  

  

  $( "body" ).on( "click", ".jvectormap-marker", function() {

    currentMarkerId = $(this).data('index'); 

    for (var i = 0; i < countries.length; i++) {
      console.log('looping centres');
      countries[i].status = 'open';
    }

    $('.jvectormap-click').html(
      '<figure class="closer">X</figure><span class="highlight"></span>'+countries[currentMarkerId].location+''
    ).css({'background-color':'#fff','width':'280px','display':'block !important'}).css('top', event.pageY - 45).css('left',event.pageX+45).css('position','absolute').css('display','block');

    countries[currentMarkerId].status = 'selected';

    //console.log(currentMarkerId + 'Marker Id' +centres[currentMarkerId].status);

    var mapObject = $('.map').vectorMap('get', 'mapObject');

    mapObject.series.markers[0].setValues(countries.reduce(function(p, c, i){ p[i] = c.status; return p }, {}) );

    

    //$(this).attr('href','http://cre8ivedge.net/dev/kofisi/img/locations/pin_selected.png');

    
  });

  $( "body" ).on( "click", ".jvectormap-click .closer", function() {
    $('.jvectormap-click').css('display','none');
    $(".jvectormap-marker").attr('href','http://cre8ivedge.net/dev/kofisi/img/locations/pin.png');
    centres[currentMarkerId].status = 'open';
  });


  $( "body" ).on( "click", ".jvectormap-click h3", function() {
    
    $('.jvectormap-click h3').removeClass('open');
    $('.jvectormap-click .accordion').slideUp();
    $(this).addClass('open').next('.accordion').slideDown();
    
  });

  /***** END VECTOR MAP *******/

  /***** ISOTOPE GRID FUNCTIONALITY *******/


  var $container = $('.isotopeWrapper');

  $container.imagesLoaded( function() {

    $container.isotope({

      itemSelector : '.item',
      percentPosition: true,
      layoutMode: 'packery',
      packery: {
        columnWidth: '.one_column'
      }

    });
    
  });

  /***** END ISOTOPE GRID FUNCTIONALITY *******/

  /***** TAB CONTENT *******/

  $(".tabNavigation li").removeClass("current");
  $(".tabNavigation li:first").addClass("current");
  $(".tabContent").hide();
  $(".tabContent:first").show();

  $(".tabNavigation li").click(tabContent);

  var targetTab = "";

  function tabContent(){

    targetTab = $(this).data("target");

    $(".tabNavigation li").removeClass("current");
    $(this).addClass("current");

    $(".tabContent").hide();
    $(".tabContent."+targetTab).show();

  }


  /***** END TAB CONTENT *******/

  /***** TESTIMONIALS CAROUSEL *******/

  createCarousel();

  function createCarousel() {
    $(".locationCarousel").owlCarousel({

      autoPlay: 5000, //Set AutoPlay to 3 seconds
      items: 1,
      itemsDesktop: [1199, 1],
      itemsDesktopSmall: [979, 1],
      itemsTablet : [768, 1],
      responsive: true,
      pagination: true,
      afterInit: function () {
        
      }

    });

    $(".featureCarousel").owlCarousel({

      autoPlay: 5000, //Set AutoPlay to 3 seconds
      items: 1,
      itemsDesktop: [1199, 1],
      itemsDesktopSmall: [979, 1],
      itemsTablet : [768, 1],
      responsive: true,
      pagination: true,
      navigation : true,
      navigationText : ["", ""],
      afterInit: function () {
        
      }

    });



    $(".relatedCarousel").owlCarousel({

      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items: 3,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [979, 2],
      itemsTablet : [768, 1],
      responsive: true,
      pagination: true,
      afterInit: function () {
        
      }

    });

    $('.mapCarousel').owlCarousel({

      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items: 2,
      itemsDesktop: [1199, 2],
      itemsDesktopSmall: [979, 2],
      itemsTablet : [768, 1],
      responsive: true,
      pagination: false,
      afterInit: function () {
        
      }

    });

    $(".centersCarousel .carousel").owlCarousel({

      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items: 3,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [768, 2],
      itemsTablet : [500, 1],
      responsive: true,
      pagination: true,
      stopOnHover : true,
      afterInit: function () {
        
      }

    });
  }

  //Click event for filters
  $('.centersCarousel select').change(function(e){

      cat = $(this).val();
      filterCarousel( cat );
  });

  function filterCarousel(cat){

    if ( cat == 'all'){
      $('#centres-hidden .item').each(function(){
         var owl   = $(".centersCarousel .carousel").data('owlCarousel');
         elem      = $(this).parent().html();

         owl.addItem( elem );
         $(this).parent().remove();
      });
    }else{
      $('#centres-hidden .item.'+ cat).each(function(){
         var owl   = $(".centersCarousel .carousel").data('owlCarousel');
         elem      = $(this).parent().html();

         owl.addItem( elem );
         $(this).parent().remove();
      });

      $('.centersCarousel .item:not(.item.'+ cat + ')').each(function(){
         var owl   = $(".centersCarousel .carousel").data('owlCarousel');
         targetPos = $(this).parent().index();
         elem      = $(this).parent();

         $( elem ).clone().appendTo( $('#centres-hidden') );
         owl.removeItem(targetPos);
      });
    }

  }

  /***** END TESTIMONIALS CAROUSEL *******/

  /***** VIDEO BACKGROUND PLAYER *******/

  $(".backgroundVideo .playButton").click(playBackgroundVideo);

  var currentVideoSrc,updatedVidSrc;

  function playBackgroundVideo(){

    currentVideoSrc = $(".backgroundVideo iframe").attr("src");

    console.log(currentVideoSrc);

    $(".backgroundVideo iframe").css({
      "z-index":10
    });

    updatedVidSrc = currentVideoSrc+"?autoplay=1&controls=1&rel=0&showinfo=0";

    $(".backgroundVideo iframe").attr("src",updatedVidSrc);

    $(".videoCloser").css("z-index","20");

  }

  $(".videoCloser").click(closeBackgroundVideo);

  function closeBackgroundVideo(){

    $(".backgroundVideo iframe").css({
      "z-index":-1
    });

    $(".backgroundVideo iframe").attr("src",currentVideoSrc);

    $(".videoCloser").css("z-index","-1");

  }

  /***** END VIDEO BACKGROUND PLAYER *******/

  /***** ACCORDION *******/

  function setDefaultCategoryFilter(){

    //alert("Set default function called");

    $(".accordionContainer .accordion").slideUp();
    $(".accordionContainer .accordion:first").slideDown();
    $(".accordionContainer .accordionTitle:first").addClass("open");

  }

  $(".accordionContainer .accordionTitle").click(openAccordion);

  function openAccordion() {

    if ($(this).hasClass('open')) {

      $(".accordionContainer .accordionTitle").removeClass('open');
      $(".accordionContainer .accordion").slideUp();
      $(this).removeClass("open").next(".accordion").slideUp();

    } else {

      $(".accordionContainer .accordionTitle").removeClass('open');
      $(".accordionContainer .accordion").slideUp();
      $(this).addClass("open").next(".accordion").slideDown(function () {
        
      });

    }

  }
  /***** END ACCORDION *******/

  

  /***** FOOTER ACCORDION *******/

  $("footer h6").click(openFooterAccordion);

  function openFooterAccordion() {

    if ($(window).width() > 1000) {

    } else {

      if ($(this).hasClass('open')) {

        $("footer h6").removeClass('open');
        $("footer .accordion").slideUp();
        $(this).removeClass("open").next(".accordion").slideUp();

      } else {

        $("footer h6").removeClass('open');
        $("footer .accordion").slideUp();
        $(this).addClass("open").next(".accordion").slideDown();

      }

    }

  }

  /***** END FOOTER ACCORDION *******/

  

});