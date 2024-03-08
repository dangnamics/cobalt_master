
<div class="inner">
<?php
$defaultOptions = [
        "content_mode"=>"static", // Can be "post", "static", or "acf"
        "content_payload"=>"Lorem ipsum dolor sit amet, consectetur adipiscing.",
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

?>
    <?php
    switch($options["content_mode"])
    {
        case "post":
            while (have_posts()) :
                if(is_single()){//if post type
                    _e( "<h2>" . (get_the_title($post)) . "</h2>");
                    _e( "<h3>By ");
                    the_author();
                    _e( "</h3>");
                }
                 the_post();
                _e(rrcb_getContent());
                wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>'));
            endwhile;
            break;
        case "locator":
                global $post;
                 $queried_object = get_queried_object();
                if(is_single()){//if post type
                    _e( "<h2>" . (get_the_title($post)) . "</h2> <span class='print-link'><a href='#' id='print-button' onclick='window.print();return false;'>Print this page</a></span>");
                }
                echo do_shortcode( '[wpsl_map zoom="15"]' );
                _e(rrcb_getContent());
                // Add the address shortcode
                    echo do_shortcode( '[wpsl_address]' );
                $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
                echo "<a class='locator-back' href='/get-help/locator'><i class='fa fa-caret-left' aria-hidden='true'></i> Back</a>";
            break;
        case "post-full":
            while (have_posts()) :
                the_post();
                _e("<a href=\"".get_permalink(get_the_ID())."\"><h2 class=\"hdr post-hdr\">");
                the_title();
                _e("</h2></a>\n");
                _e("<div class=\"post-body\">");
                _e(rrcb_getContent());
                _e("</div>");
                wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>'));
            endwhile;
            break;
        case "query" :
            $the_query = $options["content_payload"];
            while ($the_query->have_posts()) :
                $the_query->the_post();
                _e(rrcb_getContent());
                wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>'));
            endwhile;
            break;
        case "static" :
            _e($options["content_payload"]);
            break;
        case "acf":
            _e(the_field($options["content_payload"]));
            break;
    }
    ?>
</div><!--/ INNER END -->