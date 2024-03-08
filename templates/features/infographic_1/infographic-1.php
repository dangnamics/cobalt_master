<?php
/* Feature Name: Infographic v1.0
 * Feature Function: Display infographics with section title and individual infographic title and caption with sub-caption
 * Date: 2015
 * Last Modified: 08/04/2016
 * Notes :
 * 
 * */
$defaultOptions = [
    "max_number_of_items"=>3,
    "title"=>"Infographics", 
    "sub-title"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean semper mauris quis orci efficitur, nec tincidunt magna interdum. Aliquam quis.",
    "link"=>"http://wwww.example.com/", 
    "list" => [[
        "image"=>"http://placehold.it/100x100", 
        "caption"=>"Title", 
        "sub-caption"=>"Lorem ipsum dolor sit amet ut wisi consect"],
        [
        "image"=>"http://placehold.it/100x100", 
        "caption"=>"Title", 
        "sub-caption"=>"Lorem ipsum dolor sit amet ut wisi consect"],
        [
        "image"=>"http://placehold.it/100x100", 
        "caption"=>"Title", 
        "sub-caption"=>"Lorem ipsum dolor sit amet ut wisi consect"]
        ]
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);
?>

		<div class="infographics col-sm-12 <?php _e($options["instanceName"]); ?>">
				
			<h2 class="hdr infographic-title"><?php _e($options["title"]); ?></h2>
            <span class="sub-title infographic-sub-title"><?php _e($options["sub-title"]); ?></span>
            <br />
            <br />
<?php

$maxout = $options["max_number_of_items"];
foreach ($options["list"] as $listItem)
{
    // We have the ability to set the maximum number of items to show.
    if($maxout-- == 0) break;
	?>
			<div class="infographic-item">
				
				<img class="img" src="<?php _e($listItem["image"]); ?>" alt="<?php _e($listItem["caption"]); ?>" style="width:100px; height:100px;"/>
					
				<div class="infographic-title">
					<h4 class="hdr"><?php _e($listItem["caption"]); ?></h4>
					<span class="description"><?php _e($listItem["sub-caption"]); ?></span>
				</div>
				<div class="clearfix"></div>
			</div><!--/.infographic-item-->
<?php
}
?>
			
		</div><!--/.infographics-->
		
		<?php  ?>