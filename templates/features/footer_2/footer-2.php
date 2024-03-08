<?php
$defaultOptions = [
        "footer_number-of-items"=>3,
        "footer_item-1"=>"<h5>Cobalt Client Name</h5>",
        "footer_item-2"=>"<p>1234 Address Ave.<br>
					Cityname, ST 12345<br>
					info@cobaltclientname.org<br>
					(555) 123-4567</p>",
        "footer_item-3"=>"<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
					sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>",
        "footer_item-4"=>"<p>Cobalt Client Name is a non-profit 501(c)(3) organization.</p>",
        "footer_item-5"=>"<h5>Be Social</h5>
					
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</p>
					
					<a class=\"read-more\" href=\"http://example.com\" title=\"Read More\">Read More</a>",
        "footer_item-6"=>"<h5>Donate Now</h5>
					
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
					sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>",
        "footer_item-7"=>"<a class=\"btn\" href=\"http://example.com\" title=\"Call to Action\">Donate Now</a>",
        "footer_desktop-layout"=> [
            [1,2,3,4],
            5,
            [6,7]
        ],              // This is a multi-dimensional array of [columns]x[rows] describing the layout of the
                        // individual cell items in the desktop break.
        "footer_mobile-order" => false // Can be "normal", "reversed", false, or an array specifying the new order when shown in mobile.
    ];
$FOOTER_NUMBER_OF_NON_ITEM_OPTIONS = 2;

// Since we won't know how many actual areas are being defined until the template is built, we need to use an option to specify the number
// of items to look for in the database.
// We'll use that number to pre-pack the $defaultOptions array with empty options that the database will then overwrite.
if(!isset($options['footer_number-of-items']) || !is_numeric($options['footer_number-of-items']) || $options['footer_number-of-items'] < 1)
{
    $options['footer_number-of-items'] = $defaultOptions['footer_number-of-items'];
}
if(sizeof($options)<$options['footer_number-of-items'] + $FOOTER_NUMBER_OF_NON_ITEM_OPTIONS)
{
    $s = sizeof($options) - $FOOTER_NUMBER_OF_NON_ITEM_OPTIONS;
    for ($i = $s; $i < $options['footer_number-of-items']; $i++)
    {
    	$defaultOptions['footer_item_'.$i] = "";
    }
}

$options = rrcb_featureApplyDefaults($defaultOptions);
$indent = "    ";
$changeMobile = false;
$hiddenDesktop = '';
$hiddenMobile = '';
$mobileOrder = [];
if(isset($options['footer_mobile-order']) && (is_array($options['footer_mobile-order']) || $options['footer_mobile-order'] == 'reversed'))
{
    $changeMobile = true;
    $hiddenDesktop = ' hidden-xs hidden-sm';
}
?>
	<div class="row footer-desktop<?php _e($hiddenDesktop); ?>">
<?php

$cellAt = 1;
$numberOfColumns = sizeof($options["footer_desktop-layout"]);
$bootstrap_cols = floor(12 / $numberOfColumns);
for ($i = 0; $i < $numberOfColumns; $i++)
{
    // columns
    $col = $options["footer_desktop-layout"][$i];
    _e($indent."<div class=\"col col-md-{$bootstrap_cols} footer-column-". ($i+1) ."\">");
    // if the value is not an array, we pack it into an array:
    if(!is_array($col))
        $col = [$col];
    for ($j = 0; $j < sizeof($col); $j++)
    {
        // rows
        $cellValue = apply_filters('footer_item-'.$cellAt, $options["footer_item-".$cellAt]);
        _e($indent . $indent . "<div class=\"footer-item-{$cellAt}\">");
		_e($indent . $indent . $indent . $cellValue);
        _e($indent . $indent . "</div> <!--/.footer-item-{$cellAt} -->");
        $cellAt++;
    }
    _e($indent . "</div> <!--/.footer-column-". ($i+1) ." -->");
}

?>
        </div> <!--./footer-mobile-->
<?php
if($changeMobile) {
?>
	<div class="row footer-mobile hidden-lg hidden-md">
        <div class="footer-mobile-col col-sm-12 col-xs-12">
<?php
    for ($i = 0; $i < sizeof($options['footer_mobile-order']); $i++)
    {
        $cellAt = $options['footer_mobile-order'][$i];
        // rows
        $cellValue = apply_filters('footer_item-'.$cellAt, $options["footer_item-".$cellAt]);
        _e($indent . $indent . "<div class=\"footer-item-{$cellAt}\">");
		_e($indent . $indent . $indent . $cellValue);
        _e($indent . $indent . "</div> <!--/.footer-item-{$cellAt} -->");
    }

?>
            </div> <!--./footer-mobile-col-->
        </div> <!--./footer-mobile-->
<?php
}
?>

    
    
    
   				
