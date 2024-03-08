<?php get_template_part('templates/title-header_1/title', 'header-1'); ?>

<section class="title-header title-header-1">
	<div class="container">
		<div class="row">
			<div class="column-title col-md-4 pull-left col-xs-12">
			    <h1 class="title">404 Error</h1>
            </div>
			<div class="column-description col-md-8 col-xs-12">
			    <div class="description">Sorry, but the page you were trying to view does not exist</div>
			</div>
		</div>
    </div>
</section>

<section class="error-page error-page-1">
    <div class="container container-error">
    	<div class="row">
        	<div class="col-md-12">
                <div class="alert alert-warning">
                  <?php _e('Sorry, but the page you were trying to view does not exist.', 'cobalt'); ?>
                </div>
            </div>
            
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <p><?php _e('It looks like this was the result of either:', 'cobalt'); ?></p>
                <br />
                <ul>
                  <li><?php _e('a mistyped address', 'cobalt'); ?></li>
                  <li><?php _e('an out-of-date link', 'cobalt'); ?></li>
                </ul>
                <br />
                <?php get_search_form(); ?>
            	<br />
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>