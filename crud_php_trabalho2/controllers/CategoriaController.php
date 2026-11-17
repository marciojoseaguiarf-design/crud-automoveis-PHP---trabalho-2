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
Descritivo: Sistema CRUD em PHP com MySQL - Módulo Controller de categorias.
*/
require_once __DIR__ . '/../models/Categoria.php'; // Carrega as operações do modelo Categoria.
class CategoriaController { // Recebe os pedidos da tela de categorias.
    private $model; // Guarda o modelo responsável pelas categorias.
    public function __construct($db) { $this->model = new Categoria($db); } // Cria o modelo usando a conexão recebida.
    public function listar() { return $this->model->listar(); } // Pede ao modelo a lista de categorias.
    public function buscar($id) { return $this->model->buscar($id); } // Pede ao modelo uma categoria pelo identificador.
    public function salvar($nome, $id = null) { return $this->model->salvar($nome, $id); } // Encaminha o nome para criar ou atualizar.
    public function excluir($id) { return $this->model->excluir($id); } // Pede ao modelo para excluir uma categoria.
}
?>

