<?php
/**
 * Append the following configuration to file .htaccess
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

// Append to .htaccess file
$file = $_SERVER['PWD'].'/.htaccess';
$fp = fopen($file, 'r+');
fwrite($fp, $apiRewriteString);
fclose($fp);
