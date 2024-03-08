<?php
/*
Note:  (only for reference to previous version, line is not used for template) Template is not used, front-page.php is already set as Home page. This is the page for the blog main page.
 */
$category = get_queried_object();
$categoryvariable = $cat;

$pageTitle = get_cat_name($cat);
$queryString = "";

rrcb_showFeature("title-header", 
                    [
                    'title-header_title'=>$pageTitle,
                    ]);
rrcb_showFeature("breadcrumbs", ["container_class" => 'container hidden-xs']);

$postPerPage = 4;
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


$the_query = query_posts("cat={$categoryvariable}&post_type=post&post_status=publish&posts_per_page={$postPerPage}&paged={$pageNo}{$queryString}");

rrcb_showFeature("mixed", [
        "payload"=>[
            //"content"=>[
            //    "content_mode"=>"post-full",
            //    //"content_payload" => $the_query,
            //    "content_hideWrapperMarkup" => true
            //],
            "newsfeed"=>[
                "newsfeed_imageSize"=>"list-page-thumbnail",
                "newsfeed_summary-max-character-count" => 197,
                "newsfeed_summary-default" => "No summary found for this blog post.",
                "newsfeed_summary-use-content" => true,
                "newsfeed_articles"=>$the_query,
                "thumbnail_hideInlineSizes" => false,
                'newsfeed_cta-caret-class' => 'fa-caret-right',
                "newsfeed_keyline-after" => true,
            ],
            "mixed"=>[
                "mixed_numberOfRows"=>3,
                "mixed_numberOfColumns"=>1,
                "payload"=>[
                    "blog-categories"=>[
                        ],
                    "blog-article-list"=>[
                        ],
                    "blog-history"=>[
                        ],
                ],
                "container_class" => "container-mixed hidden-sm hidden-xs"
            ]
        ],
        "mixed_splitPercentage"=>[75,25],
    ]);
?>

<div class="blog-pagination container">
    <div class="row">
        <div class="pagination-prev-col col-md-2 col-sm-5 col-xs-6"><?php if($pageNo > 0) previous_posts_link( "< Newer posts"); ?></div>
        <div class="pagination-spacer-col col-md-8 col-sm-2 hidden-xs"></div>
        <div class="pagination-next-col col-md-2 col-sm-5 col-xs-6 text-right"><?php next_posts_link( "Older posts >"); ?></div>
    </div>
</div>


<?php 
wp_reset_query();

?>

