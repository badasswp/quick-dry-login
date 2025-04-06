#!/bin/bash

wp-env run cli wp theme activate twentytwentythree
wp-env run cli wp rewrite structure /%postname%
wp-env run cli wp option update blogname "Quick & Dry Login"
wp-env run cli wp option update blogdescription "Manually select any user profile to log into your WP development or staging website."
