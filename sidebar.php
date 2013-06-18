<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage BPersonal
 * @since Business Personal 1.0
 */
?>

<aside id="social-bar">
	<?php if ( is_active_sidebar( 'social-bar' ) ) : ?>
		<?php dynamic_sidebar( 'social-bar' ); ?>
	<?php endif; ?>
</aside>

<aside id="special-bar">
	<?php if ( is_active_sidebar( 'special-bar' ) ) : ?>
		<?php dynamic_sidebar( 'special-bar' ); ?>
	<?php endif; ?>
</aside>