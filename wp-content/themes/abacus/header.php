<!doctype html>
<html lang="uk">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <meta name="format-detection" content="telephone=no">

  <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico" />

  <link href="https://fonts.googleapis.com/css2?family=Neucha&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

  <?php
  function wp_is_mobile_new()
  {
    if (empty($_SERVER['HTTP_USER_AGENT'])) {
      $is_mobile_new = false;
    } elseif (
      strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
      ||  strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
      ||  strpos($_SERVER['HTTP_USER_AGENT'], 'webOS') !== false
      ||  strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== false
      ||  strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false
      ||  strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== false
      ||  strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
      ||  strpos($_SERVER['HTTP_USER_AGENT'], 'IEMobile') !== false
      ||  strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false
    ) {
      $is_mobile_new = true;
    } else {
      $is_mobile_new = false;
    }
    return apply_filters('wp_is_mobile_new', $is_mobile_new);
  }
  ?>

  <?php wp_head(); ?>
</head>

<?php
// links path
$homePath = get_option('home');
if (is_page_template('page-home.php')) {
  $homePath = '';
}
// lang detection
function langUsage($defaultText, $alternativeText)
{
  if (get_locale() === 'ru_RU') {
    echo $alternativeText;
  } else {
    echo $defaultText;
  }
}
?>

<body class="<?php if (!wp_is_mobile_new()) {
                echo 'full-version';
              } else {
                echo 'mobile-version';
              }
              if (is_404()) {
                echo ' not-found-page';
              } ?>">
  <header class="header">
    <div class="row full">
      <div class="wrap">

        <span class="menu-button">
          <span></span><span></span><span></span>
        </span>

        <a href="<?php echo $homePath; ?>#home" class="logo achor-home">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.svg" alt="<?php langUsage('Ментальна арифметика', 'Ментальная арифметика') ?>" />
        </a>

        <nav class="menu">
          <a class="anchor" href="<?php echo $homePath; ?>#services"><?php langUsage('Послуги та інструменти', 'Услуги и инструменты') ?></a>
          <a class="anchor" href="<?php echo $homePath; ?>#about"><?php langUsage('Про проект', 'О проекте') ?></a>
          <a class="anchor" href="<?php echo $homePath; ?>#difference"><?php langUsage('НЕ франшиза', 'НЕ франшиза') ?></a>
          <a class="anchor" href="<?php echo $homePath; ?>#info"><?php langUsage('Портал', 'Портал') ?></a>
          <a class="anchor" href="<?php echo $homePath; ?>#prices"><?php langUsage('Ціни', 'Цены') ?></a>
          <a class="anchor" href="<?php echo $homePath; ?>#reviews"><?php langUsage('Відгуки', 'Отзывы') ?></a>
        </nav>

        <div class="header-social">
          <?php include('parts/social.php'); ?>
        </div>

        <ul class="lang">
          <?php pll_the_languages(); ?>
        </ul>

      </div>
    </div>
  </header>

  <div class="fixed-social">
    <a href="https://t.me/Abacus_Arithmetic" target="_blank">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/img/social/telegram.png" />
    </a>
    <a href="viber://chat?number=+380680608588" target="_blank">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/img/social/viber.png" />
    </a>
  </div>

  <!-- main wrapper open -->
  <div class="main-wrapper">