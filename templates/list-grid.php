<?php
/*
Template Name: List Grid Template
*/
get_template_part('templates/page', 'banner');
//rrcb_showFeature("hero", [
//    "hero_content-display-mode"=>"right",
//    "hero_content-percentage"=>50,
//    "hero_imageSize" => "grid-page-hero-thumbnail"
//    ]);
//rrcb_showFeature("breadcrumbs");
$content = rrcb_getContent();
if(!empty($content))
{
    rrcb_showFeature("content",
        ["content_payload"=>rrcb_getContent()]
        );
}
rrcb_showFeature("grid", [
    'grid_thumbnail-imageSize' => 'grid-page-thumbnail',
    "grid_excerpt-max-length"=>9999,
    'thumbnail_hideInlineSizes' => true,
    'grid_header-position' => 'headerUnder',
    "grid_excerpt-max-length"=>240,
    "grid_caret-class-fa"=>"",
    ]);
?>