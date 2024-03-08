<?php
/**
 * Utility functions
 * Last Modified: 8/06/2016
 * Notes: Merge fix and changes from previous build (TD)
 */
include_once "viewmodels/rrcb_subsection_viewmodel.php";

function is_element_empty($element) {
  $element = trim($element);
  return !empty($element);
}

function rrcb_newsfeed_wp_calculate_image_sizes($sizes, $size, $imageUrl, $imageMeta, $attachmentId){
    global $__newsfeed_breakToFullScreen;
    $width = rrcb_decodeDesiredImageSize($size)['width'];

    //return "(min-width:480px) and (max-width:990px) 100vw, (min-width:991) and (max-width:1199) {$width}px, " . $sizes;
    return "(min-width: {$__newsfeed_breakToFullScreen}px) {$width}px, 100vw";
}

// Tell WordPress to use searchform.php from the templates/ directory
function cobalt_get_search_form() {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', 'cobalt_get_search_form');

/**
 * Add page slug to body_class() classes if it doesn't exist
 */
function cobalt_body_class($classes) {
  // Add post/page slug
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }
  return $classes;
}
add_filter('body_class', 'cobalt_body_class');

$featureOptions = null;
$defaultOptions = null;
$feature_name = 'None';
$feature_version = 0;
$instanceIndex = 0;
$hideWrapperMarkup = false;


function rrcb_showFeature($featureName, $options = null, $version = 1)
{
    global $featureOptions, $feature_name, $feature_version,$instanceIndex,$featureInstances;
    $sectionTag = isset($options["section_tag"]) ? $options["section_tag"] : "section";
    $containerClass = isset($options["container_class"]) ? $options["container_class"] : "container";
    $featureOptions = apply_filters("rrcb_featureOptions_{$featureName}_{$version}_override", $options);
    $feature_name = $featureName;
    $feature_version = $version;
    $instanceIndex++;
    // Add the feature to the list of features
    $numberOfPriorFeatures = 1;
    if(isset($featureInstances[$featureName]))
        $numberOfPriorFeatures = count($featureInstances[$featureName]) + 1;
    $featureInstances[$featureName]["{$featureName}_{$instanceIndex}"] = ($numberOfPriorFeatures);
    $hideWrapperMarkup = false;

    if(isset($options["{$featureName}_hideWrapperMarkup"]))
        $hideWrapperMarkup = $options["{$featureName}_hideWrapperMarkup"];

	$inBetweenSectionAndContainer = '';
	$inBetweenSectionAndContainer = apply_filters("rrcb_showFeature_{$featureName}_inbetween_section_and_container", $inBetweenSectionAndContainer);

    if(!$hideWrapperMarkup)
    {
        $sectionOpen = "<!--=== Feature: {$feature_name} | Version: {$feature_version} ===-->\n   <{$sectionTag} class=\"{$feature_name} {$feature_name}-{$feature_version} {$feature_name}-nth-{$numberOfPriorFeatures}\">\n{$inBetweenSectionAndContainer}        <div class=\"{$containerClass}\" >\n";
        echo apply_filters("rrcb_showFeature_{$featureName}_#{$numberOfPriorFeatures}_sectionOpen", apply_filters("rrcb_showFeature_{$featureName}_v{$version}_sectionOpen", apply_filters("rrcb_showFeature_{$featureName}_sectionOpen", apply_filters("rrcb_showFeature_sectionOpen", $sectionOpen))));
    }
    do_action("rrcb_showFeature_{$featureName}_container_before");

    $templateFilePath = locate_template("templates/features/{$featureName}_{$version}/{$featureName}-{$version}.php");
    if($templateFilePath)
    {
        include($templateFilePath);
        //$showFeatureFunction = "{$featureName}_showFeature";
        //if(function_exists($showFeatureFunction)) {
        //    call_user_func($showFeatureFunction);
        //}
    }
    else
        _e("        <!-- ERROR: Feature [{$featureName}-{$version}] not found! -->\n");

    do_action("rrcb_showFeature_{$featureName}_container_after");
    if(!$hideWrapperMarkup)
    {
        $sectionClose = "       </div> <!--/.{$containerClass}-->\n   </{$sectionTag}> <!--/.{$featureName}-{$version}-->\n  <!--=== // Feature: {$feature_name} | Version: {$feature_version} ===-->\n\n";
        echo apply_filters("rrcb_showFeature_{$featureName}_#{$numberOfPriorFeatures}_sectionClose", apply_filters("rrcb_showFeature_{$featureName}_v{$version}_sectionClose", apply_filters("rrcb_showFeature_{$featureName}_sectionClose", apply_filters("rrcb_showFeature_sectionClose", $sectionClose))));
    }
    $featureOptions = null;
}

function utils_rrcb_base_template_showing()
{
    global $featureInstances;
    $featureInstances = [];
}
add_action("rrcb_base_template_showing", "utils_rrcb_base_template_showing");



function rrcb_getImage($imageName)
{
    if (substr($imageName, 0,4) !== "http" && filter_var($imageName, FILTER_VALIDATE_URL) === FALSE)
    {
        return get_stylesheet_directory_uri() . "/images/" . $imageName;
    }
    else
    {
        return $imageName;
    }
}

function rrcb_checkPostThumbnail($postID, $size = 'thumbnail')
{
    if ( function_exists('has_post_thumbnail') && has_post_thumbnail($postID) )
    {
        if(is_array($size))
            $size = array_values($size);
        $thumbnailId = get_post_thumbnail_id($postID);
        $thumbnail = wp_get_attachment_image_src($thumbnailId , $size );

        if (!$thumbnail[0]) return false;
        else return $thumbnail[0];
    }
    return null;
}

function rrcb_getPostThumbnail($postID, $size = [400, 200], $text="", $usePlaceHolder = true)
{
    $imgW = 400;
    $imgH = 200;
    $link = rrcb_checkPostThumbnail($postID, $size);
    if(is_array($size))
    {
        $keys = array_keys($size);
        $imgW = $size[$keys[0]];
        $imgH = $size[$keys[1]];
    }
    elseif(is_string($size))
    {
        $imageSize = rrcb_decodeDesiredImageSize($size);
        if(isset($imageSize['width']))
            $imgW = $imageSize['width'];
        if(isset($imageSize['height']))
            $imgH = $imageSize['height'];
    }
    if(!$link && $usePlaceHolder)
    {
        if($imgW == 9999){
            $imgW = 400;
        }
        if($imgH == 9999){
            $imgH = 400;
        }

        $protocol = "http";
        if(!empty($_SERVER["https"]))
            $protocol = "https";
        $link = $protocol."://placehold.it/{$imgW}x{$imgH}";
        if($text)
            $link .= "&text={$text}";
    }
    return $link;
}

function rrcb_thePostThumbnail($postID, $size = [400, 200], $text="")
{
    _e(rrcb_getPostThumbnail($postID, $size, $text));
}

function rrcb_getExcerpt($post, $maxLength = 200, $defaultMessage = "")
{
    $excerpt = get_field('page_summary', $post->ID);
    if(!$excerpt)
        $excerpt = $post->post_excerpt;
    if(!$excerpt)
    {
        $excerpt = $defaultMessage;
    }
    if(!$excerpt)
    {
        if($maxLength < 1)
            $maxLength = 200;
        $excerpt = rrcb_removeUrlsFromString(wp_strip_all_tags(strip_shortcodes($post->post_content), true));
    }
    if(strlen($excerpt)>($maxLength-3))
    {
        $excerpt = substr($excerpt, 0, ($maxLength - 3))."...";
    }

    return $excerpt;
}

function rrcb_removeUrlsFromString($url){
  $U = explode(' ',$url);

  //$W =array();
  foreach ($U as $k => $u) {
    if (stristr($u,'http') || (count(explode('.',$u)) > 1)) {
      unset($U[$k]);
      return rrcb_removeUrlsFromString( implode(' ',$U));
    }
  }
  return implode(' ',$U);
}

function rrcb_theExcerpt($post, $maxLength = 200, $defaultMessage = "")
{
    _e(rrcb_getExcerpt($post, $maxLength, $defaultMessage));
}

function rrcb_getContent()
{
    $content = get_the_content();
    $content = apply_filters("the_content", $content);
    return $content;
}

function rrcb_getCallToAction($post, $default = "Read More")
{
    $coa = false;
    $hideCta = get_field("page_hide-call-to-action", $post->ID);
    if(!$hideCta){
        $coa = get_field("page_call-to-action", $post->ID);
        if(!$coa)
            $coa = $default;
    }
    return $coa;
}

function rrcb_theCallToAction($post, $default = "Read More")
{
    _e(rrcb_getCallToAction($post, $default));
}

function rrcb_theThumbnail($className, rrcb_subsection_viewmodel $sub)
{
    $imageSize = rrcb_decodeDesiredImageSize($sub->imageSize);
    $imageHeight = $imageSize["height"];
    $imageWidth = $imageSize["width"];

    $inlineSizes = $sub->hideInlineSizes ? "" : "width:{$imageWidth}px;height:{$imageHeight}px;background-position:50% 50%;background-size:cover;";
    $responsiveSizes = '';
    $responsiveSrcSet = '';
    if(isset($sub->imageAttachmentID) && !empty($sub->imageAttachmentID))
    {
        $responsiveSizes = wp_get_attachment_image_sizes($sub->imageAttachmentID, $sub->imageSize);
        $responsiveSrcSet = wp_get_attachment_image_srcset($sub->imageAttachmentID, $sub->imageSize);
    }

    $imageUrl = "src=\"{$sub->imageUrl}\"";
    if(!empty($responsiveSizes)){
        $imageUrl = "src=\"" . esc_url($sub->imageUrl)."\" srcset=\"". esc_attr($responsiveSrcSet) . "\" sizes=\"{$responsiveSizes}\"";
    }
    /*
     *  Removed to use actual images instead of image backgroup div container 10/29/2015
     * _e("<div class=\"{$className}\" style=\"background-image:url('{$sub->imageUrl}');{$inlineSizes}\"><img src=\"".rrcb_getImage("blank.png")."\" style=\"width:{$imageWidth}px; height:{$imageHeight}px;\" /></div>");
    */
     _e("<div class=\"{$className}\"><img {$imageUrl} alt=\"{$sub->imageTitle}\" class=\"img-responsive\"/></div>");
}

function rrcb_oddEven($val)
{
    if($val % 2 == 0)
        _e("even");
    else
        _e("odd");
}

function rrcb_getSubSections($layoutOptionItems, $childPostQueryArgs = [
            "post_type"     => "page",
            "numberposts"   => -1,
            "post_status"   => "publish",
            "orderby"       =>  array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
        ])
{
    $out = [];
    // In this function, we're going to set up the rules for handling parent pages that
    // want to load in sub sections.
    // The priority flow here is:
    // (1) If the layout specifies a set of subsections, or posts, we just go with them.
    // (2) If the client specifies an ACF subsection setup full of custom, page, or category
    //     items, we pull all of them together
    // (3) If the client specifies an ACF subsection as "Fill with post children", OR there
    //     is nothing specified from ACF, we just load up any and all child posts.
    // (4) If nothing is found through all of that, we just show an empty page.

    // (1)
    if(!empty($layoutOptionItems))
        return $layoutOptionItems;

    // (2),(3)
    $subsectionSource = get_field("subsection_source");
    switch ($subsectionSource)
    {
        case "custom":
            // (2)
            $out = get_field("subsection_custom-sections");
            foreach ($out as $key => $sub)
            {
                switch ($sub['subsection_type'])
                {
                    case 'page':
                        $out[$key] = $sub['subsection_page'];
                        break;
                    case 'category':
                        $catPages = get_children([
                            'post_type' => 'post',
                            'numberpost' => -1,
                            'tax_query' => [
                                'taxonomy' => $sub['subsection_category']
                                ]
                            ]);
                         unset($out);
                        foreach ($catPages as $p)
                        {
                        	$out[] = $p;
                        }
                        break;
                    default:
                        break;
                }
            }

            break;
        case "children":
        default:
            // (3)
            $out = rrcb_fillWithPostChildren($childPostQueryArgs);
            break;
    }
    return $out;
}

function rrcb_fillWithPostChildren($queryArgs = [
            "post_type"     => "page",
            "numberposts"   => -1,
            "post_status"   => "publish",
            "orderby"       => "menu_order date",
            "order"         => "ASC"
        ])
{
    //$my_wp_query = new WP_Query();
    //$all_wp_pages = $my_wp_query->query(["post_type"=>$postType]);
    if(!isset($queryArgs["post_parent"]))
    {
        $queryArgs["post_parent"] = get_the_ID();
    }
    $postItems = get_children($queryArgs);
    return $postItems;
}

function rrcb_featureApplyDefaults($defaultOptions)
{
    global $featureOptions, $feature_name, $feature_version, $instanceIndex, $featureInstances;

    // The order of options priority are:
    // (1) Feature Defaults - in $defaultOptions
    // (2) Layout Defaults - in layout call to showFeature()
    // (3) Options-level Client ACF Field - in the Advanced Custom Fields tied to site options
    // (4) Page-level Client ACF Field - in the ACF field tied to page for all features on that page
    // (5) Instance-level Client ACF Field -  in the ACF field tied specifically to the nth instance
    //     of the feature on the page

    // (1)
    if(!isset($featureOptions))
        $featureOptions = $defaultOptions;
    else
    {
        // (2)
        foreach ($defaultOptions as $key=>$opt )
        {
    	    if(!isset($featureOptions[$key]))
                $featureOptions[$key] = $opt;
        }
    }
    $featureOptions["instanceName"] = $feature_name.'_'.$instanceIndex;
    $nthFeatureNumber = -1;
    if(isset($featureInstances[$feature_name]) && isset($featureInstances[$feature_name][$featureOptions["instanceName"]]))
        $nthFeatureNumber = $featureInstances[$feature_name][$featureOptions["instanceName"]];
    foreach ($featureOptions as $key => $opt)
    {
        if(!function_exists("get_field"))
            break;

        $userField = get_field($key);
        if($userField)
    	    $featureOptions[$key] = $userField;
        else
        {
            // In case there are duplicate field names across the features, I want to
            // prefix the field names with the name of the feature.
            $userField = get_field($feature_name.'_'.$key);
            if($userField)
                $featureOptions[$key] = $userField;
            else
            {
                $userField = get_field($key, "options");
                if($userField)
                    $featureOptions[$key] = $userField;
            }
        }
        // (5)
        $userField = get_field($key.":".$nthFeatureNumber);
        if($userField !== null)
            $featureOptions[$key] = $userField;
    }

    return $featureOptions;
}

function rrcb_checkLinkShouldOpenNewWindow($url)
{
    $out = "";
    $isDonateUrl = false; //defaults
    if(filter_var($url, FILTER_VALIDATE_URL))
    {
        $ctaUrlParts = parse_url($url);
        $hostname = gethostname();
        $hostname = parse_url(WP_SITEURL, PHP_URL_HOST);
        $donateUrlArray = array(
                "2dialog.com",
                "convio.net",
                "donate"
            );
        if($ctaUrlParts["host"] != $hostname){
            //different donate url check
            foreach ($donateUrlArray as $donateUrlString) {
                if (strpos($ctaUrlParts["host"], $donateUrlString) !== FALSE) {
                    $out = " target=\"_self\"";// rrcb_lh=\"{$ctaUrlParts["host"]}\" rrcb_hn=\"{$hostname}\"";
                    $isDonateUrl = true;
                    break;
                }
            }
            if(!($isDonateUrl)){
                 $out = " target=\"_blank\"";
            }

        }else{
             $out = " target=\"_self\""; //defaults to self link
        }
    }
    return $out;
}

function rrcb_checkLinkShouldOpenSameWindow($url)
{
    $out = "";
    if(filter_var($url, FILTER_VALIDATE_URL))
    {
        $ctaUrlParts = parse_url($url);
        $hostname = gethostname();
        $hostname = parse_url(WP_SITEURL, PHP_URL_HOST);
        if($ctaUrlParts["host"] != $hostname)
            $out = " target=\"_self\"";// rrcb_lh=\"{$ctaUrlParts["host"]}\" rrcb_hn=\"{$hostname}\"";
    }
    return $out;
}

function rrcb_decodeDesiredImageSize($desiredImageSize)
{
    // First we have to determine what the size means
    $imageHeight = 0;
    $imageWidth = 0;
    $size = [];
    if(is_string($desiredImageSize))
    {
        global $_wp_additional_image_sizes;
        if(isset($_wp_additional_image_sizes[ $desiredImageSize ]))
        {
            $size["size"] = $desiredImageSize;
            $imageWidth = $_wp_additional_image_sizes[ $desiredImageSize ]['width'];
            $imageHeight = $_wp_additional_image_sizes[ $desiredImageSize ]['height'];
        }
    }
    elseif(is_array($desiredImageSize))
    {
        $keys = array_keys($desiredImageSize);
        if(array_key_exists("size",$desiredImageSize) &&
            array_key_exists("width",$desiredImageSize) &&
            array_key_exists("height",$desiredImageSize))
        {
            // This is already a processed desired size!
            // Let's just return it.
            return $desiredImageSize;
        }
        $imageWidth = $desiredImageSize[$keys[0]];
        $imageHeight = $desiredImageSize[$keys[1]];
        $size['size'] = 'custom_'.$imageWidth.'x'.$imageHeight;
    }
    $size["width"] = $imageWidth;
    $size["height"] = $imageHeight;

    return $size;
}

function rrcb_findImageMetaFromSizeAndAcfImage($desiredImageSize, $image)
{
    // If we have more information to go on, then we can find the best match
    // for the desired size.
    $o  = rrcb_decodeDesiredImageSize($desiredImageSize);

    // If all we get is a string for the specified image but nothing else,
    // I guess we just pass that over.
    if(is_string($image) && filter_var($image, FILTER_VALIDATE_URL)){
        //$o = $desiredImageSize;
        $o["url"] = $image;
    }
    else
    {
        // We can at least start with a placeholder
        $o["url"] = "//placehold.it/{$o["width"]}x{$o["height"]}";

        if(isset($o["size"])){
            if(isset($image["sizes"]) && isset($image["sizes"][$o["size"]]))
            {
                // We found a match
                $o["url"] = $image["sizes"][$o["size"]];
                $o["width"] = $image["sizes"][$o["size"]."-width"];
                $o["height"] = $image["sizes"][$o["size"]."-height"];
            }
        }
        elseif($o["width"] != 0 && $o["height"] != 0)
        {
            // If the decoder wasn't able to find a named image size, but we have
            // image dimensions to work with, we can still try to hunt one up.
            if(isset($image["sizes"]))
            {
                $closestDistance = PHP_INT_MAX;
                // Let's start by looking at all of the sizes that the image object has to offer
                $keys = array_keys($image["sizes"]);
                // And filter down those keys to just the size names so we can compare them
                $keys = array_filter($keys, function($k) { return substr($k, -6) != '-width' && substr($k, -7) != '-height'; });
                // We loop through each size name key:
                foreach ($keys as $sizeKey)
                {
                    $found = $image["sizes"][$sizeKey.'-width'] == $o['width'];
                    if($found)
                    {
                        $distance = $image['sizes'][$sizeKey.'-height'] - $o['height'];
                        if($distance < $closestDistance){
                            $o['url'] = $image['sizes'][$sizeKey];
                            $o['width'] = $image['sizes'][$o['size'].'-width'];
                            $o['height'] = $image['sizes'][$o['size'].'-height'];
                            $closestDistance = $distance;
                        }
                    }
                }

            }
        }
    }

    return $o;
}
function rrcb_checkContentForExpander($content, $id = 0)
{
    $o = '';
    if($id === 0 || is_null($id))
    {
        $id = rand();
    }
    if(strpos($content, '<!--more-->') !== FALSE)
    {
        $pos = strpos($content, '<!--more-->');
        $first = substr($content, 0, $pos);
        $second = substr($content, $pos);
        $o = '<div class="newsfeed-item-summary-first">'.$first.' <span id="newsfeed_item_'.$id.'" class="newsfeed-item-summary-second collapse">'.$second.'</span><a class="newsfeed-item-more-btn secondary-text-cta" href="#newsfeed_item_'.$id.'" data-toggle="collapse">Read More <b class="newsfeed-item-more-btn-caret fa fa-angle-down"></b></a></div>';
    }
    else {
        $o = $content;
    }
    return $o;
}

function rrcb_theBlogCategoryLine($post)
{
    $taxonomy = 'category';

    // get the term IDs assigned to post.
    $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
    // let's yank out the parent category
    $blogCategory = get_category_by_slug('blog');
    $post_terms = array_diff($post_terms, [$blogCategory->term_id]);
    // separator between links
    $separator = ', ';

    if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {

        $term_ids = implode( ',' , $post_terms );
        $terms = wp_list_categories( 'title_li=&style=none&echo=0&taxonomy=' . $taxonomy . '&include=' . $term_ids );
        $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );

        // display post categories
        _e('<div class="post-categories">Categorized under: '. $terms .'</div>');
    }
}

function rrcb_theBlogByline()
{
    if((has_category("blog")) || ( ( is_home() ) ))
    {
        global $post;
        $authorName = get_the_author();
        $authorLink = get_author_posts_url($post->post_author);
        $postDate = get_the_date();
?>
        <div class="post-meta-hdr">
            <!-- <span class="post-meta-author">Written by: <a class="blog-author-url" href="<?php _e($authorLink); ?>"><?php _e($authorName); ?></a></span> on -->
            <span class="post-meta-postdate"><?php _e($postDate); ?></span>
            <?php //rrcb_theBlogCategoryLine($post); ?>
            <!-- <hr class="post-meta-divider" /> -->
        </div>
        <?php
    }
}

//function to find the number of max columns for bootstrap col separations
function rrcb_findMaxColumns($currentNumberOfItems){
    $maxBootstrapColumns = 12; //max columns from bootstrap
    if($currentNumberOfItems >= $maxBootstrapColumns){
        return 1;
    }
    while (($maxBootstrapColumns%$currentNumberOfItems != 0)){ //if it does not have a bootstrap column
        if($maxBootstrapColumns%$currentNumberOfItems < 2){
            $currentNumberOfItems = 12;
            break;
        }
        $currentNumberOfItems--;
    }
    $newColumns = $maxBootstrapColumns/$currentNumberOfItems; 
    return $newColumns;
    //if its not divisible, reduce to the lowest number possible for custom CSS styling
}
