<?php 

// Get the header template.
get_header();

// The WordPress loop.
if (have_posts()) : 
	while (have_posts()) : 
		the_post();
		?>
		<div class="title">
			<h1 id="post-<?php the_ID(); ?>">
				<span class="breadcrumb">				
		                        <?php if(function_exists('bcn_display'))
		                        {
		                                bcn_display();
		                        }?>
					<?php //the_title(); ?>
				</span>
			</h1>
		</div>
		<div class="post-content min-height light-bg top-gutter">
			<?php the_content(); ?>
		</div>
		<?php
		wp_link_pages();
	endwhile;
else :
	?><div class="nothing"><h2>Not Found</h2>Sorry! Whatever you were looking for could not be found.</div><?php
endif;

// Show comments if a single post is shown.
$withcomments = 1;
comments_template();

// Show the footer.
get_footer(); 

?>
