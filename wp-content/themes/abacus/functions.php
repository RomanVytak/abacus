<?php


//
add_theme_support( 'post-thumbnails' );

// include theme settings
require_once(TEMPLATEPATH . '/fields.php');


/* include post types */
// require_once(TEMPLATEPATH . '/functions/post-type.php');
// require_once(TEMPLATEPATH . '/functions/extra-fields.php');
// require_once(TEMPLATEPATH . '/functions/options.php');


// fe styles
add_action('wp_enqueue_scripts', 'custome_theme_style', 11);
function custome_theme_style() {
	if (defined('IS_LOCAL') && IS_LOCAL) {
		wp_enqueue_style( 'mytheme-custom', get_template_directory_uri() .'/assets/css/style.css');
	} else {
		wp_enqueue_style( 'mytheme-custom', get_template_directory_uri() .'/assets/css/style.min.css', array(), get_option('files_versions'));
	}
}


// Suppor SVG files
function add_file_types_to_uploads($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


// menus
if(function_exists('register_nav_menus')) {
	register_nav_menus( array(
    'footer_pages' => __('Footer pages'),
	));
}
function my_wp_nav_menu_args($args='') {
	$args['container'] = '';
	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );


// change tinymce's paste-as-text functionality
function change_paste_as_text($mceInit, $editor_id) {
	// turn on paste_as_text by default
	// NB this has no effect on the browser's right-click context menu's paste!
	$mceInit['paste_as_text'] = true;
	return $mceInit;
}
add_filter('tiny_mce_before_init', 'change_paste_as_text', 1, 2);


// remove admin login header
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}


// Filter except length to 20 words.
// tn custom excerpt length
// function tn_custom_excerpt_length( $length ) {
// 	return 20;
// }
// add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );
// function new_excerpt_more( $more ) {
//     return '...';
// }
// add_filter('excerpt_more', 'new_excerpt_more');


// // remove editor from custom pages
// add_action( 'admin_init', 'hide_editor' );
// function hide_editor() {
// 	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
// 	if( !isset( $post_id ) ) return;
// 	if( $post_id == '8' || 		// home
// 		$post_id == '536' ||	// gallery
// 		$post_id == '681'	 	// calendar
// 		) {
// 		remove_post_type_support('page', 'editor');
// 	}
// }


/*New selector*/
/*function NEWqtranxf_generateLanguageSelectCode( $args = array(), $id = '' ) {
	global $q_config;
	if ( is_string( $args ) ) {
		$type = $args;
	} elseif ( is_bool( $args ) && $args ) {
		$type = 'image';
	} elseif ( is_array( $args ) ) {
		if ( ! empty( $args['type'] ) ) {
			$type = $args['type'];
		}
		if ( empty( $id ) && ! empty( $args['id'] ) ) {
			$id = $args['id'];
		}
	}
	if ( empty( $type ) ) {
		$type = 'text';
	} else switch ( $type ) {
		case 'text':
		case 'image':
		case 'both':
		case 'short':
		case 'css_only':
		case 'custom':
		case 'dropdown':
			break;
		default:
			$type = 'text';
	}
	if ( empty( $id ) ) {
		$id = 'qtranslate';
	}
	$id .= '-chooser';
	if ( is_404() ) {
		$url = get_option( 'home' );
	} else {
		$url = '';
	}
	$flag_location = qtranxf_flag_location();
	echo PHP_EOL . '<ul class="language-choosers language-chooser-' . $type . ' qtranxs_language_chooser" id="' . $id . '">' . PHP_EOL;
	switch ( $type ) {
		case 'image':
		case 'text':
		case 'css_only':
		case 'dropdown':
			{
				foreach ( qtranxf_getSortedLanguages() as $language ) {
					$alt     = $q_config['language_name'][ $language ] . ' (' . $language . ')';
					$classes = array( 'lang-' . $language );
					if ( $language == $q_config['language'] ) {
						$classes[] = 'active';
					}
					if($language=='ua'){
						echo '<li data-url="'.qtranxf_get_url_for_language($url, $language, false).'" data-value="'.$language.'" class="' . implode( ' ', $classes ) . '">';
					}
					else{
						echo '<li data-url="'.qtranxf_convertURL( $url, $language, false, true ).'" data-value="'.$language.'" class="' . implode( ' ', $classes ) . '">';
					}
					if ( $type == 'image' ) {
						echo '<img src="' . $flag_location . $q_config['flag'][ $language ] . '" alt="' . $alt . '" />';
					}
					echo '<span';
					if ( $type == 'image' || $type == 'css_only' ) {
						echo ' style="display:none"';
					}
					echo '>' . $q_config['language_name'][ $language ] . '</span>';
					//echo '</a></li>' . PHP_EOL;
					echo '</li>' . PHP_EOL;
				}
				//echo '</ul><div class="qtranxs_widget_end"></div>'.PHP_EOL;
				if ( $type == 'dropdown' ) {
					echo '<script type="text/javascript">' . PHP_EOL . '// <![CDATA[' . PHP_EOL;
					echo "var lc = document.getElementById('" . $id . "');" . PHP_EOL;
					echo "var s = document.createElement('select');" . PHP_EOL;
					echo "s.id = 'qtranxs_select_" . $id . "';" . PHP_EOL;
					echo "lc.parentNode.insertBefore(s,lc);" . PHP_EOL;
					// create dropdown fields for each language
					foreach ( qtranxf_getSortedLanguages() as $language ) {
						echo qtranxf_insertDropDownElement( $language, qtranxf_convertURL( $url, $language, false, true ), $id );
					}
					// hide html language chooser text
					echo "s.onchange = function() { document.location.href = this.value;}" . PHP_EOL;
					echo "lc.style.display='none';" . PHP_EOL;
					echo '// ]]>' . PHP_EOL . '</script>' . PHP_EOL;
				}
			}
			break;
		case 'both':
			{
				foreach ( qtranxf_getSortedLanguages() as $language ) {
					$alt = $q_config['language_name'][ $language ] . ' (' . $language . ')';
					echo '<li';
					if ( $language == $q_config['language'] ) {
						echo ' class="active"';
					}
					echo '><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '"';
					echo ' class="qtranxs_flag_' . $language . ' qtranxs_flag_and_text" title="' . $alt . '">';
					//echo '<img src="'.$flag_location.$q_config['flag'][$language].'"></img>';
					echo '<span>' . $q_config['language_name'][ $language ] . '</span></a></li>' . PHP_EOL;
				}
			}
			break;
		case 'short':
			{// undocumented, to be removed
				foreach ( qtranxf_getSortedLanguages() as $language ) {
					$alt = $q_config['language_name'][ $language ] . ' (' . $language . ')';
					echo '<li';
					if ( $language == $q_config['language'] ) {
						echo ' class="active"';
					}
					echo '><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '"';
					echo ' class="qtranxs_short_' . $language . ' qtranxs_short" title="' . $alt . '">';
					echo '<span>' . $language . '</span></a></li>' . PHP_EOL;
				}
			}
			break;
		case 'custom':
			{
				$format = isset( $args['format'] ) ? $args['format'] : '';
				foreach ( qtranxf_getSortedLanguages() as $language ) {
					$alt     = $q_config['language_name'][ $language ] . ' (' . $language . ')';
					$s       = $flag_location . $q_config['flag'][ $language ];
					$n       = $q_config['language_name'][ $language ];
					$content = $format;
					$content = str_replace( '%f', '<img src="' . $s . '" alt="' . $alt . '" />', $content );
					$content = str_replace( '%s', $s, $content );
					$content = str_replace( '%n', $n, $content );
					if ( strpos( $content, '%a' ) !== false ) {
						$a       = qtranxf_getLanguageName( $language );//this is an expensive function, do not call without necessity.
						$content = str_replace( '%a', $a == $n ? '' : $a, $content );
					}
					$content = str_replace( '%c', $language, $content );
					$classes = array( 'language-chooser-item', 'language-chooser-item-' . $language );
					if ( $language == $q_config['language'] ) {
						$classes[] = 'active';
					}
					echo '<li class="' . implode( ' ', $classes ) . '"><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '" title="' . $alt . '">' . $content . '</a></li>' . PHP_EOL;
				}
			}
			break;
	}
	echo '</ul><div class="qtranxs_widget_end"></div>' . PHP_EOL;

?>
<script>
  jQuery('body').on('click', '.language-choosers li', function() {
    jQuery(this).parent().addClass('active');
  });
  jQuery('body').on('click', '.language-choosers.active li', function() {
    var date = new Date();
    date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
    var expires = date.toUTCString();
    var lang = jQuery(this).data('value');
    var new_url = jQuery(this).data('url');
    document.cookie = "qtrans_front_language=" + lang + "; expires= " + expires + "; path=/;";
    if (document.cookie.indexOf('qtrans_front_language=' + lang) != -1) {
      window.location.href = new_url;
    }
  })
</script>
<?php
} */




//
// function load_custom_wp_admin_style() {
// 	wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/admin.css', false, '1.0.0');
// 	wp_enqueue_style( 'custom_wp_admin_css' );
// }
// add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


// function anketa_func(){
// 	$text = array(
// 		't1' => array('uk' => 'ПІБ', 'ru' => 'ФИО', 'en' => 'First Name and Last Name'),
// 		't2' => array('uk' => 'Email', 'ru' => 'Email', 'en' => 'Email'),
// 		't3' => array('uk' => 'Дата народження', 'ru' => 'Дата рождения', 'en' => 'Date of birth'),
// 		't4' => array('uk' => 'Телефон', 'ru' => 'Телефон', 'en' => 'Phone'),
// 		't5' => array('uk' => 'Які заняття відвідуєте у нас в студії?', 'ru' => 'Какие занятия посещаете у нас в студии?', 'en' => 'What classes do you visit at our studio?'),
// 		't6' => array('uk' => 'Cфера діяльності', 'ru' => 'Cфера деятельности', 'en' => 'Area of activity'),
// 		't7' => array('uk' => 'Як знайшли інформацію про нашу студію?', 'ru' => 'Как нашли информацию о нашей студии?', 'en' => 'How to find information about our studio?'),
// 		't8' => array('uk' => 'З якою метою прийшли до нас на заняття?', 'ru' => 'С какой целью пришли к нам на занятие?', 'en' => 'For what purpose did you come to our classes?'),
// 		't9' => array('uk' => 'Чи виправдали заняття ваші очікування? Ваші побажання чи зауваження', 'ru' => 'Оправдали занятия ваши ожидания? Ваши пожелания или замечания', 'en' => 'Did your expectations justify your classes? Your wishes or remarks'),
// 		't10' => array('uk' => 'Відправити', 'ru' => 'Отправить', 'en' => 'Send'),
// 		't11' => array('uk' => 'Дякую! Вас зареєстровано :)', 'ru' => 'Спасибо! Вас зарегистрировано :)', 'en' => 'Thanks! You are registered :)'),
// 		't12' => array('uk' => 'Ваш email вже зареєстровано!', 'ru' => 'Ваш электронный адрес вже зареєстортировано!', 'en' => 'Your email is already registered!'),
// 		't13' => array('uk' => 'Фото', 'ru' => 'Фото', 'en' => 'Photo'),
// 		't14' => array('uk' => 'Заповніть всі обов\'язкові поля', 'ru' => 'Заполните все обязательные поля', 'en' => 'Fill in all required fields'),
// 	);
//   $l='uk';

// 	$html='
// 	<div class="applicate_form">
// 		<form class="applicatedata">
// 			<div class="item">
// 				<label for="pib">'.$text['t1'][$l].'<span style="color:red; font-size:22px;"> *</span></label>
// 				<input class="required" id="pib" type="text" name="pib">
// 			</div>
// 			<div class="holder">
// 				<div class="item">
// 					<label for="email">'.$text['t2'][$l].'<span style="color:red; font-size:22px;"> *</span></label>
// 					<input class="required" id="email" type="text" name="email">
// 				</div>
// 				<div class="item">
// 					<label for="phone">'.$text['t4'][$l].'</label>
// 					<input id="phone" type="text" name="phone">
// 				</div>
// 			</div>
// 			<div class="holder">
// 				<div class="item">
// 					<label for="birthday">'.$text['t3'][$l].'<span style="color:red; font-size:22px;"> *</span></label>
// 					<input class="required" id="birthday" type="date" name="birthday">
// 				</div>
// 				<div class="item">
// 					<label for="photo">'.$text['t13'][$l].'</label>
// 					<input style="display:none;" id="photo" type="text" name="photo">
// 					<div class="ava_img_wrap">
// 						<div class="ava_img">
// 							<img src="https://via.placeholder.com/500/cac3b7/fff.png" alt="upload photo" title="upload photo">
// 						</div>
// 						<div class="ava_form">
// 							<input style="display:none;" type="text" name="support_title" value="'.get_the_time('Y-m-d h:i').'" class="support-title">
// 							<input type="file" accept=".png, .jpg, .jpeg" id="sortpicture" name="upload">
// 						</div>
// 					</div>
// 				</div>
// 			</div>
// 			<div class="item">
// 				<label for="lessons">'.$text['t5'][$l].'</label>
// 				<input id="lessons" type="text" name="lessons">
// 			</div>
// 			<div class="item">
// 				<label for="activity">'.$text['t6'][$l].'</label>
// 				<input id="activity" type="text" name="activity">
// 			</div>
// 			<div class="item">
// 				<label for="aboutus">'.$text['t7'][$l].'</label>
// 				<input id="aboutus" type="text" name="aboutus">
// 			</div>
// 			<div class="item">
// 				<label for="purpose">'.$text['t8'][$l].'</label>
// 				<input id="purpose" type="text" name="purpose">
// 			</div>
// 			<div class="item">
// 				<label for="justified">'.$text['t9'][$l].'</label>
// 				<input id="justified" type="text" name="justified">
// 			</div>
// 			<div class="item">
// 				<input type="submit" class="button" value="'.$text['t10'][$l].'">
// 				<span class="fill-all">('.$text['t14'][$l].')</span>
// 			</div>
// 		</form>
// 	</div>
// 	<div class="applicate_form_msg applicate_form_ok">
// 		<p>'.$text['t11'][$l].'</p>
// 	</div>
// 	<div class="applicate_form_msg applicate_form_ok_2">
// 		<p>'.$text['t12'][$l].'</p>
// 	</div>
// 	';
// 	return $html;
// }
// add_shortcode('anketa', 'anketa_func');

// add_action( 'wp_enqueue_scripts', 'add_studio_scripts' );
// function add_studio_scripts() {
// 	/* include scripts */
// 	wp_enqueue_script( 'studio_form_js', get_template_directory_uri() . '/assets/js/form.js', array ( 'jquery' ), 1.1, true);
// 	global $post;
//     wp_enqueue_media( array(
//         'post' => $post->ID,
//     ) );
// }



// add_action( 'wp_enqueue_scripts', 'editajax_data', 99 );
// function editajax_data(){
// 	wp_localize_script('jquery', 'editajax',
// 		array(
// 			'url' => admin_url('admin-ajax.php'),
// 			'nonce' => wp_create_nonce('editajax-nonce')
// 		)
// 	);
// }
// add_action( 'wp_ajax_nopriv_editajax-submit', 'editajax_submit' );
// add_action( 'wp_ajax_editajax-submit', 'editajax_submit' );



/* add review */
// add_action( 'wp_ajax_nopriv_addajax-submit', 'addajax_submit' );
// add_action( 'wp_ajax_addajax-submit', 'addajax_submit' );

// function addajax_submit(){
// 		// перевірка nonce код
// 		check_ajax_referer( 'editajax-nonce', 'nonce_code' );
// 		if( ! wp_verify_nonce( $_POST['nonce_code'], 'editajax-nonce' ) ) die( 'Stop!');
// 		$pib = wp_strip_all_tags($_POST['data'][0]['pib']);
// 		$email = wp_strip_all_tags($_POST['data'][0]['email']);
// 		$birthday = wp_strip_all_tags($_POST['data'][0]['birthday']);
// 		$phone = wp_strip_all_tags($_POST['data'][0]['phone']);
// 		$photo = wp_strip_all_tags($_POST['data'][0]['photo']);
// 		$lessons = wp_strip_all_tags($_POST['data'][0]['lessons']);
// 		$activity = wp_strip_all_tags($_POST['data'][0]['activity']);
// 		$aboutus = wp_strip_all_tags($_POST['data'][0]['aboutus']);
// 		$purpose = wp_strip_all_tags($_POST['data'][0]['purpose']);
// 		$justified = wp_strip_all_tags($_POST['data'][0]['justified']);


// 	global $wpdb;
// 	$meta_value = $email;
// 	$allmiles = $wpdb->get_var($wpdb->prepare(
// 		"SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_key = 'email' AND meta_value = %s", $meta_value
// 	));
// 	if(!$allmiles){
// 			// обробляємо дані
// 			$post_data = array(
// 				'post_title'    => $pib,
// 				'post_type'    => 'app',
// 				'post_status'    => 'publish',
// 				'meta_input'     => array('email'=>$email, 'birthday'=>$birthday, 'phone'=>$phone, 'photo'=>$photo, 'lessons'=>$lessons, 'activity'=>$activity, 'aboutus'=>$aboutus, 'purpose'=>$purpose, 'justified'=>$justified )
// 			);
// 			// вставка в базу
// 			$post_id = wp_insert_post( $post_data );
// 			if($post_id){
// 				echo '1';
// 				// відправка мейла
// 				send_app_mail($post_id, 'new');
// 			}
// 			else{}
// 	}
// 	else{
// 		echo '2';
// 	}
// 	// Завершуємо PHP
// 	wp_die();
// }

/*
// для очистки cron задачі
add_action("init", "remove_cron_job");
function remove_cron_job() {
 wp_clear_scheduled_hook("send_birth_hook");
}*/

/*CRON перевірка дня народження*/
// if ( ! wp_next_scheduled( 'send_birth_hook' ) ) {
//   wp_schedule_event( strtotime('08:00:00'), 'daily', 'send_birth_hook' );
// }
// add_action( 'send_birth_hook', 'send_birth_mail' );

// function send_birth_mail(){
// 		global $post;
// 		$args = array(
// 			'posts_per_page' => -1,
// 			'post_type' => 'app'
// 		);
// 		$query = new WP_Query( $args );
// 		if ( $query->have_posts() ) {
// 			while ( $query->have_posts() ) {
// 			$query->the_post();
// 				$today = date('m-d');
// 				$birth = strtotime(get_post_meta($post->ID, 'birthday', true));
// 				$birth2 = strtotime(get_post_meta($post->ID, 'birthday', true). ' -7 day');
// 				$newformat = date('m-d',$birth);
// 				$newformat2 = date('m-d',$birth2);
// 				if($today==$newformat){
// 					send_app_mail($post->ID, 'old1');
// 				}
// 				if($today==$newformat2){
// 					send_app_mail($post->ID, 'old2');
// 				}
// 			}
// 		}
// 		wp_reset_postdata();
// }


// // clean js
// add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
// add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
// function codeless_remove_type_attr($tag, $handle) {
//     return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
// }
// remove_action('wp_head', 'print_emoji_detection_script', 7);
// remove_action('wp_print_styles', 'print_emoji_styles');
// add_action('wp_loaded', 'prefix_output_buffer_start');
// function prefix_output_buffer_start() {
//     ob_start("prefix_output_callback");
// }
// add_action('shutdown', 'prefix_output_buffer_end');
// function prefix_output_buffer_end() {
//     ob_end_flush();
// }
// function prefix_output_callback($buffer) {
//     return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
// }


// add_action( 'wp_ajax_md_support_save','md_support_save' );
// add_action( 'wp_ajax_nopriv_md_support_save','md_support_save' );

// function md_support_save(){
//     $support_title = !empty($_POST['supporttitle']) ?
//     $_POST['supporttitle'] : 'Support Title';

//     if (!function_exists('wp_handle_upload')) {
//         require_once(ABSPATH . 'wp-admin/includes/file.php');
//     }
//     // echo $_FILES["upload"]["name"];
//     $uploadedfile = $_FILES['file'];
//     $upload_overrides = array('test_form' => false);
//     $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

//   // echo $movefile['url'];
//     if ($movefile && !isset($movefile['error'])) {
//       echo $movefile['url'];
//   } else {
//     /**
//      * Error generated by _wp_handle_upload()
//      * @see _wp_handle_upload() in wp-admin/includes/file.php
//      */
//     echo $movefile['error'];
//   }
//   die();
// }


// function send_app_mail($post_id, $type){
//   // відправка мейла
//   if(get_option('ml_adminmail')){
//     $to = get_option('ml_adminmail');
//   }
//   else{
//     $to = get_option('admin_email');
//   }
//   if($type=='new'){
//     $subject = 'Поступила нова анкета';
//   }
//   elseif($type=='old1'){
//     $subject = 'Сьогодні день народження в '.get_the_title($post_id);
//   }
//   else{
//     $subject = 'Через 7 днів день народження в '.get_the_title($post_id);
//   }

//   $link = get_option('siteurl');
//   $remove_http = '#^http(s)?://#';
//   $replace     = '';
//   $new_link    = preg_replace( $remove_http, $replace, $link );
//   $from = 'no-replay@'.$new_link;

//   $headers = 'Content-Type: text/html; charset=UTF-8; From: '.get_option('blogname').' <'.$from.'>' . "\r\n";
//   $message = '<table style="width:700px;">
//         <tr>
//           <td colspan="2">
//             ПІБ: <strong>'.get_the_title($post_id).'</strong>
//           </td>
//         </tr>
//         <tr>
//           <td colspan="2">
//             Email: <strong>'.get_post_meta($post_id, 'email', true).'</strong>
//           </td>
//         </tr>
//         <tr>
//           <td colspan="2">
//             День народження: <strong>'.get_post_meta($post_id, 'birthday', true).'</strong>
//           </td>
//         </tr>
//         <tr>
//           <td colspan="2">
//             Телефон: <strong>'.get_post_meta($post_id, 'phone', true).'</strong>
//           </td>
//         </tr>
//       </table>
//       <p>Детальніше про людину: <a href="'.get_option('home').'/wp-admin/post.php?post='.$post_id.'&action=edit">'.get_option('home').'/wp-admin/post.php?post='.$post_id.'&action=edit</a></p>';
//   wp_mail( $to, $subject, $message, $headers);
// }



// remove extra .css from header
// if(!is_admin()) {
//   add_filter( 'style_loader_src', function($href) {
//     $nameFile = 'style.min.css';
//     if (defined('IS_LOCAL') && IS_LOCAL) {
//       $nameFile = 'style.css';
//     }
//     if(strpos($href, $nameFile) !== false) {
//       return $href;
//     }
//     return false;
//   });
// }
