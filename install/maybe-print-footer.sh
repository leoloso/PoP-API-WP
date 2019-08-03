#!/bin/bash

# If previously not installed, and now it is, show footer
if [ $1 -eq 1 ]
then
    if $(wp core is-installed); then
        GREEN='\033[0;32m'
        ORANGE='\033[0;33m'
        NC='\033[0m' # No Color
        UNDERLINE=`tput smul`
        NOUNDERLINE=`tput rmul`

        echo -e "🥳 ${GREEN}Success!${NC}"
        echo "If you like PoP, please consider giving the project a star in GitHub 😀 ❤️"
        echo -e "👉🏽 ${ORANGE}${UNDERLINE}https://github.com/leoloso/PoP${NOUNDERLINE}${NC}"
        echo "Bye 👋 , happy using PoP!"
    fi
fi
