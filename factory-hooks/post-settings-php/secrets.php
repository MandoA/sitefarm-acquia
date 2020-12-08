<?php
/**
 * @file
 * Contains super secret settings. Shhh...
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */
$secrets_file = sprintf('/home/%s/secrets/secrets.settings.php', $_ENV['AH_SITE_GROUP']);
if (file_exists($secrets_file)) {
  require $secrets_file;
}