<?php
/*
Template Name: Staff and Board
 */
const STAFF_BIO_MAXLENGTH = 650;
get_template_part('templates/page', 'banner');

function rrcb_gbfb_staff_item_show($staff_member){
    if(isset($staff_member->tag) && isset($staff_member->tag["staff_group"]))
    {
        switch ($staff_member->tag["staff_group"])
        {

            case 'Executive Leadership':
                $staff_member->showFunction = function() use ($staff_member)
                 {
                     $imageLine = "<img class=\"img staff-member-img img-responsive\" src=\"{$staff_member->imageUrl}\" />";
                     $nameLine = "<div class=\"staff-member-name\">{$staff_member->headerCopy}</div>";
                     $titleLine = "<div class=\"staff-member-title\">{$staff_member->tag["staff_title"]}</div>";
                     _e("<div class=\"non-excutive\">");
                      _e($imageLine);
                     _e($nameLine);
                     if($staff_member->tag["staff_title"]){
                     _e($titleLine);
                     }
                      _e("</div>");
                 };
                break;
            case 'Board of Directors':
                $staff_member->showFunction = function() use ($staff_member)
                {
                    $nameLine = "<span class=\"staff-member-name\">{$staff_member->headerCopy}</span>";
                    $titleLine = "<span class=\"staff-member-title\">{$staff_member->tag["staff_title"]}</span>";
                    _e("<div class=\"non-excutive\">");
                    _e($nameLine . " ");
                    _e($titleLine);
                    _e("</div>");
                };
                break;
            case 'Staff':
                $staff_member->showFunction = function() use ($staff_member)
                {
                   
                    $nameLine = "<span class=\"staff-member-name\">{$staff_member->headerCopy}</span>";
                    $titleLine = "<span class=\"staff-member-title\">{$staff_member->tag["staff_title"]}</span>";
                  
                   _e("<div class=\"staff\">");
                   _e($nameLine . " - "); 
                   _e($titleLine); 
                   _e("</div>");
                };
                break;
        }

    }

    return $staff_member;
}
add_action("staff_item_show", "rrcb_gbfb_staff_item_show");

rrcb_showFeature("content", ["content_mode"=>"post"]);

rrcb_showFeature("staff",
    [
        "staff_numberOfColumns" => 3,
        "staff_groupings" => ["Executive Leadership"],
        "staff_caption" => "Our dedicated staff works tirelessly to bring help and hope to homeless and hurting men, women and children in the greater Pittsburgh area.",
        'staff_imageSize' => "staff-member-thumbnail",
        "tag_keys" => ["staff_group", "staff_title"],
        'thumbnail_hideInlineSizes'=>false
    ]);
?>
<hr class="break" />
<?php
rrcb_showFeature("staff",
    [
        "staff_numberOfColumns" => 2,
        "staff_groupings" => ["Board of Directors"],
        "tag_keys" => ["staff_group", "staff_title"],
        'thumbnail_hideInlineSizes'=>false
    ]);
?>

<?php
rrcb_showFeature("staff",
    [
        "staff_numberOfColumns" => 1,
        "staff_groupings" => ["Staff"],
        "tag_keys" => ["staff_group", "staff_title"],
        'thumbnail_hideInlineSizes'=>false
    ]);
?>

