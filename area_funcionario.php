<?php
session_start();

require_once "includes/conexao.php";
// Verifica se o funcionário está logado
if (!isset($_SESSION['usuario_funcionario'])) {
    header("Location: login.php");
    exit();
}



// Consulta todos os livros
$sql = "SELECT * FROM livros";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área do Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">


<div style="margin: 20px;">
    <a href="cadastrar_funcionario.php" style="
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    ">Cadastrar Funcionário</a>
</div>


<div class="container mt-5">
    <h2 class="mb-4">📚 Área do Funcionário</h2>

    <a href="cadastrar.php" class="btn btn-success mb-3">➕ Cadastrar Novo Livro</a>
    <a href="logout.php" class="btn btn-danger mb-3 float-end">Sair</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Ano</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($livro = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?= $livro['id'] ?></td>
                <td><?= htmlspecialchars($livro['titulo']) ?></td>
                <td><?= htmlspecialchars($livro['autor']) ?></td>
                <td><?= htmlspecialchars($livro['genero']) ?></td>
                <td><?= $livro['ano_publicacao'] ?></td>
                <td><?= $livro['status'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $livro['id'] ?>" class="btn btn-primary btn-sm">✏️ Editar</a>
                    <a href="db/excluir_livro.php?id=<?= $livro['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este livro?')">🗑 Excluir</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>