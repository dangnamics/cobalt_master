<?php
/*
Note:  (only for reference to previous version, line is not used for template) Template is not used, front-page.php is already set as Home page. This is the page for the blog main page.
 */
$category = get_queried_object();
$pageTitle = 'Blog';
$queryString = "";
if(is_a($category, 'WP_Post')) {
    $pageTitle = $category->post_title; 
}
else if (is_a($category, 'stdClass')) {
    $pageTitle = 'Category: '.$category->name;
    $queryString = "&category_name={$category->slug}";
}
else if (is_a($category, 'WP_User')) {
    $pageTitle = 'Posts written by - '.$category->data->display_name;
    $queryString = "&author={$category->ID}";
}
get_template_part('templates/page', 'banner');

$postPerPage = 5;
$pageNo = get_query_var('paged');
//$the_query = new WP_Query([
//        'numberposts' => $postPerPage,
//        'offset' => $pageNo * $postPerPage,
//        'category' => 'blog',
//        'orderby' => 'post_date',
//        'order' => 'DESC',
//        'post_type' => 'post',
//        'post_status' => 'publish'
//    ]);


$the_query = query_posts("cat=-6&post_type=post&post_status=publish&posts_per_page={$postPerPage}&paged={$pageNo}{$queryString}");

if($pageNo <=1){
    rrcb_showFeature("content", ["content_mode"=>"page"]);
}

rrcb_showFeature("mixed", [
        "payload"=>[
            //"content"=>[
            //    "content_mode"=>"post-full",
            //    //"content_payload" => $the_query,
            //    "content_hideWrapperMarkup" => true
            //],
            "newsfeed"=>[
                "newsfeed_imageSize"=>"blog-thumbnail",
                "newsfeed_summary-max-character-count" => 210,
                "newsfeed_summary-default" => "No summary found for this blog post.",
                "newsfeed_summary-use-content" => true,
                "newsfeed_articles"=>$the_query,
                "thumbnail_hideInlineSizes" => false,
                "newsfeed_display-author" => true,
                'newsfeed_cta-caret-class' => 'fa-caret-right',
                "newsfeed_keyline-after" => true,
            ],
            "mixed"=>[
                "mixed_numberOfRows"=>3,
                "mixed_numberOfColumns"=>1,
                "payload"=>[
                "blog-article-list"=>[
                        ],
                    "blog-categories"=>[
                        ],
                    "blog-history"=>[
                        ],
                ],
                "container_class" => "container-mixed hidden-sm hidden-xs hidden-md"
            ]
        ],
        "mixed_splitPercentage"=>[75,25],
    ]);
?>

<div class="blog-pagination container">
    <div class="row">
        <div class="pagination-prev-col col-md-6 col-sm-5 col-xs-6"><?php if($pageNo > 0) previous_posts_link( "< Newer posts"); ?></div>
        <div class="pagination-next-col col-md-6 col-sm-5 col-xs-6 text-right"><?php next_posts_link( "Older posts >"); ?></div>
    </div>
</div>


<?php 
wp_reset_query();

?>

