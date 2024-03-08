<?php
$heroItem = get_query_var("heroItem");
$active = get_query_var("heroItem_active");
$headlineCopy = $heroItem["title"];
$headlineSubCopy = $heroItem["sub-title"];
$callToActionCopy = $heroItem["call-to-action-copy"];
$callToActionUrl = $heroItem["call-to-action-url"];
$heroImageUrl = $heroItem["image"];
if(is_array($heroImageUrl)) $heroImageUrl = $heroImageUrl['url'];
$heroImageSize = $heroItem["hero_imageSize"];
if(is_array($heroImageSize)) $heroImageSize = implode('x',$heroImageSize);
?>
       <div class="row item<?php _e($active); ?> full content-<?php _e($heroItem["caption_position"]); ?> hero-size-<?php _e($heroImageSize); ?>" style="background-image:url('<?php _e($heroImageUrl); ?>');background-repeat:no-repeat;<?php /*height:<?php _e($heroItem["imageHeight"]); px*/ ?>">
 			<div class="bg bg-caption-<?php _e($heroItem["caption_position"]); ?>">
                <div class="container">
<?php get_template_part("templates/features/hero_2/heroItem", "content"); ?>
                </div> <!--/.container-->
            </div>
        </div> <!--/.item-->
