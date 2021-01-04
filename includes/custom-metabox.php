<?php

//creating a custom meta box

function wpb_custom_meta_box_markup( $post ) {

    //getting metabox values from database
    $wpb_author_name = get_metadata( 'book', $post->ID, 'author-name', $single=true );
    $wpb_price = get_metadata( 'book', $post->ID, 'price', $single = true );
    $wpb_publisher = get_metadata( 'book', $post->ID, 'publisher', $single = true );
    $wpb_year = get_metadata( 'book', $post->ID, 'year', $single = true );
    $wpb_edition = get_metadata( 'book', $post->ID, 'edition', $single = true );
    $wpb_url = get_metadata( 'book', $post->ID, 'url', $single = true );
    ?>
    <div class="wpb_box">
        <p class="meta-options wpb_field">
          <span>
            <label for="wpb_author_name">Author name:</label>
            <input type="text" name="wpb_author_name" id="wpb_author_name"
            value="<?php echo esc_attr( $wpb_author_name ); ?>">
          </span>
          <span>
            <label for="wpb_book_price">Price:</label>
            <input type="number" name=wpb_book_price" id="wpb_book_price"
            value="<?php echo esc_attr( $wpb_price ); ?>">
          </span>
        </p>
        <p class="meta-options wpb_field">
          <span>
            <label for="wpb_book_publisher">Publisher:</label>
            <input type="text" name="wpb_book_publisher" id="wpb_book_publisher"
            value="<?php echo esc_attr( $wpb_publisher ); ?>">
          </span>
          <span>
            <label for="wpb_book_publish_year">Published Year:</label>
            <input type="month" name="wpb_book_publish_year" id="wpb_book_publish_year"
            value="<?php echo esc_attr( $wpb_year ); ?>">
          </span>
          <span>
            <label for="wpb_book_edition">Edition:</label>
            <input type="text" name="wpb_book_edition" id="wpb_book_edition"
            value="<?php echo esc_attr( $wpb_edition ); ?>">
          </span>
        </p>
        <p class="meta-options wpb_field">
          <label for="wpb_book_url">Book URL:</label>
          <input type="url" name="wpb_book_url" id="wpb_book_url"
          value="<?php echo esc_attr( $wpb_url ); ?>">
        </p>
        <?php wp_nonce_field( 'wpb_custom_book_info_nonce', 'wpb_book_info_nonce' ); ?>
    </div>
    <?php
}


function wpb_add_custom_meta_box()  {
    add_meta_box( "wpb_book", "Book information", "wpb_custom_meta_box_markup", 'book', 'advanced', 'default', null );
}
add_action( "add_meta_boxes", "wpb_add_custom_meta_box" );


//save custom meta box

function wpb_custom_book_info_nonce( $post_id ){

    if( ! isset( $_POST['wpb_book_info_nonce'] ) || ! wp_verify_nonce( $_POST['wpb_book_info_nonce'], 'wpb_custom_book_info_nonce' ) ){
        return $post_id;
    }

    if( isset( $_POST['author_name'] ) ){
        update_metadata('book', $post_id, 'author-name', sanitize_text_field($_POST['author_name']) );
    }

    if( isset( $_POST['price'] ) ){
        update_metadata('book', $post_id, 'price', sanitize_text_field($_POST['price']) );
    }

    if( isset( $_POST['publisher'] ) ){
        update_metadata('book', $post_id, 'publisher', sanitize_text_field($_POST['publisher']) );
    }

    if( isset( $_POST['year'] ) ){
        update_metadata('book', $post_id, 'year', sanitize_text_field($_POST['year']) );
    }

    if( isset( $_POST['edition'] ) ){
        update_metadata('book', $post_id, 'edition', sanitize_text_field($_POST['edition']) );
    }

    if( isset( $_POST['url'] ) ){
        update_metadata('book', $post_id, 'url', sanitize_text_field($_POST['url']) );
    }

}
add_action( "save_post", "wpb_custom_book_info_nonce" );
