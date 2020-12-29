<?php

function wpb_register_settings() {
     add_option( 'myplugin_option_name', 'This is my option value.' );
     register_setting( 'wpb_options_group', 'wpb_option_name', 'wpb_callback' );
}
add_action( 'admin_init', 'wpb_register_settings' );


function wpb_register_options_page() {
    add_options_page( 'Page Title', 'Books Menu', 'manage_options', 'myplugin', 'wpb_options_page' );
}
add_action( 'admin_menu', 'wpb_register_options_page' );


function wpb_options_page() {
    ?>
    <div class="wrap">
      <h2>Books Menu Options</h2>
      <form>
        <p>
          <label for="wpb_books_per_page">Select number of books to be displayed per page:</label>
          <input type="number" name="wpb_books_per_page" id="wpb_books_per_page" />
        </p>
        <p>
          <label for="wpb_currency">Select currency:</label>
          <select name="wpb_currency" id="wpb_currency" >
            <option value="inr">Indian Rupee (INR)</option>
            <option value="usd">US Dollar (USD)</option>
            <option value="eur">European Euro (EUR)</option>
            <option value="jpy">Japanese Yen (JPY)</option>
            <option value="gbp">British Pound (GBP)</option>
          </select>
        </p>
        <?php submit_button(); ?>
      </form>
    </div>
    <?php
}
