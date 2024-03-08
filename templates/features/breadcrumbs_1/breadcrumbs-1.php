<?php
/* Feature Name: Breadcrumbs v.1
 * Feature Function: Uses Yoast Plugin for Breadcrumb Feature.
 * Date: 2015
 * Last Modified: 08/04/2016
 * */
if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<div class="inner"><p id="breadcrumbs">','</p></div>');
}
?>