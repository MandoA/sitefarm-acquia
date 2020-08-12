<?php

\Drupal::service('module_installer')->install([
  'sitefarm_default_content',
]);

\Drupal::service('module_installer')->uninstall([
  'default_content',
  'rest',
  'hal',
  'serialization',
  'sitefarm_default_content',
]);
