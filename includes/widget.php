<?php

//setup the widget
class Wpb_Category_Widget extends WP_Widget {
    public function __construct() {

        $widget_options = array(
            'classname' => 'wpb-category-widget',
            'description' => __( 'Custom widget to display selected category books', 'wp-book' ),
        );
        parent::__construct( 'wpb_category', __( 'Book Category', 'wp-book' ), $widget_options );
}

    /** WP_Widget_form */
function form($instance) {

  	    $title = esc_attr( $instance['title'] );
  	    $number	= esc_attr( $instance['number'] );
  	    $exclude = esc_attr( $instance['exclude'] );
  	    $taxonomy	= esc_attr( $instance['taxonomy'] );
	      ?>
  	    <p>
  	        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
  	        <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  	    </p>
  	    <p>
  	        <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of categories to display'); ?></label>
  	        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
  	    </p>
  	    <p>
  		    <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Choose the Taxonomy to display'); ?></label>
  		    <select name="<?php echo $this->get_field_name('taxonomy'); ?>" id="<?php echo $this->get_field_id('taxonomy'); ?>" class="widefat"/>
  			    <?php
  			    $taxonomies = get_taxonomies(array('public'=>true), 'names');
  			    foreach ($taxonomies as $option) {
  				    echo '<option id="' . $option . '"', $taxonomy == $option ? ' selected="selected"' : '', '>', $option, '</option>';
  			    }
  			  ?>
  		    </select>
  	    </p>
  	    <?php
}


// WP_Widget:update
function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
	    $instance['title'] = strip_tags( $new_instance['title'] );
	    $instance['number'] = strip_tags( $new_instance['number'] );
	    $instance['taxonomy'] = $new_instance['taxonomy'];
	    return $instance;
}


//front-end display of widget

/**  WP_Widget::widget  */
function widget( $args, $instance ) {
	    extract( $args );
	    $title = apply_filters( 'widget_title', $instance['title'] ); // the widget title
	    $number = $instance['number']; // the number of categories to show
	    $taxonomy = $instance['taxonomy']; // the taxonomy to display

	    $args = array(
		    'number' => $number,
		    'taxonomy' => $taxonomy
	    );

      //retrieves an array of categories or taxonomy terms
	    $cats = get_categories( $args );
	    ?>
  		<?php echo $before_widget; ?>
  	    <?php if ( $title ) { echo $before_title . $title . $after_title; } ?>
  		<ul>
  		<?php foreach( $cats as $cat ) { ?>
  		<li><a href="<?php echo get_term_link($cat->slug, $taxonomy); ?>" title="<?php sprintf( __( "View all posts in %s" ), $cat->name ); ?>"><?php echo $cat->name; ?></a></li>
  		<?php } ?>
  		</ul>
      	<?php echo $after_widget; ?>
	    <?php
}

}

add_action( 'widgets_init', function(){
    register_widget('Wpb_Category_Widget');
} );
