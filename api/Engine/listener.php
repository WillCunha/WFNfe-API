<?php

namespace Api\Eventos;

use App\GeraNfe;
use App\InsereVenda;

if ($api == 'gera') {
    if ($method == 'POST') {
        require_once('Controller.php');
    }else{
        echo json_encode(["Erro: " => $method]);
    }
}else{
    echo json_encode(["Erro: " => "Lugar errado, amigão!"]); 
}