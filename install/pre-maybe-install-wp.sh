#!/bin/bash

# Exit status 0 if WordPress installed, otherwise 1 (https://developer.wordpress.org/cli/commands/core/is-installed/)
wp core is-installed
export IS_WP_ALREADY_INSTALLED=$?
