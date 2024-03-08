<?php
$defaultOptions = ["offcanvas_hideWrapperMarkup"=>true];
$options = rrcb_featureApplyDefaults($defaultOptions);

//function offcanvas_showFeature()
//{
?>
<div class="side-nav-bar hidden-lg">
    <div class="navbar-collapse sidebar-offcanvas" id="sidebar" role="navigation">
        <?php 
        do_action("rrcb_feature_offcanvas_content");
        ?> 

    </div> <!--/.sidebar-offcanvas-->
</div>
<?php 
        //} 
?>