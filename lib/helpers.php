<?php

/**
 * Returns author first and last name. Must be used in Loop.
 * @return string
 */
function get_author_full_name(){
  $fname = get_the_author_meta('first_name');
  $lname = get_the_author_meta('last_name');
  return trim("$fname $lname");
}
