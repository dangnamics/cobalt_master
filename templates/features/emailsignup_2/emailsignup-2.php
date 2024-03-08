<?php 

$defaultOptions = [
    "emailsignup_title-text"=>"Signup to recieve the latest news",
    "emailsignup_sub-title-text"=>false,
    "emailsignup_button-text"=>"Sign me up"
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

?>
<div class="container">
		
	<h4 class="title"><?php _e($options["emailsignup_title-text"]); ?></h4>
<?php if($options["emailsignup_sub-title-text"]){ ?>
    <h5 class="small"><?php _e($options["emailsignup_sub-title-text"]); ?></h5>
<?php } ?>		
	<form action="#" class="form-inline">
		<div class="form-group">
			<input class="form-control" type="email" id="emailsignupEmail" placeholder="name@example.com" required="required">
		</div>
		<button type="submit" class="btn btn-default"><?php _e($options["emailsignup_button-text"]); ?></button>
	</form>
		
</div><!--/.container-->

