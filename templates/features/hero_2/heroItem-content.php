<?php
$heroItem = get_query_var("heroItem");
$active = get_query_var("heroItem_active");
$headlineCopy = $heroItem["title"];
$headlineSubCopy = $heroItem["sub-title"];
$callToActionCopy = $heroItem["call-to-action-copy"];
$callToActionUrl = $heroItem["call-to-action-url"];
$callToActionClass = $heroItem["call-to-action-class"];

 if(!empty($headlineCopy)) {
?>
                <div class="caption caption-<?php _e($heroItem["caption_position"]); ?>">
                  <h2 class="hdr"><?php _e($headlineCopy); ?></h2>
                  <p><?php echo _e($headlineSubCopy); ?></p>
<?php if(!empty($callToActionCopy)) { ?>
                  <p><a class="<?php _e($callToActionClass); ?>" href="<?php _e($callToActionUrl); ?>" role="button"><?php _e($callToActionCopy); ?></a></p>
<?php } ?>
                </div>
<?php } ?>
