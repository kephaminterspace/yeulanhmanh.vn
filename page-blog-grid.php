<?php
/*
Template Name: Blog Grid
*/
    /**
    * @hooked virtue_page_title - 20
    */
     do_action('kadence_page_title_container');
    ?>
	
    <div id="content" class="container">
   		<div class="row">
   			<?php global $post, $virtue_premium;
   			if(isset($virtue_premium['virtue_animate_in']) && $virtue_premium['virtue_animate_in'] == 1) {
   				$animate = 1;
   			} else {
   				$animate = 0;
   			} 
   			if(isset($virtue_premium['blog_infinitescroll']) && $virtue_premium['blog_infinitescroll'] == 1) {
   				$infinit = 'data-nextselector=".wp-pagenavi a.next" data-navselector=".wp-pagenavi" data-itemselector=".kad_blog_item" data-itemloadselector=".kad_blog_fade_in" data-infiniteloader="'.get_template_directory_uri() . '/assets/img/loader.gif"';
				$scrollclass = 'init-infinit';
   			} else {
   				 $infinit = '';
				$scrollclass = '';
   			}
   			if(isset($virtue_premium['blog_grid_display_height']) && $virtue_premium['blog_grid_display_height'] == 1) {
            	$matchheight = 1;
	        } else {
	            $matchheight = 0;
	        }
   			$blog_grid_column = get_post_meta( $post->ID, '_kad_blog_columns', true );
   			$blog_order = get_post_meta( $post->ID, '_kad_blog_order', true ); 
   			if ($blog_grid_column == 'twocolumn') {
   				$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12';
   			} else if ($blog_grid_column == 'threecolumn'){ 
   				$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12';
   			} else {
   				$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';
   			}
      		$blog_category = get_post_meta( $post->ID, '_kad_blog_cat', true ); 
			$blog_cat= get_term_by ('id',$blog_category,'category');
			if($blog_category == '-1' || $blog_category == '') {
					$blog_cat_slug = '';
			} else {
			$blog_cat = get_term_by ('id',$blog_category,'category');
			$blog_cat_slug = $blog_cat -> slug;
			}
			$blog_items = get_post_meta( $post->ID, '_kad_blog_items', true ); 
			if($blog_items == 'all') {$blog_items = '-1';} 
			if(isset($blog_order)) {
	   			$b_orderby = $blog_order;
		   	} else {
		   		$b_orderby = 'date';
		   	}
		   	if($b_orderby == 'menu_order' || $b_orderby == 'title') {$b_order = 'ASC';} else {$b_order = 'DESC';}
			?>
      		<div class="main <?php echo kadence_main_class();?>" id="ktmain" role="main">
      		<?php 
                do_action('kadence_page_before_content'); ?>
      			<div class="entry-content" itemprop="mainContentOfPage"  itemscope itemtype="http://schema.org/WebPageElement">
					<?php get_template_part('templates/content', 'page'); ?>
				</div>
      		<div id="kad-blog-grid" class="rowtight <?php echo esc_attr($scrollclass); ?> init-isotope" data-match-height="<?php echo esc_attr($matchheight);?>" <?php echo $infinit; ?> data-fade-in="<?php echo esc_attr($animate);?>"  data-iso-selector=".b_item" data-iso-style="masonry">
      		<?php   $temp = $wp_query; 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array(
						'paged' => $paged,
						'orderby' => $b_orderby,
						'order' => $b_order,
						'category_name'=>$blog_cat_slug,
						'posts_per_page' => $blog_items
						)
					);
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
						if($blog_grid_column == 'twocolumn') { ?>
							<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
							<?php get_template_part('templates/content', 'twogrid'); ?>
							</div>
						<?php } else {?>
							<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
							<?php get_template_part('templates/content', 'fourgrid');?>
							</div>
						<?php }
                    endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'virtue'); ?></li>
					<?php endif; ?>
                </div> <!-- Blog Grid -->
				<?php if ($wp_query->max_num_pages > 1) : 
        			kad_wp_pagenavi(); 
				endif; 
				$wp_query = null; 
				$wp_query = $temp;  // Reset 
				wp_reset_query(); 				
				
                /**
                * @hooked virtue_page_comments - 20
                */
                do_action('kadence_page_footer');
                ?>
</div><!-- /.main -->