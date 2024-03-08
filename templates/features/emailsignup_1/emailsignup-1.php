<?php 
$defaultOptions = [
    "emailsignup_title-text"=>"Sign up to receive the latest news, stories and events",
    "emailsignup_sub-title-text"=>true,
    "emailsignup_button-text"=>"Sign me up",
    "emailsignup_form-id"=>"Email Sign Up",
    "emailsignup_tab-index"=>1
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

?>
<h4 class="title"><?php _e($options["emailsignup_title-text"]); ?></h4>
<?php if($options["emailsignup_sub-title-text"]){ ?>
    <h5 class="small"><?php _e($options["emailsignup_sub-title-text"]); ?></h5>
<?php } 
      if(function_exists("gravity_form")){
          gravity_form($options["emailsignup_form-id"], false, true,false, null, false, $options['emailsignup_tab-index']);
      }      
      ?>		
		