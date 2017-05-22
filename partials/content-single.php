<article <?php post_class('col-md-9'); ?>>
  <div class="post-meta">
    <div class="post-author"><?= get_author_full_name(); ?></div>
    <div class="post-date"><?php the_date(); ?></div>
  </div>
  <?php the_content(); ?>
</article>
