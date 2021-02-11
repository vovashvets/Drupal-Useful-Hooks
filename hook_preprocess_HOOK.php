<?php

/**
 * Implements hook_preprocess_HOOK().
 */
function MODULENAME_preprocess_TEMPLATENAME(&$variables) {
  unset($variables['links']['it'], $variables['links']['fr']);
}
