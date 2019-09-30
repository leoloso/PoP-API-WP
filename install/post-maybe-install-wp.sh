#!/bin/bash

# If previously not installed, and now it is, append success message
if [ $1 -eq 1 ]
then
    if $(wp core is-installed); then
        ORANGE='\033[0;33m'
        NC='\033[0m' # No Color
        UNDERLINE=`tput smul`
        NOUNDERLINE=`tput rmul`
        echo -e "🍎 PoP API: ${ORANGE}${UNDERLINE}$SITE_URL_WITH_HTTP/api/?fields=__schema${NOUNDERLINE}${NC}"
    fi
fi
