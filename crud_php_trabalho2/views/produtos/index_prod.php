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
Descritivo: Sistema CRUD em PHP com MySQL - Módulo View de produtos.
*/
$titulo = 'Produtos'; require __DIR__ . '/../includes/header.php'; // Define o título e inclui o cabeçalho compartilhado.
$acao = $_GET['action'] ?? 'list'; // Lê a ação escolhida na URL.
$item = $item ?? ['nome'=>'','descricao'=>'','preco'=>'','categoria_id'=>'']; // Prepara campos vazios para um produto novo.
?>
<?php if ($acao === 'create' || $acao === 'edit'): // Mostra o formulário de cadastro ou edição. ?>
<!-- Indica se será criado ou editado um produto. -->
<h2><?= $acao === 'edit' ? 'Editar produto' : 'Novo produto' ?></h2>
<!-- Envia os campos ao roteador e inclui o identificador ao editar. -->
<form method="post" action="index.php?page=produtos&action=save<?= $acao === 'edit' ? '&id=' . (int)$item['id'] : '' ?>">
<!-- Campo obrigatório com o nome do produto. -->
<label>Nome<input name="nome" required maxlength="255" value="<?= htmlspecialchars($item['nome']) ?>"></label>
<!-- Campo opcional com a descrição do produto. -->
<label>Descrição<textarea name="descricao"><?= htmlspecialchars($item['descricao'] ?? '') ?></textarea></label>
<!-- Campo numérico para informar o preço. -->
<label>Preço<input type="number" name="preco" min="0" step="0.01" required value="<?= htmlspecialchars((string)$item['preco']) ?>"></label>
<!-- Lista as categorias para associar uma ao produto. -->
<label>Categoria<select name="categoria_id" required><option value="">Escolha uma categoria</option><?php foreach ($categorias as $cat): ?><option value="<?= (int)$cat['id'] ?>" <?= (int)$item['categoria_id'] === (int)$cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['nome']) ?></option><?php endforeach; ?></select></label>
<!-- Botão envia os dados; link volta à lista. -->
<button>Salvar</button> <a href="index.php">Voltar</a></form>
<?php else: // Caso contrário, exibe os produtos cadastrados. ?>
<!-- Mostra o título e o link para adicionar produto. -->
<h2>Produtos</h2><a class="botao" href="index.php?page=produtos&action=create">+ Novo produto</a>
<?php if (!$produtos): // Mostra um aviso quando não houver produtos. ?><p>Nenhum produto cadastrado.</p><?php else: // Caso existam produtos, monta a tabela. ?>
<!-- Cabeçalho com as informações apresentadas na lista. -->
<table><tr><th>Nome</th><th>Categoria</th><th>Preço</th><th>Ações</th></tr>
<!-- Repete uma linha com os dados e ações de cada produto. -->
<?php foreach ($produtos as $p): ?><tr><td><?= htmlspecialchars($p['nome']) ?></td><td><?= htmlspecialchars($p['categoria']) ?></td><td>R$ <?= number_format((float)$p['preco'],2,',','.') ?></td><td><a href="index.php?page=produtos&action=edit&id=<?= (int)$p['id'] ?>">Editar</a> · <a onclick="return confirm('Excluir este produto?')" href="index.php?page=produtos&action=delete&id=<?= (int)$p['id'] ?>">Excluir</a></td></tr><?php endforeach; // Termina a repetição das linhas. ?></table><?php endif; // Termina a verificação da lista vazia. ?>
<?php endif; // Termina a escolha entre formulário e listagem. ?>
<?php require __DIR__ . '/../includes/footer.php'; // Inclui o rodapé compartilhado. ?>
