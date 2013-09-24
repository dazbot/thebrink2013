<?php 

$prevButton = "";
$nextButton = "";

// Get the header template.
get_header();

// Show the most recent non-extras post on the home page.
if (is_home()) {
	query_posts('showposts=1&cat=-' . get_category_by_slug('extras')->term_id . ',-' . get_category_by_slug('about')->term_id);
}

// Show the prev/next navigation buttons.
if (have_posts()) {
	the_post();
	$prevButton = get_prev_button();
	$nextButton = get_next_button();
	rewind_posts();
}

// The WordPress loop.
if (have_posts()) : 
	while (have_posts()) : 
		the_post();
		echo "<div class=\"title\">";
		echo $prevButton;
		?>
			<h1 id="post-<?php the_ID(); ?>">
				<?php if (!is_singular()) : ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php endif; ?>
					<?php the_title(); ?>
				<?php if (!is_singular()) : ?></a><?php endif; ?>
			</h1>
		<?php
		echo $nextButton;
		echo "</div>";
		echo "<div class=\"post-content\">";
		the_content();
		echo "</div>";
		wp_link_pages();
		echo "<div class=\"prev-next-strip\">";
		echo $prevButton;
		echo $nextButton;
		echo "</div>";
	endwhile;
else :
	?><div class="nothing"><h2>Not Found</h2>Sorry! Whatever you were looking for could not be found.</div><?php
endif;

// Show comments if a single post is shown.
if (is_single() || is_home()) {
	$withcomments = 1;
	comments_template();
}

// Show the prev/next page links if multiple posts are shown.
if (!is_home()) {
	wp_pagenavi();
}

// Show the footer.
get_footer(); 

?>
