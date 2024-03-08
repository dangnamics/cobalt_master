<?php
/*
 *  set for only display content text rotator
 */

$heroItem = get_query_var("heroItem");
$active = get_query_var("heroItem_active");
$headlineCopy = $heroItem["title"];
$headlineSubCopy = $heroItem["sub-title"];

?>
       <div class="row item<?php _e($active); ?> full content-right">
 			<div class="bg bg-caption-right">
                <div class="container">
                    <div class="caption caption-right">
                      <h2 class="hdr"><?php _e($headlineCopy); ?></h2>
                      <p><?php echo _e($headlineSubCopy); ?></p>
                    </div>
                </div> <!--/.container-->
            </div>
        </div> <!--/.item-->
