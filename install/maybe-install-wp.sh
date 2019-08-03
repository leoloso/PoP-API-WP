#!/bin/bash

# Exit status 0 if WordPress installed, otherwise 1 (https://developer.wordpress.org/cli/commands/core/is-installed/)
wp core is-installed
ALREADY_INSTALLED=$?

# Delegate to package wp-install to install WordPress or show a message
wget -O - https://raw.githubusercontent.com/leoloso/wp-install/master/install/maybe-install-wp.sh --quiet | bash

# If previously not installed, and now it is, append success message
if [ $ALREADY_INSTALLED -eq 1 ]
then
    if $(wp core is-installed); then
        ORANGE='\033[0;33m'
        NC='\033[0m' # No Color
        UNDERLINE=`tput smul`
        NOUNDERLINE=`tput rmul`
        echo -e "🍎 PoP API (REST for posts): ${ORANGE}${UNDERLINE}$SITE_URL_WITH_HTTP/posts/?action=api&datastructure=rest${NOUNDERLINE}${NC}"
    fi
fi
