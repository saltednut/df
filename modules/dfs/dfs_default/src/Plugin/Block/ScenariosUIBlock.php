<?php

namespace Drupal\dfs_default\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'ScenariosUIBlock' block.
 *
 * @Block(
 *  id = "scenarios_uiblock",
 *  admin_label = @Translation("Scenarios UI Block"),
 *  category = @Translation("Scenarios")
 * )
 */
class ScenariosUIBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockAccess(AccountInterface $account) {
    if ($account->hasPermission('view scenarios block')) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\scenarios_ui\Form\ScenariosUIForm');
    $form['#attached']['library'][] = 'dfs_default/default';
    $form['submit']['#value'] = $this->t('Install Demo');
    $account = \Drupal::currentUser();
    if (!$account->hasPermission('administer scenarios')) {
      unset($form['submit']);
    }
    return $form;
  }

}
