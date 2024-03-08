<?php 

rrcb_showFeature('donation',
            [
             "donation_headline-copy"=>"Give today to help Chicago's homeless men, women and children",
            "donation_headline-sub-copy"=>"Your donation provides safe shelter, hot meals and lasting hope for new lives.",
            "donation_button-label"=>"Donate Now",
            "donation_url"=>"https://donate.com", //url to pass donation amount over
            "donation_items"=>[
                ["amount"=>"44"],
                ["amount"=>"85"],
                ["amount"=>"175"],
                ["amount"=>"250"], 
                ["amount"=>"Other"]
                ], //defaults can be anything
            ]);
rrcb_showFeature('emailsignup', 
    [
    "emailsignup_title-text"=>"Email Sign Up",
    "emailsignup_sub-title-text"=>"Sign up to receive the latest news, stories, and events",
    "emailsignup_button-text"=>"Subscribe",
    "emailsignup_form-id"=>"Let's Connect"
    ], 
    1);

rrcb_showFeature('nav',[
        "nav_menu-name"=>"footer_navigation",
        "nav_class"=>"footer-nav",
        "nav_menu-class"=>"nav nav-justified",
        "nav_menu-depth"=>2,
        "nav_menu-mode"=>"fixed",
        "section_tag" => "section id='footer-nav'",
        "container_class" => "container nav footer-nav sub-nav hidden-xs hidden-sm hidden-md"
    ]);

$ctacopy = get_field("header_donate-button-text", "options") ? get_field("header_donate-button-text", "options") : 'Donate Now';
$ctaUrl = get_field("header_donate-button-url", "options");
$ctaTarget = rrcb_checkLinkShouldOpenNewWindow($ctaUrl);
$donateButton = "<a class=\"btn btn-donate\" role=\"button\" href=\"$ctaUrl\"$ctaTarget>$ctacopy</a>";

rrcb_showFeature('footer', [
        "footer_item-1"=>$donateButton,
        "footer_item-2"=>"Organization Address",
        "footer_item-3"=>'Learn',
        "footer_item-4"=>"Our Impact",
        "footer_item-5"=>"Get Involved",
        "footer_item-6"=>"Follow Us",
        "footer_item-7"=>"501(c)(3) message",
        "footer_item-8"=>"Logos",
        "footer_desktop-layout"=> [
            [1,2,7],
            [3,8],
            [4],
            [5],
            [6]
        ],
        "footer_tablet-layout"=> [
            [1,2,7],
            [3,4],
            [5,6]
        ],
        "footer_mobile-order" => [1,5,2,7],
        "section_tag"=>"footer"
    ], 3);
?>