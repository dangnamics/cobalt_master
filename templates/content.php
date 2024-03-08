<?php 
/*
Template Name: Content Template
*/
function rrcb_content_wp_calculate_image_sizes($sizes, $size, $imageUrl, $imageMeta, $attachmentId){
    $width = rrcb_decodeDesiredImageSize($size)['width'];
    
    //return "(min-width:480px) and (max-width:990px) 100vw, (min-width:991) and (max-width:1199) {$width}px, " . $sizes;
    return "(min-width: 991px) {$width}px, 100vw";
}
add_filter('wp_calculate_image_sizes','rrcb_content_wp_calculate_image_sizes', 10, 5);

get_template_part('templates/page', 'banner');
if(is_single()){
    rrcb_showFeature("mixed", [
        "payload"=>[
            //"content"=>[
            //    "content_mode"=>"post-full",
            //    //"content_payload" => $the_query,
            //    "content_hideWrapperMarkup" => true
            //],
            "content"=>[
                "content_mode"=>"post"
              
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
                "container_class" => "container-mixed hidden-sm hidden-xs"
            ]
        ],
        "mixed_splitPercentage"=>[75,25],
    ]);
}else{
    rrcb_showFeature("content", ["content_mode"=>"post"]);

    $currentPage = get_post();
    $storiesPage = get_page_by_path('the-impact/stories-of-change');
    $showRelated = $currentPage->post_parent == $storiesPage->ID;
    if($showRelated){
        rrcb_showFeature("related",[
                "show_related"=>true, //defaults to not show
                "related_parent_page"=>"Stories of Change",
                "related_title"=>"Related Stories",
                "related_imageSize"=> "stories-more-thumbnail",
                'related_summary-max-character-count' => 135, //optional if require
                "related_use-place-holder-image" => true,
                'thumbnail_hideInlineSizes' => false
                ]);
    }
}
?>