<?php

require_once __DIR__ . '/../models/Produto.php';

class ProdutoController {

    private $produto;

    public function __construct(){

        $this->produto = new Produto();

    }

    public function index(){

        $dados = $this->produto->listar();

        include __DIR__ . '/../views/lista.php';

    }

    public function salvar($nome,$preco){

        $this->produto->inserir($nome,$preco);

        header("Location: index.php");

    }

    public function deletar($id){

        $this->produto->deletar($id);

        header("Location: index.php");

    }

}
