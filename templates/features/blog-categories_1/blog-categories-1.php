<?php
$defaultOptions = [
        "blog-categories_header"=>"Categories",
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

?>
<h2 class="hdr"><?php _e($options["blog-categories_header"]); ?></h2>
<ul>
    <?php wp_list_categories( array(
        'orderby' => 'name',
        'title_li' => '',
    ) ); ?> 
</ul>