<div class="step-8 step bg-pattern step-anchor" id="reviews">
  <div class="row">
    <h2 class="step-title"><?php the_field('reviews_title'); ?></h2>

    <?php if (have_rows('reviews')) : ?>
      <div class="items">
        <?php while (have_rows('reviews')) : the_row();
          $video = substr(get_sub_field('reviews_video'), strpos(get_sub_field('reviews_video'), "=") + 1);
        ?>
          <div class="item">
            <div class="video">
              <div class="img" data-id="<?php echo $video; ?>">
                <img src="https://img.youtube.com/vi/<?php echo $video; ?>/hqdefault.jpg" alt="video">
                <span class="play"></span>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

  </div>
</div>