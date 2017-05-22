<?php

class Type {
  /**
   * Creates a new custom post type.
   * @param String         $singular Name of post type
   * @param String|Boolean $plural   Optional custom plural value for non-standard pluralizations (e.g. persons -> people, radius -> radii)
   * @param Array          $args     Override default values for custom post type registration arguments
   */
  function __construct($singular, $plural = false, $args = []){
    $this->name         = $singular;
    $this->plural       = $plural ? $plural : $this->name.'s';
    $this->lower        = strtolower($this->name);
    $this->plural_lower = strtolower($this->plural);

    add_action('init', function(){
      $labels = [
        'name'                  => _x("$this->plural", 'text_domain'),
        'singular_name'         => _x("$this->name", 'text_domain'),
        'name_admin_bar'        => __("$this->name", 'text_domain'),
        'archives'              => __("$this->name Archives'", 'text_domain'),
        'all_items'             => __("All $this->plural", 'text_domain'),
        'add_new'               => __("Add $this->name", 'text_domain'),
        'new_item'              => __("New $this->name", 'text_domain'),
        'edit_item'             => __("Edit $this->name", 'text_domain'),
        'update_item'           => __("Update $this->name", 'text_domain'),
        'view_item'             => __("View $this->name", 'text_domain'),
        'search_items'          => __("Search $this->name", 'text_domain'),
        'insert_into_item'      => __("Insert into $this->lower", 'text_domain'),
        'uploaded_to_this_item' => __("Uploaded to this $this->lower", 'text_domain'),
        'items_list'            => __("$this->plural list", 'text_domain'),
        'items_list_navigation' => __("$this->plural list navigation", 'text_domain'),
        'not_found'             => __("No $this->plural_lower found", 'text_domain'),
        'filter_items_list'     => __("Filter '.$this->plural_lower.' list", 'text_domain')
      ];
      $default_args = [
        'label'               => $this->name,
        'labels'              => $labels,
        'supports'            => $this->supports,
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => $this->plural_lower,
        'rewrite'             => [ 'slug' => $this->plural_lower ]
      ];
      $merged_args = is_array($args) ? array_merge($default_args, $args) : $default_args;

      register_post_type($this->lower, $merged_args);
    });
  }
}

// $simple_cpt = new Type('Thing');
// $advanced_cpt = new Type('Person', 'People', [
//    'supports' => 'title',
//    'public'   => 'false'
// ]);
