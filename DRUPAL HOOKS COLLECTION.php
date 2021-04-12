<?php

/**
 * Implements hook_entity_insert().
 * 
 * Запускається коли ентіті було збережено.
 */
function hook_entity_insert(Drupal\Core\Entity\EntityInterface $entity) {

}

/**
 * Implements hook_preprocess_HOOK().
 */
function MODULENAME_preprocess_TEMPLATENAME(&$variables) {
  
}

/**
 * Implements hook_form_FORM_ID_alter
 */
function MODULENAME_form_FORMID_alter(&$form, &$form_state) {

}

/**
 * Entity API Hooks
 * В порядку їх спрацювання
 */
1) hook_entity_preload
2) hook_ENTITY_TYPE_storage_load
3) hook_ENTITY_TYPE_load
4) hook_ENTITY_TYPE_access
5) hook_entity_view_mode_alter
6) hook_entity_view_mode_info_alter
7) hook_entity_view_display_alter
8) hook_entity_prepare_view
9) hook_entity_display_build_alter
10) hook_node_view
11) hook_entity_view_alter