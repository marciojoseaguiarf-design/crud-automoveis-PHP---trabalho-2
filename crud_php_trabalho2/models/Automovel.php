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
Descritivo: Sistema CRUD em PHP com MySQL - Módulo Model de automóveis.
*/
class Automovel { // Define as consultas e alterações da tabela de automóveis.
    private $conn; // Guarda a conexão que será usada nas consultas.
    public function __construct($db) { $this->conn = $db; } // Recebe e guarda a conexão com o banco.

    public function listar() { // Define a operação que lista os automóveis.
        // Busca todos os automóveis e organiza o resultado por marca e ano.
        return $this->conn->query('SELECT * FROM automoveis ORDER BY marca, ano')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id) { // Define a operação que busca um automóvel.
        $q = $this->conn->prepare('SELECT * FROM automoveis WHERE id = ?'); // Prepara a busca de um automóvel pelo identificador.
        $q->execute([$id]); // Executa a busca usando o identificador recebido.
        return $q->fetch(PDO::FETCH_ASSOC); // Retorna os dados encontrados como uma lista associativa.
    }

    public function salvar($dados, $id = null) { // Define a operação de cadastro ou edição.
        try { // Tenta executar a gravação no banco.
            if ($id) { // Se recebeu um identificador, atualiza o registro existente.
                $q = $this->conn->prepare('UPDATE automoveis SET marca=?, ano=?, cor=?, preco=? WHERE id=?'); // Prepara a atualização do automóvel existente.
                return $q->execute([$dados['marca'], $dados['ano'], $dados['cor'], $dados['preco'], $id]); // Atualiza os campos usando valores preparados.
            }
            $q = $this->conn->prepare('INSERT INTO automoveis (marca, ano, cor, preco) VALUES (?, ?, ?, ?)'); // Prepara a inclusão de um automóvel novo.
            return $q->execute([$dados['marca'], $dados['ano'], $dados['cor'], $dados['preco']]); // Grava os dados recebidos no banco.
        } catch (PDOException $erro) { // Trata um erro ocorrido durante a gravação.
            return false; // Informa que não foi possível salvar os dados.
        }
    }

    public function excluir($id) { // Define a operação de exclusão.
        $q = $this->conn->prepare('DELETE FROM automoveis WHERE id = ?'); // Prepara a exclusão pelo identificador.
        return $q->execute([$id]); // Executa a exclusão e retorna o resultado.
    }
}
?>
