<?php

defined("BOOTSTRAP_COLUMNS") or define("BOOTSTRAP_COLUMNS", 12);

$defaultOptions = [
    "mixed_title"=>"",
    "mixed_description"=>"",
    "mixed_numberOfRows"=>1,
    "mixed_numberOfColumns"=>2,
    "mixed_splitPercentage"=>[50,50], // An array of integers [0-100], each defining the Horizontal splits in columns
    "payload" => [
        "content",
        "content"
        ]
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);
$payload = array_values($options["payload"]);
$payloadKeys = array_keys($options["payload"]);

if(!empty($options["mixed_title"])){
?>
    <h3 class="hdr"><?php _e($options["mixed_title"]); ?></h3>
<?php }
if(!empty($options["mixed_description"])) { ?>
    <p class="mixed_description"><?php _e($options["mixed_description"]); ?></p>
<?php } 

// SM: If there is a different number of columns than there is split percentages,
// we clear out the erranous percentages and refill them with equal parts of whatever
// remains.
if($options["mixed_numberOfColumns"] != count($options["mixed_splitPercentage"]))
{
    if (count($options["mixed_splitPercentage"]) > $options["mixed_numberOfColumns"])
        $options["mixed_splitPercentage"] = [];
    $startPoint = array_sum($options["mixed_splitPercentage"]);
    $stepAmount = (100 - $startPoint) / $options["mixed_numberOfColumns"];
    
    $options["mixed_splitPercentage"] = array_merge($options["mixed_splitPercentage"], array_fill(count($options["mixed_splitPercentage"]), $options["mixed_numberOfColumns"], $stepAmount));
}


// NOTES:  The "payload" parameter needs to either contain:
// 1) a string that tells me to load a feature by name with all 
//    default values
// 2) an associative array where the key is the name of the feature
//    and the value is an array of parameters to pass to the feature.
for ($i = 0; $i < $options["mixed_numberOfRows"]; $i++)
{
	?>
    <div class="container-fluid">
        <div class="row">
    <?php
        for ($j = 0; $j < $options["mixed_numberOfColumns"]; $j++)
        {
            $k = $j + ($i * $options["mixed_numberOfColumns"]);
            // We have to determine how many BootStrap columns this area should take up
            $percentage = $options["mixed_splitPercentage"][$j]/100;
            $columns = floor(BOOTSTRAP_COLUMNS * $percentage);

            if(!is_string($options["payload"][$payloadKeys[$k]]))
            {
                $itemName = $payloadKeys[$k];
                $item = $options["payload"][$itemName];
            }
            else
            {
                $itemName = $options["payload"][$k];
                $item = null;
            }
            // Giving the ability to specify a feature name and version number:
            //   e.g. infographic_2
            $version = strpos($itemName, "_");
            if($version)
            {
                $version = explode('_', $itemName)[1];
                $itemName = explode('_', $itemName)[0];
            }
            else
                $version = 1;
            if(!isset($item["section_tag"]))
                $item["section_tag"] = "aside";
            if(!isset($item["container_class"]))
                $item["container_class"] = "container-{$itemName}";
    ?>
            <div class="mixed-column column-<?php _e($itemName); ?> col-md-<?php _e($columns);?>">
                <?php rrcb_showFeature($itemName, $item, $version); ?>
            </div> <!--/.<?php _e($itemName); ?>-->
            <?php
        }
        
    ?>
        </div> <!--/.row-->
    </div> <!--/.container-fluid-->
    <?php
}


    ?>