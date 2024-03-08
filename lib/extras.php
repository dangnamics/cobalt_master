<?php
/**
 * Clean up the_excerpt()
 */
function cobalt_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'cobalt') . '</a>';
}
add_filter('excerpt_more', 'cobalt_excerpt_more');


// REMOVES LINNK TO MEDIA
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);


function my_pre_save_post( $post_id )
{
    // check if this is to be a new post
    if( $post_id != 'new' )
    {
        return $post_id;
    }

    // Create a new post
    $post = array(
        'post_status'  => 'draft' ,
        'post_title'  => 'A title, maybe a $_POST variable' ,
        'post_type'  => 'post' ,
    );  

    // insert the post
    $post_id = wp_insert_post( $post ); 

    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );    

    // return the new ID
    return $post_id;
}

add_filter('acf/pre_save_post' , 'my_pre_save_post' );

