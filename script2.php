<?php

include "pdo.php";
require_once __DIR__ . "/config/config.inc.php";
$dbConnection = new DbConnection($db_host, $db_name, $db_user, $db_pass, $db_port);


try{
    $dbConnection->delete('studenti','nome, cognome','Giovanni Verdi');
}catch(Exception $e){
    echo "". $e->getMessage() ."";
}






?>