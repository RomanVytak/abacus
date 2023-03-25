<div class="step-1 bg-pattern step" id="home">
  <div class="top-row">
    <div class="row">
      <h1 class="styled-title">
        <?php langUsage('Ментальна арифметика', 'Ментальная арифметика') ?>
        <span class="holder">
          <span class="note"><?php langUsage('відмінно працює в онлайн форматі', 'отлично работает в онлайн формате') ?></span>
        </span>
      </h1>
      <div class="text-wrap">
        <p><?php the_field('home_description'); ?></p>
        <p class="langs"><?php langUsage('Мови нашого порталу: uk, ru, en, pl, ro, cs, es', 'Языки нашего портала: uk, ru, en, pl, ro, cs, es') ?></p>
        <a href="#" class="button form yellow"><?php langUsage('Отримати консультацію', 'Получить консультацию') ?></a>
      </div>
    </div>
  </div>

  <?php if (have_rows('home_offer')) : ?>
    <div class="bottom-row">
      <div class="row">
        <div class="wrap">
          <div class="tip"><?php langUsage('Гаряча пропозиція!', 'Горячее предложение!') ?></div>
          <?php while (have_rows('home_offer')) : the_row();
            $title = get_sub_field('home_offer_title');
            $price = get_sub_field('home_offer_price');
          ?>
            <p><?php echo $title; ?></p>
            <p class="price"><span><?php echo $price; ?></span> грн</p>
            <a href="#" class="button form rose" data-form-title="<?php echo str_replace('"', "'", $title); ?>">
              <?php langUsage('Записатися', 'Записаться') ?>
            </a>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>