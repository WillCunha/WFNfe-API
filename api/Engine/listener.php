<?php

namespace Api\Eventos;

use App\GeraNfe;
use App\InsereVenda;

if ($api == 'gera') {
    if ($method == 'POST') {
        require_once('Controller.php');
    }else{
        echo json_encode(["Erro: " => "Não é permitido esse tipo de entrada aqui!"]);
    }
}