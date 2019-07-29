<?php
/**
 * Create the .env configuration files with default values for DEV/PROD environments
 */
$lines = []; 
if ('$ENV' === 'PROD') {
    $lines = [
        'USE_CACHE' => 'true', 
        'FAIL_IF_SUBCOMPONENT_DATALOADER_IS_UNDEFINED' => 'false', 
        'ENABLE_EXTRA_ROUTES_BY_PARAMS' => 'false', 
        'DISABLE_CUSTOM_CMS_CODE' => 'false', 
        'ENABLE_CONFIG_BY_PARAMS' => 'false', 
        'DISABLE_API' => 'false', 
        'EXTERNAL_SITES_RUN_SAME_SOFTWARE' => 'false',
    ];
} else { 
    $lines = [
        'USE_CACHE' => 'false', 
        'FAIL_IF_SUBCOMPONENT_DATALOADER_IS_UNDEFINED' => 'true', 
        'ENABLE_EXTRA_ROUTES_BY_PARAMS' => 'false', 
        'DISABLE_CUSTOM_CMS_CODE' => 'false', 
        'ENABLE_CONFIG_BY_PARAMS' => 'false', 
        'DISABLE_API' => 'false', 
        'EXTERNAL_SITES_RUN_SAME_SOFTWARE' => 'false',
    ];
} 
$output = ''; 
foreach($lines as $variable => $value) { 
    $output .= $variable.'='.$value.PHP_EOL; 
} 
$fp = fopen($_SERVER['PWD'].'/config/.env', 'w'); 
fwrite($fp, $output); 
fclose($fp);