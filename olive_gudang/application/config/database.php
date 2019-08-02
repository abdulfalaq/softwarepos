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
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'olive_gudang';
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
$db['olive_master']['username'] = 'root';
$db['olive_master']['password'] = '';
$db['olive_master']['database'] = 'olive_master';
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



$db['olive_keuangan']['hostname'] = 'localhost';
$db['olive_keuangan']['username'] = 'root';
$db['olive_keuangan']['password'] = '';
$db['olive_keuangan']['database'] = 'olive_keuangan';
$db['olive_keuangan']['dbdriver'] = 'mysql';
$db['olive_keuangan']['dbprefix'] = '';
$db['olive_keuangan']['pconnect'] = FALSE;
$db['olive_keuangan']['db_debug'] = TRUE;
$db['olive_keuangan']['cache_on'] = FALSE;
$db['olive_keuangan']['cachedir'] = '';
$db['olive_keuangan']['char_set'] = 'utf8';
$db['olive_keuangan']['dbcollat'] = '';
$db['olive_keuangan']['swap_pre'] = '';
$db['olive_keuangan']['autoinit'] = TRUE;
$db['olive_keuangan']['stricton'] = FALSE;

$db['kan_kasir']['hostname'] = 'localhost';
$db['kan_kasir']['username'] = 'root';
$db['kan_kasir']['password'] = '';
$db['kan_kasir']['database'] = 'kan_kasir';
$db['kan_kasir']['dbdriver'] = 'mysql';
$db['kan_kasir']['dbprefix'] = '';
$db['kan_kasir']['pconnect'] = FALSE;
$db['kan_kasir']['db_debug'] = TRUE;
$db['kan_kasir']['cache_on'] = FALSE;
$db['kan_kasir']['cachedir'] = '';
$db['kan_kasir']['char_set'] = 'utf8';
$db['kan_kasir']['dbcollat'] = '';
$db['kan_kasir']['swap_pre'] = '';
$db['kan_kasir']['autoinit'] = TRUE;
$db['kan_kasir']['stricton'] = FALSE;

$db['kan_sia']['hostname'] = 'localhost';
$db['kan_sia']['username'] = 'root';
$db['kan_sia']['password'] = '';
$db['kan_sia']['database'] = 'kan_sia';
$db['kan_sia']['dbdriver'] = 'mysql';
$db['kan_sia']['dbprefix'] = '';
$db['kan_sia']['pconnect'] = FALSE;
$db['kan_sia']['db_debug'] = TRUE;
$db['kan_sia']['cache_on'] = FALSE;
$db['kan_sia']['cachedir'] = '';
$db['kan_sia']['char_set'] = 'utf8';
$db['kan_sia']['dbcollat'] = '';
$db['kan_sia']['swap_pre'] = '';
$db['kan_sia']['autoinit'] = TRUE;
$db['kan_sia']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */