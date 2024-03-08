<?php
$defaultOptions = [
    "video_header-copy"=>"Lorem Ipsum",
    "video_sub-header-copy" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pulsi recurrant? Dici enim nihil potest verius.",
    "video_title"=>"",
    "video_description"=>"",
    "video_url"=>"",
    "video_files"=>[],
    "video_imageSize"=> ["width"=>"600px","height"=>"320px"]
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

$videoSize = rrcb_decodeDesiredImageSize($options["video_imageSize"]);

?>

<div class="video">
<?php if(!empty($options["video_header-copy"])){ ?>
    <div class="row video-hdr">
        <div class="video-hdr-title"><h2 class="hdr"><?php _e($options["video_header-copy"]); ?></h2></div>
<?php   if(!empty($options["video_sub-header-copy"])){ ?>
        <div class="video-hdr-sub-title"><?php _e($options["video_sub-header-copy"]); ?></div>
<?php   } ?>
    </div>
<?php } ?>
<?php if(!empty($options["video_title"])){ ?>
    <div class="row video-title">
        <?php _e($options["video_title"]); ?>
    </div>
<?php } ?>
    <div class="row video-stage">
        <?php 
            $videoTag = '';
            if(!empty($options['video_url']) && filter_var($options['video_url'], FILTER_SANITIZE_URL) != false){
                $videoTag = wp_oembed_get($options['video_url'], ["width"=>$videoSize['width'], "height" => $videoSize['height']]);
                if($videoTag)
                    _e($videoTag);
                else
                {
                    _e("<video width=\"{$videoSize['width']}\" height=\"{$videoSize['height']}\"><source src=\"{$options['video_url']}\" controls preload/>This browser does not support HTML5 video.</video>");
                }
            }
            else if(!empty($options['video_files']) && sizeof($options['video_files']) > 1)
            {
                _e("<video width=\"{$videoSize['width']}\" height=\"{$videoSize['height']}\" controls preload>");
                foreach ($options['video_files'] as $videoFile)
                {
                	_e("<source src=\"{$videoFile['video_url']}\"/>");
                }
                
                _e("This browser does not support HTML5 video.</video>");
            }
        ?>
    </div>
<?php if(!empty($options["video_description"])){ ?>
    <div class="row video-description">
        <?php _e($options["video_description"]); ?>
    </div>
<?php } ?>
</div> <!-- /.video -->