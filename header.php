<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage BPersonal
 * @since Business personal 1.0
 */
?><!DOCTYPE html>
<html>
<head>
	<!--[if lt IE 9]> 
 		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
	<![endif]-->
	<meta charset="utf-8">
	<title><?php wp_title( '&ndash;', true, 'right' ); bloginfo('name'); ?></title>
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory') ?>/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.8.1/build/cssreset/cssreset-min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>" media="screen" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />
	
	<?php wp_head() ?>
	
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ) ?>
	
	<script src="<? echo get_template_directory_uri() ?>/js/menu-uslugi.min.js"></script>
	
	<script src="<? echo get_template_directory_uri() ?>/js/vacancy-carousel.min.js"></script> 
	<script>
	        $(document).ready(function() {
	                $('.container').my_carousel({
	                        btnNext: '.next',
                        	btnPrev: '.prev',
                        	visible: 3,
	                        rotateBy: 1,
	                        auto: 8000,  
	                });
	        });
	</script>
</head>
<body>
<div id="wrapper">
	<header id="header">
		
		<div id="nav">
			<div class="middle">
				<?php wp_nav_menu( array( 'menu' => 'nav-menu', 'container_class' => 'nav-menu' )  ) ?>
				<ul id="contacts">
					<li id="email"><a href="mailto:bpersonal@hr.dn.ua?subject=Feedback_from_Site">bpersonal@hr.dn.ua</a></li>
					<li id="phone">+38 099 022-55-02</li>
				</ul>
			</div><!-- .middle -->
		</div>
		
		<div id="banner">
			<div class="middle">
				<div id="logo"><a href="<?php echo get_option('home') ?>"><span><?php bloginfo('name') ?></span></a></div>
				<div id="slogan">
					<?php bloginfo('description') ?>
				</div>
				<div id="special"> </div>
				<button id="add-response" onClick="document.getElementById('response-form-1').style.display='block';">добавить<br />отзыв</button>
			</div><!-- .middle -->
		</div><!-- #banner -->
		
	</header><!-- #header-->
