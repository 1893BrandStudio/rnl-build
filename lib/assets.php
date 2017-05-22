<?php

add_action('wp_enqueue_scripts', function(){
  $scripts_path = get_stylesheet_directory_uri() . '/dist/js/';
  $styles_path  = get_stylesheet_directory_uri() . '/dist/css/';

  wp_enqueue_script( 'bootstrap/js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', ['jquery'], false, true );

  wp_enqueue_script('main/js', "${scripts_path}main.js", ['jquery'], false, true);
  wp_enqueue_style('main/css', "${styles_path}main.css", [], false, 'all');


});
