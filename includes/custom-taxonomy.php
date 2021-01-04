<?php
//function to Create a custom hierarchical taxonomy Book Category

function wpb_register_taxonomy_book_category() {
     $labels = array(
         'name'              => _x( 'Book Category', 'wp-book' ),
         'singular_name'     => _x( 'Book Category', 'wp-book' ),
         'search_items'      => __( 'Search Book Category', 'wp-book' ),
         'all_items'         => __( 'All Book Category', 'wp-book' ),
         'parent_item'       => __( 'Parent Book Category', 'wp-book' ),
         'parent_item_colon' => __( 'Parent Book Category:', 'wp-book' ),
         'edit_item'         => __( 'Edit Book Category', 'wp-book' ),
         'update_item'       => __( 'Update Book Category', 'wp-book' ),
         'add_new_item'      => __( 'Add New Book Category', 'wp-book' ),
         'new_item_name'     => __( 'New Book Category Name', 'wp-book' ),
         'menu_name'         => __( 'Book Category', 'wp-book' ),
     );
     $args   = array(
         'hierarchical'      => true,
         'labels'            => $labels,
         'show_ui'           => true,
         'show_admin_column' => true,
         'query_var'         => true,
         'rewrite'           => [ 'slug' => 'book-category' ],
     );
     register_taxonomy( 'Book Category', [ 'book' ], $args );
}
add_action( 'init', 'wpb_register_taxonomy_book_category' );



//function to Create a custom non-hierarchical taxonomy Book Tag

function wpb_register_taxonomy_book_tag() {
     $labels = array(
         'name'              => _x( 'Book Tag', 'wp-book' ),
         'singular_name'     => _x( 'Book Tag', 'wp-book' ),
         'search_items'      => __( 'Search Book Tag', 'wp-book' ),
         'all_items'         => __( 'All Book Tag', 'wp-book' ),
         'parent_item'       => __( 'Parent Book Tag', 'wp-book' ),
         'parent_item_colon' => __( 'Parent Book Tag:', 'wp-book' ),
         'edit_item'         => __( 'Edit Book Tag', 'wp-book' ),
         'add_new_item'      => __( 'Add New Book Tag', 'wp-book' ),
         'update_item'       => __( 'Update Book Tag', 'wp-book' ),
         'new_item_name'     => __( 'New Book Tag Name', 'wp-book' ),
         'menu_name'         => __( 'Book Tag', 'wp-book' ),
     );
     $args   = array(
         'hierarchical'      => false,
         'labels'            => $labels,
         'show_ui'           => true,
         'show_admin_column' => true,
         'query_var'         => true,
         'rewrite'           => [ 'slug' => 'book-tag' ],
     );
     register_taxonomy( 'Book Tag', [ 'book' ], $args );
}
add_action( 'init', 'wpb_register_taxonomy_book_tag' );
