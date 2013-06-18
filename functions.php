<?php
/**
 * Functions and definitions.
 *
 * @package WordPress
 * @subpackage BPersonal
 * @since Business personal 1.0
 */
 
/**
 * Sidebar
 *------------------------------------------------------ 
 */
// Register Sidebar
function custom_sidebar()  {
	register_sidebar( array(
		'id'            => 'social-bar',
		'name'          => __( 'Левая панель', 'BPersonal' ),
		'description'   => __( 'Социальные виджеты', 'BPersonal' ),
		'before_title'  => '<h3 class="sidebar-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget-box">',
		'after_widget'  => '</div>',
	));
	register_sidebar( array(
		'id'            => 'special-bar',
		'name'          => __( 'Правая панель', 'BPersonal' ),
		'description'   => __( 'Дополнительные виджеты', 'BPersonal' ),
		'before_title'  => '<h3 class="sidebar-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<div id="%1$s" class="widget-box">',
		'after_widget'  => '</div>',
	));
 	register_sidebar( array(
		'id'            => 'vacancy',
		'name'          => __( 'Центр верх', 'BPersonal' ),
		'description'   => __( 'Центр вверху страницы', 'BPersonal' ),
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	));
  	register_sidebar( array(
		'id'            => 'bottom-bar',
		'name'          => __( 'Центр низ', 'BPersonal' ),
		'description'   => __( 'Центр внизу страницы', 'BPersonal' ),
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	));

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'custom_sidebar' );
 
/**
 * Menu
 * ------------------------------------------------------
 */
// Register Menus
function custom_navigation_menus() {
	$locations = array(
		'nav-menu' => 'Главное меню',
		'services-menu' => 'Правое меню',
	);

	register_nav_menus( $locations );
}

// Hook into the 'init' action
add_action( 'init', 'custom_navigation_menus' );

// Thumbnails
add_theme_support('post-thumbnails');

/**
 * Posts functions
 * ------------------------------------------------------
 */
// получить адрес первой картинки поста
function catch_that_image($maxWidth = 150) {
 global $post, $posts;
 $first_img = '';
 ob_start();
 ob_end_clean();
 $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
 $first_img = $matches [1] [0];
       if (!empty($first_img)) $size = getimagesize($first_img);
       $imageWidth = $size[0];
       if ($imageWidth > $maxWidth) $imageWidth = $maxWidth;
       $post_title = $post->post_title;
       $post_title = str_replace('"', '\'', $post_title);
       if(empty($first_img)) {
               return '';
       } else {
               return '<img src="'.$first_img.'" width="'.$imageWidth.'" alt="'.$post_title.'" />';
       }
}
/** 
 * Ограничить вывод количества слов $word_limit в строке $string
 * Пример для вызова ограниченного количества слов из поста:
 *  <? do_excerpt(get_the_excerpt(), 10) ?>
 */
function do_excerpt($string, $word_limit=10, $end="&hellip;") {
	$words = explode(' ', $string, ($word_limit + 1));
	if (count($words) > $word_limit) {
		array_pop($words);
	} else {
		$end = '';
	}
	echo implode(' ', $words).$end;
}

/**
 * Загрузка JQuery из Google CDN
 *
 */
if( !is_admin()){
   wp_deregister_script('jquery');
   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"), false, '1.10.1');
   wp_enqueue_script('jquery');
   }

/**
 * Custom fields for vacancies in admin panel
 *
 */
add_action('admin_init', 'my_extra_fields', 1);

function my_extra_fields() {
    add_meta_box( 'extra_fields', 'Дополнительные поля для Вакансий', 'extra_fields_box_func', 'post', 'normal', 'high'  );
}

function extra_fields_box_func( $post ){
?>
    <p><label>Город: <input type="text" name="extra[Город]" value="<?php echo get_post_meta($post->ID, 'Город', 1); ?>" /></label></p>
    <p><label>Сфера: <input type="text" name="extra[Сфера]" value="<?php echo get_post_meta($post->ID, 'Сфера', 1); ?>" /></label></p>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

add_action('save_post', 'my_extra_fields_update', 0);

function my_extra_fields_update( $post_id ){
    if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
    if ( !current_user_can('edit_post', $post_id) ) return false;

    if( !isset($_POST['extra']) ) return false;

    $_POST['extra'] = array_map('trim', $_POST['extra']);
    foreach( $_POST['extra'] as $key=>$value ){
        if( empty($value) )
            continue delete_post_meta($post_id, $key);

        update_post_meta($post_id, $key, $value);
    }
    return $post_id;
}