<?php

function wpb_add_options_link() {
			add_menu_page(
		        __( 'Book Menu Settings Page', 'wp-book' ),
		        __( 'Book Menu Settings', 'wp-book' ),
		        'manage_options',
		        'wpb-settings',
		        'wpb_settings_page',
		        '',
		        35
		    );
}
add_action( 'admin_menu', 'wpb_add_options_link' );

//registering the setting page
function wpb_register_settings(){
    	register_setting( 'wpb_settings_group', 'wpb_settings' );
}
add_action( 'admin_init', 'wpb_register_settings' );


function wpb_settings_page() {

    global $wpb_settings;

		ob_start(); ?>
		<div class="wrap">
			<h2>Book Plugin Options</h2>
		<form method="post" action="options.php">
            <?php settings_fields('wpb_settings_group'); ?>
            <h4>Currency Options</h4>
            <p>
                <?php $diff_currency = array('USD', 'INR', 'CAD', 'EUR'); ?>
                <select id="wpb_settings[currency]" name="wpb_settings[currency]">
                    <?php foreach($diff_currency as $currecy){ ?>
                        <?php if($wpb_settings['currency'] == $currecy) { $selected = 'selected="selected"'; } else{ $selected=''; } ?>
                        <option value="<?php echo $currecy; ?>"<?php echo $selected; ?>> <?php echo $currecy;?></option>
                    <?php } ?>
                </select>
                <label class="description" for="wpb_settings[number_of_books]"><?php _e('Select Currency','wp-book'); ?></label>
            </p>

            <h4>Number of Books displayed per page</h4>

            <p>
                <input id="wpb_settings[number_of_books]" name="wpb_settings[number_of_books]" type="number" value="<?php echo $wpb_settings['number_of_books']; ?>" />
                <label class="description" for="wpb_settings[number_of_books]"><?php _e('Enter Number of Books per page','wp-book'); ?></label>
            </p>

            <p>
                <input type="submit" class="button-primary" value="Save Options" />
            </p>

        </form>
	</div>
	<?php
	echo ob_get_clean();
}
