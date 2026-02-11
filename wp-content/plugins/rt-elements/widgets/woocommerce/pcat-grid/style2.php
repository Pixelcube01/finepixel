<div class="rtpcat2 mt-5">
    <div class="rts-product-category-section section-gap">
        <div class="container">
            <div class="row">

                <?php
                $tcat = count($pcats);
                $xx = 1;
                if(is_array($pcats) || is_object($pcats)) {  
                    foreach( $pcats as $pcat ) {
                        $catObj = get_term_by('slug', $pcat, 'product_cat');
                        if ( $catObj && ! is_wp_error( $catObj ) && $catObj !== null && is_object($catObj) && isset($catObj->term_id) ) {
                            $term_id = $catObj->term_id;
                            // get the thumbnail id using the category term_id
                            $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                            $pcat_image_src = wp_get_attachment_image_src($thumbnail_id, 'large');
                            $pcat_image = ($pcat_image_src && isset($pcat_image_src[0])) ? $pcat_image_src[0] : '';

                            $pcat_bg = get_term_meta( $term_id, 'pcat_grid_bg', true );
                            if( !(empty($pcat_bg)) ){
                                $pcat_single_bg = 'style="background-color: '.$pcat_bg.';"';
                            }else{
                                $pcat_single_bg = '';
                            }
                            $pcat_btnc = get_term_meta( $term_id, 'pcat_grid_btn_color', true );

                            if( !(empty($pcat_btnc)) ){
                                $cta_btn_color = 'style="color: '.$pcat_btnc.';"';
                                $cta_btn_hover_bg = 'style="background-color: '.$pcat_btnc.';"';
                            }else{
                                $cta_btn_color = '';
                                $cta_btn_hover_bg = '';
                            }


                            $name   = $catObj->name;
                            $desc   = $catObj->description;
                            $count  = $catObj->count;
                            $img    = $catObj->name;
                            $pcat_link = get_term_link( $pcat, 'product_cat' );
                            if (is_wp_error($pcat_link)) {
                                $pcat_link = '#';
                            }
                            if( $tcat == 8 ){


                            if( $xx == 1 ){
                                ?>
                                <div class="col-xl-2">
                                    <a href="<?php echo esc_url($pcat_link) ; ?>" class="product-item product-item-vertical d-block">
                                        <div class="product-thumb">
                                            <img src="<?php echo esc_url($pcat_image) ; ?>" alt="product-image">
                                        </div>
                                        <div class="contents">
                                            <span class="item-qnty"><?php echo esc_html($count.' '.$item_text); ?></span>
                                            <h3 class="product-title"><?php echo esc_html($name); ?></h3>
                                            <div class="icon"><i class="rt-arrow-right-long"></i></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-8">
                                    <div class="row">                        
        
                                <?php            
                            } elseif(  $xx == 8  ){
        
                                ?>
                            </div>
                        </div>
                                <div class="col-lg-2 col-md-12">
                                    <a href="<?php echo esc_url($pcat_link) ; ?>" class="product-item product-item-vertical product-item-bg">
                                        <div class="product-thumb"><img src="<?php echo esc_url($pcat_image) ; ?>" alt="product-image"></div>
                                        <div class="contents">
                                            <span class="item-qnty"><?php echo esc_html($count.' '.$item_text); ?></span>
                                            <h3 class="product-title"><?php echo esc_html($name); ?></h3>
                                        </div>
                                    </a>
                                </div>                        
                                
                                <?php
                            }else{
                                ?>
                                <div class="col-xl-4 col-md-6 col-sm-6">
                                    <a href="<?php echo esc_url($pcat_link) ; ?>" class="product-item product-item-horizontal">
                                        <div class="product-thumb"><img src="<?php echo esc_url($pcat_image) ; ?>" alt="product-image"></div>
                                        <div class="contents">
                                            <span class="item-qnty"><?php echo esc_html($count.' '.$item_text); ?></span>
                                            <h3 class="product-title"><?php echo esc_html($name); ?></h3>
                                        </div>
                                    </a>
                                </div>                        
                                
                                <?php            
                            }


                        }else{
                            ?>
                            <div class="col-xl-3 col-md-6 col-sm-6">
                                <a href="<?php echo esc_url($pcat_link) ; ?>" class="product-item product-item-horizontal mb-4">
                                    <div class="product-thumb"><img src="<?php echo esc_url($pcat_image) ; ?>" alt="product-image"></div>
                                    <div class="contents">
                                        <span class="item-qnty"><?php echo esc_html($count.' '.$item_text); ?></span>
                                        <h3 class="product-title"><?php echo esc_html($name); ?></h3>
                                    </div>
                                </a>
                            </div>                        
                            
                            <?php
                        }

                        $xx++;
                        } 
                    }
                }
                ?>  
                
            </div>
        </div>
    </div>
</div>
