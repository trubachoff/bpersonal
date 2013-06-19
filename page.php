<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage BPersonal
 * @since Business personal 1.0
 */
get_header() ?>

	<section id="main" class="middle">
			
		<div id="container">
			<section id="content" role="main">
			
				<?php if (is_active_sidebar( 'vacancy' )): ?>
					<div id="vacancy">
						<div id="vacancy-nav">
							<input type="button" class="prev" />
							<input type="button" class="next" />
						</div>

						<?php dynamic_sidebar( 'vacancy' ) ?>
						
						<div id="vacancy-bottom"></div>
					</div><!-- #vacancy -->
				<?php endif ?>

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1><?php the_title(); ?></h1>
						<?php the_content('Читать далее &raquo;'); ?>
						<?php wp_link_pages(array( 'before' => '<div class="page-link">', 'after' => '</div>' )); ?>
						
						<div class="entry-meta">
							<p class="data-published"><?php //the_time('j F Y') ?></p>
							<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
							<?php wp_link_pages(); ?>
						</div>

					</article>
					<?php comments_template( '', true ); ?>
					<hr />
				<?php endwhile; // end of the loop. ?>

				<?php if (is_active_sidebar( 'bottom-bar' )): ?>
					<div id="bottom-bar">
						<?php dynamic_sidebar( 'bottom-bar' ) ?>
					</div><!-- #bottom-bar -->
				<?php endif ?>
				
			</section><!-- #content -->			
		</div><!-- #container-->
		
		<?php get_sidebar() ?>
		
	</section><!-- #main-->

<?php get_footer() ?>