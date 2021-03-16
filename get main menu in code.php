<?php
/**
 * @file
 * Contains \Drupal\YOUR_MODULE\Plugin\Block\SectionsFooter.
 */

namespace Drupal\YOUR_MODULE\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;

/**
 * Provides a 'SectionsFooter' block.
 *
 * @Block(
 *   id = "sections_footer",
 *   admin_label = @Translation("Sections"),
 *   category = @Translation("YOUR_MODULE")
 * )
 */
class SectionsFooter extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $menu_name = 'main';
    $menu_tree = \Drupal::menuTree();
    $parameters = $menu_tree->getCurrentRouteMenuTreeParameters($menu_name);
    $parameters->setMinDepth(0);
    //Delete comments to have only enabled links
    //$parameters->onlyEnabledLinks();

    $tree = $menu_tree->load($menu_name, $parameters);
    $manipulators = array(
      array('callable' => 'menu.default_tree_manipulators:checkAccess'),
      array('callable' => 'menu.default_tree_manipulators:generateIndexAndSort'),
    );
    $tree = $menu_tree->transform($tree, $manipulators);
    $list = [];

    foreach ($tree as $item) {
      $title = $item->link->getTitle();
      $url = $item->link->getUrlObject();
      $list[] = Link::fromTextAndUrl($title, $url);
    }

    $output['sections'] = array(
    '#theme' => 'item_list',
    '#items' => $list,
    );
    return $output;
  }
}
