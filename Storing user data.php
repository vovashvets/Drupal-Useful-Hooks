<?php

//The interface has 3 methods or handling data: get(), set(), delete().
// So as you can see, we have 4 arguments:
// The module name we want this piece of data to be findable by
// The user ID
// The name of the piece of data
// The value of the piece of data
$userData = \Drupal::service('user.data');

$userData->set('my_module', 1, 'my_preference', 'this is my preference');

$data = $userData->get('my_module', 1, 'my_preference');

$userData->delete('my_module', 1, 'my_preference');
