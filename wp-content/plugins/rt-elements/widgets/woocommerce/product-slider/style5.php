<?php 
    // Ensure show_cat variable is available
    if ( ! isset($show_cat) ) {
        $show_cat = 'no'; // Default to not showing categories
    }
    
    while ( $the_query->have_posts() ) : $the_query->the_post();
        global $product;
        $product = wc_get_product( get_the_ID() );
        
        if ( ! $product || is_wp_error($product) ) {
            continue;
        }
        
        $is_feat = $product->is_featured();
        ?>
        <div class="product-item swiper-slide">
            <div class="product-img">
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
                <a href="<?php the_permalink() ?>">
                    <?php if ( has_post_thumbnail( get_the_ID() ) ) {
                        echo get_the_post_thumbnail( get_the_ID(), 'shop_single' );
                    } else {
                        echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                    } ?>
                </a>
            </div>
            <div class="rselements-product-list">
                    <?php if($show_cat == 'yes'):?>
						<div class="product_cats">
							<?php 
							// Get product categories with better error handling
							$terms = get_the_terms( get_the_ID(), 'product_cat' );
							if ( $terms && ! is_wp_error($terms) && ! empty($terms) ) {
								$term_names = array();
								foreach ( $terms as $term ) {
									if ( $term && ! is_wp_error($term) && isset($term->name) ) {
										$term_names[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
									}
								}
								if ( ! empty($term_names) ) {
									echo implode(', ', $term_names);
								}
							}
							?>
						</div>
					<?php endif;?>                
                <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <div class="price--cart">
                    <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                    <div class="product-btn">
                       <?php woocommerce_template_loop_add_to_cart();?>
                    </div>
                </div>
            </div>
            
        </div>
        <?php endwhile;  wp_reset_query();