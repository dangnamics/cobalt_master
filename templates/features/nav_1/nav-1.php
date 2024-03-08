<?php
$defaultOptions = [
        "nav_menu-name"=>"primary_navigation",
        "nav_class"=>"header-nav",
        "nav_menu-class"=>"nav nav-justified",
        "nav_menu-mode"=>"dropdown", // Can be "dropdown", "accordion", or "fixed"
        "nav_menu-depth"=>2,
        "nav_menu-id" => ""
    ];

$options = rrcb_featureApplyDefaults($defaultOptions);
$outerId = "{$options["nav_menu-id"]}";
if($options["nav_menu-mode"] == "accordion")
    $options["nav_class"] .= " panel-group collapse navbar-collapse";
?>
    <nav class="<?php _e($options["nav_class"]); ?>" id="<?php _e($outerId); ?>" role="navigation">
	    <?php
        $args = [
		    'theme_location' => $options["nav_menu-name"], 
		    'menu_class' => $options["nav_menu-class"],
		    'depth' => $options["nav_menu-depth"]
		    ];
        switch ($options["nav_menu-mode"])
        {
            case "dropdown":
                $args["walker"] = new CobaltNavWalker();
                break;
            case "accordion":
                $args["walker"] = new Roots_Nav_Walker();
                $args["menu_class"] = "list-unstyled main-menu";
                $args["menu_id"] = "slideMenu";
                break;
            default:
                $args["walker"] = new Walker_Nav_Menu();
                break;
        }
        
            if (has_nav_menu($options["nav_menu-name"])) {
	            wp_nav_menu($args);
            }?>
    </nav>