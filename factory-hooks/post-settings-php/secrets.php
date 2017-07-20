<?php
/**
 * @file
 * Contains super secret settings. Shhh...
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */
$secrets_file = sprintf('/mnt/files/%s.%s/secrets.settings.php', $_ENV['AH_SITE_GROUP'],$_ENV['AH_SITE_ENVIRONMENT']);
if (file_exists($secrets_file)) {
  require $secrets_file;
}