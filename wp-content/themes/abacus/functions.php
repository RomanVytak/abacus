<?php
//
add_theme_support('post-thumbnails');

// include theme settings
require_once(TEMPLATEPATH . '/fields.php');

// fe styles
add_action('wp_enqueue_scripts', 'custome_theme_style', 11);
function custome_theme_style()
{
  if (defined('IS_LOCAL') && IS_LOCAL) {
    wp_enqueue_style('mytheme-custom', get_template_directory_uri() . '/assets/css/style.css');
  } else {
    wp_enqueue_style('mytheme-custom', get_template_directory_uri() . '/assets/css/style.min.css', array(), get_option('files_versions'));
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
if (function_exists('register_nav_menus')) {
  register_nav_menus(array(
    'footer_pages' => __('Footer pages'),
  ));
}
function my_wp_nav_menu_args($args = '')
{
  $args['container'] = '';
  return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');

// change tinymce's paste-as-text functionality
function change_paste_as_text($mceInit, $editor_id)
{
  // turn on paste_as_text by default
  // NB this has no effect on the browser's right-click context menu's paste!
  $mceInit['paste_as_text'] = true;
  return $mceInit;
}
add_filter('tiny_mce_before_init', 'change_paste_as_text', 1, 2);

// remove admin login header
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header()
{
  remove_action('wp_head', '_admin_bar_bump_cb');
}

// remove Gutenberg Block Library CSS
add_action('wp_enqueue_scripts', 'remove_block_css', 100);
function remove_block_css()
{
  wp_dequeue_style('wp-block-library'); // WordPress core
  wp_dequeue_style('wp-block-library-theme'); // WordPress core
  wp_dequeue_style('wc-block-style'); // WooCommerce
  wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
}

// add GA ID in Settings -> Common
add_filter('admin_init', function () {
  add_settings_field(
    'ga_measurement_id',
    'Google Analytics ID',
    function () {
      $value = get_option('ga_measurement_id', '');
      echo '<input type="text" name="ga_measurement_id" value="' . esc_attr($value) . '" class="regular-text" placeholder="G-XXXXXXX">';
    },
    'general'
  );
  register_setting('general', 'ga_measurement_id', [
    'type' => 'string',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => '',
  ]);
});

// add GA in <head>, if ID exist
add_action('wp_head', function () {
  $ga_id = get_option('ga_measurement_id');
  if (!$ga_id) return;
?>
  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', '<?php echo esc_js($ga_id); ?>');
  </script>
  <!-- End Google Analytics -->
<?php
});
