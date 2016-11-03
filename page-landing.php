<?php
/*
Template Name: Landing - no header
*/
?>
	
    <div id="content" class="container">
   		<div class="row">
     		<div class="main <?php echo kadence_main_class(); ?>" id="ktmain" role="main">
				<div class="entry-content" itemprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
					</div>
				<?php 
                /**
                * @hooked virtue_page_comments - 20
                */
                do_action('kadence_page_footer');
                ?>
	</div><!-- /.main -->