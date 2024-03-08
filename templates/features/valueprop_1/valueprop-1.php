<?php 
/* Feature Name: Value Prop v.1.02
 * Feature Function: Display a header with option for sub description text, merged with previous valueprop on OKC (TD)
 * Date: 2015
 * Last Modified: 7/24/2017
 * Notes :  Added sub description text with linking options, has multiple line options for design purposes (TD - 08/04/16)
 * Added Parallax condition into options (TD - 7/24/2017)
 * */

$defaultOptions = [   
    "valueprop_title"=>"Healthy food. Every person. Every day.",
    "valueprop_sub_title"=> "",
    "valueprop_caption"=> "",
    "value-prop-copy"=>"Lorem ipsum dolor sit amet",
    "valueprop_link_text"=>"Learn More",
    "valueprop_link_url"=>"",
    "valueprop_parallax"=>false,
    "valueprop_parallax_bg"=> "",
    ];

$options = rrcb_featureApplyDefaults($defaultOptions);
if($options["valueprop_parallax"]){ ?>
<div class="parallax-window" data-parallax="scroll" data-image-src="<?php _e($options["valueprop_parallax_bg"]); ?>">
    <?php  }
    ?>
    <div class="content-container">
        <h2 class="hdr value-prop-title"><?php _e($options["valueprop_title"]); ?></h2>

        <?php  if($options["valueprop_sub_title"]){ ?>
        <h3 class="hdr value-prop-sub-title"><?php _e($options["valueprop_sub_title"]); ?></h3>
        <?php  } ?>

        <?php  if(($options["valueprop_caption"])){ ?>
        <p class="hdr value-prop-caption"><?php _e($options["valueprop_caption"]); ?></p>
        <?php  } ?>

        <?php  if(($options["value-prop-copy"])){ ?>
        <p class="value-prop-description"><?php _e($options["value-prop-copy"]); ?></p>
        <?php  if(!empty($options["valueprop_link_url"])){ ?>
        <a href="<?php _e($options["valueprop_link_url"]); ?>" title="<?php _e($options["valueprop_link_text"]); ?>" class="read-more btn-learn"><?php _e($options["valueprop_link_text"]); ?> </a>
        <div class="brdr"></div>
        <?php  } ?>
        <?php  } ?>
    </div>

    <?php  if($options["valueprop_parallax"]){?>
</div>
<?php  } ?>



