<?php
//Criado por Anderson Ismael
//18 de janeiro de 2018

require 'vendor/autoload.php';

function db($db=false){
    if($db==false){
        $db=[
        'database_type' => 'mysql',
        'database_name' => 'test',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
        ];
    }
    return new Medoo\Medoo($db);
}
