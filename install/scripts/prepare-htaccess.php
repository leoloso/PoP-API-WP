<?php
/**
 * Append the following configuration to file .htaccess
 * This rewrite configuration must be printed before the WordPress rewrite (# BEGIN WordPress ...)
 */
$apiRewriteString = <<<EOD
# API rewrite
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteRule ^(.*)/api/?$ /$1/?action=api [L,P,QSA]
</IfModule>
EOD;

// Prepend to .htaccess file
$file = $_SERVER['PWD'].'/.htaccess';
$fileContents = file_get_contents($file);
file_put_contents($file, $apiRewriteString.PHP_EOL.PHP_EOL.$fileContents);

// If the file is too big, use this other solution instead, taken from https://stackoverflow.com/questions/3332262/how-do-i-prepend-file-to-beginning
// $handle = fopen($file, "r+");
// $len = strlen($apiRewriteString);
// $final_len = filesize($file) + $len;
// $cache_old = fread($handle, $len);
// rewind($handle);
// $i = 1;
// while (ftell($handle) < $final_len) {
//   fwrite($handle, $apiRewriteString);
//   $apiRewriteString = $cache_old;
//   $cache_old = fread($handle, $len);
//   fseek($handle, $i * $len);
//   $i++;
// }
