<?php

?>
<!-- This site is converting visitors into subscribers and customers with OptinMonster - http://optinmonster.com -->
<div id="om-<?php _e($options["emailsignup_optin-slug"]); ?>-holder"></div>
<script>
    var <?php _e($options["emailsignup_optin-slug"]); ?>, <?php _e($options["emailsignup_optin-slug"]); ?>_poll = function() {
        var r = 0;
        return function(n, l) {
            clearInterval(r), r = setInterval(n, l)
        }
    }();
    ! function(e, t, n) {
        if (e.getElementById(n)) {
            <?php _e($options["emailsignup_optin-slug"]); ?>_poll(function() {
                if (window['om_loaded']) {
                    if (!<?php _e($options["emailsignup_optin-slug"]); ?>) {
                        <?php _e($options["emailsignup_optin-slug"]); ?> = new OptinMonsterApp();
                        return <?php _e($options["emailsignup_optin-slug"]); ?>.init({
                            u: "<?php _e($options["emailsignup_optin-user"]); ?>",
                            staging: 0
                        });
                    }
                }
            }, 25);
            return;
        }
        var d = false,
            o = e.createElement(t);
        o.id = n, o.src = "//a.optinmonster.com/app/js/api.min.js", o.onload = o.onreadystatechange = function() {
            if (!d) {
                if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") {
                    try {
                        d = om_loaded = true;
                        <?php _e($options["emailsignup_optin-slug"]); ?> = new OptinMonsterApp();
                        <?php _e($options["emailsignup_optin-slug"]); ?>.init({
                            u: "<?php _e($options["emailsignup_optin-user"]); ?>",
                            staging: 0
                        });
                        o.onload = o.onreadystatechange = null;
                    } catch (t) {}
                }
            }
        };
        (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(o)
    }(document, "script", "omapi-script");
</script>
<!-- / OptinMonster -->