<?php

namespace App\Database;

use PDO;
use PDOException;
use PDOStatement;

Class Database{

    /**
     * DEFINE HOST DO BANCO
     * 
     * @var string
     * 
     */
    const HOST = "localhost";

    /**
     * DEFINE O NOME DO BANCO
     * 
     * @var string
     */
    const NAME = "wfnfe";

    /**
     * DEFINE O USER DO BANCO
     * 
     * @var string
     */
    const user = "root";

    /**
     * DEFINE A SENHA DO BANCO
     * 
     * @var string
     */
    const pass = "";

    /**
     * DEFINE A TABELA
     * 
     * @var string
     */
    private $table;

    /**
     * INSTANCIA DA POO
     * 
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela para a conexão
     * @param string $table
     * 
     * 
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Seta a conexão com o banco
     */
    public function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::user,self::pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR EXECUTE: ' . $e->getMessage());
        }
    }

    /**
     * Executa a query
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (PDOException $e) {
            die('ERROR EXECUTE: ' . $e->getMessage());
        }
    }

    /**
     * Método que insere as informações no banco
     * 
     * @param array $values [ field => value ] 
     * @return int $id
     */
    public function insert($values){
        $campos = array_keys($values);
        $binds = array_pad([], count($campos), '?');

        $query = 'INSERT INTO '. $this->table . ' (' .implode(',', $campos). ') VALUES ( '.implode(',' , $binds). ' )';
        $this->execute($query, array_values($values));


        
        return $this->connection->lastInsertId();
    }

}