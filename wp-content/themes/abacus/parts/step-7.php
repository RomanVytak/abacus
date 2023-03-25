<div class="step-7 step step-anchor" id="prices">
  <div class="row">
    <h2 class="step-title"><?php langUsage('Ціни', 'Цены') ?></h2>

    <table>
      <thead>

        <tr>
          <td></td>
          <td>
            <?php langUsage('Пакет', 'Пакет') ?>
            <span class="name"><?php langUsage('"Тільки Портал"', '"Только Портал"') ?></span>
            <span class="price"><span>1990</span>грн</span>
          </td>
          <td>
            <?php langUsage('Пакет', 'Пакет') ?>
            <span class="name"><?php langUsage('"Матеріали + Портал"', '"Материалы + Портал"') ?></span>
            <span class="price"><span>5490</span>грн</span>
          </td>
          <td>
            <?php langUsage('Пакет', 'Пакет') ?>
            <span class="name"><?php langUsage('"Навчання викладача"', '"Обучение преподавателя"') ?><span><?php langUsage('в індивідуальному форматі', 'в индивидуальном формате') ?></span></span>
            <span class="price"><span>2990</span>грн</span>
          </td>
          <td>
            <?php langUsage('Пакет', 'Пакет') ?>
            <span class="name"><?php langUsage('"Старт з "0"', '"Старт c "0"') ?></span>
            <span class="price"><span>7990</span>грн</span>
          </td>
          <td>
            <?php langUsage('Пакет', 'Пакет') ?>
            <span class="name"><?php langUsage('"Консульта-ція"', '"Консульта-ция"') ?> ***</span>
            <span class="price"><span>390</span>грн</span>
          </td>
          <td>
            <?php langUsage('Пакет', 'Пакет') ?>
            <span class="name"><?php langUsage('"Навчання викладача"', '"Обучение преподавателя"') ?><span><?php langUsage('в груповому форматі', 'в групповом формате') ?></span></span>
            <span class="price"><span>1490</span>грн</span>
          </td>
        </tr>

      </thead>
      <tbody>

        <?php if (have_rows('prices_desktop')) : ?>
          <?php while (have_rows('prices_desktop')) : the_row();
            $title = get_sub_field('prices_desktop_text');
          ?>
            <tr>
              <td class="item">
                <span><?php echo $title; ?></span>
              </td>

              <?php if (have_rows('prices_desktop_options')) : ?>
                <?php while (have_rows('prices_desktop_options')) : the_row();
                  $icon = get_sub_field('prices_desktop_options_icon');
                  $text = get_sub_field('prices_desktop_options_text');
                ?>
                  <td>
                    <?php
                    if ($text) {
                      echo '<span class="text">' . $text . '</span>';
                    } else if ($icon === 'plus') {
                      echo '<span class="plus"></span>';
                    } else if ($icon === 'minus') {
                      echo '<span class="minus"></span>';
                    }
                    ?>
                  </td>
                <?php endwhile; ?>
              <?php endif; ?>

            </tr>
          <?php endwhile; ?>
        <?php endif; ?>

      </tbody>
    </table>

    <?php if (have_rows('prices_mob')) : ?>
      <div class="mobile-table">
        <?php while (have_rows('prices_mob')) : the_row();
          $title = get_sub_field('prices_mob_title');
          $text = get_sub_field('prices_mob_text');
          $price = get_sub_field('prices_mob_price');
        ?>
          <div class="item">
            <h4><?php echo $title; ?></h4>
            <div class="text-wrap"><?php echo $text; ?></div>
            <div class="bottom">
              <p class="price"><span><?php echo $price; ?></span> грн</p>
              <a href="#" class="button form rose" data-form-title="<?php echo langUsage('Записатися на ', 'Записаться на ') . str_replace('"', "'", $title); ?>"><?php langUsage('Записатися на курс', 'Записаться на курс') ?></a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

    <?php if (have_rows('price_notes')) : ?>
      <div class="notes">
        <?php while (have_rows('price_notes')) : the_row();
          $title = get_sub_field('price_note');
        ?>
          <p><?php echo $title; ?></p>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

    <div class="button-wrap">
      <a href="" class="button form rose has-package"><?php langUsage('Замовити послугу', 'Заказать услугу') ?></a>
    </div>
  </div>
</div>