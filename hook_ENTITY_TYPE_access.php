<?php

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Implements hook_ENTITY_TYPE_access() for entity type "user".
 *
 * @param \Drupal\user\UserInterface $entity
 *   The user object to check access for.
 *
 * @return
 *   Permission.
 */
function MODULE_user_access(UserInterface $entity, $op, AccountInterface $account) {
  // Disable access to user pages.
  if ($entity->id() == $account->id()) {
    switch ($op) {
      case 'update':
      case 'view':
      case 'user_name':
      case 'user_mail':
      case 'user_pass':
      case 'user_edit':
      case 'user_delete':
        // Example of limiting access to known user pages by role.
        $user_roles = $account->getRoles();
        if (!in_array('super_admin', $user_roles)) {
          return AccessResult::forbidden();
        }
        break;
    }
  }
  // No opinion.
  return AccessResult::neutral();
}

/**
 * Implements hook_ENTITY_TYPE_access() for entity type "node".
 */
function mymodule_node_access(NodeInterface $node, $op, AccountInterface $account) {
  $type = $node->getType();
  if ($type == 'foo' && $op == 'view') {
    if(strstr($account->getEmail(), '@example.com')) {
        return AccessResult::allowed();
    }
    else {
      return  AccessResult::forbidden();
    }
  }
  return AccessResult::neutral();
}
