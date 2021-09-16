#!/usr/bin/env bash
#
# Factory Hook: post-staging-update
#
#
# Usage: SCRIPTNAME site_group env db_role domain
# Map the script inputs to convenient names.
# Acquia hosting site / environment names
site="$1"
env="$2"

# The public domain name of the website.
domain="$4"

# The websites' document root can be derived from the site/env:
docroot="/var/www/html/$site.$env/docroot"

# Acquia recommends the following two practices:
# 1. Hardcode the drush version.
# 2. When running drush, provide the application + url, rather than relying
#    on aliases. This can prevent some hard to trace problems.
DRUSH_CMD="drush8 --root=$docroot --uri=https://$domain"

# Remove Fastly site_id, letting it generate a new one, so that it doesn't purge the live site.
$DRUSH_CMD config-delete fastly.settings site_id
$DRUSH_CMD cr -y
# Purge all Acquia and Fastly caches.
$DRUSH_CMD p:invalidate everything -y
