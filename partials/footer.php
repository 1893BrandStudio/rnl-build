    <footer class="footer">
      <div class="container">
        <?php wp_nav_menu( [
          'theme_location' => 'footer',
          'menu_class'     => 'nav footer-nav',
          'depth'          => 0
        ] ); ?>
        <div class="footer-bottom">
          <small class="footer-copyright">&copy; <?= date('Y'); ?></small>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
