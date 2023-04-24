<div class="step-6 step bg-pattern step-anchor" id="info">
  <div class="row">
    <h2 class="step-title"><?php the_field('info_title'); ?></h2>
  </div>

  <?php if (have_rows('info')) : ?>
    <div class="swiper step-6-swiper">
      <div class="swiper-wrapper">
        <?php while (have_rows('info')) : the_row();
          $title = get_sub_field('info_title');
          $video = substr(get_sub_field('info_video'), strpos(get_sub_field('info_video'), "=") + 1);
        ?>
          <div class="swiper-slide">
            <div class="holder">
              <p class="title"><?php echo $title; ?></p>
              <div class="video">
                <div class="img" data-id="<?php echo $video; ?>">
                  <img src="https://img.youtube.com/vi/<?php echo $video; ?>/hqdefault.jpg" alt="video">
                  <span class="play"></span>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  <?php endif; ?>

</div>