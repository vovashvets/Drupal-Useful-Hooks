<?php

/**
 * Implements hook_entity_extra_field_info().
 */
function site_content_entity_extra_field_info() {
  $extra['commerce_order_item']['default']['form']['booking_info'] = [
    'label' => t('Booking info'),
    'weight' => 95,
  ];
  $extra['commerce_order_item']['default']['form']['changeover_days'] = [
    'label' => t('Changeover days'),
  ];

  $bundles = \Drupal\commerce_product\Entity\ProductType::loadMultiple();
  if (isset($bundles['default'])) {
    $extra['commerce_product']['default']['display']['title_location_extra_field'] = [
      'label' => t('Title and location.'),
      'description' => t('Show title and location in the separate field.'),
      'weight' => 100,
      'visible' => TRUE,
    ];
    $extra['commerce_product']['default']['display']['villa_rating_extra_field'] = [
      'label' => t('Villa Rating'),
      'description' => t('Villa Rating'),
      'weight' => 1,
      'visible' => TRUE,
    ];
  }

  return $extra;
}

/**
 * Implements hook_ENTITY_TYPE_view().
 */
function site_content_commerce_product_view(array &$build, EntityInterface $entity, EntityViewDisplayInterface $display, $view_mode) {
  if ($entity->bundle() == 'default') {
    $title = $entity->get('title')->value;
    $destination = '';
    $destination_term_id = $entity->get('field_destination')->getValue();
    if (!empty($destination_term_id) && isset($destination_term_id[0]['target_id'])) {
      $term = Term::load($destination_term_id[0]['target_id']);
      if ($term !== NULL) {
        $child_term_name = $term->getName();
        $destination = $child_term_name;
        $parent_term_id = $term->parent->target_id;
        if ($parent_term_id !== NULL && Term::load($parent_term_id) !== NULL) {
          $destination .= ', ' . Term::load($parent_term_id)->getName();
        }
      }
    }
    $markup = new FormattableMarkup(
      '<div class="title title-location-wrapper"><h2 class="product-title">@title</h2><div class="destination-terms">@destination</div></div>',
      [
        '@title' => $title,
        '@destination' => $destination
      ]
    );
    $build['title_location_extra_field'] = [
      '#type' => 'markup',
      '#markup' => $markup,
    ];

    // Villa rating
    $villa_rating_markup = new FormattableMarkup(
      '<div class="villa-rating-extra-field"><span>@title</span>: <span>@rating</span></div>',
      [
        '@title' => 'Rating',
        '@rating' => '80'
      ]
    );
    $build['villa_rating_extra_field'] = [
      '#type' => 'markup',
      '#markup' => $villa_rating_markup,
    ];
  }
}
