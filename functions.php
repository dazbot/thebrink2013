<?php

/* No longer required. 
// Set up category-specific single.php templates.
add_filter('single_template', create_function(
	'$t', 
	'foreach((array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-category-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-category-{$cat->slug}.php"; } return $t;' )
); */

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
	
	if ((is_single() || is_home()) && !in_category('extras') && !in_category('about')) {
		$prevPost = get_previous_post(true);
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
	
	if ((is_single() || is_home()) && !in_category('extras') && !in_category('about')) {
		$nextPost = get_next_post(true);
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
        writeMosaic(
                get_permalink($myPost->ID), 
                $myPost->post_title, 
                mysql2date("j M Y", $myPost->post_date),
                $myPost->post_excerpt,
                get_the_post_thumbnail($myPost->ID, 'full')
                );
    endforeach;
    echo "<div class=\"clear\"></div>";
}

function writeMosaic($postPermalink, $postTitle, $postDate, $postExcerpt, $postThumbnail) {
    ?>
    <div class="mosaic-block bar2">
        <a href="<?php echo $postPermalink; ?>" class="mosaic-overlay">
            <div class="mosaic-cell">
                <h3><?php echo $postTitle; ?></h3>
                <p><?php echo $postDate; ?></p>
            </div>
            <div class="clear"></div>
            <div class="mosaic-cell">
                <?php echo $postExcerpt; ?>
            </div>
        </a>
        <div class="mosaic-backdrop">
            <?php echo $postThumbnail; ?>
        </div>
    </div>
    <?php
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

// Write an episode for display on the home page.
function writeHomeEpisode($order, $description) {
    
        // Find the first episode.
        $episodeQuery = new WP_Query(array(
            'category_name' => 'story',
            'orderby' => 'date',
            'order' => $order,
            'posts_per_page' => 1
        ));

        // The WordPress loop.
        if ($episodeQuery->have_posts()) : 
            while ($episodeQuery->have_posts()) :
                $episodeQuery->the_post();
                $permalink = get_permalink($post->ID);
                ?>

                <div class="home-episode" onclick="window.location = '<?php echo $permalink; ?>';">

                    <?php
                        writeMosaic(
                                 $permalink, 
                                 get_the_title(), 
                                 mysql2date("j M Y", get_the_date()),
                                 $post->post_excerpt,
                                 get_the_post_thumbnail($post->ID, 'full')
                                 );
                        ?>

                    <div class="description">
                        Read the <?php echo $description; ?> episode:<br><?php echo get_the_title(); ?>
                    </div>
                    
                    <div class="clear"></div>
                    
                </div>

                <?php
           endwhile;
        endif;

        wp_reset_postdata();
    
}

// Register sidebar.
if (function_exists('register_sidebar')) {
	register_sidebar();
}

// Register shortcodes.
add_shortcode('posts-toc', 'write_posts_toc');

// Turn on support for post thumbnails.
add_theme_support('post-thumbnails');

// Set the text for the Not Safe For Work plugin.
define('MSFW_LONG_FORM', '[Image not safe for work. Click to view.]');
