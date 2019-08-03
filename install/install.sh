#!/bin/bash

./vendor/leoloso/wp-install/install/set-wp-config.sh

# Save state if WP is already installed or not on .temp file, then maybe install
( wp core is-installed && echo $? > .temp ) || echo $? > .temp
./vendor/leoloso/wp-install/install/maybe-install-wp.sh

# Maybe show success message
IS_WP_ALREADY_INSTALLED=$(cat .temp) && ./install/post-maybe-install-wp.sh $IS_WP_ALREADY_INSTALLED

# Maybe show footer
./install/maybe-print-footer.sh $IS_WP_ALREADY_INSTALLED

# Delete the .temp file
rm .temp
