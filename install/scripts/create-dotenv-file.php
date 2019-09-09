<?php
require_once dirname(__FILE__).'/functions.php';

/**
 * Create the .env configuration files with default values for DEV/PROD environments
 */
addEnvVariablesToConfigFile([
    // PROD
    'USE_COMPONENT_MODEL_CACHE' => true,
    'FAIL_IF_SUBCOMPONENT_DATALOADER_IS_UNDEFINED' => false,
    'ENABLE_EXTRA_ROUTES_BY_PARAMS' => false,
    'DISABLE_CUSTOM_CMS_CODE' => false,
    'ENABLE_CONFIG_BY_PARAMS' => false,
    'ENABLE_VERSION_BY_PARAMS' => false,
    'DISABLE_API' => false,
    'EXTERNAL_SITES_RUN_SAME_SOFTWARE' => false,
], [
    // DEV
    'USE_COMPONENT_MODEL_CACHE' => false,
    'FAIL_IF_SUBCOMPONENT_DATALOADER_IS_UNDEFINED' => true,
    'ENABLE_EXTRA_ROUTES_BY_PARAMS' => false,
    'DISABLE_CUSTOM_CMS_CODE' => false,
    'ENABLE_CONFIG_BY_PARAMS' => false,
    'ENABLE_VERSION_BY_PARAMS' => false,
    'DISABLE_API' => false,
    'EXTERNAL_SITES_RUN_SAME_SOFTWARE' => false,
]);
