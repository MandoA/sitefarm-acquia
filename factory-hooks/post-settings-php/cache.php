<?php
/**
 * Disables APC cache on selected sites for troubleshooting purposes.
 */
$sites = [
  'lettersandscience.ucdsitefarm.acsitefactory.com',
  'lettersandscience.test-ucdsitefarm.acsitefactory.com',
];

if (in_array($_SERVER['HTTP_HOST'], $sites)) {
  ## ACQUIA SUPPORT: Completely avoid using APCu for cache bins and the class loader.
  $settings['cache']['default'] = 'cache.backend.database';
  $settings['cache']['bins']['bootstrap'] = 'cache.backend.database';
  $settings['cache']['bins']['discovery'] = 'cache.backend.database';
  $settings['cache']['bins']['config'] = 'cache.backend.database';
  $settings['class_loader_auto_detect'] = FALSE;
}