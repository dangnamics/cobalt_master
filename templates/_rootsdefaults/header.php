<header class="banner navbar navbar-default navbar-static-top navbar-inverse" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
		</div>

		<nav class="collapse navbar-collapse" role="navigation">
			<?php
				if (has_nav_menu('primary_navigation')) :
					wp_nav_menu(array(
						'theme_location' => 'primary_navigation', 
						'walker' => new Cobalt_Nav_Walker(Cobalt_Nav_Walker::RRCB_NAV_MENU_MODE_DROPDOWN), 
						'menu_class' => 'nav navbar-nav',
						'depth' => 2
						));
				endif;
			?>
		</nav>
	</div>
</header>

<header>

</header>
