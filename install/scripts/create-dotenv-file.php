<?php
require_once dirname(__FILE__).'/functions.php';

/**
 * Create the .env configuration files with default values for DEV/PROD environments
 */
addEnvVariablesToConfigFile([
    // PROD
    'USE_COMPONENT_MODEL_CACHE' => true,
    'ENABLE_EXTRA_ROUTES_BY_PARAMS' => false,
    'DISABLE_CUSTOM_CMS_CODE' => false,
    'ENABLE_CONFIG_BY_PARAMS' => false,
    'ENABLE_VERSION_BY_PARAMS' => false,
    'DISABLE_API' => false,
    'DISABLE_REST_API' => false,
    'DISABLE_GRAPHQL_API' => false,
    'EXTERNAL_SITES_RUN_SAME_SOFTWARE' => false,
    'ENABLE_SHOW_LOGS' => false,
], [
    // DEV
    'USE_COMPONENT_MODEL_CACHE' => false,
    'ENABLE_EXTRA_ROUTES_BY_PARAMS' => false,
    'DISABLE_CUSTOM_CMS_CODE' => false,
    'ENABLE_CONFIG_BY_PARAMS' => false,
    'ENABLE_VERSION_BY_PARAMS' => false,
    'DISABLE_API' => false,
    'DISABLE_REST_API' => false,
    'DISABLE_GRAPHQL_API' => false,
    'EXTERNAL_SITES_RUN_SAME_SOFTWARE' => false,
    'ENABLE_SHOW_LOGS' => true,
]);
