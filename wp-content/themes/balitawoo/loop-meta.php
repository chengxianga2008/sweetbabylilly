<?php if ( is_home() && !is_front_page() ) : ?>

	<div class="loop-meta">

		<h1 class="page-title"><?php echo get_post_field( 'post_title', get_queried_object_id() ); ?></h1>

	</div><!-- .loop-meta -->

<?php elseif ( is_category() ) : ?>

	<div class="loop-meta">

		<h1 class="page-title"><?php single_cat_title(); ?></h1>

	</div><!-- .loop-meta -->

<?php elseif ( is_tag() ) : ?>

	<div class="loop-meta">

		<h1 class="page-title"><?php single_tag_title(); ?></h1>

	</div><!-- .loop-meta -->

<?php elseif ( is_tax() ) : ?>

	<div class="loop-meta">

		<h1 class="page-title"><?php single_term_title(); ?></h1>

	</div><!-- .loop-meta -->

<?php elseif ( is_author() ) : ?>

	<?php $user_id = get_query_var( 'author' ); ?>

	<div id="hcard-<?php echo esc_attr( get_the_author_meta( 'user_nicename', $user_id ) ); ?>" class="loop-meta vcard">

		<h1 class="page-title fn n"><?php the_author_meta( 'display_name', $user_id ); ?></h1>

	</div><!-- .loop-meta -->

<?php elseif ( is_search() ) : ?>

	<div class="loop-meta">

		<h1 class="page-title"><?php printf( __( 'You are browsing the search results for "%s"', 'balitawoo' ), esc_attr( get_search_query() ) ); ?></h1>

	</div><!-- .loop-meta -->

<?php elseif ( is_date() ) : ?>

	<div class="loop-meta">
		
		<h1 class="page-title"><?php _e( 'Archives by date', 'balitawoo' ); ?></h1>

	</div><!-- .loop-meta -->

<?php elseif ( is_post_type_archive() ) : ?>

	<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>

	<div class="loop-meta">

		<h1 class="page-title"><?php post_type_archive_title(); ?></h1>

	</div><!-- .loop-meta -->

<?php elseif ( is_archive() ) : ?>

	<div class="loop-meta">

		<h1 class="page-title"><?php _e( 'Archives', 'balitawoo' ); ?></h1>

	</div><!-- .loop-meta -->

<?php endif; ?>