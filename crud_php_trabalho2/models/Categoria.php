<?php
/*
Curso: Engenharia de Software
Disciplina: Linguagem e Tecnicas de Programacao
Professor: Flores
Turma: ESOFT-2
Componentes:
          260081732 - Alan Cristian dos Santos Costa
          260071312 - Gabriel Felipe Albano Grendel
          260140792 - Gustavo Ramos Marcondes
          260052892 - Marcio Jose Aguiar Filho
          260103602 - Victor Asaf Antunes dos Santos
Data: 03 de Novembro de 2026
Descritivo: Sistema CRUD em PHP com MySQL - Módulo Model de categorias.
*/
class Categoria { // Define as operações da tabela de categorias.
    private $conn; // Guarda a conexão com o banco de dados.
    public function __construct($db) { $this->conn = $db; } // Recebe e guarda a conexão.
    public function listar() { return $this->conn->query('SELECT * FROM categorias ORDER BY nome')->fetchAll(PDO::FETCH_ASSOC); } // Busca todas as categorias por nome.
    public function buscar($id) { $q = $this->conn->prepare('SELECT * FROM categorias WHERE id = ?'); $q->execute([$id]); return $q->fetch(PDO::FETCH_ASSOC); } // Busca uma categoria pelo identificador.
    public function salvar($nome, $id = null) { // Cria uma categoria ou altera uma existente.
        if ($id) { $q = $this->conn->prepare('UPDATE categorias SET nome = ? WHERE id = ?'); return $q->execute([$nome, $id]); } // Atualiza a categoria quando já existe um identificador.
        $q = $this->conn->prepare('INSERT INTO categorias (nome) VALUES (?)'); return $q->execute([$nome]); // Cria uma categoria nova.
    }
    public function excluir($id) { $q = $this->conn->prepare('DELETE FROM categorias WHERE id = ?'); return $q->execute([$id]); } // Exclui a categoria informada.
}
?>

