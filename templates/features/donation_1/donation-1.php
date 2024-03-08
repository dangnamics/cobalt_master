<?php
/* Feature Name: Donation-1 v.1.0
 * Feature Function: Shows a range of donation button and pass donation amount to some unknown location 
 * Date: 9/22/2016
 * Last Modified: 9/22/2016
 * Notes : Buttons are used on a donation form, uses jquery to append link to query string and donation amount. 
 * 
 */
defined("BOOTSTRAP_COLUMNS") or define("BOOTSTRAP_COLUMNS", 12);

$defaultOptions = [
    "donation_headline-copy"=>"Make a Donation",
	"donation_headline-sub-copy"=>"Your donation will give the men, women and children served at Light of Life a chance at a brand new life.",
	"donation_button-label"=>"Donate",
    "donation_url"=>"", //url to pass donation amount over
    "donation_string"=>"amt",
    "donation_items"=>[], //defaults can be anything
    "donation_default"=>"",
    "donation_enable-other"=>true,
	"donation_class"=> "donation-widget",
	];
$options = rrcb_featureApplyDefaults($defaultOptions);
$donationItems = $options["donation_items"];

//figure out the query string inside the url and append the correct string
$queryString = (strpos($options["donation_url"], '?') == true ? "&" : "?");

?>


     <?php if($options["donation_headline-copy"]){ ?>
    <div class="row <?php if($options["donation_class"]){  _e($options["donation_class"]); } ?>">
     <div class="<?php _e($options["donation_class"]); ?> hdr-row col-md-12 col-sm-12">
        <h2 class="hdr "><?php _e($options["donation_headline-copy"]); ?></h2>
        <?php if($options["donation_headline-sub-copy"]) ?><p><?php _e($options["donation_headline-sub-copy"]); ?></p> 
     </div>
    </div>
    <div class="row <?php if($options["donation_class"]) _e($options["donation_class"]);  ?>-amount">
	<?php 
       } //eof donation title

     foreach ($donationItems as $donationItem){ ?>
        <span class="donation-widget <?php if($options["donation_default"] == $donationItem["amount"]){ _e("default "); } ?><?php if($donationItem["amount"]) _e($options["donation_class"]);  ?>-<?php _e($donationItem["amount"])  ?>"><a class="<?php if($options["donation_default"] == $donationItem["amount"]){ _e("on-atm "); } ?> <?php if($options["donation_class"]) _e($options["donation_class"]);  ?> action-amt" data-amt='<?php _e($donationItem["amount"])  ?>'>$<?php _e($donationItem["amount"])  ?></a></span>
   <?php  }
	    
 ?>

<?php if($options["donation_enable-other"]) { ?>
    <span class="donation-widget amt-other"><a class="donation-widget action-amt">$ <input id="otherAtm" class="open" type="text" placeholder="Other"></a></span>
<?php  } ?>
    <a class="donate-btn-widget" href="<?php _e($options["donation_url"]);_e($queryString); _e($options["donation_string"]); ?>="><?php $options["donation_button-label"] ? _e($options["donation_button-label"]) : _e("Doante");  ?></a>
    </div>


<script>
    //need to move to scripts.js
    jQuery(document).ready(function ($) {
        //find default and set donation link to default value
        var defaultValue = $("a.on-atm").data('amt');
        
        //find the donate button complete link
        var donateBtn = $("a.donate-btn-widget").attr('href');
        //disable donate button unless amount is chosen
        $("a.donate-btn-widget").bind('click', false);

        //onclick get donation amount and append it to the end of the link

        $("a.donate-btn-widget").attr('href', donateBtn + defaultValue);

        $("a.action-amt").click(function () {
            var amount = $(this).data('amt');
            //button is already on, removed from other
            $(".donation-widget-amount").find(".on-atm").removeClass("on-atm");
            //add a class for styling
            $(this).addClass("on-atm");

            //append donation link to the donate btn widget only
            $("a.donate-btn-widget").attr('href', donateBtn + amount);
            $("a.donate-btn-widget").unbind('click', false);

        });
        $("#otherAtm").focus(function () {
            $(this).change(function () {             
                var otherDonateAmt = $(this).val();
                $("a.donate-btn-widget").attr('href', donateBtn + otherDonateAmt);
            });
        });
			
	}); 
</script>

