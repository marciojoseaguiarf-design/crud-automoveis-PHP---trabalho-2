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
Descritivo: Sistema CRUD em PHP com MySQL - Módulo View de categorias.
*/
$titulo = 'Categorias'; require __DIR__ . '/../includes/header.php'; // Define o título e inclui o cabeçalho compartilhado.
$acao = $_GET['action'] ?? 'list'; // Lê a ação escolhida na URL.
$item = $item ?? ['nome'=>'']; // Prepara um campo vazio para uma categoria nova.
?>
<?php if ($acao === 'create' || $acao === 'edit'): // Mostra o formulário de cadastro ou edição. ?>
<!-- Informa se a pessoa está criando ou editando uma categoria. -->
<h2><?= $acao === 'edit' ? 'Editar categoria' : 'Nova categoria' ?></h2>
<!-- Envia o nome da categoria ao roteador e inclui o identificador ao editar. -->
<form method="post" action="index.php?page=categorias&action=save<?= $acao === 'edit' ? '&id=' . (int)$item['id'] : '' ?>"><label>Nome<input name="nome" required maxlength="255" value="<?= htmlspecialchars($item['nome']) ?>"></label><button>Salvar</button> <a href="index.php?page=categorias">Voltar</a></form>
<?php else: // Caso contrário, exibe a lista de categorias. ?>
<!-- Mostra o título e o link para adicionar categoria. -->
<h2>Categorias</h2><a class="botao" href="index.php?page=categorias&action=create">+ Nova categoria</a>
<?php if (!$categorias): // Exibe um aviso quando não houver categorias. ?><p>Nenhuma categoria cadastrada.</p><?php else: // Caso existam, monta a tabela. ?>
<!-- Cabeçalho com o nome e as ações disponíveis. -->
<table><tr><th>Nome</th><th>Ações</th></tr><?php foreach ($categorias as $c): // Repete uma linha para cada categoria. ?><tr><td><?= htmlspecialchars($c['nome']) ?></td><td><a href="index.php?page=categorias&action=edit&id=<?= (int)$c['id'] ?>">Editar</a> · <a onclick="return confirm('Excluir esta categoria e os produtos dela?')" href="index.php?page=categorias&action=delete&id=<?= (int)$c['id'] ?>">Excluir</a></td></tr><?php endforeach; // Termina a repetição. ?></table><?php endif; // Termina a verificação da lista vazia. ?>
<?php endif; // Termina a escolha entre formulário e listagem. ?>
<?php require __DIR__ . '/../includes/footer.php'; // Inclui o rodapé compartilhado. ?>
