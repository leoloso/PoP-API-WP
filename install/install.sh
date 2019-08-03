#!/bin/bash

YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Install PoP and WordPress through Composer:
echo -e "Downloading and installing the PoP API, and WordPress, through Composer... ${YELLOW}(this may take a few minutes)${NC}"
composer create-project leoloso/pop-api-wp $FOLDER_NAME

# Install the must-use plugins:
cd $FOLDER_NAME
composer install

# Configure wp-config.php through WP-CLI
wget -O - https://raw.githubusercontent.com/leoloso/wp-install/master/install/set-wp-config.sh --quiet | bash

## Check if WordPress is installed. If not, install it
#./maybe-install-wp.sh
wget -O - https://raw.githubusercontent.com/leoloso/pop-api-wp/master/install/maybe-install-wp.sh --quiet | bash

## Farewell message
#./print-footer.sh
wget -O - https://raw.githubusercontent.com/leoloso/pop-api-wp/master/install/print-footer.sh --quiet | bash
