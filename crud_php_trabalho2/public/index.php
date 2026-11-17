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
Descritivo: Ponto de entrada, roteamento e processamento das ações do CRUD.
*/
require_once __DIR__ . '/../config/database.php'; // Carrega a classe que conecta ao banco.
require_once __DIR__ . '/../controllers/CategoriaController.php'; // Carrega as ações de categorias.
require_once __DIR__ . '/../controllers/ProdutoController.php'; // Carrega as ações de produtos.
require_once __DIR__ . '/../controllers/AutomovelController.php'; // Carrega as ações de automóveis.
$db = (new Database())->getConnection(); // Abre a conexão com o banco de dados.
$page = $_GET['page'] ?? 'automoveis'; // Escolhe a área solicitada; automóveis é a página inicial.
if (!in_array($page, ['automoveis', 'categorias', 'produtos'], true)) $page = 'automoveis'; // Usa automóveis se a área não existir.
$action = $_GET['action'] ?? 'list'; // Lê a ação solicitada ou mostra a listagem.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Lê e valida o identificador enviado pela URL.
$controller = $page === 'categorias' ? new CategoriaController($db) : ($page === 'automoveis' ? new AutomovelController($db) : new ProdutoController($db)); // Cria o controlador da área escolhida.
$redirect = 'index.php?page=' . $page; // Prepara o endereço de retorno para a mesma área.
$sep = '&'; // Define o separador dos parâmetros adicionais da URL.

if ($action === 'save' && $_SERVER['REQUEST_METHOD'] === 'POST') { // Processa um formulário enviado pelo método POST.
    if ($page === 'categorias') { // Salva uma categoria.
        $nome = trim($_POST['nome'] ?? ''); // Lê o nome da categoria e remove espaços das pontas.
        $ok = $nome !== '' && $controller->salvar($nome, $id ?: null); // Salva a categoria se o nome foi preenchido.
    } elseif ($page === 'automoveis') { // Salva um automóvel.
        $dados = [ // Guarda os dados recebidos do formulário.
            'marca' => trim($_POST['marca'] ?? ''), // Lê a marca informada no formulário.
            'ano' => filter_var($_POST['ano'] ?? null, FILTER_VALIDATE_INT), // Lê o ano e verifica se é inteiro.
            'cor' => trim($_POST['cor'] ?? ''), // Lê a cor e remove espaços das pontas.
            'preco' => filter_var($_POST['preco'] ?? null, FILTER_VALIDATE_FLOAT) // Lê o preço e verifica se é número.
        ]; // Termina a lista de dados do automóvel.
        $ok = $dados['marca'] !== '' && $dados['cor'] !== '' // Exige marca e cor preenchidas.
            && $dados['ano'] !== false && $dados['ano'] >= 1886 && $dados['ano'] <= (int)date('Y') + 1 // Confere se o ano está dentro do intervalo permitido.
            && $dados['preco'] !== false && $dados['preco'] >= 0; // Confere ano válido e preço igual ou maior que zero.
        if ($ok) $ok = $controller->salvar($dados, $id ?: null); // Salva o automóvel quando os dados são válidos.
    } else { // Como a página não é categoria nem automóvel, trata o cadastro de produto.
        $dados = [ // Guarda os dados recebidos do formulário de produto.
            'nome' => trim($_POST['nome'] ?? ''), // Lê o nome do produto.
            'descricao' => trim($_POST['descricao'] ?? ''), // Lê a descrição do produto.
            'preco' => filter_var($_POST['preco'] ?? null, FILTER_VALIDATE_FLOAT), // Lê e valida o preço do produto.
            'categoria_id' => filter_var($_POST['categoria_id'] ?? null, FILTER_VALIDATE_INT) // Lê e valida a categoria escolhida.
        ]; // Termina a lista de dados do produto.
        $ok = $dados['nome'] !== '' && $dados['preco'] !== false && $dados['preco'] >= 0
            && $dados['categoria_id'] && $controller->salvar($dados, $id ?: null); // Salva o produto se todos os campos forem válidos.
    } // Termina o tratamento do formulário da área selecionada.
    header('Location: ' . $redirect . $sep . 'mensagem=' . urlencode($ok ? 'Salvo com sucesso!' : 'Confira os campos e tente novamente.')); // Retorna à página com o resultado da operação.
    exit; // Encerra o processamento após o redirecionamento.
} // Termina o tratamento do salvamento.
if ($action === 'delete' && $id) { // Verifica se foi solicitada a exclusão de um registro.
    $controller->excluir($id); // Pede ao controlador para excluir o registro.
    header('Location: ' . $redirect . $sep . 'mensagem=' . urlencode('Registro excluído.')); // Volta à lista com uma mensagem.
    exit; // Encerra o processamento após o redirecionamento.
} // Termina o tratamento da exclusão.
if ($page === 'automoveis') { // Prepara a página de automóveis.
    $automoveis = $controller->listar(); // Busca todos os automóveis cadastrados.
    $item = ['marca'=>'','ano'=>'','cor'=>'','preco'=>'']; // Define os valores vazios para um cadastro novo.
    if ($action === 'edit') { // Se a ação for editar, carrega o automóvel escolhido.
        $item = $id ? $controller->buscar($id) : false; // Busca os dados do automóvel que será editado.
        if (!$item) { // Verifica se o automóvel solicitado existe.
            header('Location: ' . $redirect . '&mensagem=' . urlencode('Automóvel não encontrado.')); // Mostra uma mensagem se não foi encontrado.
            exit; // Encerra o processamento após o redirecionamento.
        } // Termina a verificação do automóvel.
    } // Termina a preparação da edição.
    require __DIR__ . '/../views/automoveis/index_auto.php'; // Exibe a tela de automóveis.
} elseif ($page === 'categorias') { // Caso contrário, prepara a página de categorias.
    $categorias = $controller->listar(); // Busca todas as categorias cadastradas.
    $item = ($action === 'edit' && $id) ? ($controller->buscar($id) ?: ['nome' => '']) : ['nome' => '']; // Prepara a categoria a editar ou um formulário vazio.
    require __DIR__ . '/../views/categorias/index_cat.php'; // Exibe a tela de categorias.
} else { // Para as demais páginas válidas, prepara a página de produtos.
    $categorias = $controller->listarCategorias(); // Busca as categorias usadas nos produtos.
    $produtos = $controller->listar(); // Busca todos os produtos cadastrados.
    $item = ($action === 'edit' && $id) // Se estiver editando, busca o produto selecionado.
        ? ($controller->buscar($id) ?: ['nome' => '', 'descricao' => '', 'preco' => '', 'categoria_id' => ''])
        : ['nome' => '', 'descricao' => '', 'preco' => '', 'categoria_id' => '']; // Se for novo, começa com os campos vazios.
    require __DIR__ . '/../views/produtos/index_prod.php'; // Exibe a tela de produtos.
} // Encerra as opções de página do sistema.
?>
