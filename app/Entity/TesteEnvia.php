<?php

namespace App\Entity;

use NFePHP\NFe\Convert;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;

class TesteEnvia
{


    function tentaEnvio()
    {

        $config = [
            "atualizacao" => "2018-02-06 06:01:21",
            "tpAmb" => 2, // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
            "razaosocial" => "Empresa teste",
            "siglaUF" => "SP",
            "cnpj" => "78767865000156",
            "schemes" => "PL_008i2",
            "versao" => "4.00",
            "tokenIBPT" => "AAAAAAA"
        ];
        $configJson = json_encode($config);

        $xml = file_get_contents(__DIR__ . '../../../files/xml/172367524284173366bd326a649f9-nfe.xml');
        $content = file_get_contents(__DIR__ . '../../../files/1721179335-168760-66971cc73a5d2.pfx');


        try {
            //$content = conteúdo do certificado PFX
            $tools = new Tools($configJson, Certificate::readPfx($content, 'minhasenha'));
            $idLote = str_pad(100, 15, '0', STR_PAD_LEFT);
            //envia o xml para pedir autorização ao SEFAZ
            $resp = $tools->sefazEnviaLote([$xml], $idLote);
            //transforma o xml de retorno em um stdClass
            $st = new Standardize();
            $std = $st->toStd($resp);
            if ($std->cStat != 103) {
                //erro registrar e voltar
                return "[$std->cStat] $std->xMotivo";
            }
            $recibo = $std->infRec->nRec;
            //esse recibo deve ser guardado para a proxima operação que é a consulta do recibo
            header('Content-type: text/xml; charset=UTF-8');
            echo $resp;
        } catch (\Exception $e) {
            echo str_replace("\n", "<br/>", "Erro no 'Catch: '" . $e->getMessage());
        }
    }
}
