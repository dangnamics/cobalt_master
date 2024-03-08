<?php

$defaultOptions = [
    'staff_numberOfColumns' => 4,
    'staff_groupings' => ['Group 1', 'Group 2', 'Group 3'],
    'staff_imageSize' => 'staff-member-thumbnail',
    'staff_post-type' => 'staff_member',
    'staff_order-meta-key' => 'staff_order',
    'staff_group-draw-orientation' => 'horizontal', // can be 'vertical' or 'horizontal' or an array of those values
    'staff_items' => [],
    'tag_keys' => [
        'staff_group',
        'staff_office',
        'staff_company',
        'staff_term-date',
        'staff_email',
        ],
    'thumbnail_hideInlineSizes'=>false
    ];

defined("BOOTSTRAP_COLUMNS") or define("BOOTSTRAP_COLUMNS", 12);
$options = rrcb_featureApplyDefaults($defaultOptions);

$staffItems = $options["staff_items"];
$staffItems = rrcb_getSubSections($staffItems, [
        'post_parent' => "0", 
        'post_type' => $options['staff_post-type'], 
        'posts_per_page'=>'-1',
        "orderby"       => "meta_value_num title date",
        "meta_key"      => $options['staff_order-meta-key'],
        "order"         => "ASC"
        ]);

$imageSize = $options["staff_imageSize"];
$staffItems = rrcb_subsection_viewmodel::FromArray($staffItems, null, null, $imageSize, function($sub, $p) use ($options){
    $sub->ID = $p->ID;
    $sub->callToActionCopy = get_field("staff_title", $p->ID);
    $sub->callToActionUrl = "mailto:" . get_field("staff_email", $p->ID);
    $staffImage = get_field("staff_image", $p->ID);
    if(!empty($staffImage)) {
        if(is_array($staffImage) && isset($staffImage["url"]))
        {
            $sub->imageUrl = $staffImage["url"];
            if(isset($staffImage["sizes"]) && is_string($sub->imageSize) && isset($staffImage["sizes"][$sub->imageSize]))
            {
                $sub->imageUrl = $staffImage["sizes"][$sub->imageSize];
            }
        }
        else 
        {
            $sub->imageUrl = rrcb_getImage($staffImage);
        }
    }
    else {
        $imageDim = ["width" => 0, "height" => 0];
        if(is_string($sub->imageSize))
        {
            global $_wp_additional_image_sizes;
            if(isset($_wp_additional_image_sizes[$sub->imageSize]))
            {
                $imageDim["width"] = $_wp_additional_image_sizes[$sub->imageSize]["width"];
                $imageDim["height"] = $_wp_additional_image_sizes[$sub->imageSize]["height"];
            }
            elseif(is_array($sub->imageSize) && isset($sub->imageSize["height"]))
            {
                $imageDim["width"] = $sub->imageSize["width"];
                $imageDim["height"] = $sub->imageSize["height"];
            }
        }
        $sub->imageUrl = "//placehold.it/{$imageDim["width"]}x{$imageDim["height"]}&text={$sub->headerCopy}";

    }
    foreach ($options["tag_keys"] as $tagKey)
    {
    	$sub->tag[$tagKey] = get_field($tagKey, $sub->ID);
    }
    
    $sub->showFunction = function() use ($sub){
        $indent = "                      ";
        $imageLine = "<img class=\"img staff-member-img image-responsive\" src=\"{$sub->imageUrl}\" />";
        $nameLine = "<span class=\"staff-member-name\">{$sub->headerCopy}</span>";
        $titleLine = "<span class=\"staff-member-title\">{$sub->callToActionCopy}</span>";
        if($sub->callToActionUrl && $sub->callToActionUrl != "mailto:")
            $titleLine = "<a href=\"{$sub->callToActionUrl}\">" . $titleLine . "</a>";
        _e($indent . apply_filters("staff_itemDisplay_line_image", $imageLine));
        _e($indent . apply_filters("staff_itemDisplay_line_name", $nameLine));
        _e($indent . apply_filters("staff_itemDisplay_line_title", $titleLine));
    };
    return $sub;
}, $options["thumbnail_hideInlineSizes"]);

if(!is_array($options['staff_numberOfColumns']))
{
    $options['staff_numberOfColumns'] = array_fill(0, count($options['staff_groupings']), $options['staff_numberOfColumns']);
} else if(count($options['staff_numberOfColumns']) < count($options['staff_groupings'])){
    $options['staff_numberOfColumns'] = array_merge($options['staff_numberOfColumns'], array_fill(count($options['staff_numberOfColumns']), count($options['staff_groupings']) - count($options['staff_numberOfColumns']), $options['staff_numberOfColumns'][count($options['staff_numberOfColumns']) - 1]));
}
if(!is_array($options['staff_group-draw-orientation']))
{
    $options['staff_group-draw-orientation'] = array_fill(0, count($options['staff_groupings']), $options['staff_group-draw-orientation']);
} else if (count($options['staff_group-draw-orientation']) < count($options['staff_groupings'])) {
    $options['staff_group-draw-orientation'] = array_merge($options['staff_group-draw-orientation'], array_fill(count($options['staff_group-draw-orientation']), count($options['staff_groupings']) - count($options['staff_group-draw-orientation']), $options['staff_group-draw-orientation'][count($options['staff_group-draw-orientation']) - 1]));
}
$groups = []; 
foreach ($options["staff_groupings"] as $key => $group)
{
    $groupKey = is_string($key) ? $key : $group;

	$groups[$group] = array_filter(
        $staffItems,
            function($e) use (&$groupKey){
                return $e->tag["staff_group"] == $groupKey;
            }
        );
}
$g = 0;
foreach ($groups as $groupName => $groupItems)
{
    if(sizeof($groupItems) < 1)
        continue;
	?>
        <div class="staff-group container staff-group-<?php _e(++$g); ?>">
            <div class="row staff-group-hdr-row">
                <h2 class="hdr staff-group-hdr">
                    <?php _e($groupName); ?>
                </h2>
            </div>
            <div class="row staff-group-item-row">
<?php
    set_query_var('staff-item-groupName', $groupName);
    set_query_var('staff-item-numberOfColumns', $options['staff_numberOfColumns'][$g-1]);
    set_query_var('staff-groupItems', $groupItems);
    get_template_part("templates/features/staff_1/staff-items", $options["staff_group-draw-orientation"][$g-1]);
    set_query_var('staff-item-groupName', null);
    set_query_var('staff-item-numberOfColumns', null);
    set_query_var('staff-groupItems', null);

    
?>
				<div class"clearfix"></div>
            </div>
        </div>
    <?php
}

?>