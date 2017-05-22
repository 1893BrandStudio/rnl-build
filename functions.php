<?php

// This file will run code from any file in /lib.
// This file should never be modified.

$lib   = get_stylesheet_directory();
$files = glob($lib . '/lib/**/*.php');

foreach($files as $file) require_once($file);
