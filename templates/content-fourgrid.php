<?php 
    global $post, $virtue_premium; 

    $postsummery = get_post_meta( $post->ID, '_kad_post_summery', true );
    $image_size = 364;
    $image_height = apply_filters('kadence_blog_grid_image_height', null);
    if($image_height == null) {
        $image_slider_height = $image_size;
    } else {
        $image_slider_height = $image_height;
    }

    if(empty($postsummery) || $postsummery == 'default') {
        if(!empty($virtue_premium['post_summery_default'])) {
            $postsummery = $virtue_premium['post_summery_default'];
        } else {
            $postsummery = 'img_portrait';
        }
    }
    if($postsummery == 'img_landscape' || $postsummery == 'img_portrait') { ?>
        <div id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
        <?php 
            if (has_post_thumbnail( $post->ID ) ) { 
                $image_id = get_post_thumbnail_id( $post->ID );
                $image_src = wp_get_attachment_image_src( $image_id, 'full' ); 
            } else {
                $image_src = array( virtue_post_default_placeholder(), $image_size, $image_height);
                $image_id = '';
            }
            $image = aq_resize($image_src[0], $image_size, $image_height, true, false, false, $image_id);
            if(empty($image[0])) { $image = array($image_src[0], $image_src[1], $image_src[2]); }
            ?>
            <div class="imghoverclass img-margin-center">
                <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                    <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]);?>" height="<?php echo esc_attr($image[2]);?>" alt="<?php esc_attr(the_title()); ?>" <?php echo kt_get_srcset_output($image[1], $image[2], $image_src[0], $image_id);?> class="iconhover">
                </a> 
            </div>
          <?php $image = null; $thumbnailURL = null; 

    } elseif($postsummery == 'slider_landscape' || $postsummery == 'slider_portrait') {?>
        <div id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="flexslider loading kt-flexslider" style="max-width:364px;" data-flex-speed="7000" data-flex-anim-speed="400" data-flex-animation="fade" data-flex-auto="true">
                <ul class="slides">
                    <?php $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                        if(!empty($image_gallery)) {
                            $attachments = array_filter( explode( ',', $image_gallery ) );
                            if ($attachments) {
                                foreach ($attachments as $attachment) {
                                $attachment_src = wp_get_attachment_image_src($attachment , 'full');
                                $image = aq_resize($attachment_src[0], $image_size, $image_slider_height, true, false, false, $attachment);
                                if(empty($image[0])) { $image = array($attachment_src[0], $attachment_src[1], $attachment_src[2]); } ?>
                                <li>
                                    <a href="<?php the_permalink() ?>" alt="<?php esc_attr(the_title()); ?>">
                                        <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>" class="kt_flex_slider_image"  width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" <?php echo kt_get_srcset_output($image[1], $image[2], $attachment_src[0], $attachment);?> >
                                    </a>
                                </li>
                            <?php 
                            }
                          }
                        }?>                         
                </ul>
            </div> <!--Flex Slides-->
    <?php 
    } elseif($postsummery == 'video') {?>
        <div id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="videofit">
                <?php
                echo do_shortcode( get_post_meta( $post->ID, '_kad_post_video', true ) );?>
            </div>

    <?php 
    } else {?>
        <div id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in kad_blog_fade_in grid_item kt-no-post-summary" itemscope="" itemtype="http://schema.org/BlogPosting">
    <?php } ?>

            <div class="postcontent">
                <?php 
                /**
                * @hooked virtue_post_before_header_meta_date - 20
                */
                do_action( 'kadence_post_grid_excerpt_before_header' );
                ?>
                <header>
                    <?php 
                    /**
                    * @hooked virtue_post_mini_excerpt_header_title - 10
                    * @hooked virtue_post_grid_header_meta - 20
                    */
                    do_action( 'kadence_post_grid_small_excerpt_header' );
                    ?>      
                </header>
                <div class="entry-content" itemprop="articleBody">
                    <?php 
                     do_action( 'kadence_post_grid_excerpt_content_before' );

                     the_excerpt();

                     do_action( 'kadence_post_grid_excerpt_content_after' );
                    ?>
                </div>
                <footer>
                <?php 
                /**
                * @hooked virtue_post_footer_tags - 10
                */
                do_action( 'kadence_post_grid_excerpt_footer' );
                ?>
                </footer>
            </div><!-- Text size -->
            <?php 
               /**
               * 
               */
               do_action( 'kadence_post_grid_excerpt_after_footer' );
               ?>
        </div> <!-- Blog Item -->