<?php

#################################################################
# Name: config.php                                              #
# Author: John Kuiphoff                                         #
# Description: Defines common server paths and settings.        #
#################################################################

// Define site directories
$DIR = array();
$DIR['base']   = '/var/';
$DIR['pear']   = '/var/purpool_common/pear/';
$DIR['smarty'] = $DIR['base'] . 'purpool_common/smarty/';
$DIR['inc']    = $DIR['base'] . 'purpool_common/includes/';
$DIR['logs']   = $DIR['base'] . 'purpool_common/logs/';
$DIR['users']  = $DIR['base'] . 'www/purpool/users/';

// Define template configurations
$SMARTY = array();
$SMARTY['orig'] = $DIR['base'] . 'purpool_common/templates/';
$SMARTY['comp'] = $DIR['base'] . 'purpool_common/templates_c/';

// Define database configurations
$DB = array();
$DB['type']       = 'mysql';
$DB['user']       = 'purpool';
$DB['pass']       = 'WaSKCmduUV4LaY8j';
$DB['host']       = 'localhost';
$DB['database']   = 'purpool';

// Define admin password
$USER = array();
$USER['pass'] = 'purpool';

$MISC['site_url'] = 'http://pallthayer.dyndns.org/purpool/';
$MISC['admin_email'] = 'pallthay@gmail.com';
$MISC['google_key'] = 'ABQIAAAAfasZoVPbbM-4_YoGJ1bLhhQfhZS8tl8YwOn_KPOFmRfbKra2FBRRgsvjHcxYejRYnsEdksFuFwbmHw';

// Set PEAR include path
//ini_set("include_path", $DIR['pear']);

// Set URL_REWRITER parameter
ini_set("url_rewriter.tags", "");

?>
