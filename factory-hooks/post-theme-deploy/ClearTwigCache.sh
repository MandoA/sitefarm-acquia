#!/bin/bash

drush8 @$1.$2 --uri=$5 ev '\Drupal\Core\PhpStorage\PhpStorageFactory::get("twig")->deleteAll();'
