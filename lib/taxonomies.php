<?php

class Taxonomy {
  /**
   * Creates a new taxonomy.
   * @param String         $singular Name of taxonomy
   * @param String|Boolean $plural   Optional custom plural value for non-standard pluralizations (e.g. persons -> people, radius -> radii)
   * @param Array          $args     Override default values for custom taxonomy registration arguments
   */
  function __construct($singular, $plural = false, $supports = ['post'], $args = []){
    $this->name         = $singular;
    $this->plural       = $plural ? $plural : $this->name.'s';
    $this->lower        = strtolower($this->name);
    $this->plural_lower = strtolower($this->plural);
    $this->supports     = $supports;

    add_action('init', function(){
      $labels = [
        'name'                       => _x( "$this->plural", 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( "$this->name", 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( "$this->name", 'text_domain' ),
        'all_items'                  => __( "All Items", 'text_domain' ),
        'parent_item'                => __( "Parent $this->name", 'text_domain' ),
        'parent_item_colon'          => __( "Parent $this->name:", 'text_domain' ),
        'new_item_name'              => __( "New $this->name Name", 'text_domain' ),
        'add_new_item'               => __( "Add New $this->name", 'text_domain' ),
        'edit_item'                  => __( "Edit $this->name", 'text_domain' ),
        'update_item'                => __( "Update $this->name", 'text_domain' ),
        'view_item'                  => __( "View $this->name", 'text_domain' ),
        'separate_items_with_commas' => __( "Separate $this->plural_lower with commas", 'text_domain' ),
        'add_or_remove_items'        => __( "Add or remove $this->plural_lower", 'text_domain' ),
        'popular_items'              => __( "Popular $this->plural", 'text_domain' ),
        'search_items'               => __( "Search $this->plural", 'text_domain' ),
        'no_terms'                   => __( "No $this->plural_lower", 'text_domain' ),
        'not_found'                  => __( "No $this->plural_lower found", 'text_domain'),
        'items_list'                 => __( "$this->plural list", 'text_domain' ),
        'items_list_navigation'      => __( "$this->plural list navigation", 'text_domain' ),
      ];
      $default_args = [
        'label'               => $this->name,
        'labels'              => $labels,
        'hierarchical'        => false
      ];
      $merged_args = is_array($args) ? array_merge($default_args, $args) : $default_args;

      register_taxonomy($this->lower, $this->supports, $merged_args);
    });
  }
}

// $sample = new Taxonomy('Region', false, ['person'], [
//   'hierarchical' => false
// ]);
