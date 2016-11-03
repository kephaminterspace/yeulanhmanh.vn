<?php do_action('kadence_page_content_before'); ?>
<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php wp_link_pages(array('before' => '<nav class="pagination kt-pagination">', 'after' => '</nav>', 'link_before'=> '<span>','link_after'=> '</span>')); ?>
<?php endwhile; ?>
<?php do_action('kadence_page_content_after'); ?>