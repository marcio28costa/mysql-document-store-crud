<?php

require_once '../app/controllers/ProdutoController.php';

$controller = new ProdutoController();

$controller->salvar(

$_POST['nome'],
$_POST['preco']

);