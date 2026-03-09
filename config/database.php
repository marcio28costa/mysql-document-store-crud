<?php

class Database {

    public static function conectar(){

        $host = "localhost";
        $db   = "loja";
        $user = "app";
        $pass = "4pp.Manag3r";

        try {

            // conexão inicial
            $pdo = new PDO(
                "mysql:host=$host;charset=utf8mb4",
                $user,
                $pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // cria database
            $pdo->exec("
                CREATE DATABASE IF NOT EXISTS $db
                CHARACTER SET utf8mb4
                COLLATE utf8mb4_general_ci
            ");

            // conecta no database
            $pdo = new PDO(
                "mysql:host=$host;dbname=$db;charset=utf8mb4",
                $user,
                $pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // cria tabela
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS produtos (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    doc JSON,
                    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");

            return $pdo;

        } catch (PDOException $e) {

            die("Erro de conexão: " . $e->getMessage());

        }

    }

}
