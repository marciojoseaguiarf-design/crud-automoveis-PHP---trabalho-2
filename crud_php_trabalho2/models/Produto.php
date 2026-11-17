a <?php
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
Descritivo: Sistema CRUD em PHP com MySQL - Módulo Model de produtos.
*/
class Produto { // Define as operações da tabela de produtos.
    private $conn; // Guarda a conexão que será usada nas consultas.
    public function __construct($db) { $this->conn = $db; } // Recebe e guarda a conexão com o banco.
    public function listar() { // Define a operação que lista produtos e suas categorias.
        $sql = 'SELECT p.*, c.nome AS categoria FROM produtos p JOIN categorias c ON p.categoria_id = c.id ORDER BY p.nome'; // Busca produtos junto com o nome da categoria.
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados em listas associativas.
    }
    public function buscar($id) { $q = $this->conn->prepare('SELECT * FROM produtos WHERE id = ?'); $q->execute([$id]); return $q->fetch(PDO::FETCH_ASSOC); } // Busca um produto pelo identificador.
    public function salvar($dados, $id = null) { // Cria um produto ou altera um existente.
        if ($id) { // Se recebeu um identificador, atualiza o produto.
            $q = $this->conn->prepare('UPDATE produtos SET nome=?, descricao=?, preco=?, categoria_id=? WHERE id=?'); // Prepara a atualização do produto existente.
            return $q->execute([$dados['nome'], $dados['descricao'], $dados['preco'], $dados['categoria_id'], $id]); // Atualiza o produto com os valores informados.
        }
        $q = $this->conn->prepare('INSERT INTO produtos (nome, descricao, preco, categoria_id) VALUES (?, ?, ?, ?)'); // Prepara a inclusão de um produto novo.
        return $q->execute([$dados['nome'], $dados['descricao'], $dados['preco'], $dados['categoria_id']]); // Grava os dados do produto no banco.
    }
    public function excluir($id) { $q = $this->conn->prepare('DELETE FROM produtos WHERE id = ?'); return $q->execute([$id]); } // Exclui o produto informado.
}
?>

