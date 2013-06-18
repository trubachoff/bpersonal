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
								<h1><?php the_title() ?></h1>

								<?php
									$city = get_post_meta(get_the_ID(), 'Город', 1);
									$type = get_post_meta(get_the_ID(), 'Сфера', 1);
								?>

						        <ul class='post-meta'>
						        	<? if ( $city !== '' ): ?>
						          		<li><span class='post-meta-key'>Город: </span><?=$city ?></li>
						          	<? endif ?>
						          	<? if ( $type !== '' ):?>
						          		<li><span class='post-meta-key'>Сфера: </span><?=$type ?></li>
						          	<? endif ?>
						        </ul>

								<?php the_content(); ?>
								
								<p><small>Опубликовано: <?php the_time('l, j F Y') ?> [<?php the_time() ?>]</small></p>

								<?php wp_link_pages(); ?>
								<?php edit_post_link(); ?>

							</article>
					<?php endwhile ?>
					<?php comments_template(); ?>
					<?php //comment_form() ?>
				<?php else: ?>
					<article>
						<h1><?php _e( 'Нет записей' ) ?></h1>
						<p align="center"><?php _e( 'Извините, ничего не найдено.' ) ?></p>
					</article>
				<?php endif ?>
				
				<hr />

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