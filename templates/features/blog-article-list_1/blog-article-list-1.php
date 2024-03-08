<?php
$defaultOptions = [
        "blog-article-list_maxPosts" => 5,
        "blog-article-list_header"=>"Top Articles:"
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

?>
<h2 class="hdr"><?php _e($options["blog-article-list_header"]); ?></h2>
<ul>
<?php
    wp_get_archives([
        'type'=>'postbypost',
        'limit'=>$options["blog-article-list_maxPosts"],
        ]);
?>
</ul>
