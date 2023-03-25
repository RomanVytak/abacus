<?php
function additional_mime_types($mimes)
{
  $mimes['rar'] = 'application/x-rar-compressed';
  $mimes['swf'] = 'application/x-shockwave-flash';
  return $mimes;
}
add_filter('upload_mimes', 'additional_mime_types');
// Створити користувацьке меню
add_action('admin_menu', 'omr_create_menu');
function omr_create_menu()
{
  //Створити нове меню верхнього рівня
  add_menu_page(
    'Additions',
    'Additions',
    'administrator',
    __FILE__,
    'omr_settings_page',
    '' . get_bloginfo('stylesheet_directory') . '/fields.svg'
  );

  //виклик функції register settings
  add_action('admin_init', 'register_mysettings');
}

function register_mysettings()
{
  register_setting('omr-settings-group', 'files_versions');
  register_setting('omr-settings-group', 'copy_text');
}
function omr_settings_page()
{
?>
  <div class="wrap">
    <form method="post" action="options.php">
      <?php settings_fields('omr-settings-group'); ?>
      <br>

      <input style="width:100px;" type="submit" class="button-primary" value="Save" />

      <br>
      <br>

      <label for="files_versions">Files version:</label>
      <br>
      <input style="width:120px;" id="files_versions" type="text" name="files_versions" value="<?php echo get_option('files_versions'); ?>" placeholder="0001" />

      <br>
      <br>

      <label for="copy_text">Footer copy text:</label>
      <br>
      <input style="width:380px;" id="copy_text" type="text" name="copy_text" value="<?php echo get_option('copy_text'); ?>" placeholder="© 2018-2023..." />

      <br>
      <br>

    </form>
  </div>
<?php } ?>