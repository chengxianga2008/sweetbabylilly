var $ = jQuery.noConflict();
$(document).ready(function(){



	$('#mainnav').before('<div class="trigger-menu">MENU</div>');

	$(".trigger-menu").click(function(event) {
		$("#mainnav").slideToggle(400);
		/* Act on the event */
	});


	// $("#mainnav ul.menu > li:nth-child(1)").addClass("use-ico-home");
	// $("#mainnav ul.menu > li:nth-child(2)").addClass("use-ico-clothes");
	// $("#mainnav ul.menu > li:nth-child(3)").addClass("use-ico-gears");
	// $("#mainnav ul.menu > li:nth-child(4)").addClass("use-ico-gifts");




	$(".menu ul.sub-menu").hover(function() {
		$(this).parent().addClass("runing");
	}, function() {
		$(this).parent().removeClass("runing");
		// Stuff to do when the mouse leaves the element;
	});




	$(".cartbox .cartbox-top").click(function() {
		
		$(this).parent().find(".this-arrow").toggleClass('this-run');
		$(this).parent().find(".widget").fadeToggle(400, function() {

			
		});
	});


	// Taruh method disini
	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

	$('#slider').nivoSlider();
    $('#slides').slides({
		preload: true,
		generateNextPrev: true
	});

	$(document).imagesLoaded(function(){
		// Hanya untuk method slider & tabs

	});

	$(".woocommerce-tabs ul.tabs").addClass('cl');



	$(".format-gallery .framebox > ul").addClass('rslides');



	$(".format-gallery .framebox > ul").parent().addClass("wrp-sld");


      // Slideshow 4
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


$("select.orderby").chosen();
$(".woocommerce-ordering .chzn-single").append("<span class='arrow'>arrow</span>");

$(".woocommerce-ordering .chzn-single").click(function() {

	$(this).parents(".chzn-container-single").toggleClass("now-run");

	$(this).parents(".chzn-container-single").find(".chzn-drop").fadeToggle(400).toggleClass("jalan-dong");
	$(this).parents(".chzn-container-single").find(".arrow").toggleClass("arrow-open");

	// $(".woocommerce-ordering .chzn-single")
	// Act on the event
});







});

$(document).load(function(){

	$(".cartbox .cart_list li img, .sidebar .product_list_widget li img").wrap("<div class='this-wrap-img'/>");


});




