<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>


<h2 class="search-head"><?php printf( __( 'Search results for &ldquo;%s&rdquo;'), '<span>' . get_search_query() . '</span>' ); ?></h2>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'category-'.get_first_category_ID() ); ?> >
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h3 class="entry-title">', '</h3>' );
			else :
				the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			endif;
		?>
		<h4><?php the_category(', '); ?> <span>/</span> <?php the_time( 'M. j, Y' ); ?></h4>
	</header>

	<?php the_content(); ?>
</article>

<?php endwhile; else : ?>

<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

<?php endif; ?>

<?php 
	if ( ! is_single() ) :
		tm_pagination();
	endif;
?>



<?php get_footer(); ?>