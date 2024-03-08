<?php

$defaultOptions = [
    'cpt_numberOfColumns' => 2,
    'cpt_groupings' => ['Group 1', 'Group 2', 'Group 3'],
    'cpt_group-key' => 'cpt_group',
    'cpt_imageSize' => 'cpt-item-thumbnail',
    'cpt_post-type' => 'cpt_item',
    'cpt_order-meta-key' => 'cpt_order',
    'cpt_items' => [],
    'tag_keys' => [],
    'thumbnail_hideInlineSizes'=>false,
    'cpt_vm_loader' => null
    ];

defined("BOOTSTRAP_COLUMNS") or define("BOOTSTRAP_COLUMNS", 12);
$columnSize = floor(BOOTSTRAP_COLUMNS / $options["cpt_numberOfColumns"]);
$options = rrcb_featureApplyDefaults($defaultOptions);

$cptItems = $options["cpt_items"];
$cptItems = rrcb_getSubSections($cptItems, [
        'post_parent' => "0", 
        'post_type' => $options['cpt_post-type'], 
        'posts_per_page'=>'-1',
        "orderby"       => "meta_value_num title date",
        "meta_key"      => $options['cpt_order-meta-key'],
        "order"         => "ASC"
        ]);

$imageSize = $options["cpt_imageSize"];
global $tag_keys;
$tag_keys = $options["tag_keys"];
function rrcb_cpt_tag_loader($sub, $post)
{
    global $tag_keys;
    foreach ($tag_keys as $tagKey)
    {
    	$sub->tag[$tagKey] = get_field($tagKey, $sub->ID);
    }
    return $sub;
}
add_filter("subsection_viewmodel_filled", "rrcb_cpt_tag_loader", PHP_INT_MAX, 2);
$cptItems = rrcb_subsection_viewmodel::FromArray($cptItems, null, null, $imageSize, $options['cpt_vm_loader'], $options["thumbnail_hideInlineSizes"]);
remove_filter("subsection_viewmodel_filled", "rrcb_cpt_tag_loader", PHP_INT_MAX);

$groups = []; 
if(isset($options['cpt_groupings']) && count($options['cpt_groupings']) > 1) {
foreach ($options["cpt_groupings"] as $key => $group)
{
    $groupKey = is_string($key) ? $key : $group;

	$groups[$group] = array_filter(
        $cptItems,
            function($e) use (&$groupKey, $options){
                return $e->tag[$options['cpt_group-key']] == $groupKey;
            }
        );
}
} else {
    $groups[] = $cptItems;
}

foreach ($groups as $groupName => $groupItems)
{
    if(sizeof($groupItems) < 1)
        continue;
    $i=0;
	?>
        <div class="cpt-group">
<?php if($groupName != 0) { ?>
            <div class="row cpt-group-hdr-row">
                <h2 class="hdr cpt-group-hdr">
                    <?php _e($groupName); ?>
                </h2>
            </div>
<?php } ?>
            <div class="row cpt-group-item-row">
<?php
    $canHalfSize = ($options["cpt_numberOfColumns"] > 3 && $options["cpt_numberOfColumns"] % 2 == 0);
    $halfColumns = max(floor($options["cpt_numberOfColumns"] / 2), 1);
    foreach ($groupItems as $cpt_member)
    //for ($i = 0; $i < count($groupItems); $i++)
    {
        //$cpt_member = $groupItems[$i];
        if($i % $options["cpt_numberOfColumns"] == 0)
        {
            _e("        <div class=\"row cpt-medium-row\">\n");
        }
        // If the specified number of columns is 4, 6, 8, etc  We want the medium size to be half of that.
        if($canHalfSize && ($i % $halfColumns == 0))
        {
            $leftRight = ($i % $options["cpt_numberOfColumns"] == 0) ? "left" : "right";
            _e("            <div class=\"row cpt-small-row cpt-{$leftRight}-col col-md-6 col-sm-12\">\n");
        }


    	?>
                <div class="cpt-member-container col-md-<?php _e($canHalfSize ? "6" : $columnSize); ?> col-sm-<?php _e(BOOTSTRAP_COLUMNS / $halfColumns); ?>">
<?php 
        if(has_filter("cpt_item_show"))
            $cpt_member = apply_filters("cpt_item_show", $cpt_member);
        $cpt_member->showFunction->__invoke();
    ?>
                </div>
        <?php
        if($canHalfSize && ((($i % $halfColumns) + 1) == $halfColumns))
        {
            _e("            </div> <!--/.row small-->\n");
        }
        if(($i % $options["cpt_numberOfColumns"] == $options["cpt_numberOfColumns"]-1) || $i == (count($groupItems)-1))
        {
            _e("        </div> <!--/.row medium-->\n");
        }
        $i++;
    }
    
?>
				<div class"clearfix"></div>
            </div>
        </div>
    <?php
}

?>