<?php

namespace Drupal\df_tools_user\Plugin\Block;

use Drupal\user\Entity\User;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormBuilder;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the "User Dropdown" block.
 *
 * @Block(
 *   id = "user_dropdown",
 *   admin_label = @Translation("User Dropdown"),
 *   category = @Translation("Menus")
 * )
 */
class UserDropdownBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilder
   */
  protected $formBuilder;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $user;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilder $form_builder, AccountProxyInterface $user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
    $this->user = $user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder'),
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Get the user login form.
    $form = $this->formBuilder->getForm('\Drupal\user\Form\UserLoginForm');

    // Remove default form descriptions.
    unset($form['name']['#description']);
    unset($form['name']['#attributes']['aria-describedby']);
    unset($form['pass']['#description']);
    unset($form['pass']['#attributes']['aria-describedby']);

    $user_page_url = Url::fromRoute('user.page')->toString();
    $user_logout_url = Url::fromRoute('user.logout')->toString();

    $current_user = \Drupal::currentUser();

    return [
      '#theme' => 'user_dropdown',
      '#form' => $form,
      '#user_page_url' => $user_page_url,
      '#user_logout_url' => $user_logout_url,
      '#attached' => [
        'library' => [
          'df_tools_user/user-dropdown',
        ],
      ],
      '#cache' => [
        'context' => ['user'],
        'tags' => User::load($current_user->id())->getCacheTags(),
      ],
    ];
  }
}
