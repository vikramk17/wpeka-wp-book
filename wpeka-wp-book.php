<?php
/*
plugin name: WP book
Description: This is Wpeka plugin development assignment - book plugin.
Author: Vikram Kadam
version: 2.1.1
*/


/*******************************
includes
********************************/
include('includes/custom-post-type.php');
include('includes/custom-taxonomy.php');
include('includes/custom-metabox.php');
include('includes/settings.php');
include('includes/shortcode.php');
include('includes/widget.php');
include('includes/dashboard-widget.php');


// function to add custom table to database

function wpb_book_meta_install() {

    global $wpdb;

  	$table_name = $wpdb->prefix . 'bookmeta';

  	$charset_collate = $wpdb->get_charset_collate();

  	$max_index_length = 191;

  	$install_query = "CREATE TABLE $table_name (
  		meta_id bigint(20) unsigned NOT NULL auto_increment,
  		post_id bigint(20) unsigned NOT NULL default '0',
  		meta_key varchar(255) default NULL,
  		meta_value longtext,
  		PRIMARY KEY  (meta_id),
  		KEY post (post_id),
  		KEY meta_key (meta_key($max_index_length))
  	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    dbDelta( $install_query );
}
register_activation_hook( __FILE__, "wpb_book_meta_install" );


//hook into init for single site, priority 0 = highest priority
add_action('init', 'wpb_bookmeta_integrate_wpdb', 0);

// hook in to switch blog to support multisite
add_action( 'switch_blog', 'wpb_bookmeta_integrate_wpdb' );

/**Integrates bookmeta table with $wpdb **/
function wpb_bookmeta_integrate_wpdb() {
  	global $wpdb;

  	$wpdb->bookmeta = $wpdb->prefix . 'bookmeta';
  	$wpdb->tables[] = 'bookmeta';

  	return;
}


//Replicate Wrapper Functions for book meta

function add_book_meta( $book_id, $meta_key, $meta_value, $unique = false ) {
	 return add_metadata( 'book', $book_id, $meta_key, $meta_value, $unique );
}

function delete_book_meta( $book_id, $meta_key, $meta_value = '' ) {
	 return delete_metadata( 'book', $book_id, $meta_key, $meta_value );
}

function get_book_meta( $book_id, $key = '', $single = false ) {
	 return get_metadata( 'book', $book_id, $key, $single );
}

function update_book_meta( $book_id, $meta_key, $meta_value, $prev_value = '' ) {
	 return update_metadata( 'book', $book_id, $meta_key, $meta_value, $prev_value );
}
