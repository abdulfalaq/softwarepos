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
$db['default']['database'] = 'olive_kasir';
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

$db['olive_cs']['hostname'] = 'localhost';
$db['olive_cs']['username'] = 'root';
$db['olive_cs']['password'] = '';
$db['olive_cs']['database'] = 'olive_cs';
$db['olive_cs']['dbdriver'] = 'mysql';
$db['olive_cs']['dbprefix'] = '';
$db['olive_cs']['pconnect'] = FALSE;
$db['olive_cs']['db_debug'] = TRUE;
$db['olive_cs']['cache_on'] = FALSE;
$db['olive_cs']['cachedir'] = '';
$db['olive_cs']['char_set'] = 'utf8';
$db['olive_cs']['dbcollat'] = '';
$db['olive_cs']['swap_pre'] = '';
$db['olive_cs']['autoinit'] = TRUE;
$db['olive_cs']['stricton'] = FALSE;

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

$db['olive_gudang']['hostname'] = 'localhost';
$db['olive_gudang']['username'] = 'root';
$db['olive_gudang']['password'] = '';
$db['olive_gudang']['database'] = 'olive_gudang';
$db['olive_gudang']['dbdriver'] = 'mysql';
$db['olive_gudang']['dbprefix'] = '';
$db['olive_gudang']['pconnect'] = FALSE;
$db['olive_gudang']['db_debug'] = TRUE;
$db['olive_gudang']['cache_on'] = FALSE;
$db['olive_gudang']['cachedir'] = '';
$db['olive_gudang']['char_set'] = 'utf8';
$db['olive_gudang']['dbcollat'] = '';
$db['olive_gudang']['swap_pre'] = '';
$db['olive_gudang']['autoinit'] = TRUE;
$db['olive_gudang']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */