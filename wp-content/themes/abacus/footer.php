<div class="form-popup">
  <div class="wrap">
    <span class="close"></span>
    <h4><?php langUsage('Консультація', 'Консультация') ?></h4>
    <?php if (get_locale() === 'ru_RU') {
      echo do_shortcode('[contact-form-7 id="92ed5bc" title="Заказать услугу (рус)"]');
    } else {
      echo do_shortcode('[contact-form-7 id="9e2c10e" title="Замовити послугу (укр)"]');
    } ?>
  </div>
</div>

<footer>
  <div class="row">
    <div class="wrap">

      <div class="logo-wrap">
        <div class="logo">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.svg" alt="<?php langUsage('Ментальна арифметика', 'Ментальная арифметика') ?>">
        </div>
      </div>

      <div class="pages">
        <?php wp_nav_menu('menu_footer'); ?>
      </div>

      <div class="contants">
        <div class="holder">
          <div class="tel">
            <div class="ico"></div>
            <a href="tel:+380680608588">+38068-060-85-88</a>
          </div>
          <div class="mail">
            <div class="ico"></div>
            <a href="mailto:abacusarithmetic1@gmail.com">abacusarithmetic1@gmail.com</a>
          </div>
          <div class="site">
            <div class="ico"></div>
            <span>портал</span>
            <a href="https://school.abacusarithmetic.com/" target="_blank">school.abacusarithmetic.com</a>
          </div>
        </div>
      </div>

      <div class="social">
        <p><?php langUsage('Актуальні відгуки та статті про нас ви можете знайти на', 'Актуальные отзывы и статьи о нас вы можете найти на') ?>:</p>
        <?php include('parts/social.php');?>
      </div>

    </div>

    <div class="fop">
      <p><?php echo get_option('copy_text'); ?></p>
    </div>

  </div>
</footer>

<!-- main wrapper close -->
</div>

<script src="<?php bloginfo('stylesheet_directory'); ?>/assets/js/main.js?ver<?php echo get_option('files_versions'); ?>"></script>
<?php wp_footer(); ?>
</body>

</html>