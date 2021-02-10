<?php

// Як додати мета тег для певного раута
function hook_preprocess_html(&$variables) {

  $route_name = \Drupal::routeMatch()->getRouteName();

  if ($route_name == 'page_manager.page_view_index_index-panels_variant-0') {
    $google_site_verification = [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'google-site-verification',
        'content' => 'f549Pnpc8AbqTSZ8K2K31xJpYegvWHbKBZkdB7UlD3M',
      ],
    ];

    $variables['page']['#attached']['html_head'][] = [$google_site_verification, 'google-site-verification'];
  }
}
