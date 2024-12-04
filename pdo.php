<?php
class DbConnection extends PDO
{
    public $db_host;
    public $db_name;
    public $db_user;
    protected $db_pass;
    protected $db_port;

    function __construct($db_host, $db_name, $db_user, $db_pass, $db_port)
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_port = $db_port;

        return parent::__construct("mysql:host=$db_host;dbname=$db_name;port=$db_port", $db_user, $db_pass);
    }

    function createDb($db_prova)
    {
        $sql = "CREATE DATABASE $db_prova";
        $this->exec($sql);
    }

    function useDb($p_database)
    {
        $sql = "USE " . $p_database;
        $this->exec($sql);
    }
    function deleteDb($db_p)
    {
        $sql = "DROP DATABASE $db_p ";
        $this->exec($sql);
    }
    function createTable($table_p)
    {

        $sql = "CREATE TABLE $table_p(
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    nome VARCHAR(100) NOT NULL,
                    cognome VARCHAR(100) NOT NULL,
                    data_nascita DATE,
                    email VARCHAR(150),
                    creation_ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    )";
        $this->exec($sql);
    }

    function select($table, $columns, $columnNameCondition, $campo, $ordina, $limite)
    {
        $columnsString = implode(", ", $columns);

        $sql = "SELECT $columnsString FROM $table WHERE $columnNameCondition ORDER BY $campo $ordina LIMIT $limite";

        $stmt = $this->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function update($table, $valoriUpdate, $columnNameCondition, $conditionValue)
    {

        $set = [];
        foreach ($valoriUpdate as $colonna => $valore) {
            $set[] = "$colonna = :$colonna";
        }
        $setString = implode(", ", $set);

        $sql = "UPDATE $table SET $setString WHERE $columnNameCondition = :conditionValue";

        $stmt = $this->prepare($sql);

        foreach ($valoriUpdate as $colonna => $valore) {
            $stmt->bindValue(":$colonna", $valore);
        }

        $stmt->bindValue(":conditionValue", $conditionValue);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Record con $columnNameCondition = $conditionValue è stato aggiornato con successo.";
        } else {
            echo "Nessun record trovato o nessun cambiamento effettuato.";
        }
    }

    function insert($table, $dati)
    {

        $columns = implode(", ", array_keys($dati));
        $valori = ":" . implode(", :", array_keys($dati));

        $sql = "INSERT INTO $table ($columns) VALUES ($valori)";

        $stmt = $this->prepare($sql);
        foreach ($dati as $columns => $valore) {
            $stmt->bindValue(":$columns", $valore);
        }

        $stmt->execute();

    }

    function delete($table, $columnName, $value)
    {
        $sql = "DELETE FROM $table WHERE $columnName = :value";

        $stmt = $this->prepare($sql);

        $stmt->bindParam(':value', $value, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Record con $columnName = $value è stato cancellato con successo.";
        } else {
            echo "Nessun record trovato con $columnName = $value.";
        }
    }

    function dropTable($p_table)
    {
        $sql = "DROP TABLE $p_table";
        $this->exec($sql);
    }
}
