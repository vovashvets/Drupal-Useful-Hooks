<?php


function NAME_user_access_user_access(UserInterface $entity, $op, AccountInterface $account) {

  // Disable access to user pages.
  if ($entity->id() == $account->id()) {
    switch ($op) {
      case 'update':

        $current_route = \Drupal::routeMatch()->getRouteName();

        if ($account->hasPermission('edit own')) {
          return AccessResult::allowed();
        } else {
          if (in_array($current_route, ['user.reset', 'user.reset.login', 'change_pwd_page.reset', 'change_pwd_page.change_password_form'])) {
            return AccessResult::allowed();
          } else {
           return AccessResult::forbidden();
         }
        }

      case 'view':
        if($account->hasPermission('view own')) {
          return AccessResult::allowed();
        } else {
          return AccessResult::forbidden();
        }
    }
  }

  return AccessResult::neutral();
}
