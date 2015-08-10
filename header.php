<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php
			if ( is_front_page() ) {
				echo bloginfo('description');
			} else {
				echo bloginfo('name') . wp_title();
			}
		?>
	</title>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="page-header">
		<a class="mobile-menu-toggle js-menu-toggle">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</a>

		<div class="header-inner">
			<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
			<h2>Code <span>/</span> Design <span>/</span> Snapshots</h2>
		</div>

		<nav>
			<div class="menu-items-wrapper">
				
				<?php 
					$defaults = array(
						'container' => false,
						'theme_location' => 'primary-menu',
						'menu_class' => 'menu-items'
					);

					wp_nav_menu( $defaults );
				?>
								
				<a class="search-toggle js-menu-toggle" href="javascript:;">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>
			
			<div class="search-container">
				<div class="search-box">
					<div class="search-box-inner">
						<form class="search-form" role="search" method="get" action="<?php bloginfo('url'); ?>">
							<label>Search for</label>
							<input type="search" id="search-field" class="search-field" name="s" placeholder="type then hit enter">
							<input type="submit" class="search-submit" value="Search">
						</form>
					</div>

					<div class="recents-wrapper">

						<?php
							tm_get_recents(2);
							tm_get_recents(3);
							tm_get_recents(4);
						?>

					</div>
				</div>
			</div>
		</nav>
		
		

		
	</header>

	<div id="main" class="site-main">