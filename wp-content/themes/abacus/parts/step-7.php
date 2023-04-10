<div class="step-7 step step-anchor" id="prices">
  <div class="row">
    <h2 class="step-title"><?php the_field('prices_title'); ?></h2>
  </div>

  <div class="row full">
    <table>
      <thead>

        <tr>
          <td></td>

          <?php if (have_rows('packages_list')) : ?>
            <?php while (have_rows('packages_list')) : the_row();
              $title = get_sub_field('package_title');
              $undertitle = get_sub_field('package_undertitle');
              $price = get_sub_field('package_price');
            ?>
              <td>
                <?php langUsage('Пакет', 'Пакет') ?>
                <span class="name">
                  <?php echo $title; ?>
                  <span><?php echo $undertitle; ?></span>
                </span>
                <span class="price"><span><?php echo $price; ?></span>грн</span>
              </td>
            <?php endwhile; ?>
          <?php endif; ?>

        </tr>

      </thead>
      <tbody>

        <?php if (have_rows('prices_desktop')) : ?>
          <?php while (have_rows('prices_desktop')) : the_row();
            $title = get_sub_field('prices_desktop_text');
          ?>
            <tr>
              <td class="item">
                <?php echo $title; ?>
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
  </div>

  <div class="row">
    <?php if (have_rows('prices_mob')) : ?>
      <div class="mobile-table">
        <?php while (have_rows('prices_mob')) : the_row();
          $title = get_sub_field('prices_mob_title');
          $text = get_sub_field('prices_mob_text');
          $price = get_sub_field('prices_mob_price');
          $button = get_sub_field('prices_mob_button');
        ?>
          <div class="item">
            <h4><?php echo $title; ?></h4>
            <div class="text-wrap"><?php echo $text; ?></div>
            <div class="bottom">
              <p class="price"><span><?php echo $price; ?></span> грн</p>
              <a href="#" class="button form rose" data-form-title="<?php echo $button . str_replace('"', "'", $title); ?>"><?php echo $button; ?></a>
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
      <a href="" class="button form rose has-package"><?php the_field('prices_button'); ?></a>
    </div>
  </div>
</div>
</div>