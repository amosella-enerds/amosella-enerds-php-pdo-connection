<?php

include "pdo.php";
require_once __DIR__ . "/config/config.inc.php";
 $dbConnection = new DbConnection($db_host, $db_name, $db_user, $db_pass, $db_port);

 try{
    $dbConnection-> deleteDb('scuola');
}catch(Exception $e){
    echo ''. $e->getMessage() .'';
}

 try{
 
  $dbConnection->createDb('scuola');
}catch(Exception $e){
    echo ''. $e->getMessage() .'';
}

try{
    $dbConnection->useDb('scuola');
}catch(Exception $e){
    echo ''. $e->getMessage() .'';
}

try{
    $dbConnection->createTable('studenti');
}catch(Exception $e){
    echo ''. $e->getMessage() .'';
}

try{

    $table='studenti';
    $dati=[
        'nome'=>'Anna ',
        'cognome'=> 'Bianchi',
        'data_nascita'=> '2001-08-15',
        'email'=>'anna.bianchi@gmail.com',
        
    ];

    $dbConnection->insert($table, $dati);
}catch(Exception $e){
    echo ''. $e->getMessage() .'';
}












?>