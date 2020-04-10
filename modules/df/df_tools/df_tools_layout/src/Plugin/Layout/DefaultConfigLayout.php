<?php

namespace Drupal\df_tools_layout\Plugin\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\Plugin\PluginFormInterface;

class DefaultConfigLayout extends LayoutDefault implements PluginFormInterface {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'gap' => 'gap-md',
      'full_width' => FALSE,
      'class' => '',
    ];
  }

  public function build(array $regions) {
    $build = parent::build($regions);
    if (!empty($this->configuration['class'])) {
      $build['#attributes']['class'][] = $this->configuration['class'];
    }
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['gap'] = [
      '#type' => 'select',
      '#title' => $this->t('Space between rows'),
      '#options' => [
        'gap-0' => $this->t('Zero'),
        'gap-sm' => $this->t('Small'),
        'gap-md' => $this->t('Medium'),
        'gap-lg' => $this->t('Large'),
        'gap-xl' => $this->t('X-Large'),
      ],
      '#default_value' => $this->configuration['gap'],
    ];

    $form['full_width'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Full width'),
      '#default_value' => $this->configuration['full_width'],
    ];

    $form['class'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Extra Classes'),
      '#default_value' => $this->configuration['class'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    $class = $form_state->getValue('class');
    if (!preg_match("/^[a-zA-Z0-9- _]*$/", $class)) {
      $form_state->setErrorByName('class', $this->t('The class you have provided is invalid.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['gap'] = $form_state->getValue('gap');
    $this->configuration['full_width'] = $form_state->getValue('full_width');
    $this->configuration['class'] = $form_state->getValue('class');
  }

}
