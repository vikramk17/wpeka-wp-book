<?php

//creating a custom meta box

function wpb_custom_meta_box_markup( $post ) {
    wp_nonce_field(basename(__FILE__), "wpb_meta-box-nonce");
    ?>
    <div class="wpb_box">
        <p class="meta-options wpb_field">
          <span>
            <label for="wpb_author_name">Author name:</label>
            <input type="text" name="wpb_author_name" id="wpb_author_name"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'wpb_author_name', true ) ); ?>">
          </span>
          <span>
            <label for="wpb_book_price">Price:</label>
            <input type="number" name=wpb_book_price" id="wpb_book_price"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'wpb_book_price', true ) ); ?>">
          </span>
        </p>
        <p class="meta-options wpb_field">
          <span>
            <label for="wpb_book_publisher">Publisher:</label>
            <input type="text" name="wpb_book_publisher" id="wpb_book_publisher"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'wpb_book_publisher', true ) ); ?>">
          </span>
          <span>
            <label for="wpb_book_publish_year">Published Year:</label>
            <input type="month" name="wpb_book_publish_year" id="wpb_book_publish_year"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'wpb_book_publish_year', true ) ); ?>">
          </span>
          <span>
            <label for="wpb_book_edition">Edition:</label>
            <input type="text" name="wpb_book_edition" id="wpb_book_edition"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'wpb_book_edition', true ) ); ?>">
          </span>
        </p>
        <p class="meta-options wpb_field">
          <label for="wpb_book_url">Book URL:</label>
          <input type="url" name="wpb_book_url" id="wpb_book_url"
          value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'wpb_book_url', true ) ); ?>">
        </p>
    </div>
    <?php
}


function wpb_add_custom_meta_box()  {
    add_meta_box( "wpb_book", "Book information", "wpb_custom_meta_box_markup", 'book', 'advanced', 'default', null );
}
add_action( "add_meta_boxes", "wpb_add_custom_meta_box" );


//save custom meta box

function wpb_save_custom_meta_box( $post_id ) {
     //check if the post is auto saving
     if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

     if ( $parent_id = wp_is_post_revision( $post_id ) ) {
       $post_id = $parent_id;
     }
     //verify the nonce value we created earlier
     if (!isset($_POST["wpb_meta-box-nonce"]) || !wp_verify_nonce($_POST["wpb_meta-box-nonce"], basename(__FILE__)))
       return;
    //check to make sure the current user can actually edit the post
     if( !current_user_can( 'edit_post' ) ) return;

     $fields = [
         'wpb_author_name',
         'wpb_book_price',
         'wpb_book_publisher',
         'wpb_book_publish_year',
         'wpb_book_edition',
         'wpb_book_url',
     ];
     foreach ( $fields as $field ) {
         if ( array_key_exists( $field, $_POST ) ) {
             // update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
             update_book_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
         }
     }
}
add_action( "save_post", "wpb_save_custom_meta_box" );
