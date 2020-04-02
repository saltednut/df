<?php

/**
 * @file
 * Scenarios hooks implemented by the DF Tools User Demo.
 */

/**
 * Implements hook_scenarios_info().
 */
function df_tools_user_demo_scenarios_info() {
  return [
    'df_tools_user_demo' => [
      'type' => 'module',
      'label' => t('DF Tools User Demo'),
      'description' => t('Demo Framework Scenario Generic Users'),
      //'cdf' => ['/cdf'],
      'imports' => ['/data'],
    ],
  ];
}
