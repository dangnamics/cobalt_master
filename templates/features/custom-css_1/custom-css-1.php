<?php
/* Feature Name: Custom CSS v.1.0
 * Feature Function: Custom CSS overrides for admin area
 * Date: 2015
 * Last Modified: 08/04/2016
 * Notes : Nothing special, page style css overrides, called in the head.php
 * */
$defaultOptions = [
    "custom_css"=> "",
    "custom-css_hideWrapperMarkup" => true
    ];

$options = rrcb_featureApplyDefaults($defaultOptions);
$customStyles = "<style type=\"text/css\"> \n" . $options["custom_css"] . "\n</style><!-- custom theme styles -->";
_e($customStyles);

?>