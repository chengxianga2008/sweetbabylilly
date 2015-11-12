<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '1654589674798567');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1654589674798567&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<div class="landing_page container no-padding">
	<div class="row">
		<div class="col-lg-7 col-md-12 col-sm-12 no-padding">
			<div class="logo-wrapper">
				<img src="<?php echo get_stylesheet_directory_uri () . '/css/images/logo.png'; ?>">
			</div>
			<div class="ebook-wrapper">
				<img src="<?php echo get_stylesheet_directory_uri () . '/css/images/ebook.jpg'; ?>">			
			</div>
			
			<div class="visible-xs visible-ms clearfix"></div>
			<div class="logo-text1">
				<h1 class="center-block">want the <span>best</span> for <span>you</span> and your <span>baby?</span></h1>
			</div>
			<div class="logo-text2">
			    <h1 class="center-block"><a href="http://www.sweetbabylilly.com.au">www.sweetbabylilly.com.au</a> is your place for baby tips, hints and
			    the latest products!</h1>
			</div>
			<div class="arrow-wrapper">
				<p>Sign up to the right to claim your FREE Ebook</p>
				<img src="<?php echo get_stylesheet_directory_uri () . '/css/images/arrow.png'; ?>">
			
			</div>

		</div>

		<div class="col-lg-5 col-md-12 col-sm-12 no-padding">

			
			
			<div class="tags-wrapper">
				<img src="<?php echo get_stylesheet_directory_uri () . '/css/images/tags.png'; ?>">
			
			</div>
			
			<div class="babies-wrapper">
				<img src="<?php echo get_stylesheet_directory_uri () . '/css/images/babies.png'; ?>">
			
			</div>
			
			<div class="clearfix"></div>
			
			<div class="landing-form box center-block">

				<form class="form-horizontal" action="" method="post" >
				
				    <?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
					<div class="form-group">
						<label for="landing_form_name" class="col-lg-3 col-xs-12 control-label">Name:</label>
						<div class="col-lg-9 col-xs-12">
							<input type="text" required="" class="form-control" id="landing_form_name" name="landing_form_name"
								placeholder="please enter your name">
						</div>
					</div>
					
					<div class="form-group">
						<label for="landing_form_email" class="col-lg-3 col-xs-12 control-label">E-mail:</label>
						<div class="col-lg-9 col-xs-12">
							<input type="email" required="" class="form-control" id="landing_form_email" name="landing_form_email"
								placeholder="please enter email address" >
						</div>
					</div>
					
					<div class="form-group">
						<div class="center-block">
							<button id="submit-button" type="submit" class="btn btn-primary btn-raised center-block">Grab Your Free Copy Now</button>
						</div>
					</div>
				</form>

			</div>
			
		</div>


	</div>

</div>