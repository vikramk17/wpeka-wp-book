<?php

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
