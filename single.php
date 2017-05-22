<?php get_template_part('partials/header'); ?>
<?php get_template_part('partials/banner'); ?>
<?php get_template_part('partials/hero'); ?>
<main class="container">
  <div class="row">
    <?php $i = 0; ?>
    <?php while(have_posts()): the_post(); ?>
      <?php get_template_part('partials/content', 'single'); ?>
    <?php endwhile; ?>
    <aside class="col-md-3">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</main>
<?php get_template_part('partials/footer'); ?>
