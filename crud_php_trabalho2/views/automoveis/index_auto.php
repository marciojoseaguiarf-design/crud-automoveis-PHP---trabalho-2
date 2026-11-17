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
Descritivo: Sistema CRUD em PHP com MySQL - Módulo View de automóveis.
*/
$titulo = 'Automóveis'; require __DIR__ . '/../includes/header.php'; // Define o título e mostra o cabeçalho compartilhado.
$acao = $_GET['action'] ?? 'list'; // Lê a ação para escolher entre formulário e lista.
$item = $item ?? ['marca'=>'','ano'=>'','cor'=>'','preco'=>'']; // Prepara campos vazios quando for um cadastro novo.
?>
<?php if ($acao === 'create' || $acao === 'edit'): // Abre o formulário para criar ou editar. ?>
<!-- Mostra um título que indica se o automóvel será criado ou editado. -->
<h2><?= $acao === 'edit' ? 'Editar automóvel' : 'Novo automóvel' ?></h2>
<!-- Envia os campos para o roteador, incluindo o identificador ao editar. -->
<form method="post" action="index.php?page=automoveis&action=save<?= $acao === 'edit' ? '&id=' . (int)$item['id'] : '' ?>">
<!-- Campo para a marca do automóvel. -->
<label>Marca<input name="marca" required maxlength="100" value="<?= htmlspecialchars((string)($item['marca'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"></label>
<!-- Campo numérico para o ano do automóvel. -->
<label>Ano<input type="number" name="ano" min="1886" max="<?= (int)date('Y') + 1 ?>" required value="<?= htmlspecialchars((string)($item['ano'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"></label>
<!-- Campo para a cor do automóvel. -->
<label>Cor<input name="cor" required maxlength="50" value="<?= htmlspecialchars((string)($item['cor'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"></label>
<!-- Campo numérico para o preço. -->
<label>Preço<input type="number" name="preco" min="0" step="0.01" required value="<?= htmlspecialchars((string)($item['preco'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"></label>
<!-- Botão envia o formulário; link retorna à listagem. -->
<button>Salvar</button> <a href="index.php?page=automoveis">Voltar</a></form>
<?php else: // Se não for formulário, mostra a lista de automóveis. ?>
<!-- Apresenta o título da listagem. -->
<h2>Automóveis</h2><a class="botao" href="index.php?page=automoveis&action=create">+ Novo automóvel</a>
<?php if (!$automoveis): // Mostra aviso se não houver registros. ?><p>Nenhum automóvel cadastrado.</p><?php else: // Caso contrário, monta a tabela. ?>
<!-- Cabeçalho da tabela com os dados dos automóveis. -->
<table><tr><th>Marca</th><th>Ano</th><th>Cor</th><th>Preço</th><th>Ações</th></tr>
<?php foreach ($automoveis as $a): // Repete uma linha para cada automóvel. ?><tr>
<!-- Mostra a marca sem interpretar caracteres como HTML. -->
<td><?= htmlspecialchars($a['marca'], ENT_QUOTES, 'UTF-8') ?></td>
<!-- Mostra o ano como número inteiro. -->
<td><?= (int)$a['ano'] ?></td>
<!-- Mostra a cor sem interpretar caracteres como HTML. -->
<td><?= htmlspecialchars($a['cor'], ENT_QUOTES, 'UTF-8') ?></td>
<!-- Exibe o preço em formato de moeda brasileira. -->
<td>R$ <?= number_format((float)$a['preco'], 2, ',', '.') ?></td>
<!-- Links permitem editar ou pedir confirmação antes de excluir. -->
<td><a href="index.php?page=automoveis&action=edit&id=<?= (int)$a['id'] ?>">Editar</a> · <a onclick="return confirm('Excluir este automóvel?')" href="index.php?page=automoveis&action=delete&id=<?= (int)$a['id'] ?>">Excluir</a></td>
</tr><?php endforeach; // Termina a repetição das linhas. ?></table><?php endif; // Termina a verificação de lista vazia. ?>
<?php endif; // Termina a escolha entre formulário e listagem. ?>
<?php require __DIR__ . '/../includes/footer.php'; // Mostra o rodapé compartilhado. ?>
