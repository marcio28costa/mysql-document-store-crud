<?php

require_once '../app/controllers/ProdutoController.php';

$controller = new ProdutoController();

if(isset($_GET['novo'])){

    include '../app/views/form.php';

}else{

    $controller->index();

}