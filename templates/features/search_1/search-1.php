<?php
$defaultOptions = [
    "search_mode"=>"swap",              // Can be "swap", "inset" or "side by side"
    "search_button-label"=>"search",
    "search_form-method"=>"get",        // Can be "get" or "post"
    "search_action-url"=>"/"
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);
?>
<div class="search-container search-1">
    <form action="<?php _e($options["search_action-url"]); ?>">
<?php if($options["search_mode"] === "swap") { ?>
        <button class="search search-btn search-btn-<?php _e($options["search_mode"]); ?> btn btn-default <?php if($options["search_mode"] == "swap") { _e(""); }?>" value="<?php _e($options["search_button-label"]); ?>" formmethod="<?php _e($options["search_form-method"]); ?>"><span class='glyphicon glyphicon-search'></span></button>
<?php } ?>
        <input type="search" placeholder="Search" name="s" class="searchbox searchbox-input searchbox-<?php _e($options["search_mode"]); ?>" required>
        <button type="submit" class="searchbox-submit" value="" >
        <span class="searchbox-icon"></span>
        <i class="fa fa-search" style=""></i>
        </button>
    </form>
</div>
