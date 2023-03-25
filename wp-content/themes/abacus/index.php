<?php get_header();?>
<div class="content-wrap single-post">
  <?php while(have_posts()) : the_post(); ?>
  <div class="row">
    <div class="editor-text full">
      <h1 class="single-title"><?php the_title();?></h1>
      <div class="single-content">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
</div>
<?php get_footer();?>