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
Descritivo: Sistema CRUD em PHP com MySQL - Módulo Controller de produtos.
*/
require_once __DIR__ . '/../models/Produto.php'; // Carrega as operações do modelo Produto.
require_once __DIR__ . '/../models/Categoria.php'; // Carrega o modelo usado para buscar categorias.
class ProdutoController { // Recebe os pedidos da tela de produtos.
    private $model; // Guarda o modelo que acessa os produtos.
    private $categorias; // Guarda o modelo que acessa as categorias.
    public function __construct($db) { $this->model = new Produto($db); $this->categorias = new Categoria($db); } // Cria os dois modelos com a mesma conexão.
    public function listar() { return $this->model->listar(); } // Pede ao modelo a lista de produtos.
    public function buscar($id) { return $this->model->buscar($id); } // Pede ao modelo um produto pelo identificador.
    public function listarCategorias() { return $this->categorias->listar(); } // Busca categorias para preencher o formulário.
    public function salvar($dados, $id = null) { return $this->model->salvar($dados, $id); } // Encaminha os dados para criar ou atualizar o produto.
    public function excluir($id) { return $this->model->excluir($id); } // Pede ao modelo para excluir um produto.
}
?>

