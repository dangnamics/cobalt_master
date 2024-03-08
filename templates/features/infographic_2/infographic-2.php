<?php

/* Feature Name: Infographic v2.01
 * Feature Function: Display infographics with hot link and link buttons
 * Date: 2015
 * Last Modified: 10/24/2016
 * Notes : Updated from previous infographic-2 added bootstrap cols
 * 9/28/2016 - Added cta-url condition and label if exist
 * 10/24/2016 - Fix tout items link
 * 8/6/17 - Added/Fixed ticker on and off options
 * */
$defaultOptions = [
    "infographic_max-number-of-items"=>3,
    "infographic_title"=>"Infographics", 
    "infographic_sub-title"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean semper mauris quis orci efficitur, nec tincidunt magna interdum. Aliquam quis.",
    "infographic_call-to-action-url"=>"http://wwww.example.com/", 
    "infographic_cta-label"=>"Learn More", 
    "infographic_title-header-append" => '',
    "infographic_ticker" => false,
    "infographic_items" => [[
        "image"=>"http://placehold.it/420x420", 
        "caption"=>"Title", 
        "sub-caption"=>"Lorem ipsum dolor sit amet ut wisi consect",
        "link"=>"http://www.example.com"],
        [
        "image"=>"http://placehold.it/420x420", 
        "caption"=>"Title", 
        "sub-caption"=>"Lorem ipsum dolor sit amet ut wisi consect",
        "link"=>"http://www.example.com"],
        [
        "image"=>"http://placehold.it/420x420", 
        "caption"=>"Title", 
        "sub-caption"=>"Lorem ipsum dolor sit amet ut wisi consect",
        "link"=>"http://www.example.com"],
        ],
    "infographic_item-class" => "infographic-item",
    "infographic_cta-mode" => "caption", //Options:  "caption","sub-caption"
    "infographic_imageSize" => ""
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);
$colCount = rrcb_findMaxColumns($options["infographic_max-number-of-items"]); // find max columns needed
?>
<div class="row row-<?php _e($options["infographic_item-class"]); ?>">
		<div class="infographics col-sm-12 <?php _e($options["instanceName"]); ?>">				
			<h2 class="hdr infographic-title"><?php _e($options["infographic_title"]); ?></h2>
            <span class="sub-title infographic-sub-title"><?php _e($options["infographic_sub-title"]); ?></span>
            <div class="row row-items-<?php  _e($options["infographic_item-class"]); ?>">
            <?php

            $maxout = $options["infographic_max-number-of-items"];

            //output each info graphics
            foreach ($options["infographic_items"] as $listItem)
            {   
                $ctaTarget = rrcb_checkLinkShouldOpenNewWindow($listItem['link']);
                // We have the ability to set the maximum number of items to show.
                if($maxout-- == 0) break;
    
                $imageUrl = $listItem["image"];
                if(isset($options["infographic_imageSize"]) && is_array($imageUrl)){
                    $imageUrl = rrcb_findImageMetaFromSizeAndAcfImage($options["infographic_imageSize"], $listItem["image"])["url"];
                }
            ?> 
			            <div class="<?php _e($options["infographic_item-class"]);?> col-md-<?php _e($colCount); ?> col-sm-<?php _e($colCount); ?>">
				            <div class="inner">
                	            <div class="featured-img">
                                <?php if(($listItem['link'])){ ?>
                                    <a href="<?php _e($listItem['link']) ?>" <?php _e($ctaTarget);?> >
                                <?php } ?>
                                    <img class="img" src="<?php _e($imageUrl); ?>" alt="<?php if(isset($listItem['caption'])){ _e($listItem['caption']); } ?>" />
                                <?php if(($listItem['link'])){ ?>
                                    </a>
                                <?php } ?>   
                                </div>
                                <div class="infographic-title">
                                    <div class="inner">
            <?php if(($listItem['link'])){ ?>
                                        <a class="infographic-item-cta" href="<?php _e($listItem['link']); ?>">
            <?php } ?>
                                        <h4 class="hdr <?php if($options["infographic_ticker"]) { ?> ticker" data-ending-number="<?php _e(preg_replace('/[^A-Za-z0-9\-]/', '', $listItem['caption'])); ?>" data-speed="3000" data-starting-number="<?php _e(preg_replace('/[^A-Za-z0-9\-]/', '', $listItem['caption'])*.95); } ?>" ><?php if(isset($listItem['caption'])){ _e($listItem['caption']); } ?><?php _e($options["infographic_title-header-append"]); ?></h4>
            <?php if(($listItem['link'])){  ?>
                                        </a>
            <?php } ?>
            <?php if(($listItem['link'])){  ?>
                                        <a class="infographic-item-cta" href="<?php _e($listItem['link']); ?>">
            <?php } ?>
                                            <span class="description"><?php if(isset($listItem['sub-caption'])){ _e($listItem['sub-caption']); } ?></span>
            <?php if(($listItem['link'])){  ?>
                                        </a>
            <?php } ?>
			                        </div>
					            </div>
                            </div>
				            <div class="clearfix"></div>
			            </div><!--/.infographic-item-->
            <?php
            }
            ?>
			</div>
    </div><!--/.infographics-->
</div><!--/.eof row-->
<div class="row row-<?php _e($options["infographic_item-class"]); ?>-cta">
		<div class="infographics col-sm-12 <?php _e($options["instanceName"]); ?>-cta">	
            <a href="<?php _e($options["infographic_call-to-action-url"]); ?>" class="cta btn-learn-more btn-learn"><?php _e($options["infographic_cta-label"]); ?></a>
        </div>
 </div>
		