<?php
/* Feature Name: Hero-1 v.1.2
 * Feature Function: Displays images, description caption and title linked to a specified URL
 * Date: 2015
 * Last Modified: 08/04/2016
 * Notes : The options for this feature include references to "donate" but the hero feature is not always
 * going to be used for donations.
 * 
 * - This feature is used on all page templates for options to display hero or banner text, added option to have image set as background for transparent content overlay, Added double background for color background blending mode (TD)
 */
defined("BOOTSTRAP_COLUMNS") or define("BOOTSTRAP_COLUMNS", 12);

$defaultOptions = [
	"hero_donate-button-label"=>"",
    "hero_call-to-action-url"=>"#",
	"hero_background-image-url"=>"",
	"hero_headline-copy"=>"",
	"hero_headline-sub-copy"=>"",
	"hero_content-display-mode"=>"right",     // Can be "right", "left", or "full" this is location of image
    "hero_content-percentage"=>50,
    "hero_imageHeight" => 370,
    "hero_imageSize" => 'hero-image',
    "hero_imageSize-full" => "",
    'hero_imageSize-side' => '',
    'hero_allow-empty-sub-copy' => false,
    'hero_video-poster-image' => '',
    'hero_video-files' => [],
    'hero_video-display-mode' => 'cover',   // Can be "cover", "container" or "overflow" - this adds a class to the videotron
    'hero_max-video-device-width' => 'hidden-xs',
    'content-overlay-background' => false //allow the content box to sit over background
	];
$options = rrcb_featureApplyDefaults($defaultOptions);

if (!filter_var($options["hero_call-to-action-url"], FILTER_VALIDATE_URL) === false) {
    $hero_link_url = $options["hero_call-to-action-url"];
}

if($options['hero_content-display-mode'] == 'video')
{
    if(!$options['hero_video-files'] || sizeof($options['hero_video-files']) == 0)
        $options['hero_content-display-mode'] == 'full';
}

$content_display = $options["hero_content-display-mode"];
$contentCols = floor(($options["hero_content-percentage"]/100) * BOOTSTRAP_COLUMNS);
$imageCols = BOOTSTRAP_COLUMNS - $contentCols;

$headlineCopy = $options["hero_headline-copy"];
$headlineSubCopy = $options["hero_headline-sub-copy"];

$heroImageUrl = $options["hero_background-image-url"];
$heroImageHeight = $options["hero_imageHeight"];
if($options['hero_imageSize'])
{
    $heroImageSize = rrcb_decodeDesiredImageSize($options["hero_imageSize"]);
    if(!empty($heroImageSize))
    {
        $heroImageHeight = $heroImageSize["height"];
    }
    else
    {
        global $_wp_additional_image_sizes;
        if(isset($_wp_additional_image_sizes[$defaultOptions['hero_imageSize']]))
        {
            $heroImageHeight = $_wp_additional_image_sizes[$defaultOptions['hero_imageSize']]["height"];
        }
    }
}
if(empty($options['hero_imageSize-full']) && !empty($options['hero_imageSize']))
    $options['hero_imageSize-full'] = $options['hero_imageSize'];
if(empty($options['hero_imageSize-side']) && !empty($options['hero_imageSize']))
    $options['hero_imageSize-side'] = $options['hero_imageSize'];
$display_mode = $options['hero_content-display-mode'] === 'full' ? 'full' : 'side';

if(is_array($heroImageUrl) && isset($heroImageUrl["sizes"]))
{
    if(isset($heroImageUrl["sizes"][$options['hero_imageSize']])){
        $heroImageUrl = $heroImageUrl["sizes"][$options['hero_imageSize']];
    }
    else if(isset($heroImageUrl["sizes"]["large"]))
    {
        $heroImageUrl = $heroImageUrl["sizes"]["large"];
    }
}

$page_title = get_the_title();
$post = get_post(get_the_ID());
if(empty($headlineCopy))
    $headlineCopy = $post->post_title;
if(empty($headlineSubCopy) && !$options['hero_allow-empty-sub-copy'])
    $headlineSubCopy = rrcb_getExcerpt($post, 500);
if(empty($heroImageUrl))
    $heroImageUrl = rrcb_getPostThumbnail($post->ID, $options['hero_imageSize-'.$display_mode], $headlineCopy);

if($content_display == "left") { ?>

	<div class="hero-container container hero-size-<?php _e($options['hero_imageSize']); ?>">
        <div class="row content-<?php _e($content_display); ?>" <?php if($options['content-overlay-background']){ ?> style="background-image:url('<?php echo rrcb_getImage($heroImageUrl); ?>')" <?php } ?> >
            <div class="col-md-<?php _e($imageCols); ?> hero-img">
                <div class="featured-image" <?php if(!$options['content-overlay-background']){ ?> style="background-image:url('<?php echo rrcb_getImage($heroImageUrl); ?>')" <?php } ?>></div>
            </div>
            <div class="col-md-<?php _e($contentCols); ?> content"  <?php if($options['content-overlay-background']){ ?> style="background-image:url('<?php echo rrcb_getImage($heroImageUrl); ?>')" <?php } ?>>
                <div class="inner">
                    <h1 class="hdr"><?php _e($headlineCopy); ?></h1>
                    <br />
                    <p><?php _e($headlineSubCopy); ?></p>
    <?php if(!empty($options["hero_donate-button-label"])) { 
              $ctaUrl = $options["hero_call-to-action-url"];
              $ctaTarget = rrcb_checkLinkShouldOpenNewWindow($ctaUrl);
              ?>
				<br />
                    <p><a class="btn btn-donate" href="<?php _e($ctaUrl); ?>"<?php _e($ctaTarget);?> role="button"><?php _e($options["hero_donate-button-label"]); ?></a></p>
    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php }if($content_display == "right") { ?>

	<div class="hero-container container hero-size-<?php _e($options['hero_imageSize']); ?>">
        <div class="row content-<?php _e($content_display); ?>" <?php if($options['content-overlay-background']){ ?> style="background-image:url('<?php echo rrcb_getImage($heroImageUrl); ?>')" <?php } ?>>
            
            <div class="col-md-<?php _e($contentCols); ?> content"  <?php if($options['content-overlay-background']){ ?> style="background-image:url('<?php echo rrcb_getImage($heroImageUrl); ?>')" <?php } ?>>
                <div class="inner">
                    <h1 class="hdr"><?php _e($headlineCopy); ?></h1>
                    <br />
                    <p><?php _e($headlineSubCopy); ?></p>
    <?php if(!empty($options["hero_donate-button-label"])) { 
              $ctaUrl = $options["hero_call-to-action-url"];
              $ctaTarget = rrcb_checkLinkShouldOpenNewWindow($ctaUrl);
              ?>
				<br />
                    <p><a class="btn btn-donate" href="<?php _e($ctaUrl); ?>"<?php _e($ctaTarget);?> role="button"><?php _e($options["hero_donate-button-label"]); ?></a></p>
    <?php } ?>
                </div>
            </div>
            <div class="col-md-<?php _e($imageCols); ?> hero-img">
                 <div class="featured-image" <?php if(!$options['content-overlay-background']){ ?> style="background-image:url('<?php echo rrcb_getImage($heroImageUrl); ?>')" <?php } ?>></div>
            </div>
        </div>
    </div>
<?php } elseif($content_display == 'full'){
?>
	<div class="hero-container content-full hero-size-<?php _e($options['hero_imageSize']); ?>" <?php   if(!empty($hero_link_url)){ ?> style="position:relative;" <?php } ?>>
        <?php if(!empty($hero_link_url)){ ?><a class="hero_link" href="<?php _e($hero_link_url); ?>" style="display:block; height:100%; width:100%; position:absolute; z-index:1;"></a><!-- hero hot link --><?php } ?>

        <div class="jumbotron hero-size-<?php _e($options['hero_imageSize']); ?>" style="background-image:url('<?php echo rrcb_getImage($heroImageUrl); ?>')">
            <div class="container">
            	<div class="caption">
                    <h1 class="hdr"><?php _e($headlineCopy); ?></h1>
                    <p><?php echo _e($headlineSubCopy); ?></p>
          <?php if(!empty($options["hero_donate-button-label"])) { 
            $ctaUrl = $options["hero_call-to-action-url"];
            $ctaTarget = rrcb_checkLinkShouldOpenNewWindow($ctaUrl);
            ?>
                    <p><a class="btn btn-donate" href="<?php _e($ctaUrl); ?>"<?php _e($ctaTarget);?> role="button"><?php echo $options["hero_donate-button-label"]; ?></a></p>
            <?php } ?>
            	</div>
            </div><!-- CONT END -->
        </div>    
	</div>
<?php
} elseif($content_display == 'video'){
    $heroVideoPosterUrl = $options['hero_video-poster-image'];
    if(is_array($heroVideoPosterUrl))
        $heroVideoPosterUrl = rrcb_findImageMetaFromSizeAndAcfImage($options['hero_imageSize'], $heroVideoPosterUrl)['url'];
?>
    <div class="hero-container content-full content-video hero-size-<?php _e($options['hero_imageSize']); ?>" <?php   if(!empty($hero_link_url)){ ?><?php } ?>>
        <div class="videotron hero-size-<?php _e($options['hero_imageSize']); _e(' ' . $options['hero_video-display-mode']); ?>" style="background-image:url(<?php echo rrcb_getImage($heroImageUrl); ?>);">
            <div class="container">
               <div class="caption">  
                    <h1 class="hdr"><?php _e($headlineCopy); ?></h1>
                    <p><?php echo _e($headlineSubCopy); ?></p>
              <?php if(!empty($options["hero_donate-button-label"])) { 
                        $ctaUrl = $options["hero_call-to-action-url"];
                        $ctaTarget = rrcb_checkLinkShouldOpenNewWindow($ctaUrl);
              ?>
                        <p><a class="btn btn-donate" href="<?php _e($ctaUrl); ?>"<?php _e($ctaTarget);?> role="button"><?php echo $options["hero_donate-button-label"]; ?></a></p>
                <?php } ?>
                </div>
            </div>
            <?php if(!empty($hero_link_url)){ ?><a class="hero_link" href="<?php _e($hero_link_url); ?>" style="display:block; height:100%; width:100%; position:absolute; z-index:1;"></a><!-- hero hot link --><?php } ?>
            <div class="video-container <?php _e($options['hero_max-video-device-width']); ?>">
                <video autoplay muted class="hero-video" id="bgvid" loop=""<?php if(isset($heroVideoPosterUrl) && !empty($heroVideoPosterUrl)){ _e(" poster=\"{$heroVideoPosterUrl}\""); } ?> />
                <?php foreach ($options['hero_video-files'] as $videoFile)
                        {
                            $video_url = $videoFile['video_url'];
                            if(filter_var($video_url, FILTER_VALIDATE_URL) === false){
                            if(filter_var($video_url, FILTER_VALIDATE_INT)){
                                $video_url = wp_get_attachment_url($video_url);
                            }
                            }
                            $videoExt = pathinfo($video_url, PATHINFO_EXTENSION);
                            _e("<source src=\"{$video_url}\" type=\"video/{$videoExt}\">");
                        }
                ?>
                </video>
            </div>
        </div>
    </div>
<?php } 
       ?>
