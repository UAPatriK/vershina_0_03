<?php


register_nav_menu('top-bar', __('Primary Menu'));

register_nav_menus(
array(
	
	'footer_menu1' => 'Меню футера-1',
	'footer_menu2' => 'Меню футера-2',
	'footer_menu3' => 'Меню футера-3',
	
) 
	 );


/**
 * Extended Walker class for use with the
 * Twitter Bootstrap toolkit Dropdown menus in Wordpress.
 * Edited to support n-levels submenu.
 * @author johnmegahan https://gist.github.com/1597994, Emanuele 'Tex' Tessore https://gist.github.com/3765640
 * @license CC BY 4.0 https://creativecommons.org/licenses/by/4.0/
 */
class BootstrapNavMenuWalker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth ) {
		$indent = str_repeat( "\t", $depth );
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output	   .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$li_attributes = '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		// managing divider: add divider class to an element to get a divider before it.
		$divider_class_position = array_search('divider', $classes);
		if($divider_class_position !== false){
			$output .= "<li class=\"divider\"></li>\n";
			unset($classes[$divider_class_position]);
		}
		
		$classes[] = ($args->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		if($depth && $args->has_children){
			$classes[] = 'dropdown-submenu';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($depth == 0 && $args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		//v($element);
		if ( !$element )
			return;
		$id_field = $this->db_fields['id'];
		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) )
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);
		$id = $element->$id_field;
		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
			foreach( $children_elements[ $id ] as $child ){
				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}
		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}
		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}
} 


add_theme_support('post-thumbnails' );




// if ( function_exists('register_sidebar') )
// register_sidebar(array(
// 'before_widget' => '',
// 	'after_widget' => '',
// ));

add_filter('widget_text', 'do_shortcode');





// Code for Courses

function my_custom_post_courses() {
  $labels = array(
    'name'               => _x( 'Курсы', 'post type general name' ),
    'singular_name'      => _x( 'Курс', 'post type singular name' ),
    'add_new'            => _x( 'Добавить новый курс', 'book' ),
    'add_new_item'       => __( 'Новый курс' ),
    'edit_item'          => __( 'Редактировать курс' ),
    'new_item'           => __( 'Новый курс' ),
    'all_items'          => __( 'Все курсы' ),
    'view_item'          => __( 'Просмотреть курс' ),
    'search_items'       => __( 'Искать курс' ),
    'not_found'          => __( 'Курсы не найдены' ),
    'not_found_in_trash' => __( 'В корзине курсы не найдены' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Курсы'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail'),
    'has_archive'   => true,
     'menu_icon' => 'dashicons-pressthis',
  );
  register_post_type( 'courses', $args ); 
}
add_action( 'init', 'my_custom_post_courses' );

function my_updated_messages_courses( $messages ) {
  global $post, $post_ID;
  $messages['courses'] = array(
    0 => '', 
    1 => sprintf( __('Курс обновлен. <a href="%s">Просмотреть курс</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Поле добавлено.'),
    3 => __('Поле удалено.'),
    4 => __('Курс обновлен.'),
    5 => isset($_GET['revision']) ? sprintf( __('Курс восстановлен от %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Курс опубликован. <a href="%s">View course</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Курс сохранен.'),
    8 => sprintf( __('Предпросмотр курса <a target="_blank" href="%s">Preview course</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Публикация курса запланирована: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр курса</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Черновик курса сохранен. <a target="_blank" href="%s">Предпросмотр курса</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages_courses' );


function my_contextual_help_courses( $contextual_help, $screen_id, $screen ) { 
  if ( 'courses' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p> 
    ';

  } elseif ( 'edit-courses' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p>';

  }
  return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help_courses', 10, 3 );


function my_taxonomies_courses() {
  $labels = array(
    'name'              => _x( 'Категории курсов', 'taxonomy general name' ),
    'singular_name'     => _x( 'Категория курса', 'taxonomy singular name' ),
    'search_items'      => __( 'Искать категорию курсов' ),
    'all_items'         => __( 'Все категории курсов' ),
    'parent_item'       => __( 'Родительская категория курсов' ),
    'parent_item_colon' => __( 'Родительская категория курса:' ),
    'edit_item'         => __( 'Редактировать категорию курсов' ), 
    'update_item'       => __( 'Обновить категорию курсов' ),
    'add_new_item'      => __( 'Добавить новую категорию курсов' ),
    'new_item_name'     => __( 'Новая категория курсов' ),
    'menu_name'         => __( 'Категории курсов' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'courses_category', 'courses', $args );
}
add_action( 'init', 'my_taxonomies_courses', 0 );



// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields_courses', 1);

function my_extra_fields_courses() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func_courses', 'courses', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func_courses( $post ){
?>

<table width="100%" border="1" cellspacing="0" bordercolor="ececec" cellpadding="7">

<tr><label>
	<td>
		Возраст:
	</td>
	<td>
		<input type="text" name="extra[courses_row_1]" value="<?php echo get_post_meta($post->ID, 'courses_row_1', 1); ?>" style="width:50%" />
	</td></label>
</tr>
<tr><label>
	<td>
		Количество занятий в неделю:
	</td>
	<td>
		<input type="text" name="extra[courses_row_2]" value="<?php echo get_post_meta($post->ID, 'courses_row_2', 1); ?>" style="width:50%" />
	</td></label>
</tr>
<tr><label>
	<td>
		Количество детей в группе:
	</td>
	<td>
		<input type="text" name="extra[courses_row_3]" value="<?php echo get_post_meta($post->ID, 'courses_row_3', 1); ?>" style="width:50%" />
	</td></label>
</tr>
<tr><label>
	<td>
		Стоимость:
	</td>
	<td>
		<input type="text" name="extra[courses_row_4]" value="<?php echo get_post_meta($post->ID, 'courses_row_4', 1); ?>" style="width:50%" />
	</td></label>
</tr>






	</table>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update_courses', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update_courses( $post_id ){
	if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение
	if ( !current_user_can('edit_post', $post_id) ) return false; // если юзер не имеет право редактировать запись

	if( !isset($_POST['extra']) ) return false;	

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}

		update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
	}
	return $post_id;
}



// Code for Partners

function my_custom_post_partners() {
  $labels = array(
    'name'               => _x( 'Партнеры', 'post type general name' ),
    'singular_name'      => _x( 'Партнер', 'post type singular name' ),
    'add_new'            => _x( 'Добавить нового партнера', 'book' ),
    'add_new_item'       => __( 'Новый партнер' ),
    'edit_item'          => __( 'Редактировать партнера' ),
    'new_item'           => __( 'Новый партнер' ),
    'all_items'          => __( 'Все партнеры' ),
    'view_item'          => __( 'Просмотреть партнера' ),
    'search_items'       => __( 'Искать партнера' ),
    'not_found'          => __( 'Партнеры не найдены' ),
    'not_found_in_trash' => __( 'В корзине партнеры не найдены' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Партнеры'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'thumbnail'),
    'has_archive'   => true,
     'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'partners', $args ); 
}
add_action( 'init', 'my_custom_post_partners' );

function my_updated_messages_partners( $messages ) {
  global $post, $post_ID;
  $messages['partners'] = array(
    0 => '', 
    1 => sprintf( __('Партнер обновлен. <a href="%s">Просмотреть партнера</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Поле добавлено.'),
    3 => __('Поле удалено.'),
    4 => __('Партнер обновлен.'),
    5 => isset($_GET['revision']) ? sprintf( __('Партнер восстановлен от %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Партнер опубликован. <a href="%s">View partners</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Партнер сохранен.'),
    8 => sprintf( __('Предпросмотр партнера <a target="_blank" href="%s">Preview partners</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Публикация партнера запланирована: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр партнера</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Черновик партнера сохранен. <a target="_blank" href="%s">Предпросмотр партнера</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages_partners' );


function my_contextual_help_partners( $contextual_help, $screen_id, $screen ) { 
  if ( 'partners' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p> 
    ';

  } elseif ( 'edit-partners' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p>';

  }
  return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help_partners', 10, 3 );


function my_taxonomies_partners() {
  $labels = array(
    'name'              => _x( 'Категории партнеров', 'taxonomy general name' ),
    'singular_name'     => _x( 'Категория партнера', 'taxonomy singular name' ),
    'search_items'      => __( 'Искать категорию партнеров' ),
    'all_items'         => __( 'Все категории партнеров' ),
    'parent_item'       => __( 'Родительская категория партнеров' ),
    'parent_item_colon' => __( 'Родительская категория партнера:' ),
    'edit_item'         => __( 'Редактировать категорию партнеров' ), 
    'update_item'       => __( 'Обновить категорию партнеров' ),
    'add_new_item'      => __( 'Добавить новую категорию партнеров' ),
    'new_item_name'     => __( 'Новая категория партнеров' ),
    'menu_name'         => __( 'Категории партнеров' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'partners_category', 'partners', $args );
}
add_action( 'init', 'my_taxonomies_partners', 0 );



// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields_partners', 1);

function my_extra_fields_partners() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func_partners', 'partners', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func_partners( $post ){
?>

<table width="100%" border="1" cellspacing="0" bordercolor="ececec" cellpadding="7">

<tr><label>
	<td>
		Ссылка на страницу партнера:
	</td>
	<td>
		<input type="text" name="extra[partners_row_1]" value="<?php echo get_post_meta($post->ID, 'partners_row_1', 1); ?>" style="width:50%" />
	</td></label>
</tr>





	</table>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update_partners', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update_partners( $post_id ){
	if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение
	if ( !current_user_can('edit_post', $post_id) ) return false; // если юзер не имеет право редактировать запись

	if( !isset($_POST['extra']) ) return false;	

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}

		update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
	}
	return $post_id;
}



// Code for QA

function my_custom_post_qa() {
  $labels = array(
    'name'               => _x( 'Вопросы и ответы', 'post type general name' ),
    'singular_name'      => _x( 'Вопрос и ответ', 'post type singular name' ),
    'add_new'            => _x( 'Добавить новый вопрос и ответ', 'book' ),
    'add_new_item'       => __( 'Новый вопрос и ответ' ),
    'edit_item'          => __( 'Редактировать вопрос и ответ' ),
    'new_item'           => __( 'Новый вопрос и ответ' ),
    'all_items'          => __( 'Все вопросы и ответы' ),
    'view_item'          => __( 'Просмотреть вопросы и ответы' ),
    'search_items'       => __( 'Искать вопрос и ответ' ),
    'not_found'          => __( 'Вопросы и ответы не найдены' ),
    'not_found_in_trash' => __( 'В корзине вопросы и ответы не найдены' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Вопросы и ответы'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title'),
    'has_archive'   => true,
     'menu_icon' => 'dashicons-info',
  );
  register_post_type( 'qa', $args ); 
}
add_action( 'init', 'my_custom_post_qa' );

function my_updated_messages_qa( $messages ) {
  global $post, $post_ID;
  $messages['qa'] = array(
    0 => '', 
    1 => sprintf( __('Вопрос и ответ обновлен. <a href="%s">Просмотреть вопрос и ответ</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Поле добавлено.'),
    3 => __('Поле удалено.'),
    4 => __('Вопрос и ответ обновлен.'),
    5 => isset($_GET['revision']) ? sprintf( __('Вопрос и ответ восстановлен от %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Вопрос и ответ опубликован. <a href="%s">View qa</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Вопрос и ответ сохранен.'),
    8 => sprintf( __('Предпросмотр вопроса и ответа <a target="_blank" href="%s">Preview qa</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Публикация вопроса и ответа запланирована: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр вопроса и ответа</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Черновик вопроса и ответа сохранен. <a target="_blank" href="%s">Предпросмотр вопроса и ответа</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages_qa' );


function my_contextual_help_qa( $contextual_help, $screen_id, $screen ) { 
  if ( 'qa' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p> 
    ';

  } elseif ( 'edit-qa' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p>';

  }
  return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help_qa', 10, 3 );


function my_taxonomies_qa() {
  $labels = array(
    'name'              => _x( 'Категории вопросов и ответов', 'taxonomy general name' ),
    'singular_name'     => _x( 'Категория вопроса и ответа', 'taxonomy singular name' ),
    'search_items'      => __( 'Искать категорию вопросов и ответов' ),
    'all_items'         => __( 'Все категории вопросов и ответов' ),
    'parent_item'       => __( 'Родительская категория вопросов и ответов' ),
    'parent_item_colon' => __( 'Родительская категория вопроса и ответа:' ),
    'edit_item'         => __( 'Редактировать категорию вопросов и ответов' ), 
    'update_item'       => __( 'Обновить категорию вопросов и ответов' ),
    'add_new_item'      => __( 'Добавить новую категорию вопросов и ответов' ),
    'new_item_name'     => __( 'Новая категория вопросов и ответов' ),
    'menu_name'         => __( 'Категории вопросов и ответов' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'qa_category', 'qa', $args );
}
add_action( 'init', 'my_taxonomies_qa', 0 );



// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields_qa', 1);

function my_extra_fields_qa() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func_qa', 'qa', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func_qa( $post ){
?>

<table width="100%" border="1" cellspacing="0" bordercolor="ececec" cellpadding="7">

<tr><label>
	<td>
		Вопрос:
	</td>
	<td>
		<input type="text" name="extra[qa_row_1]" value="<?php echo get_post_meta($post->ID, 'qa_row_1', 1); ?>" style="width:50%" />
	</td></label>
</tr>

<tr><label>
	<td>
		Ответ:
	</td>
	<td>
		<input type="text" name="extra[qa_row_2]" value="<?php echo get_post_meta($post->ID, 'qa_row_2', 1); ?>" style="width:50%" />
	</td></label>
</tr>



	</table>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update_qa', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update_qa( $post_id ){
	if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение
	if ( !current_user_can('edit_post', $post_id) ) return false; // если юзер не имеет право редактировать запись

	if( !isset($_POST['extra']) ) return false;	

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}

		update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
	}
	return $post_id;
}



// Code for Team

function my_custom_post_team() {
  $labels = array(
    'name'               => _x( 'Команда', 'post type general name' ),
    'singular_name'      => _x( 'Команда', 'post type singular name' ),
    'add_new'            => _x( 'Добавить нового участника команды', 'book' ),
    'add_new_item'       => __( 'Новый участник команды' ),
    'edit_item'          => __( 'Редактировать участника команды' ),
    'new_item'           => __( 'Новый участник команды' ),
    'all_items'          => __( 'Все участники команды' ),
    'view_item'          => __( 'Просмотреть участника команда' ),
    'search_items'       => __( 'Искать участника команды' ),
    'not_found'          => __( 'Участники команды не найдены' ),
    'not_found_in_trash' => __( 'В корзине участники команды не найдены' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Участники команды'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'thumbnail'),
    'has_archive'   => true,
     'menu_icon' => 'dashicons-groups',
  );
  register_post_type( 'team', $args ); 
}
add_action( 'init', 'my_custom_post_team' );

function my_updated_messages_team( $messages ) {
  global $post, $post_ID;
  $messages['team'] = array(
    0 => '', 
    1 => sprintf( __('Участник команды обновлен. <a href="%s">Просмотреть участника команды</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Поле добавлено.'),
    3 => __('Поле удалено.'),
    4 => __('Участник команды обновлен.'),
    5 => isset($_GET['revision']) ? sprintf( __('Участник команды восстановлен от %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Участник команды опубликован. <a href="%s">View team</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Участник команды сохранен.'),
    8 => sprintf( __('Предпросмотр участника команды <a target="_blank" href="%s">Preview team</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Публикация участника команды запланирована: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр участника команды</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Черновик участника команды сохранен. <a target="_blank" href="%s">Предпросмотр участника команды</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages_team' );


function my_contextual_help_team( $contextual_help, $screen_id, $screen ) { 
  if ( 'team' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p> 
    ';

  } elseif ( 'edit-team' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p>';

  }
  return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help_team', 10, 3 );


function my_taxonomies_team() {
  $labels = array(
    'name'              => _x( 'Категории участников команды', 'taxonomy general name' ),
    'singular_name'     => _x( 'Категория участника команды', 'taxonomy singular name' ),
    'search_items'      => __( 'Искать категорию участников команды' ),
    'all_items'         => __( 'Все категории участников команды' ),
    'parent_item'       => __( 'Родительская категория участника команды' ),
    'parent_item_colon' => __( 'Родительская категория участника команды:' ),
    'edit_item'         => __( 'Редактировать категорию участника команды' ), 
    'update_item'       => __( 'Обновить категорию участников команды' ),
    'add_new_item'      => __( 'Добавить новую категорию участников команды' ),
    'new_item_name'     => __( 'Новая категория участников команды' ),
    'menu_name'         => __( 'Категории участников команды' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'team_category', 'team', $args );
}
add_action( 'init', 'my_taxonomies_team', 0 );



// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields_team', 1);

function my_extra_fields_team() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func_team', 'team', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func_team( $post ){
?>

<table width="100%" border="1" cellspacing="0" bordercolor="ececec" cellpadding="7">

<tr><label>
	<td>
		ФИО:
	</td>
	<td>
		<input type="text" name="extra[team_row_1]" value="<?php echo get_post_meta($post->ID, 'team_row_1', 1); ?>" style="width:50%" />
	</td></label>
</tr>

<tr><label>
	<td>
Курс:
	</td>
	<td>
		<input type="text" name="extra[team_row_2]" value="<?php echo get_post_meta($post->ID, 'team_row_2', 1); ?>" style="width:50%" />
	</td></label>
</tr>

<tr><label>
	<td>
Образование:
	</td>
	<td>
		<input type="text" name="extra[team_row_3]" value="<?php echo get_post_meta($post->ID, 'team_row_3', 1); ?>" style="width:50%" />
	</td></label>
</tr>

<tr><label>
	<td>
		Приветствие:
	</td>
	<td>
		<input type="text" name="extra[team_row_4]" value="<?php echo get_post_meta($post->ID, 'team_row_4', 1); ?>" style="width:50%" />
	</td></label>
</tr>



	</table>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update_team', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update_team( $post_id ){
	if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение
	if ( !current_user_can('edit_post', $post_id) ) return false; // если юзер не имеет право редактировать запись

	if( !isset($_POST['extra']) ) return false;	

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}

		update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
	}
	return $post_id;
}



// Code for Party

function my_custom_post_party() {
  $labels = array(
    'name'               => _x( 'Оформление праздников', 'post type general name' ),
    'singular_name'      => _x( 'Оформление праздников', 'post type singular name' ),
    'add_new'            => _x( 'Добавить новое оформление праздника', 'book' ),
    'add_new_item'       => __( 'Новое оформление праздника' ),
    'edit_item'          => __( 'Редактировать оформление праздника' ),
    'new_item'           => __( 'Новое оформление праздника' ),
    'all_items'          => __( 'Все оформления праздников' ),
    'view_item'          => __( 'Просмотреть оформление праздника' ),
    'search_items'       => __( 'Искать оформление праздника' ),
    'not_found'          => __( 'Оформления праздника не найдены' ),
    'not_found_in_trash' => __( 'В корзине оформления праздника не найдены' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Оформления праздника'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail'),
    'has_archive'   => true,
     'menu_icon' => 'dashicons-palmtree',
  );
  register_post_type( 'party', $args ); 
}
add_action( 'init', 'my_custom_post_party' );

function my_updated_messages_party( $messages ) {
  global $post, $post_ID;
  $messages['party'] = array(
    0 => '', 
    1 => sprintf( __('Оформления праздника обновлено. <a href="%s">Просмотреть оформление праздника</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Поле добавлено.'),
    3 => __('Поле удалено.'),
    4 => __('Оформление праздника обновлено.'),
    5 => isset($_GET['revision']) ? sprintf( __('Оформление праздника восстановлено от %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Оформление праздника опубликовано. <a href="%s">View party</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Оформление праздника сохранено.'),
    8 => sprintf( __('Предпросмотр оформления праздника <a target="_blank" href="%s">Preview party</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Публикация оформление праздника запланирована: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр оформления праздника</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Черновик оформления праздника сохранен. <a target="_blank" href="%s">Предпросмотр оформления праздника</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages_party' );


function my_contextual_help_party( $contextual_help, $screen_id, $screen ) { 
  if ( 'party' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p> 
    ';

  } elseif ( 'edit-party' == $screen->id ) {

    $contextual_help = '<h2></h2>
    <p></p>';

  }
  return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help_party', 10, 3 );


function my_taxonomies_party() {
  $labels = array(
    'name'              => _x( 'Категории оформления праздников', 'taxonomy general name' ),
    'singular_name'     => _x( 'Категория оформления праздника', 'taxonomy singular name' ),
    'search_items'      => __( 'Искать категорию оформления праздников' ),
    'all_items'         => __( 'Все категории оформления праздников' ),
    'parent_item'       => __( 'Родительская категория оформления праздников' ),
    'parent_item_colon' => __( 'Родительская категория оформления праздников:' ),
    'edit_item'         => __( 'Редактировать категорию оформления праздников' ), 
    'update_item'       => __( 'Обновить категорию оформления праздников' ),
    'add_new_item'      => __( 'Добавить новую категорию оформления праздников' ),
    'new_item_name'     => __( 'Новая категория оформления праздников' ),
    'menu_name'         => __( 'Категории оформления праздников' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'party_category', 'party', $args );
}
add_action( 'init', 'my_taxonomies_party', 0 );



// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields_party', 1);

function my_extra_fields_party() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func_party', 'party', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func_party( $post ){
?>

<table width="100%" border="1" cellspacing="0" bordercolor="ececec" cellpadding="7">

<tr><label>
	<td>
		Cтрока 1:
	</td>
	<td>
		<input type="text" name="extra[party_row_1]" value="<?php echo get_post_meta($post->ID, 'party_row_1', 1); ?>" style="width:50%" />
	</td></label>
</tr>

<tr><label>
	<td>
Cтрока 2:
	</td>
	<td>
		<input type="text" name="extra[party_row_2]" value="<?php echo get_post_meta($post->ID, 'party_row_2', 1); ?>" style="width:50%" />
	</td></label>
</tr>

<tr><label>
	<td>
Cтрока 3:
	</td>
	<td>
		<input type="text" name="extra[party_row_3]" value="<?php echo get_post_meta($post->ID, 'party_row_3', 1); ?>" style="width:50%" />
	</td></label>
</tr>

<tr><label>
	<td>
		Cтрока 4:
	</td>
	<td>
		<input type="text" name="extra[party_row_4]" value="<?php echo get_post_meta($post->ID, 'party_row_4', 1); ?>" style="width:50%" />
	</td></label>
</tr>



	</table>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update_party', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update_party( $post_id ){
	if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение
	if ( !current_user_can('edit_post', $post_id) ) return false; // если юзер не имеет право редактировать запись

	if( !isset($_POST['extra']) ) return false;	

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}

		update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
	}
	return $post_id;
}




add_action('admin_head', 'custom_colors');
function custom_colors() {
	echo '<style type="text/css">
	#wpadminbar{background:#A50057}
	
	#adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
	background-color:#A50057
}

#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu .wp-menu-arrow, #adminmenu .wp-menu-arrow div, #adminmenu li.current a.menu-top, #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, .folded #adminmenu li.wp-has-current-submenu {
	background: #A50057

}


#adminmenu .wp-submenu a:hover {
background-color: #191E23;
color: #fff;
}
	</style>';
}



function gb_custom_login_logo() {
    echo PHP_EOL . '<style type="text/css">
    #login h1 a {
       background-image:url(http://vershina.org.ua/wp-content/uploads/2016/03/logoVershina.png) !important;
       width: 200px;
       height: 123px;
       -webkit-background-size: 200px 123px;
       background-size: 200px 123px;
      }

     </style>' . PHP_EOL;

}

add_action('login_head', 'gb_custom_login_logo');
function custom_login_css() {
echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/login/login-style.css" />';
}

add_action('login_head', 'custom_login_css');





// Code for Events

function my_custom_post_events() {
  $labels = array(
    'name'               => _x( 'Мероприятия', 'post type general name' ),
    'singular_name'      => _x( 'Мероприятиее', 'post type singular name' ),
    'add_new'            => _x( 'Добавить новое мероприятие', 'book' ),
    'add_new_item'       => __( 'Новое мероприятие' ),
    'edit_item'          => __( 'Редактировать мероприятие' ),
    'new_item'           => __( 'Новое мероприятие' ),
    'all_items'          => __( 'Все мероприятия' ),
    'view_item'          => __( 'Просмотреть мероприятие' ),
    'search_items'       => __( 'Искать мероприятие' ),
    'not_found'          => __( 'Мероприятия не найдены' ),
    'not_found_in_trash' => __( 'В корзине мероприятия не найдены' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Мероприятия'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Тип записи для отображения мероприятий',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'thumbnail'),
    'has_archive'   => true,
     'menu_icon' => 'dashicons-calendar-alt',
  );
  register_post_type( 'events', $args ); 
}
add_action( 'init', 'my_custom_post_events' );

function my_updated_messages_events( $messages ) {
  global $post, $post_ID;
  $messages['events'] = array(
    0 => '', 
    1 => sprintf( __('Мероприятие обновлено. <a href="%s">Просмотреть мероприятие</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Поле добавлено.'),
    3 => __('Поле удалено.'),
    4 => __('Мероприятие обновлено.'),
    5 => isset($_GET['revision']) ? sprintf( __('Мероприятие обновлено от %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Мероприятие опубликовано. <a href="%s">View events</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Мероприятие сохранено.'),
    8 => sprintf( __('Предпросмотр мероприятия <a target="_blank" href="%s">Preview events</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Публикация мероприятия запланирвоана: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр мероприятия</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Черновик мероприятия сохранен. <a target="_blank" href="%s">Предпросмотр мероприятия</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages_events' );


// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields_events', 1);

function my_extra_fields_events() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func_events', 'events', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func_events( $post ){
?>

<table width="100%" border="1" cellspacing="0" bordercolor="ececec" cellpadding="7">

<tr><label>
	<td>
	Дата мероприятия:
	</td>
	<td>
		<input type="text" name="extra[events_row_1]" value="<?php echo get_post_meta($post->ID, 'events_row_1', 1); ?>" style="width:50%" />
	</td></label>
</tr>
<tr><label>
	<td>
	Время мероприятия:
	</td>
	<td>
		<input type="text" name="extra[events_row_2]" value="<?php echo get_post_meta($post->ID, 'events_row_2', 1); ?>" style="width:50%" />
	</td></label>
</tr>
<tr><label>
	<td>
	Название мероприятия:
	</td>
	<td>
		<input type="text" name="extra[events_row_3]" value="<?php echo get_post_meta($post->ID, 'events_row_3', 1); ?>" style="width:50%" />
	</td></label>
</tr>
<tr><label>
	<td>
	Ссылка на запись с мероприятием:
	</td>
	<td>
		<input type="text" name="extra[events_row_4]" value="<?php echo get_post_meta($post->ID, 'events_row_4', 1); ?>" style="width:50%" />
	</td></label>
</tr>
<tr><label>
	<td>
	Стоимость мероприятия:
	</td>
	<td>
		<input type="text" name="extra[events_row_5]" value="<?php echo get_post_meta($post->ID, 'events_row_5', 1); ?>" style="width:50%" />
	</td></label>
</tr>

	</table>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
<?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update_events', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update_events( $post_id ){
	if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение
	if ( !current_user_can('edit_post', $post_id) ) return false; // если юзер не имеет право редактировать запись

	if( !isset($_POST['extra']) ) return false;	

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}

		update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
	}
	return $post_id;
}










?>