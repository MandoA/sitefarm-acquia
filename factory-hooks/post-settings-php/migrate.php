<?php
/**
 * @file
 * Drupal migrate settings.
 */

// This setting will copy the default database config to migrate to get rid of
// database errors when the migrate_drupal module is enabled.
$databases['migrate']['default'] = $databases['default']['default'];
