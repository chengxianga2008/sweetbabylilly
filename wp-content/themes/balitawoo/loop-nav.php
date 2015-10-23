<?php if ( is_attachment() ) : ?>
		<?php previous_post_link( '%link', '<span class="previous">' . __( '<span class="meta-nav">&larr;</span> Return to entry', 'balitawoo' ) . '</span>' ); ?>

<?php elseif ( is_singular( 'post' ) ) : ?>

		<?php previous_post_link( '%link', '<span class="previous">' . __( '<span class="meta-nav">Prev</span> hendri', 'balitawoo' ) . '</span>' ); ?>
		<?php next_post_link( '%link', '<span class="next">' . __( 'Next <span class="meta-nav">&rarr;</span>', 'balitawoo' ) . '</span>' ); ?>

<?php elseif ( !is_singular() && current_theme_supports( 'loop-pagination' ) ) : loop_pagination( array( 'before' => '', 'after' => '','prev_text' => __( '<span class="meta-nav">Prev</span> Previous', 'balitawoo' ), 'next_text' => __( 'Next <span class="meta-nav">Next</span>', 'balitawoo' ) ) ); ?>

<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<span class="previous">' . __( '<span class="meta-nav"></span> Previous', 'balitawoo' ) . '</span>', 'nxtlabel' => '<span class="next">' . __( 'Next', 'balitawoo' ) . '</span>' ) ) ) : ?>

		<?php echo $nav; ?>

<?php endif; ?>