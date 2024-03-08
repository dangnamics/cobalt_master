<?php
defined("BOOTSTRAP_COLUMNS") or define("BOOTSTRAP_COLUMNS", 12);

$defaultOptions = [
    "title-header_mode"=>"side-by-side",     // Can be "side-by-side" or "top-and-bottom"
    "title-header_title" => "",
    "title-header_titlePercentage"=>45,
    "title-header_descriptionMaxLength"=>500,
    "title-header_summaryFieldName" => "title-header_summary",
    "title-header_summary" => ""
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

$page_title = $options['title-header_title'];
if(!$page_title){
    if (is_home()){
        $page_title = "Blog";
    }else{
        $page_title = get_the_title();
    }
}
$post = get_post(get_the_ID());
$titleCols = floor(($options["title-header_titlePercentage"]/100) * BOOTSTRAP_COLUMNS);
$summary = get_field($options["title-header_summaryFieldName"]);
if(!$summary)
    $summary = $options["title-header_summary"];
if(!$summary)
    $titleCols = BOOTSTRAP_COLUMNS;


switch($options["title-header_mode"])
{
    case "side-by-side":

?>
		<div class="row">
			<div class="column-title col-md-<?php _e($titleCols); ?> pull-left col-xs-12">
			    <h1 class="title"><?php echo $page_title; ?></h1>
            </div>
<?php if($titleCols < BOOTSTRAP_COLUMNS) { ?>
			<div class="column-description col-md-<?php _e(BOOTSTRAP_COLUMNS - $titleCols); ?> col-xs-12">
			    <div class="description"><?php _e($summary); ?></div>
			</div>
<?php } ?>
		</div>
<?php 
        break;
    case "top-and-bottom":
?>
		<div class="row row-title">
			<h1 class="title"><?php echo $page_title; ?></h1>
        </div>
		<div class="row row-description">
			<p class="description"><?php _e($summary); ?></p>
		</div>
<?php
        break;
    default:
        break;
}

?>