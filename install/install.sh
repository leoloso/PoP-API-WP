#!/bin/bash

YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Install PoP and WordPress through Composer:
echo "Downloading and installing PoP and WordPress through Composer..."
echo -e "${YELLOW}(this may take a few minutes)${NC}"
composer create-project leoloso/pop-api-wp $FOLDER_NAME dev-master

# Install the must-use plugins:
cd $FOLDER_NAME
composer install

# Configure wp-config.php through WP-CLI
wget -O - https://raw.githubusercontent.com/leoloso/wp-install/master/install/set-wp-config.sh | bash

## Check if WordPress is installed. If not, install it
#./maybe-install-wp.sh
wget -O - https://raw.githubusercontent.com/leoloso/pop-api-wp/master/install/maybe-install-wp.sh | bash

## Farewell message
#./print-footer.sh
wget -O - https://raw.githubusercontent.com/leoloso/pop-api-wp/master/install/print-footer.sh | bash
