<?php get_template_part('partials/header'); ?>
<?php get_template_part('partials/banner'); ?>
<main class="container">
  <div class="alert alert-warning">
    <h2>404. <?php _e('We can\'t find that.'); ?></h2>
    <p><?php _e('The page you were looking for can\'t be found. Try a search?'); ?></p>
    <?php get_template_part('partials/searchform'); ?>
  </div>
</main>
<?php get_template_part('partials/footer'); ?>
