<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/mosaic.css">
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<script src="//use.typekit.net/hwf8rlq.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php        
	$myPosts = get_posts(array('numberposts' => 1, 'order' => 'ASC', 'category_name' => 'story'));
	foreach ($myPosts as $myPost) {
		$firstPostUrl = get_permalink($myPost->ID);
	}
	?>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img src="<?php bloginfo('template_directory'); ?>/images/filler.gif" alt="Return to home page"></a>
			</div>
			<div class="collapse navbar-collapse">
				<?php wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'container' => false,
					'menu_class' => 'nav navbar-nav'	
				)); ?>
				<form class="navbar-form navbar-left search-form hidden-sm" role="search">
					<div class="form-group">
						<input name="s" type="text" class="search-field" placeholder="Search" required maxlength="20">
					</div>
				</form>
			</div>
		</div>
	</nav>
	
	<div class="container full-width">

		<div class="row">

			<div class="col-sm-9">
