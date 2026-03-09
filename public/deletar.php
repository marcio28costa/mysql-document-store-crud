<?php

require_once '../app/controllers/ProdutoController.php';

$controller = new ProdutoController();

$controller->deletar($_GET['id']);