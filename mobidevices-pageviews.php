<?php
/*
Plugin Name: MobiDevices PageViews
Plugin URI: http://mobidevices.ru
Description: Displaying the number of views your publications in the admin
Version: 1.1
Author: MobiDevices Soft
Author URI: http://mobidevices.ru
Author Email: md@mobidevices.ru
*/

function es_pageviews(){
    if(is_single()){
        global $post;
        if ($post->post_status == 'publish') {
            $pv = get_post_meta($post->ID, '_pageviews', true);
            update_post_meta($post->ID, '_pageviews', $pv + 1);
        }
    }
}
function display_pageviews($columns){
    $columns['pv'] = __('Просмотры');
    return $columns;
}
function display_pageviews_row($column_name,$post_id){
    if ($column_name != 'pv') return;
    $pv = get_post_meta($post_id, '_pageviews',true);
    echo $pv ? $pv : 0;
}
function the_pageview(){
    global $post;
    $pv = get_post_meta($post->ID, '_pageviews',true);
    echo $pv ? $pv : 0;
}
function view_style(){
    echo '<style>#pv{width:100px}</style>';
}
add_action('wp','es_pageviews');
add_filter('manage_posts_columns','display_pageviews');
add_action('manage_posts_custom_column','display_pageviews_row',10,2);
add_action('admin_head','view_style');