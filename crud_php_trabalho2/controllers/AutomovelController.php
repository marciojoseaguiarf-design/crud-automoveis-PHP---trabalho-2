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
Descritivo: Sistema CRUD em PHP com MySQL - Módulo Controller de automóveis.
*/
require_once __DIR__ . '/../models/Automovel.php'; // Carrega as operações do modelo Automovel.
class AutomovelController { // Recebe os pedidos da tela e os encaminha ao modelo.
    private $model; // Guarda o modelo que acessa a tabela de automóveis.
    public function __construct($db) { $this->model = new Automovel($db); } // Cria o modelo usando a conexão recebida.
    public function listar() { return $this->model->listar(); } // Pede ao modelo a lista de automóveis.
    public function buscar($id) { return $this->model->buscar($id); } // Pede ao modelo um automóvel pelo identificador.
    public function salvar($dados, $id = null) { return $this->model->salvar($dados, $id); } // Encaminha os dados para criar ou atualizar.
    public function excluir($id) { return $this->model->excluir($id); } // Pede ao modelo para excluir um automóvel.
}
?>
