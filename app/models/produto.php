<?php

require_once __DIR__ . '/../../config/database.php';

class Produto {

    private $db;

    public function __construct(){

        $this->db = Database::conectar();

    }

    public function listar(){

        $sql = "
            SELECT
            id,
            doc->>'$.nome' AS nome,
            doc->>'$.preco' AS preco
            FROM produtos
            ORDER BY id DESC
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function inserir($nome,$preco){

        $json = json_encode([
            "nome"=>$nome,
            "preco"=>$preco
        ]);

        $stmt = $this->db->prepare(
            "INSERT INTO produtos(doc) VALUES(?)"
        );

        $stmt->execute([$json]);

    }

    public function deletar($id){

        $stmt = $this->db->prepare(
            "DELETE FROM produtos WHERE id=?"
        );

        $stmt->execute([$id]);

    }

}

