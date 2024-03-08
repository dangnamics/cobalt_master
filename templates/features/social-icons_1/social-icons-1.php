<?php
/* Feature Name: Social Icons v.1.0
 * Feature Function: Display social icons and links
 * Date: 2015
 * Last Modified: 09/28/2016
 * Notes : Added ability to additionally display in the header area with headline text
 * */

$defaultOptions = [
    "social_facebook-url"=>"",
    "social_twitter-url"=>"",
    "social_instagram-url"=>"",
    "social_pinterest-url"=>"",
    "social_youtube-url"=>"",
    "social_vimeo-url"=>"",
    "social_linkedin-url"=>"",
    "social_icons_use-images" => true,
    "social_icons_headline" => "",
    "social_icons_in_header" => false,
    ];
global $options;
$options = rrcb_featureApplyDefaults($defaultOptions);
if(!function_exists("social_showLink")){
    function social_showLink($socialName)
    {
        global $options;
        if($options["social_{$socialName}-url"])
            if($options["social_icons_use-images"]){
                 _e("    <a target=\"blank\" href=\"{$options["social_{$socialName}-url"]}\"><img src=\"/wp-content/themes/rrcb_cobalt_master/assets/images/logo_{$socialName}.png\"></a>\n");
            }else{
                _e("    <a target=\"blank\" href=\"{$options["social_{$socialName}-url"]}\"><i class=\"fa fa-{$socialName}\"></i></a>\n");
            }
    }
}
?>
<div class="btn-group btn-group-sidebar">
<?php
     if($options["social_icons_headline"]){
       _e($options["social_icons_headline"]);
     }
    if($options["social_icons_in_header"]){
      
        social_showLink("facebook");
        social_showLink("twitter");
    }else{
        social_showLink("facebook");
        social_showLink("twitter");
        social_showLink("instagram");
        social_showLink("pinterest");
        social_showLink("youtube");
        social_showLink("vimeo");
        social_showLink("linkedin");
    }
    
?>
</div>