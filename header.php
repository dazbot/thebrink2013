<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/meanmenu.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/mosaic.css" type="text/css" media="screen" />
	<script type="text/javascript" src="//use.typekit.net/hwf8rlq.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/mosaic.1.0.1.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.corner.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.color-2.1.0.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.meanmenu.2.0.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/thebrink.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php        
	$myPosts = get_posts(array('numberposts' => 1, 'order' => 'ASC', 'category_name' => 'story'));
	foreach ($myPosts as $myPost) {
		$firstPostUrl = get_permalink($myPost->ID);
	}
	?>
	
	<div class="header linode">
		<a href="/"><img src="<?php bloginfo('template_directory'); ?>/images/banner-volume2.png" alt="The Brink" class="banner" /></a>
		<div class="desktop-menu-container">
			<div class="menu">
				<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="mainbar">
