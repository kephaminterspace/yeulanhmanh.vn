  <?php 
    /**
    * @hooked virtue_page_title - 20
    */
     do_action('kadence_page_title_container');
    ?>
  
<div id="content" class="container">
  <div class="row">
    <div class="main <?php echo kadence_main_class(); ?>  postlist" role="main">
    <?php 
      do_action('kadence_page_before_content'); ?>
      <div class="entry-content" itemprop="mainContentOfPage">
        <?php 
        if (!have_posts()) : ?>
          <div class="alert">
            <?php _e('Sorry, no results were found.', 'virtue'); ?>
          </div>
          <?php 
          get_search_form(); 
        endif;

        while (have_posts()) : the_post(); 
          get_template_part('templates/content', get_post_format()); 
        endwhile; 

        if ($wp_query->max_num_pages > 1) : 
          kad_wp_pagenavi();   
        endif; ?>
        </div>
      </div><!-- /.main -->
