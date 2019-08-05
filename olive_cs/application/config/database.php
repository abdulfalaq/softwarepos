<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'clouoid1_root';
$db['default']['password'] = 'astroboymin';
$db['default']['database'] = 'clouoid1_olive_cs';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = '';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


$db['olive_master']['hostname'] = 'localhost';
$db['olive_master']['username'] = 'clouoid1_root';
$db['olive_master']['password'] = 'astroboymin';
$db['olive_master']['database'] = 'clouoid1_olive_master';
$db['olive_master']['dbdriver'] = 'mysql';
$db['olive_master']['dbprefix'] = '';
$db['olive_master']['pconnect'] = FALSE;
$db['olive_master']['db_debug'] = TRUE;
$db['olive_master']['cache_on'] = FALSE;
$db['olive_master']['cachedir'] = '';
$db['olive_master']['char_set'] = 'utf8';
$db['olive_master']['dbcollat'] = '';
$db['olive_master']['swap_pre'] = '';
$db['olive_master']['autoinit'] = TRUE;
$db['olive_master']['stricton'] = FALSE;


$db['olive_kasir']['hostname'] = 'localhost';
$db['olive_kasir']['username'] = 'clouoid1_root';
$db['olive_kasir']['password'] = 'astroboymin';
$db['olive_kasir']['database'] = 'clouoid1_olive_kasir';
$db['olive_kasir']['dbdriver'] = 'mysql';
$db['olive_kasir']['dbprefix'] = '';
$db['olive_kasir']['pconnect'] = FALSE;
$db['olive_kasir']['db_debug'] = TRUE;
$db['olive_kasir']['cache_on'] = FALSE;
$db['olive_kasir']['cachedir'] = '';
$db['olive_kasir']['char_set'] = 'utf8';
$db['olive_kasir']['dbcollat'] = '';
$db['olive_kasir']['swap_pre'] = '';
$db['olive_kasir']['autoinit'] = TRUE;
$db['olive_kasir']['stricton'] = FALSE;