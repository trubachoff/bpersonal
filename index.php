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
				
				<?php if (have_posts()): ?>	
					<?php while (have_posts()): the_post() ?>			
							<article>
								<a class="excerpt" href="<?php the_permalink() ?>" >
									<h1><?php the_title() ?></h1>
								</a>
									<div>
									<?php if(has_post_thumbnail()) the_post_thumbnail('thumbnail') ?>
									<?php the_excerpt() ?>
								
								<a class="read_more" href="<?php the_permalink() ?>" >Читать далее&hellip;</a>
							</article>
							<hr />
					<?php endwhile ?>
					
				<?php else: ?>
					<article>
						<h1><?php _e( 'Нет записей' ) ?></h1>
						<p align="center"><?php _e( 'Извините, ничего не найдено.' ) ?></p>
					</article>
				<?php endif ?>
				
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