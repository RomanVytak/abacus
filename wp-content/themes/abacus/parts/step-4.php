<div class="step-4 step bg-pattern step-anchor" id="about">
  <div class="row">
    <div class="wrap">
      <h2 class="step-title"><?php the_field('project_title'); ?></h2>
      <div class="text-wrap"><?php the_field('project_text'); ?></div>

      <?php if (have_rows('project_items')) : ?>
        <div class="items">
          <?php while (have_rows('project_items')) : the_row();
            $title = get_sub_field('project_items_title');
            $text = get_sub_field('project_items_text');
          ?>
            <div class="item">
              <h4><?php echo $title; ?></h4>
              <div class="editor"><?php echo $text; ?></div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>