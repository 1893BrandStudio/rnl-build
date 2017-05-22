<?php
add_action( 'widgets_init', function(){
  register_sidebar( [
    'name' => 'Sidebar',
    'id' => 'sidebar',
    'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
  ] );
} );
