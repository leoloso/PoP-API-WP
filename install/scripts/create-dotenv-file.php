<?php
/**
 * Create the .env configuration files with default values for DEV/PROD environments
 */
$lines = [];
if (getenv('ENV') === 'PROD') {
    $lines = [
        'USE_CACHE' => true,
        'FAIL_IF_SUBCOMPONENT_DATALOADER_IS_UNDEFINED' => false,
        'ENABLE_EXTRA_ROUTES_BY_PARAMS' => false,
        'DISABLE_CUSTOM_CMS_CODE' => false,
        'ENABLE_CONFIG_BY_PARAMS' => false,
        'DISABLE_API' => false,
        'EXTERNAL_SITES_RUN_SAME_SOFTWARE' => false,
        'IS_CONFIG_CACHE_DEBUG' => false,
    ];
} else {
    $lines = [
        'USE_CACHE' => false,
        'FAIL_IF_SUBCOMPONENT_DATALOADER_IS_UNDEFINED' => true,
        'ENABLE_EXTRA_ROUTES_BY_PARAMS' => false,
        'DISABLE_CUSTOM_CMS_CODE' => false,
        'ENABLE_CONFIG_BY_PARAMS' => false,
        'DISABLE_API' => false,
        'EXTERNAL_SITES_RUN_SAME_SOFTWARE' => false,
        'IS_CONFIG_CACHE_DEBUG' => true,
    ];
}
$output = '';
foreach($lines as $variable => $value) {
    $output .= $variable.'='.(is_bool($value) ? ($value ? "true" : "false") : $value).PHP_EOL;
}
// Write file
$file = $_SERVER['PWD'].'/config/.env';
$fp = fopen($file, 'w');
fwrite($fp, $output);
fclose($fp);
