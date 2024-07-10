<?php

namespace App;

use App\Database\Database;

class InsereVenda{

    /**
     * Variavel que carrega o ID do Banco
     * 
     * @var string
     */
    public $id;

    /**
     * Variavel que carrega o ID Cliente
     * 
     * @var string
     */
    public $IDCliente; 

    /**
     * Variavel que carrega o ID Cliente
     * 
     * @var string
     */
    public $IDVenda; 

    function __construct($data){
        $this->IDCliente = $data->id_cliente;
        $this->IDVenda = $data->id_venda;
        $this->escreveArquivo();
        $this->insereBanco();
    }

    public function insereBanco()
    {
        $dadosVenda = new Database('nfe');
        $this->id  = $dadosVenda->insert([
            'id_cliente' => $this->IDCliente,
            'id_venda' => $this->IDVenda,
            
        ]);

        return $this->id;
    }

    public function escreveArquivo(){
        $data = "";
        $data .= $this->IDCliente;
        $data .= $this->IDVenda;
        $arquivo = fopen('escreveu.txt', 'w');
        fwrite($arquivo, $data);
        fclose($arquivo);
    }

}