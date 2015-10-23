<?php if ( is_active_sidebar( 'primary' ) ) : ?>

	<div class="widget-area sidebar" id="secondary">
		<?php dynamic_sidebar( 'primary' ); ?>
	</div>

<?php endif; ?>