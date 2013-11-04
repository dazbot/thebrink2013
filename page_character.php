<?php
/*
Template Name: Character
*/

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
				</span>
				<?php //the_title(); ?>
			</h1>
		</div>
		<div class="character min-height light-bg">
			<div class="biography">
				<?php if (get_field('nickname') != ''): ?>
					<?php if (strpos(get_field('nickname'), ',') !== FALSE) echo '<h2>Nicknames</h2>'; else echo '<h2>Nickname</h2>'; ?>
					<p><?php the_field('nickname'); ?></p>
				<?php endif; ?>
				<h2>Biography</h2>
				<?php the_content(); ?>
				<h2>Nationality</h2>
				<p><?php the_field('nationality'); ?></p>
				<?php if (get_field('age') != ''): ?>
					<h2>Age on E-Day</h2>
					<p><?php the_field('age'); ?></p>
				<?php endif; ?>
				<?php if (get_field('location') != ''): ?>
					<h2>Location on E-Day</h2>
					<p><?php the_field('location'); ?></p>
				<?php endif; ?>
			</div>
			<div class="images">
				<img src="<?php the_field('face_image'); ?>" alt="Face image" />
				<img src="<?php the_field('body_image'); ?>" alt="Body image" />				
			</div>
			<div class="clear"></div>
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
