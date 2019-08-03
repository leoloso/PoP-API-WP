<?php
/**
 * Create the .env configuration files with default values for DEV/PROD environments
 */
function addEnvVariablesToConfigFile($prodValues, $devValues)
{
    $lines = (getenv('ENV') === 'PROD') ? $prodValues : $devValues;
    $output = '';
    foreach($lines as $variable => $value) {
        $output .= $variable.'='.(is_bool($value) ? ($value ? "true" : "false") : $value).PHP_EOL;
    }

    // Append to file
    $file = $_SERVER['PWD'].'/config/.env';
    $fp = fopen($file, 'a');
    fwrite($fp, $output);
    fclose($fp);
}
