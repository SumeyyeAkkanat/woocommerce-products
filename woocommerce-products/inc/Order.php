<?php

 class Order {
        
    public function init() {
        add_action('admin_menu', array($this, 'my_custom_menu_page')); 
        add_action('wp_enqueue_style', array($this,'list_category'));   
        wp_enqueue_style('style-css', plugin_dir_url(__FILE__) . 'assets/scss/style.css', array(), '1.1', 'all');  
        add_shortcode('Best_Wordpress_Gallery', array($this, 'list_category' ));
    } 

    public function my_custom_menu_page() {
        add_menu_page(
            __( 'Custom Menu Title', 'textdomain' ),
            'custom_menu',
            'manage_options',
            'custompage',
            array($this, 'list_category')
            );
    } 

    public function list_category($args) {
   
      /*$args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10,
            'product_cat'    => 'moda'
        );
        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post();
            global $product;
            <h2>Ürünler</h2>
            echo '<br />' . woocommerce_get_product_thumbnail().' '.get_the_title();   
            endwhile;
            wp_reset_query();
        }*/

        echo '<h1>Ürünler</h1> <br> ';

            $args = array( 'post_type' => 'product', 'posts_per_page' => 10, 'product_cat' => 'koltuk-takimi' );
            //https://developer.wordpress.org/reference/classes/wp_query/
            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

                <div class="container">
                    <div class="row">
                        <div class="product">
                            <a class ="permalink" href="<?php echo get_permalink( $loop->post->ID) ?>" 
                                title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
                                <?php
                                if (has_post_thumbnail( $loop->post->ID )) 
                                    echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                                else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" />';
                                the_title( '<h3>', '</h3>' );
                                echo '<span class="price">'. $product->get_price_html() .'</span>';
                                ?>
                            </a>
                            <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                        </div>
                    </div>
                </div>
                                               
            <?php endwhile;

        wp_reset_postdata();
        //wp_reset_query(); 
        return;
    }
}  

