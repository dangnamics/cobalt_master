<?php
$heroItem = get_query_var("heroItem");
$active = get_query_var("heroItem_active");
$headlineCopy = $heroItem["title"];
$headlineSubCopy = $heroItem["sub-title"];
$callToActionCopy = $heroItem["call-to-action-copy"];
$callToActionUrl = $heroItem["call-to-action-url"];
$imageSide = $heroItem['caption_position'] == 'left' ? 'right' : 'left';
?>
<!--         <div class="container">-->
            <div class="row item<?php _e($active); ?> side hero-size-<?php _e($heroItem["hero_imageSize"]); ?>">
                <div class="container">
                    <div class="image pull-<?php _e($imageSide); ?> col-md-<?php _e($heroItem["imageCols"]); ?>" style="background-image:url('<?php _e($heroItem["image"]); ?>');background-repeat:no-repeat;height:100%"><a class="img-responsive" href="<?php _e($callToActionUrl) ?>"></a></div>
                    <div class="pull-<?php _e($heroItem["caption_position"]);?> col-md-<?php _e($heroItem["contentCols"]); ?>">
    <?php get_template_part("templates/features/hero_2/heroItem", "content"); ?>
                    </div>
                </div>
            </div> <!--/.item-->
        <!--</div>--> <!--/.container-->