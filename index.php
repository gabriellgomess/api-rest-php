<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// Headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");

// Incluindo arquivos de configuração e objetos
include_once 'config/database.php';
include_once 'objects/produto.php';

// Função para ler dados da entrada padrão
function readInput() {
    return json_decode(file_get_contents("php://input"));
}

// Função para enviar resposta HTTP
function sendResponse($code, $message) {
    http_response_code($code);
    echo json_encode(["message" => $message]);
}

// Inicializando banco de dados e objeto produto
$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

// Lendo método da requisição e URI
$requestMethod = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER['REQUEST_URI'];
$endpoints = explode("/", $uri);

// Lógica do CRUD
if (isset($endpoints[3]) && $endpoints[3] === "produtos") {
    $data = readInput();  // Lê o JSON da entrada padrão
    
    switch ($requestMethod) {
        case 'GET':
            $stmt = $produto->ler();
            $produtos = [];
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($produtos, $row);
            }
            
            sendResponse(200, $produtos);
            break;

        case 'POST':
            if (!empty($data->nome) && !empty($data->preco)) {
                $produto->nome = $data->nome;
                $produto->preco = $data->preco;
                
                if ($produto->criar()) {
                    sendResponse(201, "Produto criado");
                } else {
                    sendResponse(503, "Falha ao criar produto");
                }
            } else {
                sendResponse(400, "Dados incompletos");
            }
            break;

        case 'DELETE':
            if (!empty($data->id)) {
                $produto->id = $data->id;
                
                if ($produto->deletar()) {
                    sendResponse(200, "Produto deletado");
                } else {
                    sendResponse(503, "Falha ao deletar produto");
                }
            } else {
                sendResponse(400, "Dados incompletos");
            }
            break;

        case 'PUT':
            if (!empty($data->id) && !empty($data->nome) && !empty($data->preco)) {
                $produto->id = $data->id;
                $produto->nome = $data->nome;
                $produto->preco = $data->preco;
                
                if ($produto->atualizar()) {
                    sendResponse(200, "Produto atualizado");
                } else {
                    sendResponse(503, "Falha ao atualizar produto");
                }
            } else {
                sendResponse(400, "Dados incompletos");
            }
            break;

        default:
            sendResponse(405, "Método não permitido");
            break;
    }
} else {
    sendResponse(404, "Endpoint não encontrado");
}


// ENDPOINT
// https://gabriellgomess.com/api-rest/index.php/produtos
