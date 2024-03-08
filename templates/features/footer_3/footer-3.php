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
        "footer_tablet-layout"=> [],
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
$hiddenTablet = 'hidden-xs hidden-lg';
$hiddenMobile = 'hidden-lg hidden-md ';
$mobileOrder = [];
if(isset($options['footer_mobile-order']) && (is_array($options['footer_mobile-order']) || $options['footer_mobile-order'] == 'reversed'))
{
    $changeMobile = true;
    $hiddenDesktop = ' hidden-xs hidden-sm';
}
if(isset($options['footer_tablet-layout']) && !empty($options['footer_tablet-layout'])&& count($options['footer_tablet-layout']) > 0)
{
    $hiddenDesktop = ' hidden-xs hidden-sm hidden-md';
    $hiddenMobile .= ' hidden-sm';
}

$hiddenDesktop = apply_filters('footer-desktop-class', $hiddenDesktop);
$hiddenTablet = apply_filters('footer-tablet-class', $hiddenTablet);
$hiddenMobile = apply_filters('footer-mobile-class', $hiddenMobile);

function footer_spawnBlock($options, $blockName, $classes, $layout){
?>
	<div class="footer-<?php _e($blockName . ' ' . $classes); ?>">
<?php
    footer_spawnRow($options, $layout, $blockName);
?>
        </div> <!--./footer-<?php _e($blockName); ?>-->
<?php
}

function footer_spawnRow($options, $layout, $rowId){
    global $indent;

    //$cellAt = 1;
    $numberOfColumns = sizeof($layout);
    $bootstrap_cols = $numberOfColumns == 0 ? 3 : floor(12 / $numberOfColumns);
    _e($indent."<div class=\"row footer-row footer-row-{$rowId}\">");
    for ($i = 0; $i < $numberOfColumns; $i++)
    {
        // columns
        $col = $layout[$i];
        footer_spawnColumn($options, $col, $i + 1, $rowId, $bootstrap_cols);
    }
    _e($indent."</div> <!-- /.footer-row-{$rowId} -->");
}

function footer_spawnColumn($options, $col, $columnId, $rowId, $bootstrap_cols) 
{
    global $indent;
    _e($indent."<div class=\"col col-xs-12 col-sm-{$bootstrap_cols} col-md-{$bootstrap_cols} col-lg-{$bootstrap_cols} footer-column footer-column-{$rowId}_{$columnId}\">");
    // if the value is not an array, we pack it into an array:
    if(!is_array($col))
        $col = [$col];
    for ($j = 0; $j < sizeof($col); $j++)
    {
        // rows
        $cellIndex = $col[$j];
        if(is_array($cellIndex))
        {
            footer_spawnRow($options, $cellIndex, $rowId .'_'.$j);
        }
        else
        {
            $cellValue = apply_filters('footer_item-'.$cellIndex, $options["footer_item-".$cellIndex]);
            _e($indent . $indent . "<div class=\"footer-item footer-item-{$cellIndex}\">");
            _e($indent . $indent . $indent . $cellValue);
            _e($indent . $indent . "</div> <!--/.footer-item-{$cellIndex} -->");
        }
        //$cellAt++;
    }
    _e($indent . "</div> <!--/.footer-column-{$rowId}_{$columnId} -->");
}

footer_spawnBlock($options, 'desktop', $hiddenDesktop, $options['footer_desktop-layout']);

if(isset($options['footer_tablet-layout']) && !empty($options['footer_tablet-layout'])&& count($options['footer_tablet-layout']) > 0){
    footer_spawnBlock($options, 'tablet', $hiddenTablet, $options["footer_tablet-layout"]);
}
if($changeMobile) {
    $layout = $options['footer_mobile-order'];
    // The layout for mobile should really be a single column with multiple rows.
    if(sizeof($layout) > 1)
        $layout = [$layout];
    footer_spawnBlock($options, 'mobile', $hiddenMobile, $layout);
}
?>

    
    
    
   				
