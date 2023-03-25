<div class="step-2 step bg-pattern step-anchor" id="services">
  <div class="row">
    <h2 class="step-title"><?php langUsage('Послуги та інструменти', 'Услуги и инструменты') ?></h2>

    <?php if (have_rows('services')) : ?>
      <div class="items">
        <?php while (have_rows('services')) : the_row();
          $title = get_sub_field('service_title');
          $text = get_sub_field('service_text');
          $button = get_sub_field('service_button');
        ?>
          <div class="item">
            <div class="content">
              <div class="text">
                <h3><?php echo $title; ?></h3>
                <div class="editor"><?php echo $text; ?></div>
              </div>
              <a href="#" class="button form rose"><?php echo $button; ?></a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</div>