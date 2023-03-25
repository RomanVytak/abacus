<div class="step-5 step step-anchor" id="difference">
  <div class="row">
    <h2 class="step-title"><?php langUsage('Чим ми відрізняємось від франшизи?', 'Чем мы отличаемся от франшизы?') ?></h2>

    <?php if (have_rows('difference')) : $i = 0; ?>
      <div class="items">
        <?php while (have_rows('difference')) : the_row();
          $text = get_sub_field('difference_text');
          $i++;
        ?>
          <div class="item">
            <p class="num"><?php echo $i; ?></p>
            <p class="text"><?php echo $text; ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</div>