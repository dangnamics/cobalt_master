<?php
$defaultOptions = [
        "footer_contact-info"=>"<h5>Cobalt Rescue Mission</h5>
					
					<p>1234 Address Ave.<br>
					Cityname, ST 12345<br>
					info@cobaltrescuemission.org<br>
					(555) 123-4567</p>
					
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
					sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>
					
					<p>Cobalt Rescue Mission is a non-profit 501(c)(3) organization.</p>",
        "footer_sub1"=>"<h5>Be Social</h5>
					
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</p>
					
					<a class=\"read-more\" href=\"http://example.com\" title=\"Read More\">Read More</a>",
        "footer_sub2"=>"<h5>Donate Now</h5>
					
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
					sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>
					
					<a class=\"btn\" href=\"http://example.com\" title=\"Call to Action\">Donate Now</a>",
        "footer_icon-row"=>"",
        "footer_reverse-for-mobile" => false
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

if($options["footer_reverse-for-mobile"])
{
?>
	<div class="row mobile-footer sub1 hidden-md hidden-lg">
			
		<div class="col col-sm-12 sub2-info">
			<?php _e($options["footer_sub2"]);?>
		</div><!-- /.sub2-info -->
			
		<div class="col col-sm-12 sub1-info">
			<?php _e($options["footer_sub1"]);?>
		</div><!-- /.sub1-info -->
				
		<div class="col col-sm-12 contact-info">
			<?php _e($options["footer_contact-info"]);?>
		</div><!-- /.contact-info -->
				
	</div><!-- /.row mobile -->
<?php
}
?>
	<div class="row sub1<?php _e($options["footer_reverse-for-mobile"] ? " hidden-sm hidden-xs" : ""); ?>">
			
		<div class="col col-md-6 contact-info">
			<?php _e($options["footer_contact-info"]);?>
		</div><!-- /.contact-info -->
				
				
		<div class="col col-md-3 sub1-info">
			<?php _e($options["footer_sub1"]);?>
		</div><!-- /.sub1-info -->
				
				
		<div class="col col-md-3 sub2-info">
			<?php _e($options["footer_sub2"]);?>
		</div><!-- /.sub2-info -->
			
	</div><!-- /.row -->
<?php if(isset($options["footer_icon-row"])) { ?>
    <div class="row footer-icon-row">
			<?php _e($options["footer_icon-row"]);?>
    </div>
<?php } ?>





	<?php /*
	<nav class="footer-nav" role="navigation">
		<?php
			if (has_nav_menu('footer_navigation')) :
				wp_nav_menu(array(
					'theme_location' => 'footer_navigation', 
					'menu_class' => 'nav footer_nav',
                    'menu_depth' => 2
					));
			endif;
		?>
	</nav>
	*/ ?>
    
    
    
   				
