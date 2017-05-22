<header class="banner">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-menu" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= home_url('/'); ?>"><?php bloginfo('name'); ?></a>
      </div>
      <div class="collapse navbar-collapse" id="header-menu">
        <?php wp_nav_menu( [
          'theme_location' => 'primary',
          'menu_class' => 'nav navbar-nav',
          'depth' => 1,
          'walker' => new WP_Bootstrap_Navwalker()
        ] ); ?>
        <div class="navbar-form navbar-right">
          <?php get_template_part( 'partials/searchform' ); ?>
        </div>
      </div>
    </div>
  </nav>
</header>
