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
Descritivo: Cabeçalho e navegação compartilhados pelas páginas do sistema.
*/
?>
<?php $titulo = $titulo ?? 'CRUD simples'; // Usa o título informado ou define um padrão. ?>
<!-- Inicia a página em HTML5 e define o idioma como português do Brasil. -->
<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= htmlspecialchars($titulo) ?></title><link rel="stylesheet" href="css/style.css"></head><body>
<!-- Mostra o título e os links de navegação para cada área do sistema. -->
<header><h1>Cadastro de Automóveis</h1><nav><a href="index.php?page=automoveis">Automóveis</a><a href="index.php?page=produtos">Produtos</a><a href="index.php?page=categorias">Categorias</a></nav></header><main>
<?php if (!empty($_GET['mensagem'])): // Mostra uma mensagem quando a URL contém uma. ?><p class="mensagem"><?= htmlspecialchars($_GET['mensagem']) ?></p><?php endif; // Termina a verificação da mensagem. ?>

