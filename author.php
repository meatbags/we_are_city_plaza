<?php get_header(); ?>

	<?php
		the_author();
		the_author_meta("description");

		while ( have_posts() ) : the_post();
		
		the_permalink();
		the_title();
		the_excerpt();
		
		// do stuff
		
		endwhile;
	?>

<?php get_footer(); ?>