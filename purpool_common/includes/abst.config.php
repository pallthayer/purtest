<?php

#################################################################
# Name: config.php                                              #
# Author: John Kuiphoff                                         #
# Description: Defines common server paths and settings.        #
#################################################################

// Define site directories 
$DIR = array();
$DIR['web_dir']   = '/var/www/purpool/';
$DIR['common_dir'] = '/var/purpool_common/';
$DIR['pear']   = '/var/purpool_common/pear/';
$DIR['smarty'] = $DIR['common_dir'] . 'smarty/';
$DIR['inc']    = $DIR['common_dir'] . 'includes/';
$DIR['logs']   = $DIR['common_dir'] . 'logs/';
$DIR['users']  = $DIR['web_dir'] . 'users/';

// Define template configurations
$SMARTY = array();
$SMARTY['orig'] = $DIR['common_dir'] . 'templates/';
$SMARTY['comp'] = $DIR['common_dir'] . 'templates_c/';

// Define database configurations
$DB = array();
$DB['type']       = 'mysql';
$DB['user']       = 'purpool';
$DB['pass']       = 'your_db_password';
$DB['host']       = 'localhost';
$DB['database']   = 'purpool';

// Define admin password
$USER = array();
$USER['pass'] = 'purpool';

$MISC['site_url'] = 'http://url.to.your.purpool.site/';
$MISC['admin_email'] = 'admin_email@your.server';
$MISC['google_key'] = 'your_google_maps_api_key';

// Set PEAR include path
//ini_set("include_path", $DIR['pear']);

// Set URL_REWRITER parameter
ini_set("url_rewriter.tags", "");

?>
