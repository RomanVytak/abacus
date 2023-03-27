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
        <p class="langs"><?php the_field('home_langs'); ?></p>
        <a href="#" class="button form yellow"><?php langUsage('Отримати консультацію', 'Получить консультацию') ?></a>
      </div>
    </div>
  </div>

  <?php if (have_rows('home_offer')) : ?>
    <div class="bottom-row">
      <div class="row">
        <div class="wrap">
          <?php while (have_rows('home_offer')) : the_row();
            $title = get_sub_field('home_offer_title');
            $price = get_sub_field('home_offer_price');
            $tip = get_sub_field('home_offer_tip');
            $button = get_sub_field('home_offer_button');
          ?>
            <div class="tip"><?php echo $tip; ?></div>
            <p><?php echo $title; ?></p>
            <p class="price"><span><?php echo $price; ?></span> грн</p>
            <a href="#" class="button form rose" data-form-title="<?php echo str_replace('"', "'", $title); ?>">
              <?php echo $button; ?>
            </a>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>