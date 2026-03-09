# MySQL Document Store Demo (PHP + MySQL JSON)

Projeto de demonstração utilizando **PHP 8.2**, **MySQL 8.0** e **JSON
Document Store**, implementando um pequeno CRUD com arquitetura **MVC
simples**.

O objetivo do projeto é demonstrar como o **MySQL pode ser utilizado
como um banco de documentos (NoSQL)** utilizando colunas JSON, mantendo
compatibilidade com SQL tradicional.

------------------------------------------------------------------------

## Badges

![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple)
![License](https://img.shields.io/badge/license-MIT-green)

------------------------------------------------------------------------

# Arquitetura

    Browser
       │
       │ HTTP
       ▼
    PHP MVC
       │
       │ PDO
       ▼
    MySQL 8
       │
       │ JSON Document
       ▼
    Tabela produtos

------------------------------------------------------------------------

# Tecnologias utilizadas

-   PHP **8.2**
-   MySQL **8.0**
-   JSON Document Store
-   Bootstrap **5**
-   PDO
-   Arquitetura **MVC simples**

------------------------------------------------------------------------

# Estrutura do projeto

    mysql-document-store-crud
    │
    ├── app
    │   ├── controllers
    │   │   └── ProdutoController.php
    │   │
    │   ├── models
    │   │   └── Produto.php
    │   │
    │   └── views
    │       ├── header.php
    │       ├── footer.php
    │       ├── lista.php
    │       └── form.php
    │
    ├── config
    │   └── database.php
    │
    ├── public
    │   ├── index.php
    │   ├── salvar.php
    │   └── deletar.php
    │
    └── README.md

------------------------------------------------------------------------

# Funcionamento

O projeto cria automaticamente:

-   Database `loja`
-   Tabela `produtos`
-   Índice para busca em JSON

Tudo é inicializado automaticamente ao executar o sistema.

Tabela criada:

``` sql
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doc JSON,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

Exemplo de documento armazenado:

``` json
{
  "nome": "Mouse",
  "preco": 80
}
```

------------------------------------------------------------------------

# Query JSON no MySQL

Selecionando atributos do documento:

``` sql
SELECT
JSON_UNQUOTE(JSON_EXTRACT(doc,'$.nome')) AS nome,
JSON_UNQUOTE(JSON_EXTRACT(doc,'$.preco')) AS preco
FROM produtos;
```

Busca por nome:

``` sql
SELECT *
FROM produtos
WHERE JSON_EXTRACT(doc,'$.nome') LIKE '%mouse%';
```

------------------------------------------------------------------------

# Indexação de JSON

Exemplo usado no projeto:

``` sql
CREATE INDEX idx_nome
ON produtos(
    (CAST(JSON_UNQUOTE(JSON_EXTRACT(doc,'$.nome')) AS CHAR(100)))
);
```

------------------------------------------------------------------------

# Generated Columns (performance)

Uma técnica recomendada para melhorar performance é usar **Generated
Columns**.

``` sql
ALTER TABLE produtos
ADD COLUMN nome_virtual VARCHAR(100)
GENERATED ALWAYS AS (
JSON_UNQUOTE(JSON_EXTRACT(doc,'$.nome'))
) STORED;
```

Criando índice:

``` sql
CREATE INDEX idx_nome_virtual
ON produtos(nome_virtual);
```

Essa abordagem melhora significativamente consultas em JSON.

------------------------------------------------------------------------

# Benchmark (conceito)

  Query Type                 Performance
  -------------------------- -------------
  JSON_EXTRACT sem index     lenta
  JSON_EXTRACT com index     média
  Generated Column + index   rápida

Para sistemas grandes recomenda-se **Generated Columns + Index**.

------------------------------------------------------------------------

# Instalação

### 1. Clonar o repositório

    git clone https://github.com/seuusuario/mysql-document-store-crud.git

### 2. Copiar para o servidor web

Exemplo usando **XAMPP**:

    xampp/htdocs/mysql-document-store-crud

### 3. Criar usuário MySQL

``` sql
CREATE USER 'app'@'localhost'
IDENTIFIED BY '4pp.Manag3r';

GRANT ALL PRIVILEGES
ON loja.*
TO 'app'@'localhost';

FLUSH PRIVILEGES;
```

### 4. Abrir o sistema

    http://localhost/mysql-document-store-crud/public

O sistema criará automaticamente:

-   database
-   tabela
-   índices

------------------------------------------------------------------------

# Funcionalidades

✔ Listar produtos\
✔ Inserir produto\
✔ Excluir produto\
✔ Armazenamento JSON\
✔ Interface Bootstrap\
✔ Estrutura MVC

------------------------------------------------------------------------

# Objetivo técnico

Este projeto demonstra na prática:

-   MySQL JSON Document Store
-   Indexação de documentos
-   PHP MVC simples
-   Integração PHP + MySQL
-   Técnicas de performance com JSON

------------------------------------------------------------------------

# Autor

Projeto criado para estudo e demonstração técnica.
