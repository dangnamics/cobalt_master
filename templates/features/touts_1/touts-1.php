<?php
/* Feature Name: Touts v.1.01
 * Feature Function: Displays images, description caption and title linked to a specified URL
 * Date: 2015
 * Last Modified: 08/04/2016
 * Notes : Modified to add conditional for not having images and caption text.
 * Added the ability to always center for not have the correct number of touts (TD - 08/04/16)
 * Added a double background on absolute titles for backround blend modes backgrounds
 * */
$defaultOptions = [
    "touts_max-number-of-items"=> 3,
    "touts_header-position"=>"before", // Options: "before","after"
    "touts_link-position"=>"before", //  Options: "before","after" *in relation to caption text
    "touts_section-title"=>"",
    "touts_section-description"=>"",
    "touts_items"=> [],
    "touts_imageSize" => ['width'=>340, 'height'=>190], // Default image size for the touts
    "touts_item-class" => 'touts',
    "touts_arrow-type" => 'fa-angle-right',
    "touts_mobile-rotator" => false
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);
$colCount = rrcb_findMaxColumns($options["touts_max-number-of-items"]); // find max columns needed
$touts = $options["touts_items"];
$firstTout = true;
if(!$touts)
    return;

$imageSize = rrcb_decodeDesiredImageSize($options['touts_imageSize']);

 if($options["touts_section-title"]){ 
    $touts_class = strtolower(str_replace(" ", "-", $options["touts_section-title"]));
 }

?>


<div class="container">
     <?php if($options["touts_section-title"]){ ?>
    <div class="row touts-hdr-row <?php if($options["touts_section-title"]){  _e($touts_class); } ?>">
     <div class="<?php _e($touts_class); ?> hdr-row col-md-12 col-sm-12">
        <h2 class="hdr "><?php _e($options["touts_section-title"]); ?></h2>
        <?php if($options["touts_section-description"]){ ?><p><?php _e($options["touts_section-description"]); ?></p> <?php } ?>
     </div>
    </div>
	<?php 
       } //eof touts section title
    ?>

    <div class="row touts-items-row <?php _e($options["instanceName"]); ?><?php if($options['touts_mobile-rotator']) { _e(' hidden-xs'); } ?>">
        <?php
	    $maxout = $options["touts_max-number-of-items"];
	    foreach ($touts as $key => $tout)
	    {
            // We have the ability to set the maximum number of touts to show.
            if($maxout-- == 0) break;

            //Set if image for tout has been added
            if($tout['image']){
                $imageUrl = rrcb_findImageMetaFromSizeAndAcfImage($imageSize, $tout['image']);
                if(is_array($imageUrl) && isset($imageUrl['url']))
                    $imageUrl = $imageUrl['url'];
            }
            else
            {
                $imageUrl = '//placehold.it/?'.urlencode($tout['title']);
            }
	        ?>
    
                <div class="<?php _e($options['touts_item-class']); ?> col-md-<?php _e($colCount); ?> col-sm-<?php _e($colCount); ?>">
        	        <div class="hdr-container">
        <?php if(($options["touts_header-position"]=="before") && ($options["touts_header-position"])){ 
                  if($tout["title"]){
                  ?>           
                    <h3 class="hdr"><a href="<?php _e($tout["link_url"]); ?>" title="<?php _e($tout["title"]); ?>"><?php _e($tout["title"]); ?></a></h3>
                  <?php } ?>
        <?php } ?>
        <?php     if($tout['image']){ ?>
                    <a href="<?php _e($tout["link_url"]); ?>" class="tout-image" title="<?php if($tout["title"]){ _e($tout["title"]);} ?>" style="background-image:url(<?php _e($imageUrl); ?>); height:<?php _e($imageSize['height']); ?>px; width:100%; display:inherit;"></a>
        <?php       } ?>
        <?php if(($options["touts_header-position"]=="after") && ($options["touts_header-position"])) { 
                   if($tout["title"]){
                       ?>

                    <h3 class="hdr"><a href="<?php _e($tout["link_url"]); ?>" title="<?php _e($tout["title"]); ?>"><?php _e($tout["title"]); ?></a></h3>
        <?php       }
              } ?>
			        </div>
                    <?php if(($options["touts_link-position"])==("before")){  ?>
                    <a href="<?php _e($tout["link_url"]); ?>" title="Donate Monthly" class="read-more"><?php _e($tout["link_text"]); ?> <i class="fa <?php echo $options["touts_arrow-type"]?>"></i></a>
        	      
                    <?php } ?>
                    <div class="caption-container">
			        <?php
                        if(isset($tout["caption"])){ ?>
                                <p><?php _e($tout["caption"]); ?></p>
                    <?php } ?>
                    <?php if($options["touts_link-position"]=="after"){  ?>
                    <a href="<?php _e($tout["link_url"]); ?>" title="Donate Monthly" class="read-more"><?php _e($tout["link_text"]); ?> <i class="fa <?php echo $options["touts_arrow-type"]?>"></i></a>
        	        </div>
                    <?php } ?>
                </div>
    
            <?php } ?>
    
    </div>

</div>
<?php  
if($options['touts_mobile-rotator']){
?>
<div id="<?php _e($options['instanceName']); ?>" class="container carousel slide hidden-lg hidden-md hidden-sm" data-ride="carousel">
    <div class="row touts-items-row <?php _e($options["instanceName"]); ?> carousel-inner"  role="listbox">
        <?php
    $maxout = $options["touts_max-number-of-items"];
    foreach ($touts as $key => $tout)
    {
        // We have the ability to set the maximum number of touts to show.
        if($maxout-- == 0) break;

        //Set if image for tout has been added
        if($tout['image']){
            $imageUrl = rrcb_findImageMetaFromSizeAndAcfImage($imageSize, $tout['image']);
            if(is_array($imageUrl) && isset($imageUrl['url']))
                $imageUrl = $imageUrl['url'];
        }
        else
        {
            $imageUrl = '//placehold.it/?'.urlencode($tout['title']);
        }
        ?>
    
                <div class="<?php _e($options['touts_item-class']); ?> col-md-<?php _e($colCount); ?> col-sm-<?php _e($colCount); ?> item <?php if($maxout == $options["touts_max-number-of-items"]-1){ _e(' active'); } ?>">
        	        <div class="hdr-container">
        <?php if(($options["touts_header-position"]=="before") && ($options["touts_header-position"])){ 
                  if($tout["title"]){
        ?>           
                    <h3 class="hdr"><a href="<?php _e($tout["link_url"]); ?>" title="<?php _e($tout["title"]); ?>"><?php _e($tout["title"]); ?></a></h3>
                  <?php } ?>
        <?php } ?>
        <?php     if($tout['image']){ ?>
                    <a href="<?php _e($tout["link_url"]); ?>" class="tout-image" title="<?php if($tout["title"]){ _e($tout["title"]);} ?>"><img src="<?php _e($imageUrl); ?>"  class="img-responsive"/></a>
        <?php       } ?>
        <?php if(($options["touts_header-position"]=="after") && ($options["touts_header-position"])) { 
                  if($tout["title"]){
        ?>

                    <h3 class="hdr"><a href="<?php _e($tout["link_url"]); ?>" title="<?php _e($tout["title"]); ?>"><?php _e($tout["title"]); ?></a></h3>
        <?php       }
              } ?>
			        </div>
                    <?php if(($options["touts_link-position"])==("before")){  ?>
                    <a href="<?php _e($tout["link_url"]); ?>" title="Donate Monthly" class="read-more"><?php _e($tout["link_text"]); ?> <i class="fa <?php echo $options["touts_arrow-type"]?>"></i></a>
        	      
                    <?php } ?>
                    <div class="caption-container">
			        <?php
        if(isset($tout["caption"])){ ?>
                                <p><?php _e($tout["caption"]); ?></p>
                    <?php } ?>
                    <?php if($options["touts_link-position"]=="after"){  ?>
                    <a href="<?php _e($tout["link_url"]); ?>" title="Donate Monthly" class="read-more"><?php _e($tout["link_text"]); ?> <i class="fa <?php echo $options["touts_arrow-type"]?>"></i></a>
        	        </div>
                    <?php } ?>
                </div>
    
            <?php } ?>
    
    </div>
        <div class="tout-rotator-controls hidden-lg hidden-md hidden-sm">
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#<?php _e($options['instanceName']); ?>" role="button" data-slide="prev">
                <span><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#<?php _e($options['instanceName']); ?>" role="button" data-slide="next">
                <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
</div>
<?php
}
?>
