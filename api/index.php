<?php

require "../vendor/autoload.php";

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['path'])) {
    $path = explode('/', $_GET['path']);
} else {
    echo json_encode(["dados" => "Caminho não existe!"]);
};

if (isset($path[0])) {
    $api = $path[0];
} else {
    echo json_encode(["dados" => "Caminho incorreto!"]);
}
if (isset($path[1])) {
    $acao = $path[1];
} else {
    $acao = "Teste";
}
if (isset($path[2])) {
    $param = $path[2];
} else {
    $param = "Teste Seila";
}

$method = $_SERVER['REQUEST_METHOD'];
include_once "Engine/listener.php";