<?php

use App\Entity\AssinaNfe;
use App\Entity\EnviaLote;
use App\File\Upload;
use App\Entity\GeraNfe;
use App\InsereVenda;
//|| $param == ''


if ($acao == '') {
    echo json_encode(["Erro:" => "Ação não permitida"]);
} else if ($acao != '' && $param != '') {
    if ($acao == 'gera-nfe') {
        $fp = fopen('php://input', 'r');
        $rawData = stream_get_contents($fp);
        $data =  json_decode($rawData);
        //new InsereVenda($data);
        $arquivo = fopen('qualquercoisa.json', 'w');
        fwrite($arquivo, $rawData);
        fclose($arquivo);

        $geraNfe = new GeraNfe;

        geraNfe::$totalVenda = $data->valor_total;
        GeraNfe::$tipoPagamento = $data->tipo_pagamento;

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
        echo json_encode(["dados" => $dados]);
    } else if ($acao == 'grava-certificado') {
        if (isset($_FILES['certificado']['tmp_name'])) {
            $upload = new Upload($_FILES['certificado']);
            $upload->name = $param;
            $upload->upload(__DIR__ . './../../files');
        } else {
            echo json_encode(["Erro: " => "É necessário informar um arquivo."]);
        }
    } else if ($acao == 'assina-nfe') {
        $fp = fopen('php://input', 'r');
        $rawData = stream_get_contents($fp);
        $data =  json_decode($rawData);
        $assinaNfe = new AssinaNfe($data, $param);
    } else if ($acao == 'envia-lote') {
        $fp = fopen('php://input', 'r');
        $rawData = stream_get_contents($fp);
        $data =  json_decode($rawData);
        // $data = [
        //     'idLote' => '0000100',
        //     'atualizacao' => '2024-07-07 06:01:21',
        //     'tpAmb' => 2,
        //     'razaoSocial' => 'Teste dos Testes S.A.',
        //     'siglaUF' => 'SP',
        //     'cnpj' => '05832532000129',
        //     'schemes' => 'PL_009_V4',
        //     'versao' => '4.00',
        //     'tokenIBPT' => 'aaaaa',
        //     'certificado' => '1721179335-168760-66971cc73a5d2.pfx',
        //     'chave' => '172185447519959566a16a0b7f2fe-nfe.xml',
        //     'senha' => 'minhasenha',
        // ];
        $enviaLote = new EnviaLote($data);

    }
}
