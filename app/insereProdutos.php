<?php

namespace App;

use App\Database\Database;

class InsereProdutos{

    /**
     * Variavel que carrega o ID do Banco
     * 
     * @var string
     */
    static public $id;

    /**
     * Variavel que carrega o ID Cliente
     * 
     * @var string
     */
    static public $idProduto; 

    /**
     * Variavel que carrega o ID da Venda
     * 
     * @var string
     */
    static public $idVenda; 

    /**
     * Variavel que carrega o nome do produto
     * 
     * @var string
     */
    static public $nome; 

    /**
     * Variavel que carrega a quantidade de itens vendidos
     * 
     * @var string
     */
    static public $quantidade; 

    /**
     * Variavel que carrega o total 
     * 
     * @var string
     */
    static public $total; 

    static public function insereBanco()
    {
        $dadosVenda = new Database('produtos');
        self::$id  = $dadosVenda->insert([
            'id_venda' => self::$idVenda,
            'id_produto' => self::$idProduto,
            'nome' => self::$nome,
            'quantidade' => self::$quantidade,
            'total' => self::$total,
        ]);

        return self::$id;
    }

}