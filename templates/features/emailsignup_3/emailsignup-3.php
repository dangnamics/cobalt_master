
<?php
$defaultOptions = [
    "emailsignup_optin-slug"=>"",
    "emailsignup_optin-user"=>""
    ];
$options = rrcb_featureApplyDefaults($defaultOptions);

if($options["emailsignup_optin-user"])
    include "optinmonster-api.php";
else
    include "optinmonster-plugin.php";
?>


