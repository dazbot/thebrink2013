<?php

// Register menus.
function register_my_menus() {
	register_nav_menus(
		array('main-menu' => __('Main Menu'))
	);		
}
add_action('init', 'register_my_menus');

// Get navigation buttons HTML if a single post.
function get_prev_button() {

	$navButton = "";
	
	if ((is_single() || is_home()) && !in_category('extras')) {
		$prevPost = get_previous_post(false, get_category_by_slug('extras')->term_id);
		if ($prevPost != "") {
			if ($prevPost != "") {
				$navButton .= "<a href=\"" . get_permalink($prevPost->ID) . "\" class=\"prev prev-next\"></a>";
			}
		}
	}
	return $navButton;
	
}

// Get navigation buttons HTML if a single post.
function get_next_button() {

	$navButton = "";
	
	if ((is_single() || is_home()) && !in_category('extras')) {
		$nextPost = get_next_post(false, get_category_by_slug('extras')->term_id);
		if ($nextPost != "") {
			if ($nextPost != "") {
				$navButton .= "<a href=\"" . get_permalink($nextPost->ID) . "\" class=\"next prev-next\"></a>";
			}
		}
	}
	return $navButton;
	
}

// Write a section of the table of contents.
function write_posts_toc($atts) {

	extract(shortcode_atts(array(
		'title' => 'Table of Contents',
		'category' => '',
		'format' => 'list',
		'order' => 'ASC'
	), $atts));
	
	$myPosts = get_posts(array('numberposts' => -1, 'order' => $order, 'category_name' => $category));

	echo '<h3>' . $title . '</h3>';

	// Write the TOC in the specified format.
	switch ($format) {
		case "list":
			write_posts_toc_list($myPosts);
			break;
		case "banners":
			write_posts_toc_banners($myPosts);
			break;
		case "mosaics":
			write_posts_toc_mosaics($myPosts);
			break;
	}
	
}

// Write the posts table of contents as an unordered list.
function write_posts_toc_list($myPosts) {
	echo '<ul class="table-of-contents">';
	foreach ($myPosts as $myPost) :
		echo '<li><a href="' . get_permalink($myPost->ID) . '">' . $myPost->post_title . '</a></li>';
	endforeach;
	echo '</ul>';
}

// Write the posts table of contents as a series of banners.
function write_posts_toc_banners($myPosts) {
	foreach ($myPosts as $myPost) :
		echo '<div class="table-of-contents">';
		echo '<a href="' . get_permalink($myPost->ID) . '">' . get_the_post_thumbnail($myPost->ID, 'thumbnail') . '<h3>' . $myPost->post_title . '</h3></a>';
		echo '<div class="excerpt">' . $myPost->post_excerpt . '</div>';
		/*echo '<div class="excerpt">' . return_excerpt($myPost->ID, array('num_words' => '64')) . '</div>';*/
		echo '<div class="clear"></div>';
		echo '</div>';
	endforeach;
}

// Write the posts table of contents as a series of mosaics.
function write_posts_toc_mosaics($myPosts) {
	foreach ($myPosts as $myPost) :
		?>
		<div class="mosaic-block bar2">
			<a href="<?php echo get_permalink($myPost->ID); ?>" class="mosaic-overlay">
				<div class="mosaic-cell">
					<h3><?php echo $myPost->post_title; ?></h3>
					<p><?php echo mysql2date("j M Y", $myPost->post_date); ?></p>
				</div>
				<div class="clear"></div>
				<div class="mosaic-cell">
					<?php echo $myPost->post_excerpt; ?>
				</div>
			</a>
			<div class="mosaic-backdrop">
				<?php echo get_the_post_thumbnail($myPost->ID, 'full'); ?>
			</div>
		</div>
		<?php
	endforeach;
	echo "<div class=\"clear\"></div>";
}





//////// Custom Comments List.
function zbench_mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
	switch ($pingtype=$comment->comment_type) {
		case 'pingback' :
		case 'trackback' : ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard pingback">
				<cite class="fn zbench_pingback"><?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php printf(__('%1$s at %2$s', 'zbench'), get_comment_date(),  get_comment_time()); ?></cite>
			</div>
		</div>
	<?php
				break;
			default : ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar($comment,$size='40',$default='' ); ?>
				<cite class="fn"><?php comment_author_link(); ?></cite>
				<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf(__('%1$s at %2$s', 'zbench'), get_comment_date(),  get_comment_time()); ?></a><?php edit_comment_link(__('[Edit]','zbench'),' ',''); ?></span>
			</div>
			<div class="comment-text">
				<?php comment_text(); ?>
				<?php if ($comment->comment_approved == '0') : ?>
				<p><em class="approved"><?php _e('Your comment is awaiting moderation.','zbench'); ?></em></p>
				<?php endif; ?>
			</div>
			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div>
		</div>

	<?php 		break;
	}
}

// Register sidebar.
if (function_exists('register_sidebar')) {
	register_sidebar();
}

// Register shortcodes.
add_shortcode('posts-toc', 'write_posts_toc');

// Turn on support for post thumbnails.
add_theme_support('post-thumbnails');

?>