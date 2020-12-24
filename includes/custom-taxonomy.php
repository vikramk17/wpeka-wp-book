<?php
//function to Create a custom hierarchical taxonomy Book Category

function wpb_register_taxonomy_book_category() {
     $labels = array(
         'name'              => _x( 'Book Category', 'taxonomy general name' ),
         'singular_name'     => _x( 'Book Category', 'taxonomy singular name' ),
         'search_items'      => __( 'Search Book Category' ),
         'all_items'         => __( 'All Book Category' ),
         'parent_item'       => __( 'Parent Book Category' ),
         'parent_item_colon' => __( 'Parent Book Category:' ),
         'edit_item'         => __( 'Edit Book Category' ),
         'update_item'       => __( 'Update Book Category' ),
         'add_new_item'      => __( 'Add New Book Category' ),
         'new_item_name'     => __( 'New Book Category Name' ),
         'menu_name'         => __( 'Book Category' ),
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
         'name'              => _x( 'Book Tag', 'taxonomy general name' ),
         'singular_name'     => _x( 'Book Tag', 'taxonomy singular name' ),
         'search_items'      => __( 'Search Book Tag' ),
         'all_items'         => __( 'All Book Tag' ),
         'parent_item'       => __( 'Parent Book Tag' ),
         'parent_item_colon' => __( 'Parent Book Tag:' ),
         'edit_item'         => __( 'Edit Book Tag' ),
         'update_item'       => __( 'Update Book Tag' ),
         'add_new_item'      => __( 'Add New Book Tag' ),
         'new_item_name'     => __( 'New Book Tag Name' ),
         'menu_name'         => __( 'Book Tag' ),
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
