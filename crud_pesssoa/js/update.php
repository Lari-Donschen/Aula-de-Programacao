<?php
header('Content-Type: application/json');
//quando for uma requisição com verbo do tipo "PUT"
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {   
    $connection = require("dbfactory.php");
    //captura os dados de entrada da requisição e transforma em objeto no PHP
    $putData = json_decode(file_get_contents('php://input',true));
    $connection = require("dbfactory.php");
    
    $id = $putData->id;
    $nomeNovo = $putData->nome;
    $cpfNovo = $putData->cpf;
    $enderecoNovo = $putData->endereco;

    $sql = @"update todo set description = '$nomeNovo' where idpessoa = $id";
    $sql = @"update todo set description = '$cpfNovo' where idpessoa = $id";
    $sql = @"update todo set description = '$enderecoNovo' where idpessoa = $id";
    if ($connection -> 
        query($sql)) {                 
    }
    $connection -> close();
    //depois de executar a operação, retorna o json enviado    
    $response['body'] = json_encode($putData);
    echo $response['body'];        
} else {
    $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
    echo $response;
}
?>