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

// --- add GTM ID in Settings -> Common
add_filter('admin_init', function () {
  add_settings_field(
    'ga_measurement_id',
    'Google Tag Manager ID',
    function () {
      $value = get_option('ga_measurement_id', '');
      echo '<input type="text" name="ga_measurement_id" value="' . esc_attr($value) . '" class="regular-text" placeholder="GTM-XXXXXXX">';
    },
    'general'
  );
  register_setting('general', 'ga_measurement_id', [
    'type' => 'string',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => '',
  ]);
});

// --- add GTM in <head>
add_action('wp_head', function () {
  $id = get_option('ga_measurement_id');
  if (!$id || strpos($id, 'GTM-') !== 0) return;
?>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', '<?php echo esc_js($id); ?>');
  </script>
  <!-- End Google Tag Manager -->
<?php
}, 0);

// --- add <noscript> in <body>
add_action('wp_footer', function () {
  $id = get_option('ga_measurement_id');
  if (!$id || strpos($id, 'GTM-') !== 0) return;
?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($id); ?>"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
<?php
}, 0);

// --- Додаємо Meta Pixel ID в Settings -> General
add_filter('admin_init', function () {
  add_settings_field(
    'fb_pixel_id',
    'Meta Pixel ID',
    function () {
      $value = get_option('fb_pixel_id', '');
      echo '<input type="text" name="fb_pixel_id" value="' . esc_attr($value) . '" class="regular-text" placeholder="123456789012345">';
    },
    'general'
  );
  register_setting('general', 'fb_pixel_id', [
    'type' => 'string',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => '',
  ]);
});

// --- Виводимо Meta Pixel у <head>
add_action('wp_head', function () {
  $id = get_option('fb_pixel_id');
  if (!$id || !ctype_digit($id)) return;
?>
  <!-- Meta Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo esc_js($id); ?>');
    fbq('track', 'PageView');
  </script>
  <!-- End Meta Pixel Code -->
<?php
}, 0);

// --- <noscript> блок у <body> (wp_footer)
add_action('wp_footer', function () {
  $id = get_option('fb_pixel_id');
  if (!$id || !ctype_digit($id)) return;
?>
  <!-- Meta Pixel (noscript) -->
  <noscript>
    <img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=<?php echo esc_attr($id); ?>&ev=PageView&noscript=1" />
  </noscript>
  <!-- End Meta Pixel -->
<?php
}, 0);






// --- add Meta Pixel ID in Settings -> General
add_filter('admin_init', function () {
  add_settings_field(
    'fb_pixel_id',
    'Meta Pixel ID',
    function () {
      $value = get_option('fb_pixel_id', '');
      echo '<input type="text" name="fb_pixel_id" value="' . esc_attr($value) . '" class="regular-text" placeholder="1107742024573536">';
    },
    'general'
  );
  register_setting('general', 'fb_pixel_id', [
    'type' => 'string',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => '',
  ]);
});

// --- add Meta Pixel у <head>
add_action('wp_head', function () {
  $id = get_option('fb_pixel_id');
  if (!$id || !ctype_digit($id)) return;
?>
  <!-- Meta Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo esc_js($id); ?>');
    fbq('track', 'PageView');
  </script>
  <!-- End Meta Pixel Code -->
<?php
}, 0);

// add <noscript> in <body> (wp_footer)
add_action('wp_footer', function () {
  $id = get_option('fb_pixel_id');
  if (!$id || !ctype_digit($id)) return;
?>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=<?php echo esc_attr($id); ?>&ev=PageView&noscript=1" /></noscript>
<?php
}, 0);
