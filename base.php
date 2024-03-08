<?php get_template_part('templates/head'); ?>

<body <?php body_class(); ?> style="">
<?php
if (isset($_ENV['PANTHEON_ENVIRONMENT'])) {
      if ($_ENV['PANTHEON_ENVIRONMENT'] === 'live') {
?>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MHJL7Z"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function (w, d, s, l, i) {
w[l] = w[l] || []; w[l].push({
'gtm.start':
new Date().getTime(), event: 'gtm.js'
}); var f = d.getElementsByTagName(s)[0],
j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
'//www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
})(window, document, 'script', 'dataLayer', 'GTM-MHJL7Z');</script>
<!-- End Google Tag Manager -->
<?php
    }
}
?>
	<!--[if lt IE 9]>
		<div class="alert alert-warning">
			<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'cobalt'); ?>
		</div>
	<![endif]-->




<div class="site-wrapper">

	<!--== HEADER ==-->

	<?php
		get_template_part('templates/header');
	?>

	<!--== // HEADER ==-->


	<!--== CONTENT ==-->

	<?php 
    do_action("rrcb_base_template_showing");
    include cobalt_template_path(); 
    do_action("rrcb_base_template_shown");
        ?>

	<!--== // CONTENT ==-->


	<!--== FOOTER ==-->
	<?php get_template_part('templates/footer'); ?>
	
	<!--== // FOOTER ==-->

</div><!-- /.site-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
