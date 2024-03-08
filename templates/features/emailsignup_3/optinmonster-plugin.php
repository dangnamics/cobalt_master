<?php
/* from https://old.optinmonster.com/docs/manually-add-after-post-optin/ */
_e("<!-- optinmonster plugin ".$options["emailsignup_optin-slug"]."-->");
optin_monster_tag( $options["emailsignup_optin-slug"]);
_e("<!--/.optimonster plugin-->")
?>