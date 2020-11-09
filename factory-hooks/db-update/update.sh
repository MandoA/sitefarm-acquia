#!/bin/sh
#
# Factory Hook: db-update
#
# The existence of one or more executable files in the
# /factory-hooks/db-update directory will prompt them to be run
# *instead of* the regular database update (drush updatedb) command. So
# that update command will normally be part of the commands executed
# below.
#
# Usage: SCRIPTNAME site env db-role domain custom-arg1 custom-arg2 ...
# Map the script inputs to convenient names.
# Acquia hosting site / environment names
site="$1"
env="$2"

# database role. (Not expected to be needed in most hook scripts.)
db_role="$3"

# The public domain name of the website.
domain="$4"

# Custom argument: we will run entity updates if it is in any way
# nonempty.
update_entities="$5"

# The websites' document root can be derived from the site/env:
docroot="/var/www/html/$site.$env/docroot"

# Acquia recommends the following two practices:
# 1. Hardcode the drush version.
# 2. When running drush, provide the application + url, rather than relying
#    on aliases. This can prevent some hard to trace problems.
DRUSH_CMD="drush8 --root=$docroot --uri=https://$domain"

# Now update database.
$DRUSH_CMD updatedb -y

# Run entity updates if the updatedb command didn't fail.
if [ $? -eq 0 -a -n "$update_entities" ] ; then
    # Possibly do some preparation here...
    $DRUSH_CMD entity-updates
fi

### Copy/paste script lines from /.docksal/commands/media-update here.

# Turn on media migration modules and run migrations.
$DRUSH_CMD en sitefarm_migrate_article_media sitefarm_migrate_article_cat_media sitefarm_migrate_event_media sitefarm_migrate_page_media sitefarm_migrate_person_media sitefarm_migrate_photo_gallery_media sitefarm_migrate_focal_link_media sitefarm_migrate_focus_box_media sitefarm_migrate_image_banner_media sitefarm_migrate_marketing_highlight_media sitefarm_migrate_mkt_hlt_hrz_media sitefarm_migrate_hero_banner_media -y

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_article_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_article_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_article_media_image_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_article_cat_media_img_step1
$DRUSH_CMD migrate:import sitefarm_migrate_article_cat_media_img_step1
$DRUSH_CMD migrate:import sitefarm_migrate_article_cat_media_img_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_event_media_primary_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_event_media_primary_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_event_media_primary_image_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_event_media_documents_step1
$DRUSH_CMD migrate:import sitefarm_migrate_event_media_documents_step1
$DRUSH_CMD migrate:import sitefarm_migrate_event_media_documents_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_page_media_primary_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_page_media_primary_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_page_media_primary_image_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_page_media_documents_step1
$DRUSH_CMD migrate:import sitefarm_migrate_page_media_documents_step1
$DRUSH_CMD migrate:import sitefarm_migrate_page_media_documents_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_person_media_primary_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_person_media_primary_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_person_media_primary_image_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_person_media_documents_step1
$DRUSH_CMD migrate:import sitefarm_migrate_person_media_documents_step1
$DRUSH_CMD migrate:import sitefarm_migrate_person_media_documents_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_photo_gallery_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_photo_gallery_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_photo_gallery_media_image_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_photo_gallery_media_photos_step1
$DRUSH_CMD migrate:import sitefarm_migrate_photo_gallery_media_photos_step1
$DRUSH_CMD migrate:import sitefarm_migrate_photo_gallery_media_photos_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_focal_link_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_focal_link_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_focal_link_media_image_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_focus_box_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_focus_box_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_focus_box_media_image_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_image_banner_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_image_banner_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_image_banner_media_image_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_marketing_highlight_media_step1
$DRUSH_CMD migrate:import sitefarm_migrate_marketing_highlight_media_step1
$DRUSH_CMD migrate:import sitefarm_migrate_marketing_highlight_media_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_mkt_hlt_hrz_media_img_step1
$DRUSH_CMD migrate:import sitefarm_migrate_mkt_hlt_hrz_media_img_step1
$DRUSH_CMD migrate:import sitefarm_migrate_mkt_hlt_hrz_media_img_step2

$DRUSH_CMD migrate:duplicate-file-detection sitefarm_migrate_hero_banner_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_hero_banner_media_image_step1
$DRUSH_CMD migrate:import sitefarm_migrate_hero_banner_media_image_step2

$DRUSH_CMD pm-uninstall sitefarm_migrate_article_media sitefarm_migrate_article_cat_media sitefarm_migrate_event_media sitefarm_migrate_page_media sitefarm_migrate_person_media sitefarm_migrate_photo_gallery_media sitefarm_migrate_focal_link_media sitefarm_migrate_focus_box_media sitefarm_migrate_image_banner_media sitefarm_migrate_marketing_highlight_media sitefarm_migrate_mkt_hlt_hrz_media sitefarm_migrate_hero_banner_media -y

# Purge all Acquia and Fastly caches.
$DRUSH_CMD cr -y
$DRUSH_CMD p:invalidate everything -y
