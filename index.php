<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
<div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'cobalt'); ?>
</div>
<?php get_search_form(); ?>
<?php endif; 
      $results = [];
      while (have_posts()) :
          the_post(); 
          $results = $wp_the_query->posts;
          //get_template_part('templates/content', get_post_format()); 
      endwhile; 
      if(!empty($results))
          rrcb_showFeature("newsfeed", [
          "newsfeed_articles" => $results,
          "newsfeed_summary-max-character-count" => 200,
                      "newsfeed_row-start-even" => $listStartEven,
                      "newsfeed_imageSize" => "list-page-thumbnail",
                      "newsfeed_use-place-holder-image" => true,
                      "newsfeed_caret-class-fa"=>"angle-right",
          ]);
?>

<?php if ($wp_query->max_num_pages > 1) : ?>
<nav class="post-nav">
    <ul class="pager">
        <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'cobalt')); ?></li>
        <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'cobalt')); ?></li>
    </ul>
</nav>
<?php endif; ?>
