  <?php 
    /**
    * @hooked virtue_page_title - 20
    */
     do_action('kadence_page_title_container');
    ?>
	
    <div id="content" class="container">
   		<div class="row">
      <div class="main <?php echo kadence_main_class(); ?>" role="main">
      <?php do_action('kadence_page_before_content'); ?>
      <div class="alert">
        <?php _e('Sorry, but the page you were trying to view does not exist.', 'virtue'); ?>
      </div>

      <p><?php _e('It looks like this was the result of either:', 'virtue'); ?></p>
      <ul>
        <li><?php _e('a mistyped address', 'virtue'); ?></li>
        <li><?php _e('an out-of-date link', 'virtue'); ?></li>
      </ul>

<?php get_search_form(); ?>
</div>