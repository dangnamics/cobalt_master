<?php 

//Choose header to use

function rrcb_fbmccarran_header_afterLogo_callback()
{
?>
<div class="utility-bar">
    <ul class="container-utility-bar">
        <li class="hidden-xs hidden-sm hidden-md">
            <?php 
    rrcb_showFeature("nav", 
        [
        "nav_menu-name"=>'utility_navigation',
        "nav_menu-class"=>"util-nav hidden-xs hidden-sm hidden-md",
        "nav_menu-depth"=>1,
        "nav_hideWrapperMarkup"=>true
        ]);
            ?>
        </li>

        <li class="hidden-xs hidden-sm hidden-md search">
            <?php 
    rrcb_showFeature("search", [ 
        "search_mode"=>"inset",
        "search_hideWrapperMarkup"=>true
        ]);
    rrcb_showFeature("donation-dropdown", [ 
       "header_donate-button-text"=>"Donate Now",
   "header_donate-button-url"=>"http://www.example.com",
   'header_donate-monthly-url' => "http://www.example.com",
   'header_donate-single-url' => "http://www.example.com",
   'header_donate-btn-tablet' => true,
   'header_enable-dropdown' => false,
   "donation-dropdown_hideWrapperMarkup"=>true,
       ]);

            ?>
        </li>

    </ul>
</div>
<?php
}
add_action("rrcb_feature_header_afterLogo", "rrcb_fbmccarran_header_afterLogo_callback");

function rrcb_fbmccarran_offcanvas_content_callback()
{
    $ctacopy = get_field("header_donate-button-text", "options");
    $ctaUrl = get_field("header_donate-button-url", "options");
    $ctaTarget = ''; //rrcb_checkLinkShouldOpenNewWindow($ctaUrl);
?>
<div class="offcanvas-home-logo">
    <div class="">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img id="logo" src="<?php _e(get_field("header_logo", "options")); ?>"/>
        </a>
    </div>
</div>
<?php
    $ctacopy = "Donate Now"; //get_field("header_donate-button-text", "options");
    $ctaUrl = get_field("header_donate-button-url", "options");
    $ctaTarget = rrcb_checkLinkShouldOpenNewWindow($ctaUrl);
?>
<div class="mobile-donate-btn">
    <div class="inner">
        <a class="btn btn-donate" role="button" href="<?php _e($ctaUrl); ?>"<?php _e($ctaTarget); ?>><?php _e($ctacopy);?></a>
    </div>
</div>
<?php
    rrcb_showFeature("nav", [
        "nav_menu-name"=>'primary_navigation',
        "nav_menu-class"=>"primary_nav",
        "nav_menu-mode"=>"accordion",
        "nav_menu-depth"=>2,
        "nav_menu-id"=>"main-side-nav"
    ]);
    rrcb_showFeature("search", [ "search_mode"=>"inset" ]);
    rrcb_showFeature("nav",
        [
        "nav_menu-name"=>'sidebar-utility_navigation',
        "nav_menu-class"=>"sidebar-util-nav",
        "nav_menu-mode"=>"fixed",
        "nav_menu-depth"=>1,
        ]);
    rrcb_showFeature("social-icons", [
        //"social-icons_hideWrapperMarkup"=>true,
        "section_tag"=>"aside",
        "container_class"=>"container-social"
    ]);
}
add_action("rrcb_feature_offcanvas_content", "rrcb_fbmccarran_offcanvas_content_callback");

$ctaUrl = get_field("header_donate-button-url", "options");
add_filter('rrcb_showFeature_header_inbetween_section_and_container', function ($between) use ($ctaUrl){

	$between = "<script type=\"text/javascript\">\n
	jQuery(window).scroll(function(){\n
		var scrollPos = jQuery(document).scrollTop();\n
		  if(scrollPos > 220){\n
			jQuery(\"header .alt\").addClass(\"sticky\");\n
		  }\n
		  if(scrollPos < 220){\n
			jQuery(\"header .alt\").removeClass(\"sticky\");\n
		  }\n
	});\n
</script>\n
<div class=\"alt\">\n
	<div class=\"container\">\n
		<div class=\"home-logo\" style=\"bottom: 0px; margin-top: 20px;\">\n
			<a href=\"/\">\n
				<img class=\"logo\" src=\"/wp-content/uploads/2017/12/pittsburgh-logo.png\" style=\"width: 186px; height: auto;\" />\n
			</a>\n
		</div><!-- /.home-logo -->\n
		<div class=\"utility-bar\">\n
			<ul class=\"container-utility-bar\">\n
				<li class=\"dropdown donate-btn\">\n
					<a class=\"btn btn-secondary btn-donate hidden-xs hidden-sm hidden-md \" role=\"button\" href=\"{$ctaUrl}?ref=sticky_nav\" style=\"width: 200px;min-height: 52px;font-size: 21px;line-height: normal; margin-top: 17px;\">Donate Now </a>\n
				</li>\n
			</ul>\n
		</div>\n
	</div>\n
</div>\n
<style>\n
  @keyframes fadein {\n
    from {\n
      opacity: 0;\n
    }\n
\n
    to {\n
      opacity: 1;\n
    }\n
  }\n
\n
  @-o-keyframes fadein {\n
    from {\n
      opacity: 0;\n
    }\n
\n
    to {\n
      opacity: 1;\n
    }\n
  }\n
\n
  @-webkit-keyframes fadein {\n
    from {\n
      opacity: 0;\n
    }\n
\n
    to {\n
      opacity: 1;\n
    }\n
  }\n
\n
  @keyframes fadeout {\n
    from {\n
      opacity: 1;\n
    }\n
\n
    to {\n
      opacity: 0;\n
    }\n
  }\n
\n
  @-o-keyframes fadeout {\n
    from {\n
      opacity: 1;\n
    }\n
\n
    to {\n
      opacity: 0;\n
    }\n
  }\n
\n
  @-webkit-keyframes fadeout {\n
    from {\n
      opacity: 1;\n
    }\n
\n
    to {\n
      opacity: 0;\n
    }\n
  }\n
\n
  .alt {\n
    animation-duration: 1s;\n
    animation-name: fadeout;\n
    animation: fadeout 1s;\n
    background: rgba(255,255,255,1);\n
    border-bottom: solid 1px #48952C;\n
    position: fixed;\n
    top: 0px;\n
	left:0;\n
    width: 100%;\n
    display: block;\n
    z-index: 999;\n
    height: 0px;\n
    overflow-y: hidden;\n
    -webkit-transition: height 0.5s linear;\n
    -moz-transition: height 0.5s linear;\n
    -ms-transition: height 0.5s linear;\n
    -o-transition: height 0.5s linear;\n
    transition: height 0.5s linear;\n
  }\n
\n
    .alt.sticky {\n
      animation-duration: 1s;\n
      animation-name: fadein;\n
      animation: fadein 1s;\n
      height: 115px !important;\n
      -webkit-transition: height 0.5s linear;\n
      -moz-transition: height 0.5s linear;\n
      -ms-transition: height 0.5s linear;\n
      -o-transition: height 0.5s linear;\n
      transition: height 0.5s linear;\n
    }\n
	@media (max-width:1023px){\n
		.alt { display: none;}\n
	}\n
</style>";

	return $between;
?>

<?php
});

rrcb_showFeature('offcanvas', ["offcanvas_hideWrapperMarkup"=>true]);
rrcb_showFeature('header', ["header_search"=>true, "section_tag"=>"header", "header_nav-menu-class"=>"nav navbar-nav navbar-right"]);

?>
<hr class="header-break">
<div class="offcanvas-site-cover"></div>
