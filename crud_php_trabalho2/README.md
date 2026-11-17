<!--
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
Descritivo: Documentação do sistema CRUD em PHP com MySQL.
-->
# CRUD simples em PHP e MySQL

Cadastro, listagem, edição e exclusão de automóveis, produtos e categorias. O projeto usa PHP, PDO e uma estrutura MVC simples.

## Requisitos
- XAMPP com Apache e MySQL
- PHP 7.4 ou superior com PDO MySQL

## Executar pela primeira vez
1. Copie a pasta `crud_php_mvc_simples` para `C:\xampp\htdocs\`.
2. Inicie Apache e MySQL pelo painel do XAMPP.
3. Acesse `http://localhost/phpmyadmin` e importe `database.sql`.
4. Se seu MySQL usar outras credenciais, altere `config/database.php`.
5. Abra `http://localhost/crud_php_mvc_simples/public/`.

## Banco já existente
Para adicionar o CRUD de automóveis sem repetir as categorias e produtos de exemplo, abra `database.sql` e execute somente o bloco `CREATE TABLE IF NOT EXISTS automoveis` no phpMyAdmin. Em um banco antigo, faça backup e execute no phpMyAdmin: `ALTER TABLE automoveis DROP COLUMN modelo;` e `ALTER TABLE automoveis DROP COLUMN placa;`.

## Campos do automóvel
Marca, ano, cor e preço.

Preencha os nomes e RAs nos cabeçalhos dos arquivos antes de entregar.
