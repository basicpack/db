<?php
//Criado por Anderson Ismael
//18 de janeiro de 2018

require 'vendor/autoload.php';

function createDB($cfg=false){
    if(!$cfg){
        $cfg=getDbCfg();
    }
    $conn = new mysqli($cfg['server'], $cfg['username'], $cfg['password']);
    if ($conn->connect_error) {
        die("erro de conexão: ".PHP_EOL.$conn->connect_error);
    }
    $sql = "SHOW DATABASES LIKE  '".$cfg['database_name']."'";
    if ($conn->query($sql)->num_rows <> 1) {
        $sql = "CREATE DATABASE ".$cfg['database_name'];
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }

}

function db($cfg=false){
    if(!$cfg){
        $cfg=getDbCfg();
    }
    return new Medoo\Medoo($cfg);
}

function getDbCfg(){
    inc('env');
    if(isset($_ENV)){
        $cfg=[
            'database_type' => 'mysql',
            'database_name' => $_ENV['MYSQL_DB'],
            'server' => $_ENV['MYSQL_SERVER'],
            'username' => $_ENV['MYSQL_USER'],
            'password' => $_ENV['MYSQL_PASSWORD']
        ];
    }else{
        $cfg=[
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ];
    }
    return $cfg;
}
