#!/bin/bash

if ! $(wp core is-installed); then
    ## Check if WordPress is installed. If not, install it
    wget -O - https://raw.githubusercontent.com/leoloso/wp-install/master/install/maybe-install-wp.sh | bash
    if ! $(wp core is-installed); then
    else
        ORANGE='\033[0;33m'
        NC='\033[0m' # No Color
        UNDERLINE=`tput smul`
        NOUNDERLINE=`tput rmul`
        echo -e "🍎 PoP API (REST for posts): ${ORANGE}${UNDERLINE}$SITE_URL_WITH_HTTP/posts/?action=api&datastructure=rest${NOUNDERLINE}${NC}"
    fi
fi
