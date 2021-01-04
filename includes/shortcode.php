<?php


//adding shortcode to custom posttype
function wpb_book_shortcode( $atts ){
        $atts = shortcode_atts(
            array(
                'book_id' => '',
                'author_name' => '',
                'year' => '',
                'category' => '',
                'tag' => '',
                'publisher' => ''
            ),
            $atts
        );

        $args = array(
                'post_type' => 'book',
                'post_status' => 'publish',
                'author' => $atts['author_name'],
              );

            if($atts['book_id'] != ''){
                $args['book_id'] = $atts['book_id'];
            }
            if($atts['category'] != ''){
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'book_category',
                        'terms' => array( $atts['category'] ),
                        'field' => 'name',
                        'operator' => 'IN'
                    ),
                );
            }
            if($atts['tag'] != ''){
                $args[ 'tax_query' ] = array(
                    array(
                        'taxonomy' => 'book_tags',
                        'terms' => array($atts['tag']),
                        'field' => 'name',
                        'operator' => 'IN'
                    ),
                );
            }
        return wpb_book_shortcode_function( $args );
    }

    //adding the shortcode
    add_shortcode( 'book','wpb_book_shortcode' );


    // function for rendering the data
    function wpb_book_shortcode_function( $args ){

        global $wpb_settings;

        $wpb_query = new WP_Query( $args );
        if ( $wpb_query->have_posts() ) {
            while($wpb_query->have_posts()){
                $wpb_query->the_post();

                //retriving the meta info of book from database
                $wpb_info_author_name = get_metadata( 'book', get_the_id(), 'author-name' )[0];
                $wpb_info_price = get_metadata( 'book', get_the_id(), 'price' )[0];
                $wpb_info_publisher = get_metadata( 'book', get_the_id(), 'publisher' )[0];
                $wpb_info_year = get_metadata( 'book', get_the_id(), 'year' )[0];
                $wpb_info_edition = get_metadata( 'book', get_the_id(), 'edition' )[0];
                $wpb_info_url = get_metadata( 'book', get_the_id(), 'url' )[0];

                ?>
                <ul>
                <?php
                    if ( get_the_title() != '' ){
                        ?>
                        <li>Title: <a href="<?php get_post_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                        <?php
                    }
                    if( $wpb_info_author_name != ''  ){
                        ?>
                        <li>Author: <?php echo $wpb_info_author_name; ?></li>
                        <?php
                    }
                    if( $wpb_info_price != '' ){
                        ?>
                        <li>Price: <?php echo $wpb_info_price . ' ' . $wpb_settings[ 'currency' ] ; ?></li>
                        <?php
                    }
                    if( $wpb_info_publisher != '' ){
                        ?>
                        <li>Publisher: <?php echo $wpb_info_publisher; ?></li>
                        <?php
                    }
                    if( $wpb_info_year != '' ){
                        ?>
                        <li>Year: <?php echo $wpb_info_year; ?></li>
                        <?php
                    }
                    if( $wpb_info_edition != '' ){
                        ?>
                        <li>Edition: <?php echo $wpb_info_edition; ?></li>
                        <?php
                    }
                    if( $wpb_info_url  != '' ){
                        ?>
                        <li>Url: <?php echo $wpb_info_url; ?></li>
                        <?php
                    }
                    if ( get_the_content() != '' ) {
                        ?>
                        <li>Content: <?php echo get_the_content(); ?></li>
                        <?php
                    }
                ?>
                </ul>
                <?php
            }
        }else {
            ?>
            <h1>Sorry no Books Found</h1>
            <?php
        }
    }
