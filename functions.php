<?php 

add_theme_support( 'menus' );
add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );



function register_theme_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu')
		)
	);
}
add_action('init', 'register_theme_menus');



function tm_theme_styles() {
	wp_enqueue_style('main_css', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'tm_theme_styles');



function tm_theme_js() {
	//wp_enqueue_script('modernizr_js', get_template_directory_uri() . '/js/vendor/modernizr-2.8.3.min.js', '', '', false);
	wp_enqueue_script('main_js', get_template_directory_uri() . '/js/min/main-min.js', array('jquery'), '', true);

}
add_action('wp_enqueue_scripts', 'tm_theme_js');



// Numbered Pagination
if ( !function_exists( 'tm_pagination' ) ) {
	function tm_pagination() {
		
		$prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
		$next_arrow = is_rtl() ? '&larr;' : '&rarr;';
		
		global $wp_query;
		$total = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			if ( !$current_page = get_query_var('paged') )
				$current_page = 1;
			if ( get_option('permalink_structure') ) {
				$format = 'page/%#%/';
			} else {
				$format = '&paged=%#%';
			}

			echo '<div class="pagination">';

			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );

			echo '</div>';
		}
	}
}


// Get parent category ... used to add class to articles for correct coloring
function get_first_category_ID() {
	$category = get_the_category(); 
	$category_parent_id = $category[0]->category_parent;
	
	if ( $category_parent_id != 0 ) {
		$category_parent = get_term( $category_parent_id, 'category' );
		$css_slug = $category_parent->slug;
	} else {
		$css_slug = $category[0]->slug;
	}

	return $css_slug;
}



//Get recent headlines
function tm_get_recents($catID) {
	$args = array(
		'post_type' => 'post',
		'cat' => $catID,
		'posts_per_page' => '5'
	);
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		echo '<div class="recents-column">';
		echo '<h4>Recent in ' . get_cat_name($catID) . '</h4>';
		echo '<ul>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			echo '<li><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></li>';
		}
		echo '</ul>';
		echo '</div>';
	} 
	wp_reset_postdata();
}

?>