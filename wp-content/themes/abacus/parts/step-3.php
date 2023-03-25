<div class="step-3 step">
  <div class="row">
    <div class="text">
      <p><?php langUsage('Що таке', 'Что такое') ?></p>
      <h2 class="styled-title"><?php langUsage('«Ментальна арифметика»?', '«Ментальная арифметика»?') ?></h2>
      <h4><?php langUsage('Ця методика призначена для розвитку', 'Эта методика предназначена для развития') ?>:</h4>
    </div>

    <?php if (have_rows('about')) : ?>
      <div class="lists">
        <ul>
          <?php while (have_rows('about')) : the_row();
            $text = get_sub_field('about_text');
          ?>
            <li><?php echo $text; ?></li>
          <?php endwhile; ?>
        </ul>
      </div>
    <?php endif; ?>

  </div>
</div>