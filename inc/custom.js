(function ($) {

    "use strict";

   // alert('HHH');
           

            $('.ajax-filters select').on('change', function(e){

                e.preventDefault();

                var $parent = $(".champions-cont"),

                school = $(".ajax-filters .school").val(),

                year = $(".ajax-filters .year").val(),

                number = $parent.attr("show");

                //alert(number);

                $.ajax({

                    type: 'POST',

                    dataType: 'json',

                    url: ajax_items.ajaxurl,

                    data: { 

                        'action': 'ajax_champions_filter', //calls ajax_product_overview

                        'school': school,

                        'year': year,

                        'number': number

                    },

                     beforeSend: function (response) {
                        var loader = '<div class="loader-container"><span class="loader"></span></div>';//<div class="loader"><img src="http://thisiskilifi.com/wp-content/themes/kilifi/img/ajax-loader.gif"></div>';
                        $parent.empty();
                        $parent.prepend(loader);                        
                    },
                    success: function (response) {

                       $parent.empty();

                       if(response.status){                           
                            $parent.html(response.content);
                            console.log("Champions filtered");         
                       }else{
                            $parent.html("<div class='alert alert-warning text-center'>" + response.content + "</div>");
                            console.log("Champions not filtered. The server return no results");
                       }                     
                    },

                });                

            });

})(jQuery);