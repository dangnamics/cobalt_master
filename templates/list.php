<?php
/*
Template Name: List Template
*/
get_template_part('templates/page', 'banner');
while (have_posts()) :
    the_post();
$latestBlogPosts = get_children([
        'post_parent' => get_the_ID(),
        'post_type' => 'page',
        'post_status' => 'publish',
        'orderby' => 'menu_order date',
        'order' => 'ASC'

    ]);
$listStartEven = false;
$content = rrcb_getContent();
if(is_page("Events")){
    $thumbnailImage = "events-page-thumbnail";
}else{
$thumbnailImage = "list-page-thumbnail";
}
if($content)
{
    rrcb_showFeature("content",
        ["content_payload"=>$content]
        );
}
rrcb_showFeature("newsfeed", [
                    "newsfeed_description"=>"Stay informed with the latest from our blog. ",
                    //"newsfeed_articles"=>$latestBlogPosts,
                    "newsfeed_summary-max-character-count" => 240,
                    "newsfeed_row-start-even" => $listStartEven,
                    "newsfeed_imageSize" => $thumbnailImage,
                    "newsfeed_use-place-holder-image" => true,
                    "newsfeed_caret-class-fa"=>"angle-right",
                    ]);
    endwhile; 
?>