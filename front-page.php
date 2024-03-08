<?php
/*
Template Name: Home Page Template
Notes: Changed to front-page.php to always have this set as Home Page if static Home is not set
Content area is not required or pulled in. 
 */
?>
<?php 

//Hero Image area
rrcb_showFeature('hero',
    [
    "hero_donate-button-label"=>"You can help",
    "hero_headline-copy"=>"Creating Better Futures",
    "hero_headline-sub-copy"=>"one meal at a time",
    "hero_imageHeight" => 770,
    "container_class" => "container-fluid",
    "hero_content-display-mode"=>"full",
    "hero_imageSize" => 'home-hero-banner',
    "hero_max-video-device-width" => 'hidden-xs hidden-sm'
    ]);

//Donation 1
rrcb_showFeature('donation',
    [
        
        "donation_button-label"=>"Donate Now",
        "donation_string"=>"amt",
        "donation_class"=> "donation-widget",
    ]);
?>
<hr class="icon" />
<?php
//Value Prop 1
rrcb_showFeature('valueprop', 
    [
   "valueprop_title"=>"Greater Pittsburgh Community Food Bank",
    "valueprop_caption"=> "",
    "value-prop-copy"=>"With your support, we bridge communities and resources throughout southwestern Pennsylvania to help neighbors overcome food insecurity and lead happy, healthy lives.",
]);

?>

<?php
//Touts 1
rrcb_showFeature('touts', 
    [
    "touts_header-position" => "after",
    "touts_section-title"=>"<b>Neighbors</b> helping neighbors",
    "touts_max-number-of-items"=> 3,
    "touts_link-position"=>"after",
    "touts_imageSize" => "home-touts",
   
    "touts_mobile-rotator" => false,
    "touts_items"=> [
         [
        "title"=>"MONTHLY GIVING", 
        "caption"=>"You can help meet the needs of our neighbors who struggle and stabilize lives on an ongoing basis. Monthly giving is the most impactful way to make a lasting difference.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Give Now",
        "image"=> "http://placehold.it/300x191"],
        [
        "title"=>"VOLUNTEER", 
        "caption"=>"Lend your hands and heart to our mission. Volunteers are vital to everything we do at the Food Bank and we'd love to welcome you to our family.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Learn More",
        "image"=> "http://placehold.it/300x191"],
        [
        "title"=>"Speak Out", 
        "caption"=>"Be a voice for local children, families and seniors struggling with food insecurity. There are many opportunities to be heard.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Learn More",
        "image"=> "http://placehold.it/300x191"],
        
         ]
    ]);
?>

<?php
//Value Prop 2
rrcb_showFeature('valueprop', 
    [
   "valueprop_title"=>"Healthy Meals",
    "valueprop_sub_title"=> "lead to happier lives",
    "value-prop-copy"=>"Food is something we all need and something we can all share. With the community's support, we work to increase access to nutritious food and foster long-term stability for neighbors who struggle.",
    "valueprop_link_text"=>"Read More",
    "valueprop_link_url"=>"http://www.example.com",
]);

?>




<?php
//Inforgraphics
rrcb_showFeature('infographic', 
  [
      "infographic_max-number-of-items"=>3,
      "infographic_title"=>"<b>The Impact</b> we make together", 
      "infographic_sub-title"=>"Eliminating food insecurity and the worry that goes with it is something we can all do together. By supporting the Food Bank, donors and volunteers and everyone in the community can be part of a lasting solution for people who are struggling.",
      "infographic_call-to-action-url"=>"http://www.example.com/", 
      "infographic_cta-label"=>"Learn More", 
      "infographic_imageSize" => "home-infographics",
      "infographic_ticker" => false,
      "infographic_items" => [[
      "image"=>"http://placehold.it/266x266", 
      "caption"=>"31,000,000", 
      "sub-caption"=>"meals distributed",
      "link"=>"http://www.example.com"],
      [
      "image"=>"http://placehold.it/266x266", 
      "caption"=>"5,412", 
      "sub-caption"=>"volunteers",
      "link"=>"http://www.example.com"],
      [
      "image"=>"http://placehold.it/266x266", 
      "caption"=>"7,100,100", 
      "sub-caption"=>"pounds of fresh product",
      "link"=>"http://www.example.com"]
      ]
  ],2); ?>


<?php
//Touts 2
rrcb_showFeature('touts', 
    [
    "touts_header-position" => "after",
    "touts_section-title"=>"<b>Filling</b> plates. <b>Building</b> bridges.",
    "touts_section-description"=>"By strengthening community connections, we're working to make southwestern Pennsylvania 100% hunger-free as we help those we serve get on the path to a bright futures.",
    "touts_max-number-of-items"=> 4,
    "touts_link-position"=>"after",
    "touts_imageSize" => "home-touts",
   
    "touts_mobile-rotator" => false,
    "touts_items"=> [
         [
        "title"=>"Food to people", 
        "caption"=>"Lorem ipsum dolor sit amet, elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Give Now",
        "image"=> "http://placehold.it/300x191"],
        [
        "title"=>"Resources", 
        "caption"=>"Lorem ipsum dolor sit amet, elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Learn More",
        "image"=> "http://placehold.it/300x191"],
        [
        "title"=>"Partners", 
        "caption"=>"Lorem ipsum dolor sit amet, elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Learn More",
        "image"=> "http://placehold.it/300x191"],
        
         [
         "title"=>"How we work", 
        "caption"=>"Lorem ipsum dolor sit amet, elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Learn More",
        "image"=> "http://placehold.it/300x191"],
        
         ]
    ]);
?>

<?php
//Touts 1
rrcb_showFeature('touts', 
    [
    "touts_header-position" => "before",
    "touts_section-title"=>"<b>On Their Feet</b> again",
     "touts_section-description"=>"Making neighbors lives better is the reason we do what we do. Here are a few stories that friends like you helped create.",
    "touts_max-number-of-items"=> 3,
    "touts_link-position"=>"after",
    "touts_imageSize" => "home-touts",
   
    "touts_mobile-rotator" => false,
    "touts_items"=> [
         [
        "title"=>"Sarah", 
        "caption"=>"Lorem ipsum dolor sit amet, elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Read more",
        "image"=> "http://placehold.it/300x191"],
        [
        "title"=>"Amber", 
        "caption"=>"Lorem ipsum dolor sit amet, elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Read more",
        "image"=> "http://placehold.it/300x191"],
        [
        "title"=>"The Smiths", 
        "caption"=>"Lorem ipsum dolor sit amet, elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient.", 
        "link_url"=>"http://www.example.com",
        "link_text"=> "Read more",
        "image"=> "http://placehold.it/300x191"],
        
         ]
    ]);
?>

<?php 

//Blog Query
$blog_query = query_posts("posts_per_page=3&post_type=post&post_status=publish&order=DESC");
//Events Query
$pageEvents = (get_page_by_title( 'Events' ));
// Get an array of Ancestors and Parents if they exist 

$eventsdArg = array(
'sort_order' => 'DESC',
'number'=>2,
'sort_column' => 'menu_order',
'hierarchical' => 0,    
'parent' => $pageEvents->ID,
'post_type' => 'page',
'offset' => 0,
'post_status' => 'publish');
$events = get_pages($eventsdArg); 


?>
<section class="blog-news-section">
    <div class="newsfeed-border-top"></div>
    <div class="container blog-news-container">
        
        <div class="row mixin-section blog-news-section">
            <div class="col-md-6">
                <?php
                rrcb_showFeature("newsfeed", [
                       "newsfeed_title"=>"<b>Blog</b>",
                       
                       "newsfeed_articles"=> $blog_query,
                       "newsfeed_summary-max-character-count" => 80,
                       "newsfeed_imageSize" => "home-blog",
                       "newsfeed_use-place-holder-image" => true,
                       "newsfeed_display-date" => true
                       ]);
                ?>

            </div>
            <div class="col-md-6">
                <?php
                rrcb_showFeature("newsfeed", [
                       "newsfeed_title"=>"<b>Upcoming</b> events",
                       
                       "newsfeed_articles"=> $events,
                       "newsfeed_summary-max-character-count" => 80,
                       "newsfeed_imageSize" => "home-events",
                       "newsfeed_use-place-holder-image" => true
                       ]);
                ?>
            </div>
        </div>
    </div>
</section>
