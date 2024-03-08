<?php
/*
Template Name: Blog Page
This template is not used for Blog unless you do not specify a blog page. home.php is the default blog page.
 */

get_template_part('templates/page', 'banner');
rrcb_showFeature("breadcrumbs");
rrcb_showFeature("mixed", [
        "payload"=>[
            "content"=>["content_mode"=>"post"],
            "mixed"=>[
                "mixed_numberOfRows"=>2,
                "mixed_numberOfColumns"=>1,
                "payload"=>[
                    "blog-history"=>[
                        ],
                    "blog-article-list"=>[
                        ]
                ]
            ]
        ],
        "mixed_splitPercentage"=>[80,20]
    ]);
rrcb_showFeature("content", ["content_mode"=>"post"]);

?>