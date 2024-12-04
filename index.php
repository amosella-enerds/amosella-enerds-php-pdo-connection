<?php
include "pdo.php";
require_once __DIR__ . "/config/config.inc.php";


/*try {
    $dbConnection = new DbConnection($db_host, $db_name, $db_user, $db_pass, $db_port);
    $dbConnection->createDb("Test2");
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

*/
try {
    $dbConnection = new DbConnection($db_host, $db_name, $db_user, $db_pass, $db_port);
    $dbConnection->useDb("alemartindb");
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

/*
try {
    $dbConnection = new DbConnection($db_host, $db_name, $db_user, $db_pass, $db_port);
    $dbConnection->deleteDb("Test2");
} catch (PDOException $ex) {
    echo $ex->getMessage();
}


try {
    $dbConnection->createTable("");
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

try {
    $dbConnection = new DbConnection($db_host, $db_name, $db_user, $db_pass, $db_port);
    $dbConnection->dropTable("elenco");
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
*/
try {
    $table = 'martinsicuro';
    $dati = [
        'giocatori',
        'staff'
    ];
    $condizione='TRUE';
    

    $result = $dbConnection->select($table, $dati, $condizione, 'giocatori','DESC', 5);
    print_r($result);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

/*
try {

    $result = $dbConnection->insert('martinsicuro','giocatori', 'alessandro' );
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

*/
/*
try { 
    $result= $dbConnection->delete('martinsicuro','giocatori','alessandro');

}catch (PDOException $ex) {
    echo $ex->getMessage();
}
    */
/*
try {
    $table = 'martinsicuro'; 
    $dati = [
        'giocatori' => 'giovanni', 
        'staff' => 'rosi' 
    ];
    $condizione = 'id = 1'; 

    $result = $dbConnection->update($table, $dati, $condizione, '');
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

*/











































































































