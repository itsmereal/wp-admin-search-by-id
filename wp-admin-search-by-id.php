<?php
/*
Plugin Name: WP Admin Search by ID
Description: Search by ID in WordPress Dashboard
Version: 1.0
Author: Al-Mamun Talukder
Author URI: http://itsmereal.com
License: MIT
License URI: https://opensource.org/licenses/MIT
*/

function wp_admin_search_by_id( $search, $wp_query ) {
    if ( ! is_admin() ) {
        return $search;
    }

    if ( ! $wp_query->is_main_query() && ! $wp_query->is_search() ) {
        return $search;
    }   

    $search_string = get_query_var( 's' );

    if ( ! filter_var( $search_string, FILTER_VALIDATE_INT ) ) {
        return $search;
    }
    
    return "AND wp_posts.ID = '" . intval( $search_string )  . "'";
}

add_filter( 'posts_search', 'wp_admin_search_by_id', 10, 2 );
