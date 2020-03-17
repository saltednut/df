<?php

/**
 * @file
 * Scenarios hooks implemented by the DFS Gol profile.
 */

/**
 * Implements hook_scenarios_info().
 */
function dfs_gol_scenarios_info() {
  return [
    'dfs_gol' => [
      'type' => 'module',
      'label' => t('DFS GOL'),
      'description' => t('Demo Framework Scenario for GOOOOOL.'),
      //'files' => ['/files/images' => 'public://images'],
      //'cdf' => ['/cdf'],
      'imports' => ['/data/content'],
    ],
  ];
}
