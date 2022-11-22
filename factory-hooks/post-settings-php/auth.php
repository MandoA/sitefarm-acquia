<?php
/**
 * @file
 * Authentication settings.
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */

// CAS module settings.
if (isset($_SERVER['AH_SITE_ENVIRONMENT']) &&
  in_array($_SERVER['AH_SITE_ENVIRONMENT'], ['01live', '01update'])
  ) {
  // Prod environment should use the Prod CAS Server.
  $config['cas.settings']['server']['hostname'] = 'cas.ucdavis.edu';
}
else {
  // All other installations should use the Dev CAS Server.
  $config['cas.settings']['server']['hostname'] = 'ssodev.ucdavis.edu';
}
$config['cas.settings']['server']['version'] = '3.0';
$config['cas.settings']['server']['port'] = '443';
$config['cas.settings']['server']['path'] = '/cas';
$config['cas.settings']['server']['verify'] = '0';
$config['cas.settings']['server']['cert'] = '';
$config['cas.settings']['user_accounts']['restrict_password_management'] = TRUE;
$config['cas.settings']['email_hostname'] = 'ucdavis.edu';
$config['cas.settings']['login_link_enabled'] = TRUE;
$config['cas.settings']['login_link_label'] = 'UC Davis Login';

// samlauth module settings.
$config['samlauth.authentication']['map_users'] = TRUE;
$config['samlauth.authentication']['map_users_name'] = FALSE;
$config['samlauth.authentication']['map_users_mail'] = TRUE;
$config['samlauth.authentication']['map_users_roles'] = [
  'site_manager' => 'site_manager',
  'administrator' => 'administrator',
  'contributor' => '0',
  'editor' => '0',
  'site_builder' => '0'
  ];
$config['samlauth.authentication']['create_users'] = TRUE;
$config['samlauth.authentication']['sync_name'] = TRUE;
$config['samlauth.authentication']['sync_mail'] = TRUE;
