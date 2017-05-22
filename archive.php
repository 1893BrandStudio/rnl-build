<?php get_template_part('partials/header'); ?>
<?php get_template_part('partials/banner'); ?>
<main class="container">
  <h1><?php _e('Posts related to'); ?> <?= get_queried_object()->name; ?></h1>
  <div class="row">
    <div class="col-md-9">
      <?php
        if(have_posts()):
          while(have_posts()):
            the_post();
            get_template_part('partials/content');
          endwhile;
        endif;
      ?>
    </div>
    <aside class="col-md-3">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</main>
<?php get_template_part('partials/footer'); ?>
