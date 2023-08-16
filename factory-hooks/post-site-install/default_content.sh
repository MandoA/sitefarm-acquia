#!/bin/bash
#
# Factory Hook: post-site-install
#
# This is necessary so that blt drupal:install tasks are invoked automatically
# when a site is created on ACSF.
#
# Usage: default_content.sh sitegroup env db-role domain

# Exit immediately on error and enable verbose log output.
set -ev

# Map the script inputs to convenient names:
# Acquia Hosting sitegroup (application) and environment.
sitegroup="$1"
env="$2"
# Database role. This is a truly unique identifier for an ACSF site and is e.g.
# part of the public files path.
db_role="$3"
# Internal (Acquia managed) domain name of the website. (No public domain name
# is assigned yet, immediately after installation.) The first part is a name
# that is unique per installed site. A small but significant difference with
# $db_role: if a site gets deleted and reinstalled with the same name, it gets
# a different $db_role.
internal_domain="$4"

# The websites' document root can be derived from the site/env:
docroot="/var/www/html/$sitegroup.$env/docroot"

# Acquia recommends the following two practices:
# 1. Hardcode the drush version.
# 2. When running drush, provide the application + url, rather than relying
#    on aliases. This can prevent some hard to trace problems.
DRUSH_CMD="drush8 --root=$docroot --uri=https://$internal_domain"

$DRUSH_CMD en sitefarm_default_content -y

$DRUSH_CMD pm-uninstall default_content rest hal serialization sitefarm_default_content single_content_sync -y
