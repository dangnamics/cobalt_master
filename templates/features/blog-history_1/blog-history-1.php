<?php
$defaultOptions = [
        "blog-history-list_maxPosts" => 5,
        "blog-history-list_header"=>"Archives:"
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

?>
<h2 class="hdr"><?php _e($options["blog-history-list_header"]); ?></h2>
<ul>

<?php
    wp_get_archives('type=yearly');
?>
</ul>