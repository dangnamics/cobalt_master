<?php
/* Feature Name: Donation Drop Down
 * Feature Function: Drop down menu for donation button
 * Date: 8/23/2017
 * Last Modified: 
 * Notes :
 * 
 *
 */

$defaultOptions = [
	"header_donate-button-text"=>"Donate Now",
    "header_donate-button-url"=>"http://www.example.com",
    'header_donate-monthly-url' => "http://www.example.com",
    'header_donate-single-url' => "http://www.example.com",
    'header_donate-btn-tablet' => true,
    'header_enable-dropdown' => false,
    "donation-dropdown_hideWrapperMarkup"=>true,
	];
$options = rrcb_featureApplyDefaults($defaultOptions);

?>

<li class="dropdown donate-btn">

    <a class="btn btn-secondary btn-donate hidden-xs hidden-sm hidden-md <?php if ($options["header_enable-dropdown"]){ ?> dropdown-toggle <?php } ?>"  <?php if($options["header_enable-dropdown"]){ ?> id="dropdownMenuLink"  <?php } ?> role="button" href="<?php _e($options["header_donate-button-url"]); ?>" ><?php _e($options["header_donate-button-text"]);?>  <?php if ($options["header_enable-dropdown"]){ ?> <?php } ?></a>
    <?php if ($options["header_enable-dropdown"]){ ?>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php _e($options["header_donate-single-url"]); ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> One-Time Gift</a>
        <a class="dropdown-item" href="<?php _e($options["header_donate-monthly-url"]); ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Monthly Gift</a>

    </div>
    <?php } ?>

</li>
<?php if($options["header_donate-btn-tablet"]){ ?>
<li class="dropdown donate-btn tablet-view">

    <a class="btn btn-secondary btn-donate hidden-xs hidden-sm hidden-lg"  href="<?php _e($options["header_donate-button-url"]); ?>"> <?php _e($options["header_donate-button-text"]); ?></a>

</li>
<?php } ?>
