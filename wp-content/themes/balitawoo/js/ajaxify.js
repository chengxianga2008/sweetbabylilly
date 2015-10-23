var $ = jQuery.noConflict();
$(document).ready( function() {

   $(".loadmore a").click( function(e) {
      e.preventDefault();
      page = $(this).attr("data-page");
      nonce = $(this).attr("data-nonce");

      $.ajax({
         type : "post",
         dataType : "json",
         url : ajaxify.ajaxurl,
         data : {action: "ajaxify_load_post", page : page, nonce: nonce},
         success: function(response) {
            if(response.type == "success") {
               add_posts(response.data);
            }
            else {
               alert(response.type);
               // alert("Your vote could not be added");
            }
         }
      }).done( function(){
         $(".format-gallery .framebox > ul").addClass('rslides');
         $(".format-gallery .framebox > ul").parent().addClass("wrp-sld");

         $(".rslides").responsiveSlides({
            auto: false,
            pager: false,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            before: function () {
             $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
             $('.events').append("<li>after event fired.</li>");
            }
         });
      });   

   });

   function add_posts ( data ) {
      for ( counter = 1; counter <= data.length; counter++ ) {
         if( 0 == counter % 2 ) {
            $('.postleft').append(data[counter-1]); 
         }
         else {
            $('.postright').append(data[counter-1]);
         }
      }
      $('.loadmore a').attr('data-page', parseInt( $('.loadmore a').attr('data-page') ) + 1);
   }

})