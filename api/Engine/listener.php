<?php

namespace Api\Eventos;

use App\GeraNfe;
use App\InsereVenda;

if ($api == 'gera') {
    if ($method == 'GET') {
        require_once('Controller.php');
    }else{
        require_once('Controller.php');
        $fp = fopen('php://input', 'r');
        $rawData = stream_get_contents($fp);
        $data =  json_decode($rawData);
        new InsereVenda($data);
        $arquivo = fopen('qualquercoisa.json', 'w');
        fwrite($arquivo, $rawData);
        fclose($arquivo);

        $geraNfe = new GeraNfe;
        geraNfe::$chave = $data->chave;
        geraNfe::$razaoSocialEmissor = $data->razaoSocialEmissor;
        geraNfe::$ieEmissor = $data->ieEmissor;
        geraNfe::$cnpjEmisor = $data->cnpjEmissor;
        geraNfe::$siglaUFEmissor = $data->ufEmissor;
        geraNfe::$ruaEmissor = $data->ruaEmissor;
        geraNfe::$numeroRuaEmissor = $data->numeroRuaEmissor;
        geraNfe::$nomeBairroEmissor = $data->nomeBairroEmissor;
        geraNfe::$codigoMunicipioEmissor = $data->codigoMunicipioEmissor;
        geraNfe::$nomeCidadeEmissor = $data->nomeCidadeEmissor;
        geraNfe::$cepEmissor = $data->cepEmissor;
        geraNfe::$codigoPaisEmissor = $data->codigoPaisEmissor;
        geraNfe::$nomePaisEmissor = $data->nomePaisEmissor;
        
        geraNfe::$razaoSocialDest = $data->razaoSocialEmissorDest;
        geraNfe::$indIEDest = $data->indIEDest;
        geraNfe::$cnpjDest = $data->cnpjDest;
        geraNfe::$ruaDest = $data->ruaDest;
        geraNfe::$numeroRuaDest = $data->numeroRuaDet;
        geraNfe::$nomeBairroDest = $data->nomeBairroDest;
        geraNfe::$codigoMunicipioDest = $data->codigoMunicipioDest;
        geraNfe::$nomeCidadeDest = $data->nomeCidadeDest;
        geraNfe::$siglaUFDest = $data->siglaUFDest;
        geraNfe::$cepDest = $data->cepEmissorDest;
        
        geraNfe::$arrayProdutos = $data->produtos;

        geraNfe::$modFrete = $data->modFrete;
        geraNfe::$quantidadeVol = $data->quantidadeVol;
        geraNfe::$especie = $data->especie;
        geraNfe::$marcaCaixa = $data->marcaCiaxa;
        geraNfe::$peso = $data->pesoLiquido;
        geraNfe::$quantidadeParcelas = $data->quantidadeParcelas;
        $dados = GeraNfe::GeraNFE();
        //$venda->quantidade = $data->quantidade;
        //$atualiza = $venda->atualiza();
    }
}