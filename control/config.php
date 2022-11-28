<?php
session_start();

// Verifica a versão do php para utilizar o array de constante abaixo 
phpversion() < 7 ? exit('Erro-01: Necessário versão do PHP 7 em diante') : "";

// Heroku adiciona a variavel abaixo
// [CLEARDB_DATABASE_URL] => mysql://bf3eef74bd00a8:59bfcdbf@us-cdbr-iron-east-04.cleardb.net/heroku_e9f457f91695453?reconnect=true
if(isset($_SERVER['JAWSDB_URL']))
{
    // DB Heroku - By Add-on JawsDB MySQL
    $app_db = [
        'drive' => 'mysql', 
        'host'  => 'xefi550t7t6tjn36.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 
        'user'  => 'a0vxd47q0p4q1pn4', 
        'pass'  => 'qir5yz7j0mjl5our', 
        'base'  => 'oqrstdjzy0wgj80c'
    ];
}
else
{
    // DB Local
    $app_db = [
        'drive' => 'mysql', 
        'host'  => 'localhost', 
        'user'  => 'crud', 
        'pass'  => '362514', 
        'base'  => 'php_crud'
    ];
}

define("APPDB", $app_db);