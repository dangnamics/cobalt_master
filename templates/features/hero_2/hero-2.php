<?php
/* Feature Name: Hero-2 v.1
 * Feature Function: Displays images, text or combination as carousel slider
 * Date: 2015
 * Last Modified: 09/22/2016
 * Notes : This feature is expansion of hero-1 with additional options. Text option only implemented on OKC website. First used on SAMM, now on 
 * third edition for LOL.
 * 
 */
defined("BOOTSTRAP_COLUMNS") or define("BOOTSTRAP_COLUMNS", 12);

$defaultOptions = [
    "hero_items" => [
        [
	    "display_mode"=>"full",     // Can be "full" "side"or "none"
        "caption_position"=>"right", // Can be "right" or "left"
	    "image"=>"",
	    "title"=>"",
	    "sub-title"=>"",
	    "call-to-action-copy"=>"",
        "call-to-action-url"=>"",
        "call-to-action-class"=>"btn btn-donate",
        "content_percentage"=>42,
        "post"=>null
        ]
    ],
    "hero_imageSize-full" => ["width"=>740, "height"=>320],
    "hero_imageSize-side" => ["width"=>540, "height"=>320],
    "hero_imageSize-none" => ["width"=>540, "height"=>320],
    "hero_default-display-mode"=>"full",
    "hero_default-caption-position"=>"right",
    "hero_default-call-to-action-copy"=>"Learn More",
    "hero_default-call-to-action-class"=>"btn btn-donate",
    "hero_default-content_percentage"=>42,
    "hero_carousel-left-arrow-class" => "fa fa-chevron-left",
    "hero_carousel-right-arrow-class" => "fa fa-chevron-right",
	];
$options = rrcb_featureApplyDefaults($defaultOptions);


$heroItems = $options["hero_items"];
?>
<div id="hero_<?php _e($options["instanceName"]); ?>" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner container-jumbotron" role="listbox">
<?php if(count($heroItems) > 1) { ?>
        <!-- Indicators -->
        <ol class="carousel-indicators">
<?php 
          for ($i = 0; $i < count($heroItems); $i++) { 
              $active = $i == 0 ? " class=\"active\"" : "";
              _e("<li data-target=\"#hero_{$options["instanceName"]}\" data-slide-to=\"{$i}\"{$active}></li>");
          }
?>
        </ol>
<?php } ?>
<!--[if gte IE 9]>
  <style type="text/css">
    .bg {
       filter: none;
    }
  </style>
<![endif]-->
<?php
$active = " active";
foreach ($heroItems as $heroItem)
{
    // Overriding defaults if nothing is specified (like if only a post_object is used).
    if(!isset($heroItem['display_mode'])) $heroItem['display_mode'] = $options['hero_default-display-mode'];
    if(!isset($heroItem['caption_position'])) $heroItem['caption_position'] = $options['hero_default-caption-position'];
    if(!isset($heroItem['call-to-action-copy'])) $heroItem['call-to-action-copy'] = $options['hero_default-call-to-action-copy'];
    if(!isset($heroItem['call-to-action-class'])) $heroItem['call-to-action-class'] = $options['hero_default-call-to-action-class'];
    if(!isset($heroItem['content_percentage'])) $heroItem['content_percentage'] = $options['hero_default-content_percentage'];

    if(isset($heroItem['post']))
    {
        $post = $heroItem['post'];
        if(is_numeric($post))
            $post = get_post($post);
        
	    $heroItem["image"] = rrcb_getPostThumbnail($post->ID, $options["hero_imageSize-".$heroItem['display_mode']], $post->post_title);
	    $heroItem["title"] = $post->post_title;
	    $heroItem["sub-title"] = strip_tags(rrcb_getExcerpt($post));
        $heroItem["call-to-action-url"] = get_post_permalink($post->ID);
    }

    if(!isset($heroItem['image']) || !isset($heroItem['title']) || (empty($heroItem['image']) && empty($heroItem['title'])))
        continue;

    $content_display = $heroItem["display_mode"];
    if(isset($heroItem["content_percentage"])){
    $contentCols = floor(($heroItem["content_percentage"]/100) * BOOTSTRAP_COLUMNS);
    $imageCols = BOOTSTRAP_COLUMNS - $contentCols;
    }
    if(!empty($heroItem["image"])){
    $heroImage = rrcb_findImageMetaFromSizeAndAcfImage($options["hero_imageSize-".$heroItem['display_mode']], $heroItem["image"]);

    $heroImageUrl = $heroImage["url"];
    }
    $headlineCopy = $heroItem["title"];
    $headlineSubCopy = $heroItem["sub-title"];

    $page_title = get_the_title();
    $post = get_post(get_the_ID());
    if(empty($headlineCopy))
        $headlineCopy = $post->post_title;
    if(empty($headlineSubCopy))
        $headlineSubCopy = rrcb_getExcerpt($post, 500);
    //if(empty($heroImageUrl))
        //$heroImageUrl = rrcb_getPostThumbnail($post->ID, [($imageCols * 100), 500], $headlineCopy);
    if(!empty($heroImageUrl)){
        $heroItem["imageCols"] = $imageCols;
        $heroItem["contentCols"] = $contentCols;   
        $heroItem["image"] = $heroImageUrl;
        $heroItem["imageHeight"] = $heroImage["height"];
        $heroItem["hero_imageSize"] = $options["hero_imageSize-".$heroItem['display_mode']];
    }
    set_query_var("heroItem", $heroItem);
    set_query_var("heroItem_active", $active);
    get_template_part("templates/features/hero_2/heroItem", $heroItem["display_mode"]);
    set_query_var("heroItem", null);
    $active = "";
}
set_query_var("heroItem_active", null);
if(count($heroItems) > 1) {
?>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#hero_<?php _e($options["instanceName"]); ?>" role="button" data-slide="prev">
          <span class="left arrow-control <?php _e($options['hero_carousel-left-arrow-class']); ?>" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#hero_<?php _e($options["instanceName"]); ?>" role="button" data-slide="next">
          <span class="right arrow-control <?php _e($options['hero_carousel-left-arrow-class']); ?>" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
<?php } ?>
</div>
