</div>
<div class="animated text-section footer-animation">
	<div class="wave"></div>
		<!-- #colophon .site-footer -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<?php get_template_part( 'sidebar', 'subsidiary' ) ?>
			<?php
				$socmed_title = ( '' != of_get_option('tokokoo_social_header') ) ? of_get_option('tokokoo_social_header') : 'Elsewhere';
				$twitter = ( '' != of_get_option('tokokoo_tw') ) ? '<li><img src="'.get_template_directory_uri().'/img/ico_twitter.png" width="32" height="31"> <a href="http://www.twitter.com/'.of_get_option('tokokoo_tw').'">Follow our tweet</a></li>' : '';
				$flickr = ( '' != of_get_option('tokokoo_flickr') ) ? '<li><img src="'.get_template_directory_uri().'/img/ico_flickr.png" width="32" height="31"> <a href="http://www.flickr.com/'.of_get_option('tokokoo_flickr').'">Our Flickr Page</a></li>' : '';
				$facebook = ( '' != of_get_option('tokokoo_fb') ) ? '<li><img src="'.get_template_directory_uri().'/img/ico_facebook.png" width="32" height="31"> <a href="http://www.facebook.com/'.of_get_option('tokokoo_fb').'">Our Facebook Page</a></li>' : '';
	
			?>
			<?php if ( '' != $facebook || '' != $twitter || '' != $flickr ): ?>
			<section class="socmed widget">
			
				<h3><?php echo $socmed_title; ?></h3>
				<ul>
					<?php echo $twitter; ?>
					<?php echo $flickr; ?>
					<?php echo $facebook; ?>
					<!-- <li><img src="<?php echo get_template_directory_uri(); ?>/img/ico_twitter.png" width="32" height="31"> <a href="http://www.twitter.com/<?php echo $twitter; ?>">Follow our tweet</a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/img/ico_flickr.png" width="32" height="31"> <a href="http://www.flickr.com/"<?php echo $flickr; ?>>Our Flickr Page</a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/img/ico_facebook.png" width="32" height="31"> <a href="http://www.facebook.com/<?php echo $facebook; ?>">Our Facebook Page</a></li> -->
				</ul>
			</section>
			<?php endif; ?>
			<div class="clear"></div>
		</div>
	</footer>

	<!-- container -->
	<div  id="footer"  class="foot">
		<div class="container">
		<div class="footer-w1170">
		
				<div><img class="foothome" src="<?php echo get_template_directory_uri(); ?>/img/footerleft.png" width="202" height="190"></div>
		
				<div><img class="footapolo" src="<?php echo get_template_directory_uri(); ?>/img/footerright.png" width="202" height="190"></div>
		
			<div class="pay">
				<img src="<?php echo get_template_directory_uri(); ?>/img/ico_pay.png" width="155" height="22">
				<?php if ( !of_get_option('tokokoo_credits') ): ?>
				<p>
					<?php tokokoo_footer_text(); ?>
				</p>
				<?php endif; ?>
			</div>
		</div>
		</div>
		
		<!-- w1170 -->
	</div>
</div>	
</div>
	

	<!-- foot -->
<?php wp_footer(); ?>

<script type="text/javascript">

jQuery(document).ready(function($){
	   // cache the window object
	   $window = $(window);
	 
	   $('section[data-type="background"]').each(function(){
	     // declare the variable to affect the defined data-type
	     var $scroll = $(this);
	                     
	      $(window).scroll(function() {
	        // HTML5 proves useful for helping with creating JS functions!
	        // also, negative value because we're scrolling upwards                             
	        var yPos = -($window.scrollTop() / $scroll.data('speed')); 
	         
	        // background position
	        var coords = '50% '+ yPos + 'px';
	 
	        // move the background
	        $scroll.css({ backgroundPosition: coords });    
	      }); // end window scroll
	   });  // end section function

// 	var s = skrollr.init();

	   $('.text-section-1').waypoint(function(direction) {
		   $(this.element).toggleClass("fadeInLeft");
		 }, {
 		   offset: '70%'
		 });

		 
	   $('.text-section-2').waypoint(function(direction) {
		   $(this.element).toggleClass("fadeInRight");
		 }, {
 		   offset: '70%'
		 });

	   $('.footer-animation').waypoint(function(direction) {
		   $(this.element).toggleClass("fadeIn");
		 }, {
 		   offset: '70%'
		 });

	   $('.home-ebook-img').waypoint(function(direction) {
		   $(this.element).toggleClass("rollIn");
		 }, {
 		   offset: '70%'
		 });

	   $('.bottom-slide').waypoint(function(direction) {
		   $(this.element).toggleClass("fadeIn");
		 }, {
 		   offset: '70%'
		 });

	   var animation_arr = ["wobble", "bounce", "flash","rubberBand","shake", "jello"];
	   var i = 0;

	   
	   $('#logo').toggleClass("wobble");

	   $('#logo').on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
		   $('#logo').toggleClass(animation_arr[i]);
		   i++;
		   if(i==6){
			   i=0;
		   }
		   $('#logo').toggleClass(animation_arr[i]);
		   
		   
	   });

	   $(".parallax_section").parallax({
			
	   });

	//s.refresh($('#home_section_1'));
}); // close out script


</script>

</body>
</html>