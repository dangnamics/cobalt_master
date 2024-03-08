<?php

/**
 * rrcb_subsection_viewmodel - ViewModel object that describes a template subsection.
 *
 * Features need a unified way to utilize the information inside a template sub-section.  
 *
 * @version 1.0
 * @author smagallanes
 */
class rrcb_subsection_viewmodel
{
    public $ID;
    public $imageUrl;
    public $imageTitle;
    public $imageSize;
    public $image;
    public $imageAttachmentID;
    public $headerCopy;
    public $summary;
    public $body;
    public $callToActionCopy;
    public $callToActionUrl;
    public $callToActionTarget;
    public $hideInlineSizes;
    public $tag;
    public $showFunction;

    private static function __defaultTransformCallback(rrcb_subsection_viewmodel $s, $source)
    {
        return $s;
    }

    public static function FromArray(array $posts, $summaryMaxLength = 200, $summaryDefault = '', $imageSize = "thumbnail", $transformCallback = null, $hideInlineSizes = false)
    {
        if(!is_array($posts))
            throw new RuntimeException("Posts varible invalid: must be an array of objects.");

        $o = [];
        foreach ($posts as $post)
        {
            $sub = new rrcb_subsection_viewmodel();
        	if(is_a($post, "WP_Post")) :
                $sub = self::FromWPPost($post, $summaryMaxLength, $summaryDefault, $imageSize, $transformCallback);
            else :
                $sub = self::FromACFObject($post, $summaryMaxLength, $summaryDefault, $imageSize, $transformCallback);
            endif;
            $sub->imageSize = $imageSize;
            $sub->hideInlineSizes = $hideInlineSizes;
            if($transformCallback)
                $sub = $transformCallback($sub, $post);
            $sub = apply_filters("subsection_viewmodel_filled", $sub, $post);
            $o[] = $sub;
        }
        return $o;
    }

    //public static function FromWPPostArray(array $posts, $summaryMaxLength = 200, $summaryDefault = '', $tranformCallback = null){
    //    if(!is_array($posts))
    //        throw new RuntimeException("Posts varible invalid: must be an array of objects.");

    //    $o = [];
    //    foreach ($posts as $post)
    //    {
    //        if(!is_a($post, "WP_Post"))
    //            throw new RuntimeException("Posts varible invalid: must be an array of WP_Post objects.");

    //        $o[] = self::FromWPPost($post, $summaryMaxLength, $summaryDefault, $tranformCallback);
    //    }
    //    return $o;
    //}

    public static function FromWPPost(WP_Post $post, $summaryMaxLength = 200, $summaryDefault = '', $imageSize = [300, 300], $transformCallback = null)
    {
        $sub = new rrcb_subsection_viewmodel();
        $sub->ID = $post->ID;
        $sub->headerCopy = $post->post_title;
        $sub->summary = rrcb_getExcerpt($post, $summaryMaxLength, $summaryDefault);
        $sub->body = get_field('page_summary', $post->ID);
        $sub->body = apply_filters('the_content', $sub->body);  // this might be unnecessary.
        $sub->callToActionUrl = get_permalink($post->ID);       // Might need to centralize this call for posts with redirects?
        $image = rrcb_getPostThumbnail($post->ID, $imageSize, $post->post_title);
        $sub->imageAttachmentID = get_post_thumbnail_id($post->ID);
        $sub->imageUrl = $image;
        $sub->imageTitle = $post->post_title;
        $sub->callToActionCopy = rrcb_getCallToAction($post);
        $sub->callToActionTarget = "";
        return $sub;
    }

    public static function FromACFObject($acf, $summaryMaxLength = 200, $summaryDefault = '', $imageSize = [300, 300], $transformCallback = null)
    {
        $sub = new rrcb_subsection_viewmodel();
        //$sub->ID = $acf->ID;
        $sub->headerCopy = $acf["subsection_header-copy"];
        $sub->summary = $acf["subsection_summary"];
        $sub->body = $acf["subsection_summary"];
        $sub->callToActionUrl = $acf["subsection_link-url"];
        $sub->image = self::FindImageMetaFromSizeAndAcfImage($imageSize, $acf["subsection_image"]);
        if(isset($acf["subsection_image"]) && is_array($acf["subsection_image"]) && isset($acf["subsection_image"]["ID"]))
            $sub->imageAttachmentID = $acf["subsection_image"]["ID"];
        $sub->imageUrl = $sub->image["url"];
        $sub->imageTitle = $acf["subsection_header-copy"];
        $sub->imageSize = $sub->image;
        $sub->callToActionCopy = $acf["subsection_link-copy"];
        $sub->callToActionTarget = rrcb_checkLinkShouldOpenNewWindow($sub->callToActionUrl);
        return $sub;
    }

    private static function DecodeDesiredImageSize($desiredImageSize)
    {
        return rrcb_decodeDesiredImageSize($desiredImageSize);
    }

    // This should be moved to a more centralized location in the code, like utils.php
    private static function FindImageMetaFromSizeAndAcfImage($desiredImageSize, $image)
    {
        return rrcb_findImageMetaFromSizeAndAcfImage($desiredImageSize, $image);
    }
}
