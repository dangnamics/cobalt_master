<?php
/**
 * Cobalt includes
 *
 * The $cobalt_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/cobalt/cobalt/pull/1042
 */
$cobalt_includes = array(
  'lib/utils.php',           // Utility functions
  'lib/init.php',            // Initial theme setup and constants
  'lib/wrapper.php',         // Theme wrapper class
  'lib/sidebar.php',         // Sidebar class
  'lib/config.php',          // Configuration
  'lib/activation.php',      // Theme activation
  'lib/titles.php',          // Page titles
  'lib/nav/CobaltNavWalker.php',                // Custom nav modifications - Dropdown
  'lib/nav/AccordionNavWalker.php',             // Custom nav modifications - Accordion
  'lib/gallery.php',         // Custom [gallery] modifications
  'lib/scripts.php',         // Scripts and stylesheets
  'lib/extras.php',          // Custom functions
  'lib/acf-settings.php',	 // Advanced Custom Fields Template for Child Themes
  'lib/acf-field-groups.php', // Advance Custom Fields Register Field Groups
);

$fullSiteName = 'www.pittsburghfoodbank.org';
// Require HTTPS, www.
if (isset($_SERVER['PANTHEON_ENVIRONMENT']) &&
  ($_SERVER['PANTHEON_ENVIRONMENT'] === 'live') &&
  (php_sapi_name() != "cli")) {
    if ($_SERVER['HTTP_HOST'] != $fullSiteName ||
        !isset($_SERVER['HTTP_X_SSL']) ||
        $_SERVER['HTTP_X_SSL'] != 'ON' ) {
        header('HTTP/1.0 301 Moved Permanently');
        header('Location: https://'.$fullSiteName. $_SERVER['REQUEST_URI']);
        exit();
    }
}

foreach ($cobalt_includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'cobalt'), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);

/*
 * Setting up the custom Options pages
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
    //acf_add_options_sub_page(array(
    //    'page_title' 	=> 'Theme Home Page Settings',
    //    'menu_title'	=> 'Home',
    //    'parent_slug'	=> 'theme-general-settings',
    //));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

function wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}


add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

add_action('acf/init', 'cb_acf_add_local_field_groups'); //defaults advance customs fields
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' ); //enable gform label hidden
add_filter( 'gform_confirmation_anchor', '__return_true' ); // anchor for all forms


