<?php
/**
 * @file
 * Enables modules and site configuration for the DF site installation.
 */

/**
 * Implements template_preprocess_block().
 */
function df_preprocess_block(array &$variables) {
  $variables['attributes']['data-block-plugin-id'] = $variables['elements']['#plugin_id'];
}
