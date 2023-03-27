<div class="step-3 step">
  <div class="row">
    <div class="text">
      <h2 class="styled-title"><?php the_field('about_title'); ?></h2>
      <h4><?php the_field('about_undertitle'); ?></h4>
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