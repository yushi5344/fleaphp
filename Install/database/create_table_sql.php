<?php

require_once dirname(__FILE__) . '/../../FLEA/FLEA.php';
require_once 'd:/www/temp/adodb/adodb.inc.php';

dl('php_mysql.' . PHP_SHLIB_SUFFIX);
dl('php_oci8.' . PHP_SHLIB_SUFFIX);


$db =& ADONewConnection($argv[2]);
/* @var $db ADOConnection */
// $db->Connect('localhost', 'FLEA_USER', 'FLEA_USER');

$dict =& NewDataDictionary($db);
/* @var $dict ADODB_DataDict */

FLEA::loadHelper('yaml');

$tables = load_yaml($argv[1], false);
foreach ($tables as $tableName => $fields) {
    $fields = implode(', ', $fields);
    $arr = $dict->CreateTableSQL($tableName, $fields, array('REPLACE'));
    foreach ($arr as $sql) {
        $sql = trim($sql);
        echo $sql;
        echo ";\n\n";
    }
}
