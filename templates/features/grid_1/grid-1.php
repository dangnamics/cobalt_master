<?php
$defaultOptions = [
    "grid_numberOfColumns"=>2,
    "grid_numberOfColumns_sm"=>2,
    "grid_excerpt-max-length"=>200,
    "grid_thumbnail-image-height"=>200,
    "grid_thumbnail-imageSize" => [270, 190],
    "grid_caret-class-fa"=>"chevron-right",
    "grid_items"=>[],
    "grid_break-to-full-screen"=>767,
    "thumbnail_hideInlineSizes"=>false
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

defined("BOOTSTRAP_COLUMNS") or define("BOOTSTRAP_COLUMNS", 12);
$columnSize_md = floor(BOOTSTRAP_COLUMNS / $options["grid_numberOfColumns"]);
$columnSize_sm = floor(BOOTSTRAP_COLUMNS / $options["grid_numberOfColumns_sm"]);

global $__grid_breakToFullScreen;
$__grid_breakToFullScreen = $options['grid_break-to-full-screen'];
function rrcb_grid_wp_calculate_image_sizes($sizes, $size, $imageUrl, $imageMeta, $attachmentId){
    global $__grid_breakToFullScreen;
    $width = rrcb_decodeDesiredImageSize($size)['width'];
    
    //return "(min-width:480px) and (max-width:990px) 100vw, (min-width:991) and (max-width:1199) {$width}px, " . $sizes;
    return "(min-width: {$__grid_breakToFullScreen}px) {$width}px, 100vw";
}
if(isset($__grid_breakToFullScreen) && !empty($__grid_breakToFullScreen) && is_numeric($__grid_breakToFullScreen))
    add_filter('wp_calculate_image_sizes','rrcb_grid_wp_calculate_image_sizes', 10, 5);

if( have_posts() ) : while(have_posts()) : the_post();

$gridItems = rrcb_getSubSections($options["grid_items"]);
$gridItems = rrcb_subsection_viewmodel::FromArray($gridItems, $options["grid_excerpt-max-length"], "", $options['grid_thumbnail-imageSize'], null, $options["thumbnail_hideInlineSizes"]);//[400,$options["grid_thumbnail-image-height"]]);

$keys=array_keys($gridItems);
// Now we loop and build the grid
for ($j = 0; $j < ceil(count($gridItems)/$options["grid_numberOfColumns"]); $j++)
{
?>
				<div class="row grid-row-<?php rrcb_oddEven($j + 1); ?><?php if($j == 0) _e(' first'); else if ($j == (ceil(count($gridItems)/$options["grid_numberOfColumns"]) - 1)) _e(' last') ?>">
<?php
    for ($i = ($j * $options["grid_numberOfColumns"]); $i < (($j * $options["grid_numberOfColumns"]) + $options["grid_numberOfColumns"]); $i++)
    {
        if($i >= count($gridItems))
            break;

        $col_num = ($i % $options["grid_numberOfColumns"]) + 1;
        $subsection = $gridItems[$keys[$i]];
        //$ctaTarget = rrcb_checkLinkShouldOpenNewWindow($subsection->callToActionUrl);
        ?>
                    <div class="grid-item col-sm-<?php _e($columnSize_sm); ?> col-md-<?php _e($columnSize_md); ?> grid-col-<?php rrcb_oddEven($col_num); ?>">
                        <div class="inner">
<?php if($subsection->callToActionCopy) { ?>
						  <a href="<?php _e($subsection->callToActionUrl); ?>" title="<?php _e($subsection->headerCopy); ?>"<?php _e($subsection->callToActionTarget); ?>> <h2><?php _e($subsection->headerCopy); ?></h2></a>
                           <a href="<?php _e($subsection->callToActionUrl); ?>" title="<?php _e($subsection->headerCopy); ?>"<?php _e($subsection->callToActionTarget); ?>>
                                <?php rrcb_theThumbnail('grid-image grid-image-thumbnail',  $subsection); ?>
                            </a>
<?php } else { ?>
                            <h2><?php _e($subsection->headerCopy); ?></h2>
                            <?php rrcb_theThumbnail('grid-image grid-image-thumbnail',  $subsection); ?>
<?php }?>
						    <?php if($subsection->summary){ ?><p><?php _e($subsection->summary); ?></p><?php } ?>
<?php if($subsection->callToActionCopy) { ?>
                            <div><a class="cta" href="<?php _e($subsection->callToActionUrl); ?>"><?php _e($subsection->callToActionCopy); ?>&nbsp; <?php if($options["grid_caret-class-fa"]){ ?><i class="fa fa-<?php _e($options["grid_caret-class-fa"]); ?>"></i><?php } ?></a></div>
<?php }?>
                       </div>
                    </div>
        <?php
    } // end column loop

?>
                </div> <!--/.row-->
<?php 
} // end row loop
endwhile;
endif; 
?>