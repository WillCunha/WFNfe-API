<?php

namespace App\Entity;

use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\Common\Soap\SoapCurl;
use NFePHP\NFe\Common\Standardize;

class EnviaLote
{

    /**
     * Id do Lote a ser enviador
     * 
     * @var string
     */
    public $id;

    /**
     * Variavel que contem a dados da ultima atualização da NFe.
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
     * Conteúdo do XML
     * 
     * @var string
     */
    public $xmlAssinado;

    /**
     * Variavel que contem a certificado digital da empresa
     * 
     * @var string
     */
    public $certificado;

    /**
     * Variavel que contem a razão social do emissor
     * 
     * @var string
     */
    public $razaoSocial;

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
     * Variavel que contem a chave da NFe para que possamos pega-la e assina-la
     * 
     * @var string
     */
    public $chave;

    /**
     * Variavel que contem a resposta da Sefaz
     * 
     * @var string
     */
    public $resp;

    /**
     * Variavel que contem o recibo
     * 
     * @var string
     */
    public $recibo;

    /**
     * Variavel que mantem o tipo de algoritimo
     * 
     * @var string
     */
    public $algoritimo;

    public $canonical;
    

    public function __construct($dados)
    {
        $this->id = $dados->idLote;
        $this->atualizacao = $dados->atualizacao;
        $this->tpAmb = $dados->tpAmb;
        $this->razaoSocial = $dados->razaosocial;
        $this->siglaUF = $dados->siglaUF;
        $this->cnpj = $dados->cnpj;
        $this->schemes = $dados->schemes;
        $this->versao = $dados->versao;
        $this->tokenIBPT = $dados->tokenIBPT;
        $this->certificado = $dados->certificado;
        $this->chave = $dados->chave;
        $this->senha = $dados->senha;
        $this->algoritimo = OPENSSL_ALGO_SHA1;
        $this->canonical = [true, false, null, null];
        $this->certificado = file_get_contents(__DIR__ . '../../../files/' . $this->certificado);
        $this->xmlAssinado = file_get_contents(__DIR__ . '../../../files/xml/' . $this->chave . "");
        $arquivo = fopen('recebeu.txt', 'w');
        $msng = "Senha: "  . $this->senha;
        fwrite($arquivo,  $msng);
        fclose($arquivo);
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
        $this->enviaLote();
    }

    public function enviaLote()
    {

        try {
            //$content = conteúdo do certificado PFX
            $tools = new Tools($this->configJson, Certificate::readPfx($this->certificado, $this->senha));
            $idLote = str_pad(100, 15, '0', STR_PAD_LEFT);
            //envia o xml para pedir autorização ao SEFAZ
            $this->resp = $tools->sefazEnviaLote([$this->xmlAssinado], $idLote);
            //transforma o xml de retorno em um stdClass

            $this->consultaLote();
        } catch (\Exception $e) {
            echo str_replace("\n", "<br/>", "Erro no 'Catch': " . $e->getMessage());
        }
    }

    public function consultaLote()
    {
        $st = new Standardize();
        $std = $st->toStd($this->resp);
        if ($std->cStat != 103) {
            //erro registrar e voltar
            $arquivo = fopen('erroEnvio.txt', 'w');
            $erro = ("[$std->cStat] $std->xMotivo");
            fwrite($arquivo,  $erro);
            fclose($arquivo);
        } else {
            $arquivo = fopen('sucessoEnvio.txt', 'w');
            $retorno = ("$std->infRec");
            fwrite($arquivo,  $retorno);
            fclose($arquivo);
        }
        $this->recibo = $std->infRec->nRec;
    }
}
