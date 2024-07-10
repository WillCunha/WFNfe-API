<?php

use App\GeraNfe;
use App\InsereVenda;
//|| $param == ''

if ($acao == '') {
    echo json_encode(["Erro:" => "Ação não permitida"]);
} else if ($acao != '' && $param != '') {
    if ($acao == 'gera-nfe') {
        //$dadosIngressos = GeraNfe::GeraNFE($param);
        //$insereDados =  new InsereVenda($param);
        //echo json_encode(["dados" => $insereDados]);
    }
}
