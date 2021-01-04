<?php

// adding dashboard widget

function wpb_book_dashboard_widget(){

    wp_add_dashboard_widget(
        'wpb_book_dashboard_widget',
        __('Top 5 Book category', 'wp-book'),
        'wpb_book_dashboard_widget_callback',
        'dashboard',
        'normal',
        'high',
    );

}
add_action('wp_dashboard_setup', 'wpb_book_dashboard_widget');


//dashboard widget callback function

function wpb_book_dashboard_widget_callback(){

        //getting top 5 book categories
        $categories = get_terms( array(
	        'taxonomy' => 'book_category',
	        'hide_empty' => false,
	        'order' => 'DESC',
	        'number' => 5
        ));
        if( !empty( $categories )): ?>
            <p class="book-table-head">
                <span><b><?php esc_html_e( 'Category Name', 'wp-book' ); ?></b></span>
            </p>
        <ul class="dashboard-book-display">
        <?php
                foreach($categories as $cat){
                ?>
                        <li><a href="<?php echo get_category_link( $cat->term_id );?>">
                                <?php echo $cat->name; ?>
                            </a>
                        </li>
                    <?php
                }
                ?>
        </ul>
        <?php else : ?>
            <p><?php esc_html_e( 'Add new book categories', 'wp-book' ); ?></p>
        <?php
        endif;
}
