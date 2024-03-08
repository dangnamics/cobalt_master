<?php get_template_part('templates/content', 'single'); ?>
<section class="author-bio">
    <div class="container">
        
            <div class="author-bio row">
                <div class="col-md-2 avatar">
                    <?php echo get_avatar( get_the_author_meta('email'), '90' ); ?>

                </div>
			    <div class="author-info col-md-10">
				   
				   <p class="author-description"><?php the_author_meta('description'); ?></p>				   
				    
			    </div>
            <!--END .author-bio-->
            </div>
        
    </div>
</section>
<section class="comments-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        <?php
        if ( comments_open() || get_comments_number() ) {
		    comments_template();
	    }      
        ?>
           </div>
        </div>
   </div>
</section>
