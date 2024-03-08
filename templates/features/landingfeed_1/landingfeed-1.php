<?php 

/* Feature Name: Landing Page Feed - Custom Built for Hunger Action Month
 * Feature Function: Newsfeed reorganized for landing page
 * Date:8/28/2018
 * Last Modified:
 * Notes : Same as newsfeed-1, just moved blocks around to beter fit custom layout of Hunger Action Month
 * 
 * */

$defaultOptions = [
    "newsfeed_max-number-of-items"=>-1,
    "newsfeed_title"=>"", 
    "newsfeed_description"=>"",
    "newsfeed_imageSize"=> ["width"=>250,"height"=>188],
    "newsfeed_articles"=>[],
    "thumbnail_hideInlineSizes"=>false,
    "newsfeed_row-start-even" => false,
    "newsfeed_summary-max-character-count" => 300,
    "newsfeed_use-place-holder-image" => true,
    "newsfeed_break-to-full-screen" => '',
    "newsfeed_display-author" => false,
    "newsfeed_display-date" => false,
    "newsfeed_caret-class-fa"=>"angle-right",
];
$options = rrcb_featureApplyDefaults($defaultOptions);
//$options["newsfeed_imageSize"] = "home-news-article";
$newsItems = $options["newsfeed_articles"];

$newsItems = rrcb_getSubSections($newsItems);
//defined("FEAT_NEWSFEED_DEFAULT_SUMMARY") or define("FEAT_NEWSFEED_DEFAULT_SUMMARY", "No content for this post");
defined("FEAT_NEWSFEED_DEFAULT_SUMMARY") or define("FEAT_NEWSFEED_DEFAULT_SUMMARY", "");

global $__newsfeed_breakToFullScreen;
$__newsfeed_breakToFullScreen = $options['newsfeed_break-to-full-screen'];

if(isset($__newsfeed_breakToFullScreen) && !empty($__newsfeed_breakToFullScreen) && is_numeric($__newsfeed_breakToFullScreen))
    add_filter('wp_calculate_image_sizes','rrcb_newsfeed_wp_calculate_image_sizes', 10, 5);

$newsItems = rrcb_subsection_viewmodel::FromArray($newsItems, $options["newsfeed_summary-max-character-count"], FEAT_NEWSFEED_DEFAULT_SUMMARY, $options["newsfeed_imageSize"], function(rrcb_subsection_viewmodel $s,$p){
    $hideCta = get_field("page_hide-call-to-action");
    if($hideCta)
        $s->callToActionCopy = null;
    //if(strstr($s->imageUrl, 'placehold.it'))
    //    $s->imageUrl = null;
    if(strpos($s->body, '<!--more-->') !== FALSE)
    {
        $pos = strpos($s->body, '<!--more--></p>');
        $first = substr($s->body, 0, $pos);
        $second = substr($s->body, $pos + 15);
        $s->summary = '<div class="newsfeed-item-summary-first">'.$first.'</p></div><div id="newsfeed_item_'.$s->ID.'" class="newsfeed-item-summary-second collapse">'.$second.'</div><a class="newsfeed-item-more-btn secondary-text-cta" href="#newsfeed_item_'.$s->ID.'" data-toggle="collapse">Read More <b class="newsfeed-item-more-btn-caret fa fa-angle-down"></b></a><a class="newsfeed-item-less-btn secondary-text-cta" href="#newsfeed_item_'.$s->ID.'" data-toggle="collapse">Read Less <b class="newsfeed-item-more-btn-caret fa fa-angle-up"></b></a>';
    }
    return $s;
}, $options["thumbnail_hideInlineSizes"]);

?>
<div class="newsfeed col-sm-12">
    <?php
    if(!empty($options["newsfeed_title"])){
    ?>
    <h3 class="hdr"><?php _e($options["newsfeed_title"]); ?></h3>
    <?php if($options["newsfeed_description"]) {?><span class="newsfeed-description"><?php _e($options["newsfeed_description"]); ?></span> <?php } ?>

    <?php 
    }
    // Setting up the alternating row styles
    $rowOdd = $options["newsfeed_row-start-even"];

    $articles = $newsItems;
    foreach ($articles as $article)
    {
        if(isset($options["newsfeed_max_number_of_items"]) && $i>=$options["newsfeed_max_number_of_items"])
            break;

        $rowOdd = !$rowOdd;
        if(is_array($article))
        {
            $articleId = $article["ID"];
            $imageSize = $options["newsfeed_imageSize"];
            $article = rrcb_subsection_viewmodel::FromWPPost(get_post($articleId), function($s, $p) use ($imageSize) {
                $s->callToActionCopy = get_field("page_call-to-action", $s->ID);
                $s->imageUrl = rrcb_getPostThumbnail($s->ID, [$options["newsfeed_imageSize"]["width"], $options["newsfeed_imageSize"]["height"]], $s->headerCopy, $options['newsfeed_use-place-holder-image']);
            });
        }
        else
        {
            $articleId = $article->ID;
        }
        $callToAction = $article->callToActionCopy;
    ?>
    <div class="newsfeed-item news-items">
        <div class="container-fluid">
            <div class="row row-<?php _e($rowOdd ? "odd" : "even"); ?>">
                <?php 
        $bodyClass = "news-items-body";
        if(!empty($article->imageUrl)) { ?>

                <div class="news-items-left">
                    <div class="inner">
                        <div class="news-items-heading">
                            <?php
            if( get_field('event_date', $article->ID) ):
                            ?>
                            <h4 class="hdr event-date date">
                                <?php
                the_field('event_date',$article->ID);
                                ?>
                            </h4>
                            <?php  endif;  ?>
                            <?php
            if($options['newsfeed_display-date']){ ?>
                            <div class="news-date date">
                                <?php



                                ?>
                                <h4>
                                    <?php
                _e(get_the_date('F j, Y',$article->ID));

                                    ?>
                                </h4>

                            </div>
                            <?php } ?>
                            <h3 class="hdr">
                                <?php if($callToAction) { ?>
                                <a href="<?php _e($article->callToActionUrl); ?>" title="<?php _e($article->headerCopy); ?>" <?php _e($article->callToActionTarget); ?>>
                                    <?php _e($article->headerCopy); ?>
                                </a>
                                <?php } else {
                                          _e($article->headerCopy);
                                      } ?>
                            </h3>

                        </div>
                        <?php 
            if($callToAction) { 
                $ctaTarget = rrcb_checkLinkShouldOpenNewWindow($article->callToActionUrl);

                        ?>
                        <a href="<?php _e($article->callToActionUrl); ?>" title="<?php _e($article->headerCopy); ?>"<?php _e($article->callToActionTarget); ?>>
                            <?php 
                rrcb_theThumbnail("newsfeed-image", $article);
                            ?>
                        </a>
                        <?php 
            } else { 
                rrcb_theThumbnail("newsfeed-image", $article);
            } 
                        ?>
                    </div>
                </div>
                <?php  
        }
        else
        {
            $bodyClass = "news-items-full";
        }
                ?>
                <div class="newsfeed-information <?php _e($bodyClass); ?>">
                    <div class="inner">
                        

                        <?php 
        if($options['newsfeed_display-author']){ ?>
                        <div class="news-author">
                            <?php
            $auth = get_post($article->ID); // gets author from post
            $authid = $auth->post_author; // gets author id for the post


            $user_nickname = get_the_author_meta('display_name',$authid); // retrieve user nickname ?>
                            <h4>
                                <?php
            _e("By " . $user_nickname);
            
                                ?>
                            </h4>

                        </div>
                        <?php } ?>

                        

                        <div class="description"><?php _e($article->summary);?></div>
                        <?php if($callToAction) { ?>
                        <a class="secondary-text-cta arrow" href="<?php _e($article->callToActionUrl); ?>" title="<?php _e($article->headerCopy); ?>" <?php _e($article->callToActionTarget); ?>><?php _e($callToAction); ?> <i class="fa fa-<?php _e($options["newsfeed_caret-class-fa"]); ?>"></i></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- <hr /> -->
            </div>
        </div>
    </div>
    <!--/.newsfeed-item-->
    <?php
    }
    //wp_reset_postdata();
    ?>

</div>
<!--/.newsfeed-->

<?php



?>	