<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'kt_header_after', 'kt_mobile_header', 20 );
function kt_mobile_header() {
	global $virtue_premium;
	if(isset($virtue_premium['mobile_header']) && $virtue_premium['mobile_header'] == '1') {
		get_template_part('templates/mobile', 'header'); 
	}
}

add_action( 'kt_header_after', 'kt_shortcode_after_header', 40 );
function kt_shortcode_after_header() {
	global $virtue_premium;
	if(isset($virtue_premium['sitewide_after_header_shortcode_input']) && !empty($virtue_premium['sitewide_after_header_shortcode_input']) ) {
		echo do_shortcode($virtue_premium['sitewide_after_header_shortcode_input']); 
	}
}

add_action( 'kadence_page_footer', 'virtue_page_comments', 20 );
function virtue_page_comments() {
	global $virtue_premium;
	if(isset($virtue_premium['page_comments']) && $virtue_premium['page_comments'] == '1') {
		comments_template('/templates/comments.php');
	}
}

add_action( 'kadence_page_title_container', 'virtue_page_title', 20 );
function virtue_page_title() {
	global $virtue_premium, $post;
	if(is_home()){
		$homeid = get_option( 'page_for_posts' );
		$pagetitle = get_post_meta( $homeid, '_kad_show_page_title', true );
	} elseif(is_archive()) {
		$cat_term_id = get_queried_object()->term_id;
		$meta = get_option('kad_cat_title');
		if (empty($meta)) $meta = array();
		if (!is_array($meta)) $meta = (array) $meta;
		$meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
		if(isset($meta['archive_show_title'])) {
			$pagetitle = $meta['archive_show_title'];
		} else {
			$pagetitle = 'default';
		}
	} elseif(is_404()) {
		$pagetitle = 'default';
	} else {
		$pagetitle = get_post_meta( $post->ID, '_kad_show_page_title', true );
	}
	if(empty($pagetitle) || $pagetitle == 'default') {
		if(isset($virtue_premium['page_title_show']) && $virtue_premium['page_title_show'] == '0') {
			// Do nothing
		} else {
			get_template_part('/templates/page', 'header'); 
		}
	} elseif($pagetitle == 'show') {
		get_template_part('/templates/page', 'header'); 
	} else {
		// do nothing
	}
}
