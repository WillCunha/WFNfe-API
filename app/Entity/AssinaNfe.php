<?php

namespace App\Entity;

use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\Common\Signer;

class AssinaNfe
{


    /**
     * Variavel que contem a data da ultima atualização da NFe.
     * 
     * @var string
     */
    public $atualizacao;

    /**
     * Variavel que contem o tipo de ambiente que esta sendo trabalhado.
     * 1 - PROD | 2 - TESTES
     * 
     * @var string
     */
    public $tpAmb;

    /**
     * Variavel que contem a razão social do emissor
     * 
     * @var string
     */
    public $razaoSocial;


    /**
     * Variavel que contem a sigla do estado do assinante
     * 
     * @var string
     */
    public $siglaUF;

    /**
     * Variavel que contem o CNPJ
     * 
     * @var string
     */
    public $cnpj;


    /**
     * Variavel que contem o esquema da NFe;
     * 
     * @var string
     */
    public $schemes;


    /**
     * Variavel que contem a versão da NFe.
     * 
     * @var string
     */
    public $versao;


    /**
     * Vaiavel que contem o TOKEN do Institudo Brasileiro de Planejamento e Tributação
     * 
     * @var stirng
     */
    public $tokenIBPT;


    /**
     * Variavel que contem a chave da NFe para que possamos pega-la e assina-la
     * 
     * @var string
     */
    public $chave;


    /**
     * Variavel que contem a certificado digital da empresa
     * 
     * @var string
     */
    public $certificado;

    /**
     * Variavel que contem a senha do certificado digital da empresa
     * 
     * @var string
     */
    public $senha;

    /**
     * Variavel que carrega a configuração da assinatura
     * 
     * @var string
     */
    public $configJson;

    /**
     * Variavel que contem o conteúdo do XML
     * 
     * @var string
     */
    public $xml;

    /**
     * Variavel que contem o XML assinado
     * 
     * @var string;
     */
    public $xmlAssinado;

    public $algoritimo;

    public $canonical;

    public function __construct($data, $chave)
    {
        $this->atualizacao = $data->atualizacao;
        $this->tpAmb = $data->tpAmb;
        $this->razaoSocial = $data->razaosocial;
        $this->siglaUF = $data->siglaUF;
        $this->cnpj = $data->cnpj;
        $this->schemes = $data->schemes;
        $this->versao = $data->versao;
        $this->tokenIBPT = $data->tokenIBPT;
        $this->certificado = $data->certificado;
        $this->chave = $chave;
        $this->senha = $data->senha;
        $this->algoritimo = OPENSSL_ALGO_SHA1;
        $this->canonical = [true,false,null,null];
        $this->xml = file_get_contents("C:/xampp/htdocs/homologacao/entradas/" . $this->chave ."");
        $this->certificado = file_get_contents(__DIR__ . '../../../files/' . $this->certificado);
        $this->insereDados();
    }

    public function insereDados()
    {
        $config = [
            "atualizacao" => $this->atualizacao,
            "tpAmb" => $this->tpAmb, // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
            "razaosocial" => $this->razaoSocial,
            "siglaUF" => $this->siglaUF,
            "cnpj" => $this->cnpj,
            "schemes" => $this->schemes,
            "versao" => $this->versao,
            "tokenIBPT" => $this->tokenIBPT
        ];
        $this->configJson = json_encode($config);
        $this->assinaXml();
    }

    public function assinaXml()
    {

        try {
            $tools = new Tools($this->configJson, Certificate::readPfx($this->certificado, $this->senha));
            $this->xmlAssinado = $tools->signNFe($this->xml);

            

            echo $this->xmlAssinado;

            $filename = "C:/xampp/htdocs/homologacao/entradas/" . $this->chave; // Ambiente Windows

            file_put_contents($filename, $this->xmlAssinado);
            chmod($filename, 0777);

        } catch (\Exception $e) {
            echo $e->getMessage();
            $arquivo = fopen('erros.txt', 'w');
            fwrite($arquivo,  $e->getMessage());
            fclose($arquivo);
        }
    }
}
