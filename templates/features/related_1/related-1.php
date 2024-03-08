<?php

/* Feature Name: Related Stories v.1.1
 * Feature Function: Pulls related post or page in the same post or parent page
 * Date: 2015
 * Last Modified: 09/28/2016
 * Notes : Touched up related stories from older version, only show when related feature is turned on by acf
 * */

$defaultOptions = [
    "show_related"=>false, //defaults to not show
    "max_number-of-related"=>3,
    "related_parent_page"=>"Stories",
    "related_title"=>"",
    "related_imageSize"=> "related-thumbnail",
    'related_summary-max-character-count' => 300, //optional if require
    "related_use-place-holder-image" => true,
    'thumbnail_hideInlineSizes' => false
];

$options = rrcb_featureApplyDefaults($defaultOptions);
defined("FEAT_RELATED_DEFAULT_SUMMARY") or define("FEAT_RELATED_DEFAULT_SUMMARY", "No related stories for this post");
global $post;

if($options["show_related"]){ //if true
    //check if current is post or page
    if(is_page()){
        // Get an array of Ancestors and Parents if they exist 
        $parent = get_post($post->post_parent);
        $parentID =  $parent->ID;
        $parentTitle = $parent->post_name;

        $relatedArg = array(
        'sort_order' => 'asc',
        'sort_column' => 'menu_order',
        'hierarchical' => 0,
        'child_of' => $parent->ID,
        'parent' => -1,
        'exclude' => $post->ID,
        'post_type' => 'page',
        'offset' => 0,
        'post_status' => 'publish');
        $related = get_pages($relatedArg); 
        $articles = $related;
?>


<div class="row row-<?php _e($parentTitle); ?>">
    <h3><?php _e($options["related_title"]) ?></h3>

    <?php
    //function for except on summary, need to move and update
        function description($x, $length)
        {
            if(strlen($x)<=$length)
            {
                _e( $x);
            }
            else
            {
                $y=substr($x,0,$length) . '...';
               _e($y);
            }
        }

        $i=0;
        foreach ($articles as $article)
        {
            //get page setup summary
            $summary = get_field( 'page_summary', $article->ID );
            $cta_text = get_field( 'page_call-to-action', $article->ID );
            if(isset($options["max_number-of-related"]) && $i++>=$options["max_number-of-related"])
                break;
            if($article->ID != $parent->ID){
                $currentArticleTitle = preg_replace("/[^A-Za-z0-9]/", "", get_the_title($article->ID));
    ?>
    <div class="col-md-4 col-sm-4 mod">
        <div class="inner inner-<?php _e($currentArticleTitle); ?>">
            <?php
                $articleId = $article->ID;
                $imageSize = $options["related_imageSize"];
                
            ?>
            <a href="<?php _e(get_the_permalink($article->ID)); ?>" title="<?php _e(get_the_title($article->ID)); ?>">
                <img src="<?php _e(rrcb_getPostThumbnail($article->ID,$imageSize)); ?>" alt="<?php _e(get_the_title($article->ID)); ?>" class="img-responsive"/></a>
            <h4>
                <a href="<?php _e(get_the_permalink($article->ID)); ?>" title="<?php _e(get_the_title($article->ID)); ?>" >
                    <?php _e(get_the_title($article->ID)); ?>
                </a>
            </h4>
            <p><?php  description($summary, $options["related_summary-max-character-count"]); ?></p>
            <a href="<?php _e(get_the_permalink($article->ID)); ?>" title="<?php _e(get_the_title($article->ID)); ?>" class="read-more">
                <?php _e($cta_text); ?> <i class="fa fa-angle-right fa-lg"></i>
            </a>
            <div class="brdr"></div>

        </div>
    </div>
    <?php
            }
        }

    ?>

    <?php 
        
    }elseif (is_single()) { //for blog post related
        $currentCategories = get_the_category(get_the_ID());
        $currentPostID = get_the_ID();
        $relatedArg = array( 
             'category_name' => $currentCategories[count($currentCategories)-1]->name,
             'posts_per_page'=>$options["max_number-of-related"],
             "order"         => "DESC",
             'post__not_in' => array($currentPostID)
             );
        $related =  new WP_Query($relatedArg);
        $articles = $related;
        $i=0;
        while($articles->have_posts()) :
            $articles->the_post(); 
            if(isset($options["max_number-of-related"]) && $i++>=$options["max_number-of-related"])
                break;
    ?>
    <div class="col-md-4 col-sm-4 mod-<?php _e($currentCategories[count($currentCategories)-1]->name); ?>">
        <div class="inner inner-<?php _e($currentCategories[count($currentCategories)-1]->name); ?>">
            <a href="<?php _e(get_the_permalink($post->ID)); ?>" title="<?php _e(get_the_title($post->ID)); ?>">
                <img src="<?php _e(rrcb_getPostThumbnail($post->ID,$options["related_imageSize"])); ?>" alt="<?php _e(get_the_title($post->ID)); ?>" class="img-responsive"/></a>
            <a href="<?php _e(get_the_permalink($post->ID)); ?>" title="<?php _e(get_the_title($post->ID)); ?>">
                <?php _e(get_the_title($post->ID)); ?> <i class="fa fa-angle-right"></i>
            </a>
            <div class="brdr"></div>
        </div>
    </div>
    <?php 
        endwhile;
        
    }



    ?>

</div>
<?php } ?>