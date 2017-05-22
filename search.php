<?php get_template_part('partials/header'); ?>
<?php get_template_part('partials/banner'); ?>
<main class="container">
  <h1>You searched for: &ldquo;<?= $_GET['s']; ?>&rdquo;</h1>
  <div class="row">
    <section class="col-md-9">
      <?php if( have_posts() ){
        while( have_posts() ){
          the_post();
      ?>
        <article class="item item--search">
          <?php get_template_part('partials/item'); ?>
        </article>
      <?php
        }
      } ?>
    </section>
    <aside class="col-md-3">
      <?php get_sidebar(); ?>
    </aside>
  </div>
</main>
<?php get_template_part('partials/footer'); ?>
