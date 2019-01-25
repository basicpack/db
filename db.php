<?php
//Criado por Anderson Ismael
//18 de janeiro de 2018

require 'vendor/autoload.php';

function createDB($cfg){
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
    $filename=ROOT.'config/db.php';
    if($cfg==false){
        if(file_exists($filename)){
            $cfg=require $filename;
        }else{
            $cfg=[
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
            ];
        }
    }
    return new Medoo\Medoo($cfg);
}
