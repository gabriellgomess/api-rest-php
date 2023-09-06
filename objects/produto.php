<?php

class Produto {
    // Propriedades privadas para armazenar a conexão com o banco de dados e o nome da tabela
    private $conn;
    private $table_name = "produtos";
  
    // Propriedades privadas para armazenar os atributos de um produto
    private $id;
    private $nome;
    private $preco;
  
    // Construtor que inicializa a conexão com o banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Métodos getter e setter para as propriedades id, nome e preço
    // Eles também podem incluir lógica para validação
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    // Método para ler todos os produtos da tabela
    public function ler() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
  
    // Método para criar um novo produto na tabela
    // Nota: Os valores de nome e preço devem ser definidos antes de chamar este método
    public function criar() {
        if (empty($this->nome) || empty($this->preco)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " (nome, preco) VALUES (:nome, :preco)";
        $stmt = $this->conn->prepare($query);
        
        // Usa bindParam para associar os parâmetros da consulta às propriedades do objeto
        if (!$stmt->bindParam(":nome", $this->nome) || !$stmt->bindParam(":preco", $this->preco)) {
            return false;
        }
        
        return $stmt->execute();
    }

    // Método para deletar um produto pelo ID
    // Nota: O valor de id deve ser definido antes de chamar este método
    public function deletar() {
        if (empty($this->id)) {
            return false;
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Usa bindParam para associar o parâmetro da consulta à propriedade id do objeto
        if (!$stmt->bindParam(":id", $this->id)) {
            return false;
        }
        
        return $stmt->execute();
    }
  
    // Método para atualizar um produto existente na tabela pelo ID
    // Nota: Os valores de id, nome e preço devem ser definidos antes de chamar este método
    public function atualizar() {
        if (empty($this->id) || empty($this->nome) || empty($this->preco)) {
            return false;
        }

        $query = "UPDATE " . $this->table_name . " SET nome = :nome, preco = :preco WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Usa bindParam para associar os parâmetros da consulta às propriedades do objeto
        if (!$stmt->bindParam(":id", $this->id) || !$stmt->bindParam(":nome", $this->nome) || !$stmt->bindParam(":preco", $this->preco)) {
            return false;
        }

        return $stmt->execute();
    }
}
