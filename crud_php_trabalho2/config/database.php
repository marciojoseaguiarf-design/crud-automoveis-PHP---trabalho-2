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
Descritivo: Conexão do sistema ao banco de dados MySQL.
*/
class Database { // Guarda os dados e cria a conexão com o banco.
    private $host = 'localhost'; // Define o endereço do servidor MySQL.
    private $db_name = 'crud_php_mvc_simples'; // Define o nome do banco usado pelo sistema.
    private $username = 'root'; // Define o usuário do banco.
    private $password = ''; // Define a senha do usuário do banco.
    public $conn; // Guarda a conexão criada.

    public function getConnection() { // Prepara e retorna a conexão com MySQL.
        $this->conn = null; // Começa sem uma conexão aberta.
        try { // Tenta abrir a conexão com o banco.
            $this->conn = new PDO( // Cria uma nova conexão usando PDO.
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Faz o PDO informar erros como exceções.
        } catch (PDOException $erro) { // Trata falhas ao conectar.
            die('Erro ao conectar ao banco. Confira o MySQL e config/database.php.'); // Mostra uma mensagem e para se a conexão falhar.
        }
        return $this->conn; // Entrega a conexão para o restante do sistema.
    }
}
?>


