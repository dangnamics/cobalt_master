<?php
$feature_name = 'Header'; // Feature Name
$feature_version = '1'; // Version Number

$defaultOptions = ["header_logo"=>"http://placehold.it/225x125&text=LOGO",
    "header_partner_login_url"=>false,
    "header_tagline-copy"=>false,
    "header_utility-nav-menu-name"=>"utility_navigation",
    "header_nav-menu-class" => "nav navbar-nav navbar-right",
    "header_search"=>false];
$options = rrcb_featureApplyDefaults($defaultOptions);

$logoClass = apply_filters('header_home-logo-class','home-logo');
$buttonClass = apply_filters('header_button-class','navbar-toggle collapsed');
$navbarClass = apply_filters('header_navbar-class','navbar hidden-sm hidden-xs hidden-md');

$hideWrapperMarkup = true;

?>
				<div class="<?php _e($logoClass); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo" src="<?php _e($options["header_logo"]); ?>"/></a>
<?php if($options['header_tagline-copy']) { ?>
					<div class="tagline" role="contentinfo">
						<?php _e($options["tagline-copy"]); ?>
					</div>
<?php } ?>
				</div><!-- /.home-logo -->
<?php 
    // To give Cobalt the flexibility to add whatever they want after the logo
    do_action("rrcb_feature_header_afterLogo"); 
?>
                    <div class="navbar-header">
                      <button type="button" class="<?php _e($buttonClass); ?>" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar icon-bar-top"></span>
                        <span class="icon-bar icon-bar-middle"></span>
                        <span class="icon-bar icon-bar-bottom"></span>
                      </button>
                    </div>

                <div class="clearfix"></div>
        
                <nav class="<?php _e($navbarClass); ?>">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php 
    do_action("rrcb_feature_header_mobileMenu_top");
    rrcb_showFeature("nav", ["nav_class"=>"header-nav hidden-sm hidden-xs ", "nav_hideWrapperMarkup"=>true, "nav_menu-class"=>$options["header_nav-menu-class"]]); 
    do_action("rrcb_feature_header_mobileMenu_bottom"); 
    ?>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
<?php /*

<ul class="nav nav-pills nav-justified">
<?php
    rrcb_showFeature("nav", 
            [
            "nav_menu-name"=>"primary_navigation",
            "nav_class"=>"primary-nav",
            "nav_menu-class"=>"nav navbar-nav",
            "nav_menu-depth"=>2,
            ]); ?></ul>


				<div class="navigation">
			
						<?php /*
    rrcb_showFeature("nav", 
            [
            "nav_menu-name"=>"primary_navigation",
            "nav_class"=>"primary-nav",
            "nav_menu-class"=>"nav navbar-nav",
            "nav_menu-depth"=>2,
            ]); 

				</div><!-- /.navigation -->*/ ?>
			


<?php $hideWrapperMarkup = false; ?>