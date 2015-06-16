<!--<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
	<input class="search-input" type="search" name="s" placeholder="<?php _e( 'Search', 'ifcfilms' ); ?>">
</form>-->

<!-- search -->
<div class="search">
	<form class="search-input-container" method="get" action="<?php echo home_url(); ?>" role="search">
		<a href="#" class="search-btn"><?php get_template_part('partials/svgs/icon', 'search'); ?></a>
		<input class="search-input" placeholder="<?php _e( 'Search', 'ifcfilms' ); ?>" type="search" value="" name="s">
    <!-- set it to only film post type results -->
    <input type="hidden" name="post_type" value="film">
	</form>
</div>
<!-- /search -->
