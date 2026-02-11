<?php
    // Ensure weiboo_option variable is available
    if ( ! isset($weiboo_option) ) {
        $weiboo_option = array();
    }
    
    while ( $the_query->have_posts() ) : $the_query->the_post();
        global $product;
        $product = wc_get_product(get_the_ID());
        
        if ( ! $product || is_wp_error($product) ) {
            continue;
        }
        
        $is_feat = $product->is_featured();
        $rating  = $product->get_average_rating();
        $p2ndImg = get_post_meta(get_the_ID(), 'rt_product_2nd_img_id', true);
        $gallery = $product->get_gallery_image_ids();
        if($gallery){
            array_unshift($gallery, get_post_thumbnail_id());
            if($p2ndImg){
                $gallery[] = $p2ndImg;
            }
        }
        $regular_price = get_post_meta( get_the_ID(), '_regular_price', true );
        ?>
        <div class="product-item swiper-slide">
            <div class="product-inner">
                <div class="product-img cute">
                    <div class="sale--box">
                        <?php
                        if ( $product->is_on_sale() )  {    
                            woocommerce_show_product_loop_sale_flash();
                        }
                        $is_new = weiboo_is_recent_post();
                        if ($is_new){
                            ?> <span class="new"><?php esc_html_e( 'NEW', 'rtelemenets' ); ?></span>  <?php
                        }
                        if( $is_feat ){
                            ?> <span class="hot"><?php esc_html_e( 'HOT', 'rtelemenets' ); ?></span>  <?php
                        }
                        ?>
                    </div>
                    <div class="quick-action-btns">
                        <div class="cta-single cta-plus">
                            <i class="rt-plus"></i>
                        </div>
                        <div class="cta-single cta-quickview">
                            <?php if ( function_exists( 'YITH_WCQV_Frontend' ) && isset($weiboo_option['wc_quickview_icon']) && $weiboo_option['wc_quickview_icon']  ): ?>
                                <a href="" class="yith-wcqv-button" data-product_id="<?php echo esc_attr( $product->get_id() );?>"><i class="fa fa-eye"></i></a>
                            <?php endif; ?>
                        </div>
                        <div class="cta-single cta-wishlist">
                            <?php if ( class_exists( 'YITH_WCWL_Shortcode' ) && isset($weiboo_option['wc_wishlist_icon']) && $weiboo_option['wc_wishlist_icon'] ): ?>
                                <?php
                                    $args = array(
                                        'browse_wishlist_text' => '<i class="fa fa-check"></i>',
                                        'already_in_wishslist_text' => '',
                                        'product_added_text' => '',
                                        'icon' => 'fa-heart-o',
                                        'label' => '',
                                        'link_classes' => 'add_to_wishlist single_add_to_wishlist alt wishlist-icon',
                                    );
                                ?>
                                <?php echo YITH_WCWL_Shortcode::add_to_wishlist( $args );?>	
                                <?php endif; ?>
                        </div>
                        <div class="cta-single product-btn cta-addtocart cart-icon-instedof-text">


                        <?php 
                        if( empty($regular_price) ){
                            ?>
                            <a href="<?php the_permalink();?>">
                                <i class="rt-basket-shopping"></i>
                            </a>                            
                            <?php
                        }else{
                            woocommerce_template_loop_add_to_cart();
                        }
                        ?>
                          
                        </div>
                    </div>
                <?php
                    if(empty($gallery)){
                        ?>                      
                        
                            <a href="<?php the_permalink();?>" class="feature--image">
                                <?php echo get_the_post_thumbnail( get_the_ID(), $settings['thumbnail_size'] );?>                            
                            </a>
                            <?php
                            if( !empty($p2ndImg) ){
                                $img2_src = wp_get_attachment_image_src( $p2ndImg, $settings['thumbnail_size']);
                                if( $img2_src && isset($img2_src[0]) ){
                                    $img2_link = $img2_src[0];
                                    ?>
                                    <a href="<?php the_permalink();?>" class="p-2nd--image">
                                        <img src="<?php echo esc_url($img2_link);?>" alt="Product 2nd Image">
                                      
                                    </a>                            
                                <?php
                                }
                            }
                    }else{
                        ?>
                        <div class="swiper product-image--slider">
                            <div class="swiper-wrapper">
                                <?php
                                foreach( $gallery as $pimage ){
                                // Display the image URL
                                    $link = wp_get_attachment_image_src($pimage, $settings['thumbnail_size']);
                                    // Display Image instead of URL
                                    if( $link && isset($link[0]) ){
                                    ?>
                                    <div class="swiper-slide">
                                        <a href="<?php the_permalink();?>" class="feature--image"><img src="<?php echo esc_url($link[0]);?>" alt=""  width="<?php echo esc_attr($link[1]); ?>" height="<?php echo esc_attr($link[2]); ?>"></a>
                                        <div class="slider-pagi-height-fix"></div>
                                    </div>
                                    <?php
                                    }
                                }						
                                ?>
                            </div>
                      
                            <div class="swiper-pagination swiper-pagination-clickable"></div>
                        </div>
                        <?php
                    }
                ?>
                </div>
                <?php if(empty($gallery)){
                        ?><div class="slider-pagi-height-fix"></div><?php
                } ?>
                
                <div class="rselements-product-list">
                    <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                    <span class="product-price">
                        <?php echo $product->get_price_html(); ?>
                    </span>
                </div>                
            </div>

            
        </div>
        <?php endwhile;  wp_reset_query();