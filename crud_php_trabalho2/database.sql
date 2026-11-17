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
Descritivo: Criação do banco de dados e das tabelas do sistema CRUD.
*/
CREATE DATABASE IF NOT EXISTS crud_php_mvc_simples CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; -- Cria o banco se ele ainda não existir.
USE crud_php_mvc_simples; -- Define o banco onde as próximas tabelas serão criadas.
CREATE TABLE IF NOT EXISTS categorias ( -- Cria a tabela de categorias se ela ainda não existir.
    id INT AUTO_INCREMENT PRIMARY KEY, -- Cria o identificador automático de cada categoria.
    nome VARCHAR(255) NOT NULL -- Guarda o nome obrigatório da categoria.
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; -- Define armazenamento e codificação da tabela de categorias.
CREATE TABLE IF NOT EXISTS produtos ( -- Cria a tabela de produtos se ela ainda não existir.
    id INT AUTO_INCREMENT PRIMARY KEY, -- Cria o identificador automático de cada produto.
    nome VARCHAR(255) NOT NULL, -- Guarda o nome obrigatório do produto.
    descricao TEXT, -- Guarda uma descrição opcional do produto.
    preco DECIMAL(10,2) NOT NULL, -- Guarda o preço obrigatório do produto.
    categoria_id INT NOT NULL, -- Guarda a categoria ligada ao produto.
    CONSTRAINT fk_produto_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE -- Liga o produto à categoria e apaga produtos quando a categoria for removida.
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; -- Define armazenamento e codificação da tabela de produtos.
INSERT INTO categorias (nome) VALUES ('Eletrônicos'),('Livros'),('Vestuário'); -- Insere três categorias de exemplo.
INSERT INTO produtos (nome, descricao, preco, categoria_id) VALUES -- Começa a inserir produtos de exemplo.
('Smartphone X','Um smartphone de exemplo.',1200.00,1), -- Insere um produto eletrônico.
('Livro de exemplo','Um livro de exemplo.',85.50,2), -- Insere um livro.
('Camiseta básica','Camiseta de algodão.',35.90,3); -- Insere uma peça de vestuário.

-- A próxima tabela guarda os automóveis cadastrados.
CREATE TABLE IF NOT EXISTS automoveis ( -- Cria a tabela de automóveis se ela ainda não existir.
    id INT AUTO_INCREMENT PRIMARY KEY, -- Cria o identificador automático de cada automóvel.
    marca VARCHAR(100) NOT NULL, -- Guarda a marca obrigatória do automóvel.
    ano SMALLINT NOT NULL, -- Guarda o ano obrigatório do automóvel.
    cor VARCHAR(50) NOT NULL, -- Guarda a cor obrigatória do automóvel.
    preco DECIMAL(10,2) NOT NULL -- Guarda o preço obrigatório do automóvel.
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; -- Define armazenamento e codificação da tabela de automóveis.

